@extends('admin.layouts.app')

@section('title', 'Manage FAQs')
@section('header', 'Frequently Asked Questions')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Manage FAQs</h1>
        <p class="text-sm text-gray-500 font-medium mt-0.5">Add, edit or organize the questions your customers ask the most.</p>
    </div>
    <a href="{{ route('admin.faqs.create') }}" class="px-4 py-2 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Add New FAQ
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @if($faqs->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-6 py-4 font-bold text-xs uppercase tracking-wider text-gray-500">Order</th>
                    <th class="px-6 py-4 font-bold text-xs uppercase tracking-wider text-gray-500">Question</th>
                    <th class="px-6 py-4 font-bold text-xs uppercase tracking-wider text-gray-500">Category</th>
                    <th class="px-6 py-4 font-bold text-xs uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-4 font-bold text-xs uppercase tracking-wider text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($faqs as $faq)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-md bg-gray-100 text-gray-600 font-medium text-xs">{{ $faq->sort_order }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-900">{{ $faq->question }}</div>
                        <div class="text-xs text-gray-500 mt-1 line-clamp-1 max-w-md">{{ $faq->answer }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($faq->category)
                            <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-600 text-xs font-semibold">{{ $faq->category }}</span>
                        @else
                            <span class="text-gray-400 text-xs italic">Uncategorized</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($faq->is_active)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-600 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-gray-100 text-gray-500 text-xs font-semibold">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Hidden
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this FAQ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="p-12 text-center">
        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-gray-100">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-1">No FAQs yet</h3>
        <p class="text-gray-500 text-sm mb-5">Create your first question and answer to display on the store.</p>
        <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add First FAQ
        </a>
    </div>
    @endif
</div>
@endsection
