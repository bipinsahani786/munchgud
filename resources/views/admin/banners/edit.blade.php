@extends('admin.layouts.app')

@section('title', 'Edit Banner')
@section('header', 'Edit Banner')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.banners.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-gray-500 transition shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Edit Banner</h1>
            <p class="text-xs text-gray-500 font-medium mt-0.5">Update hero banner details.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')

            <div class="space-y-6">
                <!-- Image Upload -->
                <div x-data="imagePreview('{{ Storage::url($banner->image_path) }}')">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Banner Image</label>
                    
                    <div class="relative rounded-xl overflow-hidden border border-gray-200 bg-gray-50 mb-3 h-48 group cursor-pointer" onclick="document.getElementById('image').click()">
                        <img :src="previewUrl" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                            <p class="text-white text-sm font-bold flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Click to upload new image
                            </p>
                        </div>
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep current image. PNG, JPG up to 2MB.</p>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*" @change="updatePreview">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Text Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" required>
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        @error('subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Link (URL)</label>
                        <input type="text" name="link_url" value="{{ old('link_url', $banner->link_url) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        @error('link_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        @error('sort_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Visibility -->
                <div class="flex items-center gap-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-600">
                    <label for="is_active" class="text-sm font-semibold text-gray-700">Active (Visible on Storefront)</label>
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.banners.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-xl transition">Cancel</a>
                <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-gray-900 hover:bg-gray-800 rounded-xl transition shadow-sm">Update Banner</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imagePreview', (initialUrl) => ({
            previewUrl: initialUrl,
            updatePreview(event) {
                const file = event.target.files[0];
                if (file) {
                    this.previewUrl = URL.createObjectURL(file);
                } else {
                    this.previewUrl = initialUrl;
                }
            }
        }));
    });
</script>
@endsection
