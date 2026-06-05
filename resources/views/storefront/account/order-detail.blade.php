@extends('storefront.account.layout')

@section('account_content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="font-heading text-3xl font-bold text-mg-dark flex items-center gap-3">
            Order #{{ $order->order_number }}
            <span class="inline-block px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full 
                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : 
                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700') }}">
                {{ $order->status }}
            </span>
            @if($order->status === 'cancelled' && $order->payment_status === 'refunded')
                <span class="inline-block px-3 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full bg-blue-100 text-blue-700">
                    Refunded
                </span>
            @endif
        </h2>
    </div>
    <a href="{{ route('account.orders') }}" class="text-sm font-semibold text-mg-muted hover:text-mg-green flex items-center gap-1">
        &larr; Back to Orders
    </a>
</div>

@if($order->status === 'cancelled')
<div class="bg-red-50 border border-red-100 p-5 rounded-3xl text-red-800 text-sm font-medium mb-8 flex flex-col gap-2 shadow-sm">
    <div class="flex items-center gap-2">
        <span class="text-lg">❌</span>
        <span class="font-bold text-red-900">This order has been cancelled.</span>
    </div>
    @if($order->payment_status === 'refunded')
        <div class="flex items-center gap-2 mt-1 bg-blue-50 border border-blue-100 text-blue-800 p-3 rounded-xl">
            <span class="text-base">💰</span>
            <span class="font-bold text-blue-900">Your refund has been processed successfully to your original payment source.</span>
        </div>
    @endif
    @if($order->cancelled_reason)
        <p class="text-sm text-red-700 bg-white/60 p-4 rounded-xl border border-red-200/50 mt-1 font-semibold">
            <span class="text-xs text-red-500 uppercase tracking-wider block mb-1">Reason for Cancellation</span>
            {{ $order->cancelled_reason }}
        </p>
    @endif
</div>
@endif

<div class="bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5 mb-8">
    <h3 class="font-bold text-mg-dark mb-6">Live Tracking</h3>
    
    <!-- Interactive Logistics Tracking Map (iframe) -->
    {{-- 
    <div class="w-full h-96 rounded-2xl overflow-hidden border border-mg-dark/10 shadow-sm mb-8 bg-mg-cream relative">
        <iframe src="{{ route('account.orders.map', $order->id) }}" class="absolute inset-0 w-full h-full border-0" allowfullscreen></iframe>
    </div>
    --}}
    
    @if($order->status !== 'delivered' && $order->status !== 'cancelled')
    <div class="bg-emerald-50 border border-emerald-100/50 p-5 rounded-2xl mb-6 flex items-start gap-3">
        <span class="text-xl shrink-0">📅</span>
        <div>
            <h4 class="font-bold text-mg-dark text-xs uppercase tracking-wide">Estimated Delivery Date</h4>
            <p class="text-sm font-extrabold text-mg-green mt-0.5">
                {{ $order->estimated_delivery_date->format('l, d M Y') }}
            </p>
        </div>
    </div>
    @endif
    
    @php
        $trackings = \App\Models\OrderTracking::where('order_id', $order->id)->orderBy('tracked_at', 'desc')->get();
    @endphp

    @if($trackings->isEmpty())
        <div class="bg-orange-50 border border-orange-100 p-4 rounded-xl text-orange-800 text-sm font-medium mb-6">
            Tracking information is not available yet. We'll update this once your order ships.
        </div>
    @else
        <div class="relative border-l-2 border-mg-green/20 ml-3 mb-8">
            @foreach($trackings as $index => $track)
                <div class="mb-6 ml-6 relative">
                    <span class="absolute -left-[2.1rem] w-4 h-4 rounded-full {{ $index === 0 ? 'bg-mg-green ring-4 ring-mg-green/20' : 'bg-mg-dark/20' }}"></span>
                    <h4 class="text-sm font-bold {{ $index === 0 ? 'text-mg-green' : 'text-mg-dark' }}">{{ $track->status }}</h4>
                    @if($track->location)
                        <p class="text-xs text-mg-muted mt-1 font-medium">{{ $track->location }}</p>
                    @endif
                    @if($track->description)
                        <p class="text-xs text-mg-dark/70 mt-1">{{ $track->description }}</p>
                    @endif
                    <p class="text-[10px] text-mg-muted mt-1 uppercase tracking-wider">{{ $track->tracked_at->format('d M Y, h:i A') }}</p>
                </div>
            @endforeach
        </div>
    @endif
    
    <div class="flex gap-4">
        <a href="{{ route('account.tickets.create', ['order_id' => $order->id]) }}" class="text-sm font-bold text-mg-orange bg-mg-orange/10 px-6 py-2.5 rounded-lg hover:bg-mg-orange hover:text-white transition-all">Report Issue</a>
        <a href="{{ route('account.orders.invoice', $order->id) }}" class="text-sm font-bold text-mg-dark border border-mg-dark/10 px-6 py-2.5 rounded-lg hover:bg-mg-dark/5 transition-all">Download Invoice</a>
    </div>
</div>

<div class="bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
    <h3 class="font-bold text-mg-dark mb-6">Order Items</h3>
    <div class="space-y-4">
        @foreach($order->items as $item)
            <div class="flex items-center gap-4 py-4 border-b border-mg-dark/5 last:border-0 last:pb-0">
                <div class="w-16 h-16 bg-mg-cream rounded-xl overflow-hidden flex items-center justify-center border border-mg-dark/5">
                    @if($item->sku->product->primaryImage)
                        <img src="{{ Storage::url($item->sku->product->primaryImage->path) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-xl">🥜</span>
                    @endif
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm text-mg-dark">{{ $item->product_name }}</h4>
                    <p class="text-xs text-mg-muted mt-0.5">
                        Qty: {{ $item->quantity }} • {{ $item->sku_name }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-mg-dark text-sm font-mono">₹{{ number_format($item->total_price, 2) }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pricing Summary breakdown -->
    <div class="mt-8 pt-6 border-t border-mg-dark/5 space-y-3">
        <div class="flex justify-between items-center text-sm font-medium text-mg-muted">
            <span>Subtotal</span>
            <span class="font-mono text-mg-dark">₹{{ number_format($order->subtotal, 2) }}</span>
        </div>
        @if($order->discount_amount > 0)
        <div class="flex justify-between items-center text-sm font-medium text-mg-green">
            <span>Discount (Coupon Applied)</span>
            <span class="font-mono">-₹{{ number_format($order->discount_amount, 2) }}</span>
        </div>
        @endif
        <div class="flex justify-between items-center text-sm font-medium text-mg-muted">
            <span>Shipping & Handling</span>
            <span class="font-mono text-mg-dark">
                @if($order->shipping_amount > 0)
                    ₹{{ number_format($order->shipping_amount, 2) }}
                @else
                    <span class="text-mg-green font-bold uppercase tracking-wider text-[11px]">Free</span>
                @endif
            </span>
        </div>
        @if($order->tax_amount > 0)
        <div class="flex justify-between items-center text-sm font-medium text-mg-muted">
            <span>Estimated GST/Tax</span>
            <span class="font-mono text-mg-dark">₹{{ number_format($order->tax_amount, 2) }}</span>
        </div>
        @endif
        <div class="flex justify-between items-center pt-4 border-t border-mg-dark/5">
            <span class="font-heading text-lg font-bold text-mg-dark">Grand Total</span>
            <span class="text-xl font-black font-mono text-mg-green">₹{{ number_format($order->total, 2) }}</span>
        </div>
    </div>
</div>
@endsection
