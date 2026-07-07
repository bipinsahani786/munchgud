@extends('admin.layouts.app')

@section('title', 'Customer Details')
@section('header', 'Customer Details')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.customers.index') }}" class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">{{ $user->name }}</h1>
            <p class="text-xs text-gray-500 font-medium mt-0.5">Joined {{ $user->created_at->format('M d, Y') }}</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <form action="{{ route('admin.customers.toggle', $user) }}" method="POST">
            @csrf
            @method('PATCH')
            @if($user->is_active)
                <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 hover:bg-red-100 font-semibold rounded-xl transition text-sm">Block Customer</button>
            @else
                <button type="submit" class="px-4 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-100 font-semibold rounded-xl transition text-sm">Activate Customer</button>
            @endif
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Details & Stats -->
    <div class="space-y-6">
        
        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
            <div class="w-20 h-20 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-2xl mx-auto mb-4">
                {{ substr($user->name, 0, 1) }}
            </div>
            <h2 class="text-lg font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
            <div class="inline-flex items-center gap-1.5 text-sm text-gray-500 mb-4">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <a href="mailto:{{ $user->email }}" class="hover:text-emerald-600 transition">{{ $user->email }}</a>
            </div>
            @if($user->phone)
            <div class="flex items-center justify-center gap-1.5 text-sm text-gray-500">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                {{ $user->phone }}
            </div>
            @endif
            
            <div class="mt-6 pt-6 border-t border-gray-100 grid grid-cols-2 gap-4">
                <div>
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Orders</div>
                    <div class="text-xl font-bold text-gray-900">{{ $user->orders->count() }}</div>
                </div>
                <div>
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Spent</div>
                    <div class="text-xl font-bold text-gray-900">₹{{ number_format($totalSpent, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Change Password Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">Change Password</h3>
            <form action="{{ route('admin.customers.change-password', $user) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1.5">New Password</label>
                    <input type="password" name="password" required placeholder="Minimum 6 characters"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wide mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation" required placeholder="Re-enter password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                <button type="submit" class="w-full bg-emerald-600 text-white text-xs font-bold py-2.5 rounded-xl hover:bg-emerald-700 transition">Update Password</button>
            </form>
        </div>

        <!-- Addresses -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Saved Addresses</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($user->addresses as $address)
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-[10px] font-bold uppercase tracking-wider rounded">{{ $address->label }}</span>
                            @if($address->is_default)
                                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-wider rounded">Default</span>
                            @endif
                        </div>
                        <p class="text-sm font-semibold text-gray-900">{{ $address->name }}</p>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                            {{ $address->line1 }}<br>
                            @if($address->line2){{ $address->line2 }}<br>@endif
                            {{ $address->city }}, {{ $address->state }} {{ $address->pincode }}
                        </p>
                    </div>
                @empty
                    <div class="p-6 text-center text-sm text-gray-400">
                        No saved addresses found.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- Right Column: Orders -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Recent Orders</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Order</th>
                            <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Date</th>
                            <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                            <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Total</th>
                            <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($user->orders as $order)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-3 font-semibold text-gray-900">{{ $order->order_number }}</td>
                                <td class="px-6 py-3 text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-3">
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-600 rounded">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 font-bold text-gray-900">₹{{ number_format($order->total, 2) }}</td>
                                <td class="px-6 py-3 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-xs">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                    This customer hasn't placed any orders yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
