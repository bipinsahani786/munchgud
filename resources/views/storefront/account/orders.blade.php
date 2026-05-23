@extends('storefront.account.layout')

@section('account_content')
<h2 class="font-heading text-3xl font-bold text-mg-dark mb-8">Orders & Tracking</h2>

<div class="bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
    @if($orders->isEmpty())
        <div class="text-center py-10">
            <p class="text-mg-muted mb-4">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-mg-green text-white font-bold px-6 py-2 rounded-full hover:bg-mg-green-dark transition">Shop Now</a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="p-6 rounded-2xl border border-mg-dark/5 hover:border-mg-green/30 transition-colors">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 pb-6 border-b border-mg-dark/5">
                        <div>
                            <p class="text-xs text-mg-muted uppercase tracking-wider font-bold mb-1">Order #{{ $order->order_number }}</p>
                            <p class="text-sm font-semibold text-mg-dark">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="mt-4 md:mt-0 text-right">
                            <p class="text-2xl font-black font-mono text-mg-dark mb-1">₹{{ $order->total }}</p>
                            <span class="inline-block px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full 
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : 
                                   ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700') }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex -space-x-3 overflow-hidden">
                            @foreach($order->items->take(4) as $item)
                                @if($item->sku->product->primaryImage)
                                    <img src="{{ Storage::url($item->sku->product->primaryImage->path) }}" class="inline-block h-12 w-12 rounded-full ring-2 ring-white object-cover bg-mg-cream">
                                @else
                                    <div class="inline-block h-12 w-12 rounded-full ring-2 ring-white bg-mg-cream flex items-center justify-center text-xs">🥜</div>
                                @endif
                            @endforeach
                            @if($order->items->count() > 4)
                                <div class="inline-block h-12 w-12 rounded-full ring-2 ring-white bg-mg-dark/5 flex items-center justify-center text-xs font-bold text-mg-dark">+{{ $order->items->count() - 4 }}</div>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('account.orders.invoice', $order->id) }}" class="hidden sm:inline-block text-xs font-bold text-mg-muted hover:text-mg-dark px-4 py-2 border border-mg-dark/10 rounded-lg">Invoice</a>
                            <a href="{{ route('account.orders.show', $order->id) }}" class="bg-mg-green text-white text-xs font-bold px-5 py-2 rounded-lg hover:bg-mg-green-dark transition-colors">Track Order</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
