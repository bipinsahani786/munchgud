@extends('admin.layouts.app')

@section('title', 'Edit Page: ' . $page->name)
@section('header', 'Edit Page')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Editing: {{ $page->name }}</h1>
        <p class="text-sm text-gray-500 font-medium mt-0.5">URL: <a href="{{ url('/'.$page->slug) }}" target="_blank" class="text-emerald-600 hover:underline">/{{ $page->slug }}</a></p>
    </div>
    <a href="{{ route('admin.pages.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">&larr; Back to CMS</a>
</div>

<form action="{{ route('admin.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content Area -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Basic Info -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">Page Details</h2>
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Page Name (Internal)</label>
                    <input type="text" name="name" value="{{ old('name', $page->name) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5 flex justify-between">
                        <span>Main Content (HTML/Text)</span>
                        <span class="text-gray-400 font-normal normal-case">For pages like Privacy, Terms, About</span>
                    </label>
                    <textarea name="content" rows="15" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none font-mono text-gray-600">{{ old('content', $page->content) }}</textarea>
                </div>
            </div>

            <!-- Dynamic Sections -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Dynamic Sections</h2>
                    <button type="button" onclick="addSection()" class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg hover:bg-emerald-100 transition">+ Add Section</button>
                </div>
                <p class="text-xs text-gray-500 mb-6 leading-relaxed">Sections are key-value pairs used to store specific blocks of text or images for complex pages (like the Homepage). You can add new sections here and use them in the blade templates using <code>$page->sections['key']</code>.</p>
                
                <div id="sections-container" class="space-y-4">
                    @if(is_array($page->sections))
                        @foreach($page->sections as $key => $value)
                            <div class="flex gap-3 items-start border border-gray-100 bg-gray-50/50 p-4 rounded-xl relative group">
                                <div class="w-1/3">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Key</label>
                                    <input type="text" value="{{ $key }}" class="w-full border border-gray-200 bg-gray-100 rounded-lg px-3 py-2 text-xs font-mono text-gray-500 cursor-not-allowed" readonly>
                                    <input type="hidden" name="sections[{{ $key }}]" value="{{ $value }}">
                                </div>
                                <div class="w-2/3">
                                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Value (Text/HTML)</label>
                                    @if(is_string($value) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $value))
                                        <div class="mb-2">
                                            <img src="{{ Storage::url($value) }}" alt="{{ $key }}" class="h-16 rounded border border-gray-200">
                                            <input type="hidden" name="sections[{{ $key }}]" value="{{ $value }}">
                                        </div>
                                        <input type="file" name="section_images[{{ $key }}]" class="text-xs w-full">
                                    @else
                                        <textarea name="sections[{{ $key }}]" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none">{{ $value }}</textarea>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Template for new sections -->
                <template id="new-section-template">
                    <div class="flex gap-3 items-start border border-emerald-100 bg-emerald-50/30 p-4 rounded-xl relative">
                        <div class="w-1/3">
                            <label class="block text-[10px] font-bold text-emerald-600 uppercase tracking-widest mb-1">New Key</label>
                            <input type="text" name="new_section_keys[]" placeholder="e.g. hero_subtitle" class="w-full border border-emerald-200 rounded-lg px-3 py-2 text-xs font-mono focus:ring-2 focus:ring-emerald-500/20 outline-none">
                        </div>
                        <div class="w-2/3">
                            <label class="block text-[10px] font-bold text-emerald-600 uppercase tracking-widest mb-1">New Value</label>
                            <textarea name="new_section_values[]" rows="2" placeholder="Text or HTML content..." class="w-full border border-emerald-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 outline-none"></textarea>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Sidebar (SEO) -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden p-6 sticky top-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">SEO Details</h2>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" placeholder="e.g. Premium Makhana | MunchGud" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                        <p class="text-[10px] text-gray-400 mt-1">Leave empty to use the default site title.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" placeholder="e.g. makhana, healthy snacks, bihar" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Meta Description</label>
                        <textarea name="meta_description" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none">{{ old('meta_description', $page->meta_description) }}</textarea>
                    </div>
                </div>

                <hr class="my-6 border-gray-100">
                
                <button type="submit" class="w-full py-3 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-gray-800 transition shadow-sm">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    function addSection() {
        const container = document.getElementById('sections-container');
        const template = document.getElementById('new-section-template');
        const clone = template.content.cloneNode(true);
        container.appendChild(clone);
    }
</script>
@endsection
