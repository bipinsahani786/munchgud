@extends('admin.layouts.app')

@section('title', 'Orders')
@section('header', 'Orders')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-mg-dark tracking-tight">Order Management</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">View, track, and manage all customer orders.</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-white/50">
        <form action="" method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="relative group flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-mg-green transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Order #..." class="w-full border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green transition-all outline-none bg-gray-50/50 focus:bg-white text-gray-700 font-medium placeholder-gray-400">
            </div>
            
            <div class="flex gap-3">
                <select name="status" class="w-full sm:w-48 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green transition-all outline-none bg-gray-50/50 focus:bg-white text-gray-700 font-medium cursor-pointer appearance-none">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-mg-dark transition-colors shadow-sm">Filter</button>
            </div>
        </form>
    </div>
    
    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Order #</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Customer</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Payment</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Total</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors group cursor-pointer" onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                        <td class="px-6 py-4">
                            <span class="font-bold text-mg-dark group-hover:text-mg-green transition text-base">{{ $order->order_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-mg-green font-bold text-xs">
                                    {{ substr($order->user->name ?? 'G', 0, 1) }}
                                </div>
                                <div class="font-medium text-gray-900">{{ $order->user->name ?? 'Guest' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex text-[11px] leading-5 font-bold rounded-full border 
                                {{ $order->status === 'delivered' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                {{ $order->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                {{ $order->status === 'processing' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                {{ $order->status === 'shipped' ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                {{ !in_array($order->status, ['delivered','pending','processing','shipped','cancelled']) ? 'bg-gray-100 text-gray-800 border-gray-200' : '' }}
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-semibold text-gray-900 text-xs flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full {{ $order->payment_status === 'paid' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                                <span class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-widest">{{ $order->payment_method }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold text-mg-dark text-base">₹{{ number_format($order->total, 2) }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="text-gray-500 font-medium text-xs">{{ $order->created_at->format('M d, Y') }}</div>
                            <div class="text-gray-400 text-[11px] mt-0.5">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No orders found</h3>
                                <p class="text-gray-500 text-sm font-medium">There are no orders matching your criteria.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
