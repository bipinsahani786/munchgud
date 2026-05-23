<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\ProductSku;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartService
{
    private function getKey(): array
    {
        if (Auth::check()) {
            return ['user_id' => Auth::id()];
        }
        return ['session_id' => Session::getId()];
    }

    public function getItems(): Collection
    {
        return CartItem::where($this->getKey())
            ->with(['sku.product.primaryImage', 'sku.product.category', 'sku.variantOptions'])
            ->get();
    }

    public function addItem(int $skuId, int $qty = 1): void
    {
        $sku = ProductSku::findOrFail($skuId);
        if ($sku->stock_qty <= 0) return;

        $key = $this->getKey();
        $cartItem = CartItem::where($key)->where('product_sku_id', $skuId)->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $qty;
            $cartItem->quantity = min($newQty, $sku->stock_qty);
            $cartItem->save();
        } else {
            CartItem::create(array_merge($key, [
                'product_sku_id' => $skuId,
                'quantity' => min($qty, $sku->stock_qty)
            ]));
        }
    }

    public function updateQty(int $cartItemId, int $qty): void
    {
        $cartItem = CartItem::where($this->getKey())->where('id', $cartItemId)->firstOrFail();
        
        if ($qty <= 0) {
            $cartItem->delete();
            return;
        }

        $cartItem->quantity = min($qty, $cartItem->sku->stock_qty);
        $cartItem->save();
    }

    public function removeItem(int $cartItemId): void
    {
        CartItem::where($this->getKey())->where('id', $cartItemId)->delete();
    }

    public function clear(): void
    {
        CartItem::where($this->getKey())->delete();
        $this->removeCoupon();
    }

    public function mergeGuestCart(string $sessionId): void
    {
        if (!Auth::check()) return;

        $guestItems = CartItem::where('session_id', $sessionId)->get();
        $userId = Auth::id();

        foreach ($guestItems as $item) {
            $existing = CartItem::where('user_id', $userId)
                ->where('product_sku_id', $item->product_sku_id)
                ->first();
                
            if ($existing) {
                $existing->quantity = min($existing->quantity + $item->quantity, $existing->sku->stock_qty);
                $existing->save();
                $item->delete();
            } else {
                $item->user_id = $userId;
                $item->session_id = null;
                $item->save();
            }
        }
    }

    public function applyCoupon(string $code): array
    {
        $coupon = Coupon::where('code', $code)->first();
        
        if (!$coupon) {
            return ['success' => false, 'message' => 'Invalid coupon code.', 'discount' => 0];
        }

        $items = $this->getItems();
        $subtotal = $items->sum(function($item) {
            return $item->quantity * $item->sku->sale_price;
        });

        if (!$coupon->isValid($subtotal)) {
            return ['success' => false, 'message' => 'Coupon criteria not met or expired.', 'discount' => 0];
        }

        Session::put('coupon_id', $coupon->id);
        
        return [
            'success' => true, 
            'message' => 'Coupon applied successfully.', 
            'discount' => $coupon->calculateDiscount($subtotal)
        ];
    }

    public function removeCoupon(): void
    {
        Session::forget('coupon_id');
    }

    public function getSummary(): array
    {
        $items = $this->getItems();
        $subtotal = $items->sum(function($item) {
            return $item->quantity * $item->sku->sale_price;
        });

        $discount = 0;
        $coupon = null;
        if (Session::has('coupon_id')) {
            $coupon = Coupon::find(Session::get('coupon_id'));
            if ($coupon && $coupon->isValid($subtotal)) {
                $discount = $coupon->calculateDiscount($subtotal);
            } else {
                $this->removeCoupon();
                $coupon = null;
            }
        }
        
        $mrpTotal = $items->sum(function($item) {
            return $item->quantity * $item->sku->mrp;
        });
        
        $itemDiscount = max(0, $mrpTotal - $subtotal);

        $afterDiscount = max(0, $subtotal - $discount);
        
        $freeShippingThreshold = settings('free_shipping_threshold', 499);
        $shipping = ($afterDiscount >= $freeShippingThreshold || $afterDiscount == 0) 
            ? 0 
            : settings('flat_shipping_rate', 50);

        $taxPercent = settings('gst_percent', 18);
        $tax = round($afterDiscount * ($taxPercent / 100), 2);

        $total = $afterDiscount + $shipping + $tax;

        return [
            'subtotal' => round($subtotal, 2),
            'mrp_total' => round($mrpTotal, 2),
            'item_discount' => round($itemDiscount, 2),
            'discount' => round($discount, 2),
            'shipping' => round($shipping, 2),
            'tax' => round($tax, 2),
            'total' => round($total, 2),
            'coupon' => $coupon,
            'items_count' => $items->sum('quantity'),
            'items' => $items
        ];
    }
}
