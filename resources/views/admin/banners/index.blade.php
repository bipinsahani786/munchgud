@extends('admin.layouts.app')

@section('title', 'Banners')
@section('header', 'Storefront Banners')

@section('content')
<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Banners</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Manage the hero banners displayed on your storefront.</p>
    </div>
    <a href="{{ route('admin.banners.create') }}" class="px-4 py-2 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition shadow-sm text-sm inline-flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Add Banner
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($banners as $banner)
        <div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden group">
            <div class="relative h-48 bg-gray-100">
                <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                    <a href="{{ route('admin.banners.edit', $banner) }}" class="p-2 bg-white text-gray-900 rounded-lg hover:bg-gray-100 transition" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    </a>
                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition" title="Delete">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
                @if(!$banner->is_active)
                    <div class="absolute top-3 left-3 px-2 py-1 bg-white/90 backdrop-blur-sm text-gray-900 text-[10px] font-bold uppercase tracking-widest rounded shadow-sm">
                        Hidden
                    </div>
                @endif
                <div class="absolute top-3 right-3 w-6 h-6 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-xs font-bold text-gray-700 shadow-sm">
                    {{ $banner->sort_order }}
                </div>
            </div>
            <div class="p-5">
                <h3 class="font-bold text-gray-900 text-lg mb-1 truncate">{{ $banner->title }}</h3>
                <p class="text-sm text-gray-500 truncate">{{ $banner->subtitle ?? 'No subtitle' }}</p>
                @if($banner->link_url)
                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-400 truncate">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        {{ $banner->link_url }}
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 text-center bg-white border border-gray-100 rounded-2xl shadow-sm">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">No banners found</h3>
            <p class="text-gray-500 text-sm font-medium mb-5">Upload a hero banner to display on your storefront.</p>
            <a href="{{ route('admin.banners.create') }}" class="px-5 py-2.5 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition inline-flex items-center gap-2 text-sm">
                Add First Banner
            </a>
        </div>
    @endforelse
</div>
@endsection
