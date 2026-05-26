@extends('admin.layouts.app')

@section('title', 'Edit Coupon')
@section('header', 'Edit Coupon')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.coupons.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-500 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Edit Coupon: {{ $coupon->code }}</h1>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden" x-data="couponForm()">
        <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" class="p-6">
            @csrf
            @method('PATCH')

            <div class="space-y-6">
                <!-- Code & Type -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Coupon Code <span class="text-red-500">*</span></label>
                        <input type="text" name="code" value="{{ old('code', $coupon->code) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none uppercase font-mono" required>
                        @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Discount Type <span class="text-red-500">*</span></label>
                        <select name="type" x-model="type" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                            <option value="percent">Percentage (%)</option>
                            <option value="flat">Flat Amount (₹)</option>
                            <option value="free_shipping">Free Shipping</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Description (Internal)</label>
                    <input type="text" name="description" value="{{ old('description', $coupon->description) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Values -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Discount Value <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm" x-text="type === 'flat' ? '₹' : '%'"></span>
                            <input type="number" name="value" step="0.01" value="{{ old('value', (float)$coupon->value) }}" class="w-full border border-gray-200 rounded-xl pl-8 pr-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" required>
                        </div>
                        @error('value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Min Order Amount <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">₹</span>
                            <input type="number" name="min_order_amount" step="0.01" value="{{ old('min_order_amount', (float)$coupon->min_order_amount) }}" class="w-full border border-gray-200 rounded-xl pl-8 pr-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" required>
                        </div>
                        @error('min_order_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div x-show="type === 'percent'">
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Max Discount Amount</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">₹</span>
                            <input type="number" name="max_discount_amount" step="0.01" value="{{ old('max_discount_amount', (float)$coupon->max_discount_amount) }}" class="w-full border border-gray-200 rounded-xl pl-8 pr-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        </div>
                        @error('max_discount_amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Limits & Dates -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Usage Limit</label>
                        <input type="number" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        @error('usage_limit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Start Date</label>
                        <input type="datetime-local" name="start_at" value="{{ old('start_at', $coupon->start_at ? $coupon->start_at->format('Y-m-d\TH:i') : '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        @error('start_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">End Date</label>
                        <input type="datetime-local" name="end_at" value="{{ old('end_at', $coupon->end_at ? $coupon->end_at->format('Y-m-d\TH:i') : '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        @error('end_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Visibility -->
                <div class="flex items-center gap-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-600">
                    <label for="is_active" class="text-sm font-semibold text-gray-700">Active (Can be used by customers)</label>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.coupons.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-xl transition">Cancel</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-gray-900 hover:bg-gray-800 rounded-xl transition shadow-sm">Update Coupon</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('couponForm', () => ({
            type: '{{ old('type', $coupon->type) }}',
        }))
    });
</script>
@endsection
