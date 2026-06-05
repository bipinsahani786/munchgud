@extends('storefront.layout')

@section('title', 'Order Success - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen py-24">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="w-24 h-24 bg-mg-green rounded-full text-white flex items-center justify-center mx-auto mb-8 premium-shadow animate-bounce">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        </div>
        
        <h1 class="text-4xl font-serif text-munch-900 mb-4">Thank you for your order!</h1>
        <p class="text-lg text-munch-600 mb-8 font-light">Your order <span class="font-bold text-mg-green">#{{ $order->order_number }}</span> has been successfully placed. We've sent a confirmation email with your order details.</p>
        
        <!-- Estimated Delivery Date Callout -->
        <div class="bg-emerald-50 border border-emerald-100 p-6 rounded-3xl mb-8 text-left premium-shadow flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 text-2xl">
                🚚
            </div>
            <div>
                <h4 class="font-bold text-mg-dark text-sm uppercase tracking-wide">Estimated Delivery Date</h4>
                <p class="text-lg text-mg-green font-extrabold mt-1">
                    {{ $order->estimated_delivery_date->format('l, d M Y') }}
                </p>
                <p class="text-xs text-mg-muted mt-1">We will deliver your order to {{ $order->shipping_city }} by this date.</p>
            </div>
        </div>

        <div class="bg-white p-8 border border-munch-200 premium-shadow mb-10 text-left rounded-3xl">
            <h3 class="font-serif text-xl text-munch-900 mb-6 border-b border-munch-100 pb-4">Order Summary</h3>
            
            <div class="space-y-4 mb-6">
                @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <span class="text-munch-700">{{ $item->product_name }} ({{ $item->sku_name }}) x{{ $item->quantity }}</span>
                        <span class="text-munch-900 font-medium font-mono">₹{{ number_format($item->total_price, 2) }}</span>
                    </div>
                @endforeach
            </div>
            
            <div class="border-t border-munch-100 pt-4 space-y-2 text-sm text-munch-600">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="font-mono">₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount_amount > 0)
                <div class="flex justify-between text-munch-accent font-medium">
                    <span>Discount</span>
                    <span class="font-mono">-₹{{ number_format($order->discount_amount, 2) }}</span>
                </div>
                @endif
                <div class="flex justify-between">
                    <span>Shipping</span>
                    <span>{{ $order->shipping_amount == 0 ? 'Free' : '₹'.number_format($order->shipping_amount, 2) }}</span>
                </div>
                <div class="flex justify-between border-t border-munch-100 pt-4 mt-2">
                    <span class="text-base font-bold text-munch-900">Total Paid</span>
                    <span class="text-xl font-serif font-bold text-mg-green font-mono">₹{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center bg-mg-green text-white px-8 py-4 font-bold rounded-full hover:bg-mg-green-dark transition-all uppercase tracking-widest text-xs shadow-md shadow-mg-green/20">
                Continue Shopping
            </a>
            <a href="{{ route('account.orders') }}" class="inline-flex items-center justify-center bg-white border border-munch-300 text-munch-900 px-8 py-4 font-bold rounded-full hover:bg-munch-50 transition-all uppercase tracking-widest text-xs shadow-sm">
                Track Your Order
            </a>
        </div>
    </div>
</div>
@endsection
