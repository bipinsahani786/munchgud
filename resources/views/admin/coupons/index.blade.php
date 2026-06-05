@extends('admin.layouts.app')

@section('title', 'Discount Coupons')
@section('header', 'Coupons')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Discount Coupons</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Manage promotional codes and discounts for your customers.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.coupons.create') }}" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Create Coupon
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Code & Details</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Discount</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Usage</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($coupons as $coupon)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 text-base uppercase tracking-wide flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                {{ $coupon->code }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">{{ Str::limit($coupon->description, 50) }}</div>
                            @if($coupon->end_at)
                                <div class="text-[10px] text-gray-400 mt-1 font-semibold uppercase tracking-wider">
                                    Expires: {{ $coupon->end_at->format('M d, Y') }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($coupon->type === 'free_shipping')
                                <span class="font-bold text-emerald-600">FREE Delivery</span>
                            @elseif($coupon->type === 'percent')
                                <span class="font-bold text-emerald-600">{{ number_format($coupon->value, 0) }}% OFF</span>
                                @if($coupon->max_discount_amount)
                                    <div class="text-[10px] text-gray-500 mt-0.5">Up to ₹{{ number_format($coupon->max_discount_amount, 0) }}</div>
                                @endif
                            @else
                                <span class="font-bold text-emerald-600">₹{{ number_format($coupon->value, 2) }} OFF</span>
                            @endif
                            @if($coupon->min_order_amount > 0)
                                <div class="text-[10px] text-gray-500 mt-0.5">Min Order: ₹{{ number_format($coupon->min_order_amount, 0) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-gray-900">{{ $coupon->used_count }}</span>
                                <span class="text-gray-400 text-xs">/ {{ $coupon->usage_limit ?: '∞' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1 items-start">
                                @if($coupon->is_active && (!$coupon->end_at || $coupon->end_at->isFuture()) && (!$coupon->usage_limit || $coupon->used_count < $coupon->usage_limit))
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100 rounded">Active</span>
                                @else
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-600 border border-gray-200 rounded">Inactive/Expired</span>
                                @endif

                                @if($coupon->is_visible)
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100 rounded">Public</span>
                                @else
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-100 rounded">Internal Only</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="p-2 bg-gray-50 text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-200 rounded-lg transition" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-gray-50 text-gray-500 hover:text-red-600 hover:bg-red-50 border border-gray-200 hover:border-red-200 rounded-lg transition" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No coupons found</h3>
                                <p class="text-gray-500 text-sm font-medium mb-4">Create your first discount code.</p>
                                <a href="{{ route('admin.coupons.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-xl text-sm font-semibold hover:bg-gray-800 transition">Create Coupon</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($coupons->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $coupons->links() }}
        </div>
    @endif
</div>
@endsection
