<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Services\CartService;
use App\Services\OrderService;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createOrder(Request $request, CartService $cartService) {
        $summary = $cartService->getSummary();
        
        if ($summary['items_count'] === 0) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
        }

        try {
            $receiptId = 'rcpt_' . auth()->id() . '_' . time();
            $razorpayOrder = $this->paymentService->createRazorpayOrder($summary['total'], $receiptId);
            
            // Store address temporarily in session if creating order
            if ($request->address_id) {
                $address = auth()->user()->addresses()->find($request->address_id);
                if ($address) {
                    session(['temp_checkout_address' => $address->toArray()]);
                }
            } elseif ($request->address_data) {
                session(['temp_checkout_address' => $request->address_data]);
            }
            
            return response()->json([
                'success' => true, 
                'razorpay_order_id' => $razorpayOrder['id'], 
                'amount' => $summary['total'] * 100, 
                'key' => \App\Models\Setting::get('razorpay_key')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment initiation failed'], 500);
        }
    }

    public function verify(Request $request, OrderService $orderService) {
        $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required'
        ]);

        $isValid = $this->paymentService->verifySignature(
            $request->razorpay_order_id,
            $request->razorpay_payment_id,
            $request->razorpay_signature
        );

        if (!$isValid && \App\Models\Setting::get('razorpay_key')) {
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
        }

        try {
            $addressData = session('temp_checkout_address', []);
            $order = $orderService->createFromCart($addressData, 'razorpay', auth()->id());
            
            $order->payment()->create([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'amount' => $order->total,
                'status' => 'paid',
                'raw_response' => $request->all()
            ]);
            
            $order->update(['payment_status' => 'paid']);
            
            session()->forget('temp_checkout_address');
            
            return response()->json([
                'success' => true, 
                'order_number' => $order->order_number,
                'redirect_url' => route('checkout.success', ['orderNumber' => $order->order_number])
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Order creation failed'], 500);
        }
    }

    public function webhook(Request $request) {
        // Handle webhook for async captures/failures
        return response()->json(['status' => 'ok']);
    }
}
