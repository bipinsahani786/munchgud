@extends('admin.layouts.app')

@section('title', 'Edit Page: ' . $page->name)
@section('header', 'Edit Page')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Edit: {{ $page->name }}</h1>
        <p class="text-sm text-gray-500 font-medium mt-1">Live URL: <a href="{{ url('/'.$page->slug) }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 hover:underline flex items-center gap-1 inline-flex">/{{ $page->slug }} <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a></p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-bold text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition shadow-sm">Cancel</a>
        <button type="submit" form="page-form" class="px-6 py-2 bg-emerald-600 text-white text-sm font-bold rounded-xl hover:bg-emerald-700 transition shadow-sm shadow-emerald-500/20">Save Page</button>
    </div>
</div>

<form id="page-form" action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    
    <div x-data="{ tab: 'content' }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Tabs Header -->
        <div class="flex border-b border-gray-100 bg-gray-50/50 overflow-x-auto">
            <button type="button" @click="tab = 'content'" :class="tab === 'content' ? 'border-emerald-500 text-emerald-700 bg-white' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'" class="flex-1 lg:flex-none border-b-2 py-4 px-8 text-sm font-bold uppercase tracking-wider transition-colors whitespace-nowrap">Main Content</button>
            <button type="button" @click="tab = 'sections'" :class="tab === 'sections' ? 'border-emerald-500 text-emerald-700 bg-white' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'" class="flex-1 lg:flex-none border-b-2 py-4 px-8 text-sm font-bold uppercase tracking-wider transition-colors whitespace-nowrap">Page Sections</button>
            <button type="button" @click="tab = 'seo'" :class="tab === 'seo' ? 'border-emerald-500 text-emerald-700 bg-white' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'" class="flex-1 lg:flex-none border-b-2 py-4 px-8 text-sm font-bold uppercase tracking-wider transition-colors whitespace-nowrap">SEO & Settings</button>
        </div>

        <div class="p-6 lg:p-8">
            <!-- TAB: Main Content -->
            <div x-show="tab === 'content'" x-cloak>
                <div class="max-w-4xl">
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2 flex justify-between">
                            <span>Rich Text Content</span>
                            <span class="text-gray-400 font-normal normal-case">Drag & drop images directly into the editor.</span>
                        </label>
                        <div class="border border-gray-200 rounded-xl overflow-hidden">
                            <textarea name="content" class="wysiwyg hidden">{{ old('content', $page->content) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB: Dynamic Sections -->
            <div x-show="tab === 'sections'" x-cloak>
                <div class="max-w-5xl">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Dynamic Page Sections</h2>
                            <p class="text-sm text-gray-500 mt-1">Manage individual text blocks, banners, and marketing copy.</p>
                        </div>
                        <button type="button" onclick="addSection()" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-gray-800 transition shadow-sm">+ Add Section</button>
                    </div>

                    @php
                        $sections = is_array($page->sections) ? $page->sections : [];
                        if ($page->slug === 'home') {
                            if (!array_key_exists('instagram_reels_list', $sections)) {
                                $oldLinks = [];
                                foreach(['instagram_video_1', 'instagram_video_2', 'instagram_video_3'] as $oldKey) {
                                    if (!empty($sections[$oldKey])) {
                                        $oldLinks[] = trim($sections[$oldKey]);
                                    }
                                }
                                $sections['instagram_reels_list'] = implode("\n", $oldLinks);
                            }
                        }
                    @endphp
                    <div id="sections-container" class="space-y-6">
                        @if(count($sections) > 0)
                            @foreach($sections as $key => $value)
                                @php
                                    if (in_array($key, ['instagram_video_1', 'instagram_video_2', 'instagram_video_3'])) {
                                        continue;
                                    }
                                    $isImage = (is_string($value) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $value)) || str_ends_with(strtolower($key), 'image') || str_ends_with(strtolower($key), 'bg') || str_ends_with(strtolower($key), 'poster');
                                    $formattedKey = ucwords(str_replace('_', ' ', $key));
                                @endphp
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 relative group transition hover:border-emerald-200 hover:shadow-sm">
                                    @if($key !== 'instagram_reels_list')
                                        <input type="hidden" name="sections[{{ $key }}]" value="{{ is_string($value) ? $value : json_encode($value) }}">
                                    @endif
                                    
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <label class="block text-sm font-bold text-gray-800">{{ $formattedKey }}</label>
                                            <span class="text-[10px] font-mono text-gray-400 bg-white border border-gray-200 px-2 py-0.5 rounded">{{ $key }}</span>
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-2 py-1 rounded">{{ $isImage ? 'Image' : 'Text / HTML' }}</span>
                                    </div>

                                    @if($isImage)
                                        <div class="flex items-center gap-6 bg-white p-4 rounded-lg border border-gray-100" x-data="{ previewUrl: '{{ $value ? Storage::url($value) : '' }}' }">
                                            <div class="w-32 h-20 bg-gray-100 rounded-lg border border-gray-200 overflow-hidden flex items-center justify-center flex-shrink-0 text-gray-300">
                                                <template x-if="previewUrl">
                                                    <img :src="previewUrl" alt="{{ $formattedKey }}" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!previewUrl">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </template>
                                            </div>
                                            <div class="flex-1">
                                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">{{ $value ? 'Replace Image' : 'Upload Image' }}</label>
                                                <input type="file" name="section_images[{{ $key }}]" accept="image/*" @change="if($event.target.files.length) previewUrl = URL.createObjectURL($event.target.files[0])" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer">
                                                @if($value)
                                                <label class="flex items-center gap-2 mt-3 cursor-pointer inline-flex">
                                                    <input type="checkbox" name="remove_section_images[]" value="{{ $key }}" class="w-4 h-4 text-red-600 rounded border-gray-300 focus:ring-red-500" @change="if($el.checked) previewUrl = ''">
                                                    <span class="text-xs font-bold text-red-600">Remove Image Completely</span>
                                                </label>
                                                @endif
                                            </div>
                                        </div>
                                    @elseif($key === 'instagram_reels_list')
                                        <div x-data="{ 
                                            reels: {!! json_encode(array_map(function($url) { return ['url' => $url]; }, array_values(array_filter(array_map('trim', explode("\n", $value)))))) !!} 
                                        }" x-init="if (!reels || reels.length === 0) reels = [{ url: '' }]">
                                            <input type="hidden" name="sections[{{ $key }}]" :value="reels.map(r => r.url).filter(u => u.trim() !== '').join('\n')">
                                            
                                            <div class="space-y-3">
                                                <template x-for="(reel, index) in reels" :key="index">
                                                    <div class="flex gap-2 items-center">
                                                        <input type="url" x-model="reel.url" placeholder="e.g. https://www.instagram.com/reel/..." class="flex-1 border border-gray-200 bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                                                        <button type="button" @click="if (reels.length > 1) reels.splice(index, 1); else reels = [{ url: '' }]" class="p-2.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition flex-shrink-0" title="Remove URL">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                            
                                            <button type="button" @click="reels.push({ url: '' })" class="mt-3 inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold text-xs rounded-xl hover:bg-emerald-100 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                                + Add Reel URL
                                            </button>
                                        </div>
                                    @else
                                        <textarea name="sections[{{ $key }}]" rows="{{ strlen($value) > 100 ? 4 : 2 }}" class="w-full border border-gray-200 bg-white rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition">{{ is_string($value) ? $value : json_encode($value) }}</textarea>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                <p class="text-gray-500 text-sm">No dynamic sections created yet.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 bg-blue-50/50 border border-blue-100 rounded-xl p-5">
                        <h3 class="text-sm font-bold text-blue-900 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Available Homepage Keys
                        </h3>
                        <ul class="text-xs text-blue-800 space-y-2 list-disc list-inside">
                            <li><code class="bg-white px-1 py-0.5 rounded border border-blue-200">ingredients_list</code> (Text: newline separated list of ingredients)</li>
                            <li><code class="bg-white px-1 py-0.5 rounded border border-blue-200">whats_not_list</code> (Text: newline separated list of what's not)</li>
                            <li><code class="bg-white px-1 py-0.5 rounded border border-blue-200">health_benefits_json</code> (Text: JSON array for benefits)</li>
                            <li><code class="bg-white px-1 py-0.5 rounded border border-blue-200">combo_packs_json</code> (Text: JSON array for combos)</li>
                            <li><code class="bg-white px-1 py-0.5 rounded border border-blue-200">bestseller_benefits</code> (Text: newline separated list of benefits)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- TAB: SEO & Settings -->
            <div x-show="tab === 'seo'" x-cloak>
                <div class="max-w-2xl space-y-6">
                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Internal Page Name</label>
                        <input type="text" name="name" value="{{ old('name', $page->name) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition">
                        <p class="text-[11px] text-gray-400 mt-2">This is only visible to admins.</p>
                    </div>

                    <div class="space-y-5">
                        <h3 class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-2">Search Engine Optimization</h3>
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="e.g. Premium Makhana | MunchGud" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" placeholder="e.g. makhana, healthy snacks, bihar" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2 flex justify-between">
                                <span>Meta Description</span>
                                <span class="text-gray-400 font-normal normal-case" x-data="{ len: {{ strlen($page->meta_description ?? '') }} }" x-text="len + '/160 chars'"></span>
                            </label>
                            <textarea name="meta_description" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition">{{ old('meta_description', $page->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<!-- Template for new sections -->
<template id="new-section-template">
    <div class="bg-emerald-50/30 border border-emerald-200 rounded-xl p-5 relative flex flex-col md:flex-row gap-4 mt-6 section-block" x-data="{ type: 'text' }">
        <div class="w-full md:w-1/3">
            <label class="block text-[10px] font-bold text-emerald-700 uppercase tracking-widest mb-2">New Key Name</label>
            <input type="text" name="new_section_keys[]" placeholder="e.g. hero_subtitle or hero_image" class="w-full border border-emerald-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition">
            
            <div class="mt-3 flex gap-4">
                <label class="flex items-center gap-1.5 text-xs font-bold text-gray-600 cursor-pointer">
                    <input type="radio" x-model="type" value="text" class="text-emerald-600"> Text
                </label>
                <label class="flex items-center gap-1.5 text-xs font-bold text-gray-600 cursor-pointer">
                    <input type="radio" x-model="type" value="image" class="text-emerald-600"> Image
                </label>
            </div>
            <!-- Hidden input to tell controller which type this is -->
            <input type="hidden" name="new_section_types[]" :value="type">
        </div>
        <div class="w-full md:w-2/3">
            <label class="block text-[10px] font-bold text-emerald-700 uppercase tracking-widest mb-2" x-text="type === 'image' ? 'Upload Image' : 'Content (Text / HTML)'"></label>
            
            <!-- We don't disable the input to maintain array index alignment in the controller -->
            <textarea x-show="type === 'text'" name="new_section_values[]" rows="2" placeholder="Enter content here..." class="w-full border border-emerald-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition"></textarea>
            
            <div x-show="type === 'image'" x-data="{ newPreview: '' }">
                <div class="mb-3 w-32 h-20 bg-gray-100 rounded-lg border border-gray-200 overflow-hidden flex items-center justify-center text-gray-300" x-show="newPreview">
                    <img :src="newPreview" class="w-full h-full object-cover">
                </div>
                <input type="file" name="new_section_images[]" accept="image/*" @change="if($event.target.files.length) newPreview = URL.createObjectURL($event.target.files[0])" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer border border-emerald-300 rounded-xl bg-white p-1">
            </div>
        </div>
        <button type="button" @click="$el.closest('.section-block').remove()" class="absolute -top-3 -right-3 w-8 h-8 bg-white border border-gray-200 text-gray-500 hover:text-red-500 rounded-full flex items-center justify-center shadow-sm z-10">✕</button>
    </div>
</template>

<style>
    .ck-editor__editable_inline {
        min-height: 500px;
        border-bottom-left-radius: 0.75rem !important;
        border-bottom-right-radius: 0.75rem !important;
        padding: 1rem 2rem !important;
    }
    .ck-toolbar {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 0.5rem !important;
    }
    [x-cloak] { display: none !important; }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    if (document.querySelector('.wysiwyg')) {
        ClassicEditor
            .create(document.querySelector('.wysiwyg'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'imageUpload', 'insertTable', '|', 'undo', 'redo' ],
                simpleUpload: {
                    uploadUrl: '{{ route('admin.upload.image') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            })
            .catch(error => {
                console.error(error);
            });
    }

    function addSection() {
        const container = document.getElementById('sections-container');
        const template = document.getElementById('new-section-template');
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
    }
</script>
@endsection
