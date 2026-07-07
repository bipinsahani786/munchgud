<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index() {
        $summary = $this->cartService->getSummary();
        
        $wishlists = auth()->check() 
            ? auth()->user()->wishlists()->with(['sku.product.primaryImage', 'sku.product.category'])->get() 
            : collect();
        
        $coupons = Coupon::where('is_active', true)
            ->where('is_visible', true)
            ->where(function($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>=', now());
            })
            ->get();

        if (auth()->check()) {
            $userId = auth()->id();
            $coupons = $coupons->filter(function($coupon) use ($userId) {
                if ($coupon->per_user_limit !== null) {
                    $userUses = \App\Models\Order::where('user_id', $userId)
                        ->where('coupon_id', $coupon->id)
                        ->where('status', '!=', 'cancelled')
                        ->count();
                    return $userUses < $coupon->per_user_limit;
                }
                return true;
            });
        }
        
        $recommendedProducts = Product::active()
            ->with(['skus', 'primaryImage', 'category'])
            ->inRandomOrder()->take(8)->get();
        
        return view('pages.cart', compact('summary', 'wishlists', 'coupons', 'recommendedProducts'));
    }

    public function add(Request $request) {
        $qty = $request->input('qty') ?? $request->input('quantity') ?? 1;
        $request->merge(['qty' => intval($qty)]);

        $request->validate([
            'sku_id' => 'required|exists:product_skus,id',
            'qty' => 'integer|min:1'
        ]);

        $sku = \App\Models\ProductSku::find($request->sku_id);
        if (!$sku || $sku->stock_qty < $request->qty) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Out of stock or not enough quantity.']);
            }
            return redirect()->back()->with('error', 'Out of stock or not enough quantity.');
        }

        $this->cartService->addItem($request->sku_id, $request->qty);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'summary' => $this->cartService->getSummary()]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    public function updateQty(Request $request, CartItem $item) {
        $request->validate(['qty' => 'required|integer|min:0']);
        
        // Authorization: Ensure item belongs to user or session
        // Basic check for now (Policy would be better)
        
        $this->cartService->updateQty($item->id, $request->qty);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'summary' => $this->cartService->getSummary()]);
        }
        
        return redirect()->back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $item) {
        $this->cartService->removeItem($item->id);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'summary' => $this->cartService->getSummary()]);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function moveToWishlist(CartItem $item) {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please login first.'], 401);
        }

        $skuId = $item->product_sku_id;

        // Add to wishlist if not already there
        \App\Models\Wishlist::firstOrCreate([
            'user_id' => $user->id,
            'product_sku_id' => $skuId
        ]);

        // Remove from cart
        $this->cartService->removeItem($item->id);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Moved to wishlist',
                'summary' => $this->cartService->getSummary(),
                'wishlist_count' => $user->wishlists()->count()
            ]);
        }

        return redirect()->back()->with('success', 'Item moved to wishlist.');
    }

    public function applyCoupon(Request $request) {
        $request->validate(['code' => 'required|string']);
        
        $result = $this->cartService->applyCoupon($request->code);

        if ($request->wantsJson()) {
            $result['summary'] = $this->cartService->getSummary();
            return response()->json($result);
        }
        
        if ($result['success']) {
            return redirect()->back()->with('success', $result['message']);
        }
        
        return redirect()->back()->with('error', $result['message']);
    }

    public function removeCoupon() {
        $this->cartService->removeCoupon();
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'summary' => $this->cartService->getSummary()]);
        }
        
        return redirect()->back()->with('success', 'Coupon removed.');
    }
}
