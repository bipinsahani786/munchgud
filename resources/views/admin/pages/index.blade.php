@extends('admin.layouts.app')

@section('title', 'Pages CMS')
@section('header', 'Content Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Pages CMS</h1>
        <p class="text-sm text-gray-500 font-medium mt-0.5">Manage content and SEO meta tags for all storefront pages.</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100 text-xs text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Page Name</th>
                    <th class="px-6 py-4 font-semibold">Slug (URL)</th>
                    <th class="px-6 py-4 font-semibold">SEO Meta Title</th>
                    <th class="px-6 py-4 font-semibold text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($pages as $page)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $page->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-600">
                                /{{ $page->slug }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($page->meta_title)
                                <span class="text-emerald-600 font-medium text-xs">{{ $page->meta_title }}</span>
                            @else
                                <span class="text-gray-400 italic text-xs">Not set</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.pages.edit', $page) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-900 text-white text-xs font-semibold rounded-lg hover:bg-gray-800 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Edit Content
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 font-medium">No pages found in the CMS yet. Please run the PageSeeder.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
