@extends('storefront.account.layout')

@section('account_content')
<h2 class="font-heading text-2xl sm:text-3xl font-bold text-mg-dark mb-6 sm:mb-8">Dashboard Overview</h2>

<div class="grid sm:grid-cols-3 gap-6 mb-10">
    <div class="bg-white rounded-3xl p-6 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
        <div class="w-12 h-12 rounded-2xl bg-mg-green/10 text-mg-green flex items-center justify-center mb-4">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        </div>
        <p class="text-3xl font-black text-mg-dark mb-1">{{ auth()->user()->orders()->count() }}</p>
        <p class="text-sm font-semibold text-mg-muted uppercase tracking-wider">Total Orders</p>
    </div>
    <div class="bg-white rounded-3xl p-6 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-mg-orange flex items-center justify-center mb-4">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p class="text-3xl font-black text-mg-dark mb-1">{{ auth()->user()->supportTickets()->count() }}</p>
        <p class="text-sm font-semibold text-mg-muted uppercase tracking-wider">Support Tickets</p>
    </div>
    <div class="bg-white rounded-3xl p-6 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-500 flex items-center justify-center mb-4">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <p class="text-3xl font-black text-mg-dark mb-1">{{ auth()->user()->addresses()->count() }}</p>
        <p class="text-sm font-semibold text-mg-muted uppercase tracking-wider">Saved Addresses</p>
    </div>
</div>

<div class="bg-white rounded-3xl p-5 sm:p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-heading text-xl font-bold text-mg-dark">Recent Orders</h3>
        <a href="{{ route('account.orders') }}" class="text-sm font-semibold text-mg-green hover:underline">View All</a>
    </div>
    @if($recentOrders->isEmpty())
        <div class="text-center py-10">
            <p class="text-mg-muted mb-4">You haven't placed any orders yet.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-mg-green text-white font-bold px-6 py-2 rounded-full hover:bg-mg-green-dark transition">Shop Now</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($recentOrders as $order)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-4 rounded-2xl border border-mg-dark/5 hover:border-mg-green/30 transition-colors">
                    <div>
                        <p class="font-bold text-mg-dark mb-1">{{ $order->order_number }}</p>
                        <p class="text-xs text-mg-muted">{{ $order->created_at->format('M d, Y') }} • ₹{{ $order->total }}</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex items-center gap-4">
                        <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full 
                            {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : 
                               ($order->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-orange-100 text-orange-700') }}">
                            {{ $order->status }}
                        </span>
                        <a href="{{ route('account.orders.show', $order->id) }}" class="text-sm font-semibold text-mg-green hover:underline">Track & View</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
