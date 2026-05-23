@extends('components.layout.app')

@section('title', 'My Account - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white border border-munch-200 premium-shadow">
                <div class="p-6 border-b border-munch-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-munch-900 rounded-full text-white flex items-center justify-center font-serif text-xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-munch-900">{{ $user->name }}</div>
                        <div class="text-xs text-munch-500">{{ $user->email ?? $user->phone }}</div>
                    </div>
                </div>
                <nav class="flex flex-col p-4 space-y-1">
                    <a href="{{ route('account.index') }}" class="px-4 py-2 font-medium text-sm {{ request()->routeIs('account.index') ? 'bg-munch-50 text-munch-accent' : 'text-munch-700 hover:bg-munch-50' }}">Dashboard</a>
                    <a href="{{ route('account.orders') }}" class="px-4 py-2 font-medium text-sm {{ request()->routeIs('account.orders*') ? 'bg-munch-50 text-munch-accent' : 'text-munch-700 hover:bg-munch-50' }}">Orders</a>
                    <a href="{{ route('account.addresses') }}" class="px-4 py-2 font-medium text-sm {{ request()->routeIs('account.addresses*') ? 'bg-munch-50 text-munch-accent' : 'text-munch-700 hover:bg-munch-50' }}">Addresses</a>
                    <a href="{{ route('account.wishlist') }}" class="px-4 py-2 font-medium text-sm {{ request()->routeIs('account.wishlist') ? 'bg-munch-50 text-munch-accent' : 'text-munch-700 hover:bg-munch-50' }}">Wishlist</a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-4 border-t border-munch-100 pt-4">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 font-medium text-sm text-red-600 hover:bg-red-50">Logout</button>
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="bg-white p-8 border border-munch-200 premium-shadow">
                <h2 class="text-3xl font-serif text-munch-900 mb-8">Welcome back, {{ explode(' ', $user->name)[0] }}</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
                    <div class="bg-munch-50 p-6 text-center border border-munch-200">
                        <div class="text-3xl font-serif text-munch-900 mb-2">{{ $user->orders()->count() }}</div>
                        <div class="text-sm font-medium uppercase tracking-wider text-munch-600">Total Orders</div>
                    </div>
                    <div class="bg-munch-50 p-6 text-center border border-munch-200">
                        <div class="text-3xl font-serif text-munch-900 mb-2">{{ $user->wishlists()->count() }}</div>
                        <div class="text-sm font-medium uppercase tracking-wider text-munch-600">Wishlist Items</div>
                    </div>
                    <div class="bg-munch-50 p-6 text-center border border-munch-200">
                        <div class="text-3xl font-serif text-munch-900 mb-2">₹{{ number_format($user->orders()->where('payment_status','paid')->sum('total'), 0) }}</div>
                        <div class="text-sm font-medium uppercase tracking-wider text-munch-600">Total Spent</div>
                    </div>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-serif text-munch-900">Recent Orders</h3>
                    <a href="{{ route('account.orders') }}" class="text-sm font-medium text-munch-accent hover:underline">View All</a>
                </div>
                
                @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-munch-200 text-xs font-semibold text-munch-500 uppercase tracking-wider">
                                    <th class="py-3 px-4">Order #</th>
                                    <th class="py-3 px-4">Date</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-munch-700">
                                @foreach($recentOrders as $order)
                                    <tr class="border-b border-munch-100 hover:bg-munch-50">
                                        <td class="py-4 px-4 font-medium text-munch-900">
                                            <a href="{{ route('account.orders.show', $order) }}" class="hover:text-munch-accent">{{ $order->order_number }}</a>
                                        </td>
                                        <td class="py-4 px-4">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="py-4 px-4">
                                            <span class="px-2 py-1 bg-gray-100 text-xs font-medium rounded uppercase tracking-wider
                                                {{ $order->status == 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                            ">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-right font-medium">₹{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8 bg-munch-50 border border-munch-200">
                        <p class="text-munch-600 mb-4">You haven't placed any orders yet.</p>
                        <a href="{{ route('products.index') }}" class="inline-block border border-munch-900 px-6 py-2 text-munch-900 hover:bg-munch-900 hover:text-white transition-colors text-sm font-medium">Start Shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
