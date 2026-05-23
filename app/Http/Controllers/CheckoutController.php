<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use App\Models\Order;

class CheckoutController extends Controller
{
    protected CartService $cartService;
    protected OrderService $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function index() {
        $summary = $this->cartService->getSummary();
        if ($summary['items_count'] === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        
        $addresses = auth()->user()->addresses()->get();
        $defaultAddress = auth()->user()->defaultAddress;
        
        return view('pages.checkout', compact('summary','addresses','defaultAddress'));
    }

    public function store(Request $request) {
        $request->validate([
            'address_id' => 'required_without:new_address|exists:addresses,id',
            'payment_method' => 'required|in:razorpay,cod'
        ]);

        $addressData = [];
        if ($request->address_id) {
            $addressData = auth()->user()->addresses()->find($request->address_id)->toArray();
        } else {
            // Logic to create and use new address if provided
        }

        if ($request->payment_method === 'razorpay') {
            // Payment will be handled by PaymentController via AJAX
            return response()->json(['success' => true, 'payment_required' => true]);
        }

        // COD
        $order = $this->orderService->createFromCart($addressData, 'cod', auth()->id());
        
        return redirect()->route('checkout.success', ['orderNumber' => $order->order_number]);
    }

    public function success(string $orderNumber) {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->with(['items.sku'])
            ->firstOrFail();
            
        return view('pages.order-success', compact('order'));
    }
}
