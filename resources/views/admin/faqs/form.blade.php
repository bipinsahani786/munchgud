@extends('admin.layouts.app')

@section('title', isset($faq) ? 'Edit FAQ' : 'Add FAQ')
@section('header', 'Frequently Asked Questions')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-bold text-gray-900">{{ isset($faq) ? 'Edit FAQ' : 'Add New FAQ' }}</h1>
        <p class="text-sm text-gray-500 font-medium mt-0.5">Provide a clear question and a helpful answer.</p>
    </div>
    <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm">
        Back to FAQs
    </a>
</div>

<form action="{{ isset($faq) ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}" method="POST">
    @csrf
    @if(isset($faq)) @method('PATCH') @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 grid md:grid-cols-2 gap-6">
            
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Question <span class="text-red-500">*</span></label>
                <input type="text" name="question" value="{{ old('question', $faq->question ?? '') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" placeholder="e.g. What are the shipping charges?">
                @error('question') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Answer <span class="text-red-500">*</span></label>
                <textarea name="answer" rows="4" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none leading-relaxed" placeholder="e.g. We offer free shipping on all orders above ₹999.">{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Category (Optional)</label>
                <input type="text" name="category" value="{{ old('category', $faq->category ?? '') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" placeholder="e.g. shipping, product, general">
                @error('category') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                <p class="text-[11px] text-gray-400 mt-1.5">Lower numbers appear first.</p>
                @error('sort_order') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="flex items-center gap-3 cursor-pointer p-4 border border-gray-100 rounded-xl bg-gray-50/50 hover:bg-gray-50 transition">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="is_active" value="1" class="peer sr-only" {{ old('is_active', $faq->is_active ?? true) ? 'checked' : '' }}>
                        <div class="w-10 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Active (Visible)</div>
                        <div class="text-xs text-gray-500 mt-0.5">Toggle to show or hide this FAQ on the storefront.</div>
                    </div>
                </label>
            </div>

        </div>
    </div>

    <!-- Save -->
    <div class="flex items-center justify-end gap-3 mt-6">
        <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">Cancel</a>
        <button type="submit" class="px-6 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 transition shadow-sm shadow-emerald-500/20">
            {{ isset($faq) ? 'Update FAQ' : 'Save FAQ' }}
        </button>
    </div>
</form>
@endsection
