<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ActivityLog;
use App\Models\ProductSku;
use App\Events\OrderPlaced;
use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected CartService $cartService;
    protected PaymentService $paymentService;

    public function __construct(CartService $cartService, PaymentService $paymentService)
    {
        $this->cartService = $cartService;
        $this->paymentService = $paymentService;
    }

    public function createFromCart(array $addressData, string $paymentMethod, ?int $userId): Order
    {
        return DB::transaction(function () use ($addressData, $paymentMethod, $userId) {
            $summary = $this->cartService->getSummary();
            
            if ($summary['items_count'] === 0) {
                throw new \Exception('Cart is empty.');
            }

            $order = Order::create([
                'user_id' => $userId,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $paymentMethod,
                'subtotal' => $summary['subtotal'],
                'discount_amount' => $summary['discount'],
                'shipping_amount' => $summary['shipping'],
                'tax_amount' => $summary['tax'],
                'total' => $summary['total'],
                'coupon_id' => $summary['coupon'] ? $summary['coupon']->id : null,
                'shipping_name' => $addressData['name'] ?? '',
                'shipping_phone' => $addressData['phone'] ?? '',
                'shipping_line1' => $addressData['line1'] ?? '',
                'shipping_line2' => $addressData['line2'] ?? null,
                'shipping_city' => $addressData['city'] ?? '',
                'shipping_state' => $addressData['state'] ?? '',
                'shipping_pincode' => $addressData['pincode'] ?? '',
            ]);

            foreach ($summary['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_sku_id' => $item->product_sku_id,
                    'product_name' => $item->sku->product->name,
                    'sku_name' => $item->sku->name,
                    'sku_code' => $item->sku->sku_code,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->sku->sale_price,
                    'total_price' => $item->quantity * $item->sku->sale_price
                ]);

                // Deduct stock
                $item->sku->decrement('stock_qty', $item->quantity);
            }

            if ($summary['coupon']) {
                $summary['coupon']->increment('used_count');
            }

            $this->cartService->clear();

            event(new OrderPlaced($order));

            return $order;
        });
    }

    public function updateStatus(int $orderId, string $status, ?int $adminId = null): Order
    {
        $order = Order::findOrFail($orderId);
        $oldStatus = $order->status;
        
        $order->status = $status;
        
        if ($status === 'shipped' && !$order->shipped_at) {
            $order->shipped_at = now();
        }
        if ($status === 'delivered' && !$order->delivered_at) {
            $order->delivered_at = now();
        }
        
        $order->save();

        ActivityLog::log('Order Status Updated', "Status changed from {$oldStatus} to {$status}", $order, $adminId);
        
        event(new OrderStatusUpdated($order, $oldStatus));

        return $order;
    }

    public function cancelOrder(int $orderId, string $reason, ?int $adminId = null): Order
    {
        return DB::transaction(function () use ($orderId, $reason, $adminId) {
            $order = Order::with(['items.sku', 'payment'])->findOrFail($orderId);
            
            if (in_array($order->status, ['cancelled', 'delivered'])) {
                throw new \Exception('Order cannot be cancelled in current state.');
            }

            $oldStatus = $order->status;
            
            $order->status = 'cancelled';
            $order->cancelled_reason = $reason;
            $order->save();

            // Restore stock
            foreach ($order->items as $item) {
                if ($item->sku) {
                    $item->sku->increment('stock_qty', $item->quantity);
                }
            }

            // Refund if paid
            if ($order->payment_status === 'paid' && $order->payment) {
                $this->paymentService->initiateRefund($order->payment->razorpay_payment_id, $order->total);
                $order->payment_status = 'refunded';
                $order->save();
            }

            ActivityLog::log('Order Cancelled', "Reason: {$reason}", $order, $adminId);

            event(new OrderStatusUpdated($order, $oldStatus));

            return $order;
        });
    }
}
