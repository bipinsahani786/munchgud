@extends('admin.layouts.app')

@section('title', $blog->exists ? 'Edit Article: ' . $blog->title : 'Write New Article')
@section('header', 'Blogs')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&display=swap" rel="stylesheet">
<style>
    /* TinyMCE Custom Styling */
    .tox-tinymce {
        border-radius: 0.875rem !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        font-family: inherit !important;
    }
    .tox .tox-toolbar-overlord,
    .tox .tox-menubar {
        background-color: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .tox .tox-statusbar {
        border-top: 1px solid #e2e8f0 !important;
        background-color: #f8fafc !important;
    }
    .tox .tox-edit-area__iframe {
        background-color: #ffffff !important;
    }

    /* Google Search Preview Simulation */
    .google-preview-card {
        background: #ffffff;
        border: 1px solid #dfe1e5;
        border-radius: 12px;
        padding: 16px 20px;
        font-family: Arial, sans-serif;
    }
    .google-preview-url {
        color: #202124;
        font-size: 13px;
        line-height: 18px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .google-preview-title {
        color: #1a0dab;
        font-size: 19px;
        line-height: 25px;
        font-weight: 400;
        cursor: pointer;
        text-decoration: none;
        display: block;
        margin: 2px 0 4px 0;
    }
    .google-preview-title:hover {
        text-decoration: underline;
    }
    .google-preview-desc {
        color: #4d5156;
        font-size: 13px;
        line-height: 20px;
        word-wrap: break-word;
    }

    /* Full Storefront Typography (.prose-mg) for Live Previews - 100% IDENTICAL to TinyMCE & Storefront */
    .prose-mg, .prose-mg *, .live-sim-content, .live-sim-content * {
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg, .live-sim-content {
        color: #374151;
        font-size: 1.05rem;
        line-height: 1.8;
        font-family: 'Inter', sans-serif;
    }
    .prose-mg h1 {
        font-family: 'Outfit', sans-serif;
        font-size: 2rem !important;
        font-weight: 800 !important;
        line-height: 1.25 !important;
        color: #111827 !important;
        margin-top: 1.75rem !important;
        margin-bottom: 0.875rem !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg h2 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.65rem !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        color: #111827 !important;
        margin-top: 1.75rem !important;
        margin-bottom: 0.75rem !important;
        border-bottom: 2px solid rgba(46, 139, 87, 0.15);
        padding-bottom: 0.4rem;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem !important;
        font-weight: 700 !important;
        line-height: 1.4 !important;
        color: #1f2937 !important;
        margin-top: 1.5rem !important;
        margin-bottom: 0.65rem !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg h4 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.15rem !important;
        font-weight: 700 !important;
        line-height: 1.4 !important;
        color: #1f2937 !important;
        margin-top: 1.25rem !important;
        margin-bottom: 0.5rem !important;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg p, .live-sim-content p {
        margin-bottom: 1.25rem !important;
        color: #374151;
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg strong, .prose-mg b {
        color: #111827 !important;
        font-weight: 700 !important;
    }
    .prose-mg em, .prose-mg i {
        font-style: italic;
    }
    .prose-mg a {
        color: #2E8B57 !important;
        text-decoration: underline !important;
        text-underline-offset: 3px;
        font-weight: 600;
        transition: color 0.2s;
    }
    .prose-mg a:hover {
        color: #1e5c3a !important;
    }
    .prose-mg ul {
        list-style-type: disc !important;
        padding-left: 1.5rem !important;
        margin-top: 0.75rem !important;
        margin-bottom: 1.25rem !important;
    }
    .prose-mg ol {
        list-style-type: decimal !important;
        padding-left: 1.5rem !important;
        margin-top: 0.75rem !important;
        margin-bottom: 1.25rem !important;
    }
    .prose-mg li {
        margin-bottom: 0.4rem !important;
        line-height: 1.7;
    }
    .prose-mg img {
        max-width: 100% !important;
        border-radius: 12px !important;
        box-sizing: border-box !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.06);
    }
    .prose-mg img:not([style*="height"]):not([height]) {
        height: auto;
    }
    .prose-mg img[style*="float: left"],
    .prose-mg img[style*="float:left"],
    .prose-mg img.alignleft,
    .prose-mg img.align-left {
        float: left !important;
        margin: 0.5rem 1.5rem 1rem 0 !important;
        clear: none !important;
    }
    .prose-mg img[style*="float: right"],
    .prose-mg img[style*="float:right"],
    .prose-mg img.alignright,
    .prose-mg img.align-right {
        float: right !important;
        margin: 0.5rem 0 1rem 1.5rem !important;
        clear: none !important;
    }
    .prose-mg img[style*="margin: auto"],
    .prose-mg img[style*="margin:auto"],
    .prose-mg img[style*="margin-left: auto"],
    .prose-mg img.aligncenter,
    .prose-mg img.align-center {
        float: none !important;
        margin: 1.5rem auto !important;
        display: block !important;
    }
    /* Zero margin for paragraph containing only floated image so adjacent text starts at the exact top */
    .prose-mg p:has(> img[style*="float: left"]:only-child),
    .prose-mg p:has(> img[style*="float:left"]:only-child),
    .prose-mg p:has(> img[style*="float: right"]:only-child),
    .prose-mg p:has(> img[style*="float:right"]:only-child),
    .prose-mg p:has(> img.alignleft:only-child),
    .prose-mg p:has(> img.alignright:only-child) {
        margin-bottom: 0 !important;
    }
    .prose-mg blockquote {
        border-left: 4px solid #2E8B57 !important;
        background: rgba(46, 139, 87, 0.05) !important;
        padding: 1.1rem 1.35rem !important;
        border-radius: 0 0.875rem 0.875rem 0 !important;
        font-style: italic !important;
        color: #475569 !important;
        margin: 1.5rem 0 !important;
    }
    .prose-mg table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin: 1.5rem 0 !important;
        font-size: 0.95rem;
    }
    .prose-mg th {
        background: #f8fafc !important;
        color: #111827 !important;
        font-weight: 700 !important;
        text-align: left !important;
        padding: 0.75rem 0.875rem !important;
        border: 1px solid #e2e8f0 !important;
    }
    .prose-mg td {
        padding: 0.75rem 0.875rem !important;
        border: 1px solid #e2e8f0 !important;
        color: #374151;
    }

    /* Custom Scrollbar for Preview */
    .custom-preview-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .custom-preview-scroll::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 8px;
    }
    .custom-preview-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 8px;
    }
    .custom-preview-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endsection

@section('container_class', 'w-full max-w-7xl mx-auto transition-all duration-300')

@section('content')
<div class="w-full max-w-7xl mx-auto pb-16 transition-all duration-300" id="blogAppContainer" data-exists="{{ $blog->exists ? '1' : '0' }}" data-has-image="{{ $blog->image ? '1' : '0' }}">
    
    <!-- Top Bar Navigation, Title & Mode Actions -->
    <div class="mb-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200/80 pb-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                <a href="{{ route('admin.blogs.index') }}" class="hover:text-mg-green transition">Articles</a>
                <span>/</span>
                <span class="text-gray-700">{{ $blog->exists ? 'Edit' : 'New' }}</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-gray-900 tracking-tight font-heading">
                {{ $blog->exists ? 'EDIT ARTICLE' : 'WRITE NEW ARTICLE' }}
            </h1>
            <p class="text-sm font-medium text-gray-500 mt-0.5">
                {{ $blog->exists ? 'Update your published article content, URL, media, and SEO metadata.' : 'Compose, format, and publish a high-quality blog article for MunchGud.' }}
            </p>
        </div>

        <div class="flex items-center gap-2.5 flex-wrap self-start md:self-auto">
            <a href="{{ route('admin.blogs.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-gray-300 bg-white text-gray-700 text-xs font-bold hover:bg-gray-50 transition shadow-2xs">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back</span>
            </a>

            <!-- Full Page View (Wide Display) Toggle Button -->
            <button type="button" id="btnToggleFullDisplay" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-gray-300 bg-white text-gray-700 text-xs font-bold hover:bg-gray-50 transition shadow-2xs">
                <svg id="iconExpand" class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                <span id="textExpand">⛶ Full Page View</span>
            </button>

            <!-- Standalone Fullscreen Customer Preview Modal Trigger -->
            <button type="button" id="btnOpenFullscreenModal" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl border border-gray-300 bg-white text-gray-700 text-xs font-bold hover:bg-gray-50 transition shadow-2xs">
                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span>Customer View</span>
            </button>

            <!-- Quick Save & Publish Post in Top Bar -->
            <button type="submit" form="blogArticleForm" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-900 hover:bg-black text-white text-xs font-bold transition shadow-xs">
                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span>Save Post</span>
            </button>
        </div>
    </div>

    <!-- Live Auto-Sync Status Notification Banner -->
    <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border border-emerald-200/80 rounded-2xl px-4 py-2.5 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs">
        <div class="flex items-center gap-2 text-emerald-800 font-semibold">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping flex-shrink-0"></span>
            <span>Real-time Live Sync Active: Content on the left updates the live customer page on the right instantly.</span>
        </div>
        <div class="flex items-center gap-2 self-start sm:self-auto">
            <span class="text-[11px] font-bold text-emerald-700 bg-white/90 px-2.5 py-0.5 rounded-lg border border-emerald-200 shadow-2xs">
                Side-by-Side Editor & Live Preview
            </span>
        </div>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800">Please correct the following errors:</h3>
                    <ul class="mt-1 text-xs font-semibold text-red-700 list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ $blog->exists ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogArticleForm" class="space-y-6">
        @csrf
        @if($blog->exists) @method('PUT') @endif

        <!-- SECTION 1: Article Header Details (Title, Slug, Author, Cover Image Picker, Permalink) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 sm:p-7 space-y-5">
            
            <!-- Row 1: Article Title & Custom URL / Slug -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="articleTitle" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Article Title <span class="text-red-500">*</span>
                        </label>
                        <span id="titleCount" class="text-[11px] font-medium text-gray-400">0 / 100</span>
                    </div>
                    <input type="text" 
                           name="title" 
                           id="articleTitle" 
                           value="{{ old('title', $blog->title) }}" 
                           required 
                           placeholder="e.g. Complete AC Repairing Practical Guide 2026"
                           class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="articleSlug" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Custom URL / Slug (Optional)
                        </label>
                        <button type="button" id="toggleSlugSyncBtn" class="text-[11px] font-semibold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            <span>Sync with Title</span>
                        </button>
                    </div>
                    <input type="text" 
                           name="slug" 
                           id="articleSlug" 
                           value="{{ old('slug', $blog->slug) }}" 
                           placeholder="e.g. ac-repairing-guide"
                           class="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm font-mono">
                    <p class="text-[11px] font-medium text-gray-400 mt-1">Leave blank to auto-generate from title.</p>
                </div>
            </div>

            <!-- Row 2: Author Name & Cover Image Picker -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-1">
                <div>
                    <label for="authorName" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        Author Name
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        <input type="text" 
                               name="author_name" 
                               id="authorName" 
                               value="{{ old('author_name', $blog->author_name ?? 'Admin') }}" 
                               placeholder="e.g. Admin" 
                               class="w-full bg-white border border-gray-300 rounded-xl pl-10 pr-4 py-3 text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">
                        Cover Image
                    </label>
                    <div class="flex items-center gap-3 border border-gray-300 rounded-xl p-1.5 bg-white shadow-sm focus-within:ring-2 focus-within:ring-emerald-500 focus-within:border-emerald-500">
                        <label for="coverImageInput" class="cursor-pointer inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-bold hover:bg-indigo-100 transition flex-shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Choose File
                        </label>
                        <input type="file" name="image" id="coverImageInput" accept="image/*" class="hidden">
                        <span id="coverImageName" class="text-xs text-gray-400 font-medium truncate flex-1">
                            {{ $blog->image ? basename($blog->image) : 'No file chosen' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Row 3: Cover Image Hyperlink / Redirect URL (Optional) -->
            <div class="pt-1">
                <div class="flex items-center justify-between mb-1.5">
                    <label for="coverImageLinkInput" class="block text-xs font-bold text-gray-700 uppercase tracking-wider flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <span>Cover Image Hyperlink / Redirect URL</span>
                        <span class="text-[10px] font-semibold text-gray-400 normal-case">(Optional)</span>
                    </label>
                    <span class="text-[11px] font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Click to Redirect
                    </span>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </span>
                    <input type="text" 
                           name="cover_image_link" 
                           id="coverImageLinkInput" 
                           value="{{ old('cover_image_link', $blog->cover_image_link) }}" 
                           placeholder="e.g. https://munchgud.com/products/roasted-makhana or /products/peri-peri-makhana" 
                           class="w-full bg-white border border-gray-300 rounded-xl pl-10 pr-4 py-2.5 text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm font-mono">
                </div>
                <p class="text-[11px] font-medium text-gray-400 mt-1 flex items-center gap-1">
                    <span>💡 Visitor cover image par click karega toh is link par redirect ho jayega. Khali chhodne par normal banner rahega.</span>
                </p>
            </div>

            <!-- Live Permalink Display Box -->
            <div class="bg-gray-50 rounded-xl p-3.5 border border-gray-200 flex flex-wrap items-center justify-between gap-2 text-xs">
                <div class="flex items-center gap-2 text-gray-600 truncate">
                    <span class="font-bold text-gray-500 uppercase text-[10px] tracking-wider">Permalink:</span>
                    <span class="text-gray-400">https://munchgud.com/blogs/</span>
                    <span id="slugBadge" class="font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200 truncate">
                        {{ $blog->slug ?: 'your-slug-here' }}
                    </span>
                </div>
                <button type="button" id="copyLinkBtn" class="inline-flex items-center gap-1 text-[11px] font-bold text-gray-600 hover:text-emerald-700 bg-white px-2.5 py-1 rounded border border-gray-300 shadow-2xs hover:bg-gray-50 transition">
                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span id="copyLinkText">Copy URL</span>
                </button>
            </div>

        </div>

        <!-- SECTION 2: THE MAIN STAGE — Full Article Editor & Live Customer Preview Option -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 text-xs font-black text-gray-900 uppercase tracking-wider">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Article Workspace
                </span>
                <span id="stageModeDesc" class="hidden md:inline-block text-[11px] font-medium text-gray-500">
                    — Full Page Article Editor (Click "Live Preview" to test customer view)
                </span>
            </div>

            <!-- View Mode Switcher: Full Editor (Default), Live Preview, Split View -->
            <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-xl border border-gray-200 shadow-2xs self-start sm:self-auto">
                <button type="button" id="btnModeEditor" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold bg-white text-gray-900 shadow-2xs transition" title="Full Page Article Editor">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Full Editor</span>
                </button>
                <button type="button" id="btnModePreview" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold text-gray-600 hover:text-gray-900 transition" title="Click to view Live Website Customer Preview">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span>Live Preview</span>
                </button>
                <button type="button" id="btnModeSplit" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold text-gray-500 hover:text-gray-900 transition" title="Side-by-side (50/50) view">
                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 4H5a1 1 0 00-1 1v14a1 1 0 001 1h4m6-16h4a1 1 0 011 1v14a1 1 0 01-1 1h-4m-6-16v16"/></svg>
                    <span>Split (50/50)</span>
                </button>
            </div>
        </div>

        <div id="mainStageGrid" class="w-full">
            
            <!-- Article Content / Description (Rich Text Editor - Full Page by default) -->
            <div id="editorCardContainer" class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 flex flex-col space-y-4 w-full">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-gray-100 pb-3 flex-shrink-0">
                    <div>
                        <label class="block text-base font-bold text-gray-900 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Article Content / Description</span>
                        </label>
                        <p class="text-xs font-medium text-gray-400 mt-0.5">
                            Full Page Rich Text Editor — Font Size, Headings, Free-Form Image Resizing & Drag/Drop
                        </p>
                    </div>
                    
                    <!-- Editor Statistics Pills & Quick Preview Button -->
                    <div class="flex items-center gap-2 flex-wrap self-start sm:self-auto">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gray-100 text-gray-600 text-xs font-semibold">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            <span id="wordCountDisplay">0 words</span>
                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200/60">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span id="readingTimeDisplay">~1 min read</span>
                        </span>
                        <!-- Prominent Preview Post Button -->
                        <button type="button" id="btnEditorQuickPreview" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-2xs transition hover:shadow-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Live Preview Post</span>
                        </button>
                    </div>
                </div>

                <!-- TinyMCE Textarea -->
                <div class="flex-1 w-full min-h-[580px]">
                    <textarea id="tinymceEditor" name="content" class="w-full min-h-[580px]">{!! old('content', $blog->content) !!}</textarea>
                </div>

                <div class="flex flex-wrap items-center justify-between text-xs text-gray-500 pt-2 border-t border-gray-100 gap-2 flex-shrink-0">
                    <span class="flex items-center gap-1.5">
                        <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Select text for <strong>Font Size & Heading</strong>. Click image for <strong>⋮ Toolbar, ❌ Delete</strong> or drag resize.</span>
                    </span>
                    <button type="button" id="btnEditorFooterPreview" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline inline-flex items-center gap-1">
                        <span>Check Live Customer Preview →</span>
                    </button>
                </div>
            </div>

            <!-- Live Customer Website Preview (Shown on demand when user clicks Preview!) -->
            <div id="previewCardContainer" class="hidden bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden flex flex-col w-full">
                
                <!-- Browser Header Mockup Bar -->
                <div class="bg-gray-100/90 border-b border-gray-200 px-4 py-3 flex items-center justify-between gap-2 flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span>
                        <div class="ml-2 bg-white px-3 py-1 rounded-lg text-xs font-mono text-gray-600 border border-gray-200 shadow-2xs flex items-center gap-1.5 truncate max-w-[280px] sm:max-w-md">
                            <svg class="w-3 h-3 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                            <span>munchgud.com/blogs/</span><span class="live-sim-slug font-bold text-emerald-700">{{ $blog->slug ?: 'your-slug' }}</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" id="btnPreviewBackToEditor" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-stone-900 hover:bg-black text-white text-xs font-bold shadow-2xs transition">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            <span>✏️ Back to Editor</span>
                        </button>
                        <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Live Customer Preview
                        </span>
                    </div>
                </div>

                <!-- Scrollable Live Customer Page Canvas (100% Identical to MunchGud Storefront) -->
                <div id="previewScrollCanvas" class="flex-1 p-4 sm:p-8 md:p-12 bg-[#FAFAF5] overflow-y-auto max-h-[850px] custom-preview-scroll">
                    <div class="max-w-4xl mx-auto">
                        
                        <!-- Header -->
                        <header class="max-w-4xl mx-auto text-center mb-12">
                            <div class="flex items-center justify-center gap-4 text-sm font-bold text-[#2B6E2F] uppercase tracking-widest mb-6">
                                <span>{{ $blog->created_at ? $blog->created_at->format('M d, Y') : date('M d, Y') }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-[#2B6E2F]/30"></span>
                                <span>BY <span class="live-sim-author">{{ $blog->author_name ?? 'MunchGud' }}</span></span>
                            </div>

                            <h1 class="live-sim-title text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-[#1A1A1A] leading-tight mb-8 text-center" style="font-family: 'Playfair Display', Georgia, serif !important;">
                                {{ $blog->title ?: 'Your Article Title Goes Here' }}
                            </h1>

                            <!-- Cover Image Banner -->
                            <div class="live-sim-cover-wrapper rounded-3xl overflow-hidden aspect-[21/9] bg-[#FAF8F5] shadow-xl border border-black/5 relative group mb-12">
                                <a id="liveSimCoverLink" href="{{ $blog->cover_image_link ?: 'javascript:void(0)' }}" target="{{ $blog->cover_image_link ? '_blank' : '_self' }}" class="block w-full h-full relative cursor-pointer" title="{{ $blog->cover_image_link ? 'Redirects to: ' . $blog->cover_image_link : 'Cover Image' }}">
                                    <img src="{{ $blog->image ? Storage::url($blog->image) : '' }}" 
                                         alt="Cover Image" 
                                         class="live-sim-cover-img {{ $blog->image ? '' : 'hidden' }} w-full h-full object-cover">
                                    <div class="live-sim-cover-placeholder {{ $blog->image ? 'hidden' : 'flex' }} w-full h-full flex-col items-center justify-center text-stone-400 p-6 text-center">
                                        <svg class="w-10 h-10 text-stone-300 mb-1.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="text-xs font-bold text-stone-600">Cover Image Preview</span>
                                        <span class="text-[10px] text-stone-400 mt-0.5">Select cover image above to preview here</span>
                                    </div>
                                    <!-- Dynamic Hyperlink Indicator Badge in Live Preview -->
                                    <div id="liveSimLinkBadge" class="{{ $blog->cover_image_link ? 'flex' : 'hidden' }} absolute bottom-4 right-4 bg-black/70 backdrop-blur-md text-white px-3.5 py-1.5 rounded-full text-xs font-semibold items-center gap-1.5 shadow-lg pointer-events-none transition-all">
                                        <svg class="w-3.5 h-3.5 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        <span class="truncate max-w-[200px]" id="liveSimLinkText">{{ $blog->cover_image_link ?: '' }}</span>
                                    </div>
                                </a>
                            </div>
                        </header>

                        <!-- Live Formatted Rich Text Content Body (100% Identical to Storefront) -->
                        <div class="live-sim-content max-w-4xl mx-auto prose max-w-none prose-mg">
                            {!! $blog->content ?: '<p class="text-stone-400 italic text-center py-8 text-sm">Start typing article content, headers, or adding images in the editor on the left to see your live formatted post rendered here...</p>' !!}
                        </div>

                        <!-- MunchGud Footer & Bottom Action Bar -->
                        <div class="max-w-4xl mx-auto mt-16 pt-10 border-t border-black/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <span class="inline-flex items-center gap-2 font-bold text-[#1A1A1A]">
                                <svg class="w-5 h-5 text-[#2B6E2F]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                                <span>Published on MunchGud • 100% Healthy Roasted Makhana</span>
                            </span>

                            <div class="flex items-center gap-2">
                                <button type="button" id="btnPreviewFooterBack" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-stone-900 hover:bg-black text-white text-xs font-bold shadow-2xs transition">
                                    <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>✏️ Return to Editor to Make Changes</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- SECTION 3: SEO, Publishing Controls & Quality Checklist (Grid) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- Left (2 cols): SEO Optimization & Google Live Simulation -->
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 space-y-5">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                        <div>
                            <h2 class="text-base font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                Search Engine Optimization (SEO)
                            </h2>
                            <p class="text-xs font-medium text-gray-400 mt-0.5">Control how this post appears in Google search engine rankings.</p>
                        </div>
                        <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                            SEO Engine Ready
                        </span>
                    </div>

                    <!-- Google Search Preview Simulation Box -->
                    <div>
                        <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center justify-between">
                            <span>Google Search Result Snippet (Preview)</span>
                            <span class="text-[11px] font-normal text-gray-400">Desktop View</span>
                        </div>
                        <div class="google-preview-card shadow-2xs">
                            <div class="google-preview-url">
                                <div class="w-4 h-4 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold">M</div>
                                <span>https://munchgud.com › blogs › <span id="googlePreviewSlug">{{ $blog->slug ?: 'post-slug' }}</span></span>
                            </div>
                            <a href="javascript:void(0)" id="googlePreviewTitle" class="google-preview-title">
                                {{ $blog->meta_title ?: ($blog->title ?: 'Article Title Goes Here — MunchGud') }}
                            </a>
                            <div id="googlePreviewDesc" class="google-preview-desc">
                                {{ $blog->meta_description ?: 'Discover our latest insights on healthy roasted makhana, nutritional superfoods, and wellness recipes crafted by MunchGud.' }}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-1">
                        <!-- Meta Title Input -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="metaTitleInput" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Meta Title
                                </label>
                                <span id="metaTitleCount" class="text-[11px] font-medium text-gray-400">0 / 60 characters (Recommended)</span>
                            </div>
                            <input type="text" 
                                   name="meta_title" 
                                   id="metaTitleInput" 
                                   value="{{ old('meta_title', $blog->meta_title) }}" 
                                   placeholder="e.g. 7 Health Benefits of Roasted Makhana — MunchGud" 
                                   class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm">
                            <div class="w-full bg-gray-100 rounded-full h-1 mt-1.5 overflow-hidden">
                                <div id="metaTitleBar" class="h-1 bg-emerald-500 transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- Meta Description Textarea -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="metaDescInput" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">
                                    Meta Description
                                </label>
                                <span id="metaDescCount" class="text-[11px] font-medium text-gray-400">0 / 160 characters (Recommended)</span>
                            </div>
                            <textarea name="meta_description" 
                                      id="metaDescInput" 
                                      rows="3" 
                                      placeholder="Brief summary of the article for Google search snippet. Keep it between 120-160 characters for best click-through rate." 
                                      class="w-full bg-white border border-gray-300 rounded-xl px-4 py-2.5 text-sm font-medium text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition shadow-sm">{{ old('meta_description', $blog->meta_description) }}</textarea>
                            <div class="w-full bg-gray-100 rounded-full h-1 mt-1.5 overflow-hidden">
                                <div id="metaDescBar" class="h-1 bg-emerald-500 transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right (1 col): Publishing Settings, Cover Thumbnail & Quality Checklist -->
            <div class="lg:col-span-1 space-y-5">
                
                <!-- Card 1: Publishing Settings -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 space-y-4">
                    <h2 class="text-base font-bold text-gray-900 border-b border-gray-100 pb-3 flex items-center justify-between">
                        <span>Publishing Settings</span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold {{ $blog->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                            {{ $blog->is_active ? '● Published' : '○ Draft' }}
                        </span>
                    </h2>

                    <!-- Publish Status Switch -->
                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <div>
                            <span class="text-sm font-bold text-gray-900 block">Publish immediately</span>
                            <span class="text-[11px] text-gray-400 block mt-0.5">Visible to customers on MunchGud</span>
                        </div>
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               name="is_active" 
                               id="publishStatusCheckbox"
                               value="1" 
                               {{ old('is_active', $blog->exists ? $blog->is_active : true) ? 'checked' : '' }} 
                               class="w-5 h-5 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500 cursor-pointer">
                    </label>

                    <!-- Publish Action Buttons -->
                    <div class="space-y-2 pt-1">
                        <button type="submit" 
                                id="submitPublishBtn"
                                class="w-full bg-gray-900 hover:bg-black text-white py-3 px-4 rounded-xl font-bold text-sm transition shadow-sm hover:shadow flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            <span>{{ $blog->exists ? 'Update Blog Post' : 'Save & Publish Post' }}</span>
                        </button>

                        <button type="button" 
                                id="saveDraftBtn"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-2.5 px-4 rounded-xl font-bold text-xs transition flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                            <span>Save as Draft</span>
                        </button>
                    </div>

                    @if($blog->exists)
                        <div class="text-[11px] text-gray-400 space-y-1 pt-2 border-t border-gray-100">
                            <div class="flex justify-between">
                                <span>Created:</span>
                                <span class="font-medium text-gray-600">{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Card 2: Cover / Featured Image Thumbnail Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 space-y-3">
                    <h2 class="text-sm font-bold text-gray-900 border-b border-gray-100 pb-2 flex items-center justify-between">
                        <span>Cover / Featured Image</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">16:9 Aspect</span>
                    </h2>

                    <!-- Live Image Preview Box -->
                    <div id="imagePreviewContainer" class="{{ $blog->image ? '' : 'hidden' }} relative rounded-xl overflow-hidden border border-gray-200 bg-gray-50 aspect-video group">
                        <img id="liveImagePreview" 
                             src="{{ $blog->image ? Storage::url($blog->image) : '' }}" 
                             alt="Cover Preview" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                            <label for="coverImageInput" class="px-2.5 py-1 rounded-lg bg-white text-gray-900 text-xs font-bold cursor-pointer hover:bg-gray-100 transition shadow">
                                Change
                            </label>
                            <button type="button" id="removeImageBtn" class="px-2.5 py-1 rounded-lg bg-red-600 text-white text-xs font-bold hover:bg-red-700 transition shadow">
                                Clear
                            </button>
                        </div>
                    </div>

                    <!-- Sidebar Link indicator if cover image has a redirect link -->
                    <div id="coverLinkThumbnailBadge" class="{{ $blog->cover_image_link ? 'flex' : 'hidden' }} items-center gap-1.5 text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200 truncate">
                        <svg class="w-3 h-3 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span class="truncate font-mono" id="coverLinkThumbnailText">{{ $blog->cover_image_link ?: '' }}</span>
                    </div>

                    <!-- Dropzone upload trigger -->
                    <div id="uploadPlaceholder" class="{{ $blog->image ? 'hidden' : '' }} border-2 border-dashed border-gray-300 hover:border-emerald-500 rounded-xl p-5 text-center cursor-pointer transition bg-gray-50/50 hover:bg-emerald-50/30">
                        <label for="coverImageInput" class="cursor-pointer block">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 mx-auto flex items-center justify-center mb-1.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-xs font-bold text-gray-700 block">Click to upload cover image</span>
                            <span class="text-[10px] text-gray-400 block mt-0.5">PNG, JPG, WebP up to 3MB</span>
                        </label>
                    </div>
                </div>

                <!-- Card 3: Quality & SEO Checklist -->
                <div class="bg-gradient-to-br from-gray-900 to-gray-800 text-white rounded-2xl shadow-sm p-5 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-emerald-400 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Article Quality Checklist
                    </h3>
                    <ul class="space-y-2 text-xs text-gray-300">
                        <li id="checkTitle" class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-white/10 flex items-center justify-center text-[10px]">○</span>
                            <span>Article Title specified</span>
                        </li>
                        <li id="checkSlug" class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-white/10 flex items-center justify-center text-[10px]">○</span>
                            <span>SEO-friendly custom URL</span>
                        </li>
                        <li id="checkContent" class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-white/10 flex items-center justify-center text-[10px]">○</span>
                            <span>Content over 50 words</span>
                        </li>
                        <li id="checkImage" class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-white/10 flex items-center justify-center text-[10px]">○</span>
                            <span>Cover image added</span>
                        </li>
                        <li id="checkMeta" class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full bg-white/10 flex items-center justify-center text-[10px]">○</span>
                            <span>Meta description added</span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </form>
</div>

<!-- Standalone Fullscreen Live Customer Preview Modal -->
<div id="fullscreenPreviewModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden flex-col">
    <!-- Modal Top Bar -->
    <div class="bg-gray-900 text-white px-6 py-3 flex items-center justify-between border-b border-gray-800 flex-shrink-0">
        <div class="flex items-center gap-3">
            <span class="text-sm font-black tracking-tight text-white font-heading">LIVE ARTICLE CUSTOMER SIMULATOR</span>
            <span class="text-xs text-emerald-400 bg-emerald-500/20 px-2.5 py-0.5 rounded-full border border-emerald-500/30">Live Sync</span>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" id="btnCloseFullscreenModal" class="px-3.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                <span>Close Preview</span>
            </button>
        </div>
    </div>
    <!-- Modal Body -->
    <div class="flex-1 overflow-y-auto p-4 sm:p-10 bg-[#fafaf9]">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl p-8 sm:p-14 shadow-xl border border-stone-200/80">
            <!-- Header -->
            <header class="text-center mb-10">
                <div class="flex items-center justify-center gap-3 text-xs sm:text-sm font-bold text-emerald-700 uppercase tracking-widest mb-4">
                    <span>{{ date('M d, Y') }}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500/40"></span>
                    <span>BY <span class="live-sim-author">{{ $blog->author_name ?? 'Admin' }}</span></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500/40"></span>
                    <span class="live-sim-read-time">~1 min read</span>
                </div>
                <h1 class="live-sim-title font-heading text-3xl sm:text-5xl font-black text-stone-900 leading-tight mb-8">
                    {{ $blog->title ?: 'Your Article Title Goes Here' }}
                </h1>
                <div class="live-sim-cover-wrapper rounded-3xl overflow-hidden aspect-[21/9] bg-stone-100 shadow-xl border border-stone-200/60 relative">
                    <img src="{{ $blog->image ? Storage::url($blog->image) : '' }}" 
                         alt="Cover Image" 
                         class="live-sim-cover-img {{ $blog->image ? '' : 'hidden' }} w-full h-full object-cover">
                    <div class="live-sim-cover-placeholder {{ $blog->image ? 'hidden' : 'flex' }} w-full h-full flex-col items-center justify-center text-stone-400 p-8 text-center">
                        <span class="text-sm font-bold text-stone-600 uppercase tracking-wider">Cover Image Preview</span>
                    </div>
                </div>
            </header>
            <div class="live-sim-content prose max-w-none prose-mg text-stone-800">
                {!! $blog->content ?: '<p class="text-stone-400 italic text-center py-12">Start typing article content in the editor to see your live formatted post rendered here...</p>' !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- TinyMCE 6 Rich Text Editor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Client-side image optimizer: automatically downscales high-res / heavy images (> 800KB or > 1920px)
        // so that uploads finish in milliseconds, look crystal sharp, and NEVER trigger HTTP 413 (Payload Too Large)!
        function compressImageIfLarge(fileOrBlob, callback) {
            try {
                var type = fileOrBlob.type || '';
                // Don't process SVG or animated GIFs
                if (type.indexOf('svg') !== -1 || type.indexOf('gif') !== -1) {
                    callback(fileOrBlob);
                    return;
                }
                // If smaller than 800KB and valid, can proceed directly
                if (fileOrBlob.size && fileOrBlob.size < 800000) {
                    callback(fileOrBlob);
                    return;
                }

                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = new Image();
                    img.onload = function () {
                        var maxDim = 1920;
                        var width = img.width;
                        var height = img.height;

                        if (width > maxDim || height > maxDim || (fileOrBlob.size && fileOrBlob.size >= 800000)) {
                            if (width > height && width > maxDim) {
                                height = Math.round((height * maxDim) / width);
                                width = maxDim;
                            } else if (height > maxDim) {
                                width = Math.round((width * maxDim) / height);
                                height = maxDim;
                            }

                            var canvas = document.createElement('canvas');
                            canvas.width = width;
                            canvas.height = height;
                            var ctx = canvas.getContext('2d');
                            ctx.drawImage(img, 0, 0, width, height);

                            canvas.toBlob(function (blob) {
                                if (blob && blob.size < (fileOrBlob.size || Infinity)) {
                                    callback(blob);
                                } else {
                                    callback(fileOrBlob);
                                }
                            }, 'image/jpeg', 0.85);
                        } else {
                            callback(fileOrBlob);
                        }
                    };
                    img.onerror = function () {
                        callback(fileOrBlob);
                    };
                    img.src = e.target.result;
                };
                reader.onerror = function () {
                    callback(fileOrBlob);
                };
                reader.readAsDataURL(fileOrBlob);
            } catch (err) {
                callback(fileOrBlob);
            }
        }

        // 1. Initialize TinyMCE Editor with Free-Form Image Resizing & Text Safety
        tinymce.init({
            selector: '#tinymceEditor',
            height: 600,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'quickbars'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | ' +
                     'alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist outdent indent | ' +
                     'table link quickimageupload media | lineheight removeformat code fullscreen preview',
            toolbar_mode: 'wrap',
            toolbar_sticky: false,
            branding: false,
            promotion: false,
            fontsize_formats: '8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 28pt 32pt 36pt 48pt 64pt',
            fontfamily_formats: 'Inter=Inter, sans-serif; Outfit=Outfit, sans-serif; Arial=arial,helvetica,sans-serif; Georgia=georgia,palatino,serif; Courier New=courier new,courier,monospace',
            quickbars_selection_toolbar: 'bold italic underline strikethrough | forecolor backcolor | blocks | quicklink blockquote',
            quickbars_insert_toolbar: false,
            
            // Image Resizing: FREE-WAY RESIZING in both length (height) and width!
            object_resizing: true, // Enables native 8-point drag resize handles
            resize_img_proportional: false, // FREE-FORM resizing! Drag length (height) or width independently!
            block_unsupported_drop: false, // Prevents "Dropped file type is not supported" error on internal image drags!
            images_file_types: 'jpg,jpeg,png,gif,webp,svg,bmp,tiff',
            image_dimensions: true,
            image_advtab: true,
            image_caption: true,
            image_title: true,
            paste_data_images: true,
            images_upload_url: '/admin/upload-image',
            automatic_uploads: true,
            file_picker_types: 'image',

            // Prevent TinyMCE from converting absolute /storage/ URLs to relative ../../storage/
            // and do NOT set document_base_url to '/' so iframe resolves root-relative URLs against host
            relative_urls: false,
            remove_script_host: true,
            convert_urls: true,

            content_style: `
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&display=swap');
                html {
                    background-color: #FAFAF5;
                    padding: 0;
                    margin: 0;
                }
                body { 
                    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; 
                    font-size: 1.05rem; 
                    line-height: 1.8; 
                    color: #374151; 
                    background-color: #ffffff;
                    max-width: 896px;
                    margin: 16px auto;
                    padding: 24px 32px;
                    box-sizing: border-box;
                    min-height: calc(100vh - 32px);
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08), 0 1px 2px -1px rgba(0, 0, 0, 0.08);
                    border: 1px solid #e2e8f0;
                    border-radius: 12px;
                    overflow-wrap: break-word !important;
                    word-wrap: break-word !important;
                    word-break: break-word !important;
                    user-select: text !important;
                    -webkit-user-select: text !important;
                }
                * {
                    overflow-wrap: break-word !important;
                    word-wrap: break-word !important;
                    word-break: break-word !important;
                }
                body, p, h1, h2, h3, h4, h5, h6, span, strong, em, b, i, li, blockquote, td, th {
                    user-select: text !important;
                    -webkit-user-select: text !important;
                }
                ::selection {
                    background-color: #bfdbfe !important;
                    color: #1e3a8a !important;
                }
                ::-moz-selection {
                    background-color: #bfdbfe !important;
                    color: #1e3a8a !important;
                }
                h1, h2, h3, h4, h5, h6 { 
                    font-family: 'Outfit', sans-serif; 
                    color: #111827; 
                    font-weight: 700; 
                }
                h1 { font-size: 2rem; font-weight: 800; margin-top: 1.75rem; margin-bottom: 0.875rem; line-height: 1.25; }
                h2 { font-size: 1.65rem; font-weight: 800; margin-top: 1.75rem; margin-bottom: 0.75rem; border-bottom: 2px solid rgba(46, 139, 87, 0.15); padding-bottom: 0.4rem; line-height: 1.3; }
                h3 { font-size: 1.35rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.65rem; line-height: 1.4; }
                h4 { font-size: 1.15rem; font-weight: 700; margin-top: 1.25rem; margin-bottom: 0.5rem; line-height: 1.4; }
                p { margin-bottom: 1.25rem; color: #374151; line-height: 1.8; }
                img { 
                    max-width: 100%; 
                    cursor: grab !important; 
                    border-radius: 12px; 
                    box-sizing: border-box;
                    transition: outline 0.15s ease, box-shadow 0.15s ease;
                    -webkit-user-drag: element !important;
                    user-drag: element !important;
                }
                img:active, img[data-mce-selected]:active {
                    cursor: grabbing !important;
                }
                img:not([style*="height"]):not([height]) {
                    height: auto;
                }
                img[style*="float: left"],
                img[style*="float:left"],
                img.alignleft,
                img.align-left {
                    float: left !important;
                    margin: 0.5rem 1.5rem 1rem 0 !important;
                    clear: none !important;
                }
                img[style*="float: right"],
                img[style*="float:right"],
                img.alignright,
                img.align-right {
                    float: right !important;
                    margin: 0.5rem 0 1rem 1.5rem !important;
                    clear: none !important;
                }
                img[style*="margin: auto"],
                img[style*="margin:auto"],
                img[style*="margin-left: auto"],
                img.aligncenter,
                img.align-center {
                    float: none !important;
                    margin: 1.5rem auto !important;
                    display: block !important;
                }
                /* Zero margin for paragraph containing only floated image so adjacent text starts at the exact top */
                p:has(> img[style*="float: left"]:only-child),
                p:has(> img[style*="float:left"]:only-child),
                p:has(> img[style*="float: right"]:only-child),
                p:has(> img[style*="float:right"]:only-child),
                p:has(> img.alignleft:only-child),
                p:has(> img.alignright:only-child) {
                    margin-bottom: 0 !important;
                }
                /* Prominent green glow on selected image */
                img[data-mce-selected] { 
                    outline: 3px solid #10b981 !important; 
                    outline-offset: 3px !important; 
                    box-shadow: 0 0 0 5px rgba(16, 185, 129, 0.25) !important; 
                    cursor: grab !important;
                }
                blockquote { 
                    border-left: 4px solid #2E8B57; 
                    background: rgba(46, 139, 87, 0.05); 
                    padding: 1.1rem 1.35rem; 
                    border-radius: 0 0.875rem 0.875rem 0; 
                    font-style: italic; 
                    color: #475569;
                    margin: 1.5rem 0; 
                }
                table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; font-size: 0.95rem; }
                th, td { border: 1px solid #e2e8f0; padding: 0.75rem 0.875rem; }
                th { background-color: #f8fafc; font-weight: 700; color: #111827; }
                td { color: #374151; }
            `,
            file_picker_callback: function (cb, value, meta) {
                var ed = tinymce.activeEditor;
                var savedBookmark = null;
                try {
                    if (ed && ed.selection) {
                        savedBookmark = ed.selection.getBookmark(2, true);
                    }
                } catch (e) {}

                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    var file = this.files[0];
                    if (!file) return;

                    compressImageIfLarge(file, function (optimizedFile) {
                        var formData = new FormData();
                        var tokenInput = document.querySelector('input[name="_token"]');
                        if (tokenInput) {
                            formData.append('_token', tokenInput.value);
                        }
                        var filename = file.name || 'image.jpg';
                        formData.append('upload', optimizedFile, filename);

                        var xhr = new XMLHttpRequest();
                        xhr.withCredentials = true;
                        xhr.open('POST', '/admin/upload-image');
                        if (tokenInput) {
                            xhr.setRequestHeader('X-CSRF-TOKEN', tokenInput.value);
                        }

                        xhr.onload = function () {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                try {
                                    var json = JSON.parse(xhr.responseText);
                                    var imageUrl = json.location || json.url;
                                    if (imageUrl) {
                                        if (savedBookmark && ed && ed.selection) {
                                            try {
                                                ed.selection.moveToBookmark(savedBookmark);
                                                ed.selection.collapse(false);
                                            } catch (e) {}
                                        }
                                        cb(imageUrl, { title: file.name, alt: file.name });
                                        return;
                                    }
                                } catch (e) {}
                            }
                            if (xhr.status === 413) {
                                alert('Image file is too large for the server.');
                            } else {
                                alert('Image upload failed. Please try again.');
                            }
                        };

                        xhr.onerror = function () {
                            alert('Network error while uploading image.');
                        };

                        xhr.send(formData);
                    });
                };

                input.click();
            },
            images_upload_handler: function (blobInfo, progress) {
                return new Promise(function (resolve, reject) {
                    var rawBlob = blobInfo.blob();
                    compressImageIfLarge(rawBlob, function (optimizedBlob) {
                        var xhr = new XMLHttpRequest();
                        xhr.withCredentials = true;
                        xhr.open('POST', '/admin/upload-image');
                        
                        var tokenInput = document.querySelector('input[name="_token"]');
                        var token = tokenInput ? tokenInput.value : '';
                        if (token) {
                            xhr.setRequestHeader("X-CSRF-TOKEN", token);
                        }

                        xhr.upload.onprogress = function (e) {
                            if (e.lengthComputable) {
                                progress(e.loaded / e.total * 100);
                            }
                        };

                        xhr.onload = function () {
                            if (xhr.status === 419 || xhr.status === 403) {
                                reject('Session or CSRF token expired. Please refresh the page.');
                                return;
                            }
                            if (xhr.status === 413) {
                                reject('Image file is too large for the server. Maximum allowed size is 64MB.');
                                return;
                            }
                            if (xhr.status < 200 || xhr.status >= 300) {
                                var errText = 'HTTP Error: ' + xhr.status;
                                try {
                                    var errJson = JSON.parse(xhr.responseText);
                                    if (errJson && errJson.error && errJson.error.message) {
                                        errText = errJson.error.message;
                                    }
                                } catch (e) {}
                                reject(errText);
                                return;
                            }
                            try {
                                var json = JSON.parse(xhr.responseText);
                                var imageUrl = json.location || json.url;
                                if (!imageUrl) {
                                    reject('Invalid server response.');
                                    return;
                                }
                                resolve(imageUrl);
                            } catch (e) {
                                reject('Invalid server JSON response.');
                            }
                        };

                        xhr.onerror = function () {
                            reject('Image upload failed due to a network error.');
                        };

                        var formData = new FormData();
                        if (token) {
                            formData.append('_token', token);
                        }
                        var filename = blobInfo.filename() || 'image.jpg';
                        formData.append('upload', optimizedBlob, filename);
                        xhr.send(formData);
                    });
                });
            },
            setup: function (editor) {
                // 1-Click Direct Image Upload Button
                editor.ui.registry.addButton('quickimageupload', {
                    icon: 'image',
                    tooltip: 'Upload & Insert Image directly (without losing text)',
                    onAction: function () {
                        // Crucial: Save exact cursor selection bookmark BEFORE opening file dialog
                        var savedBookmark = null;
                        try {
                            savedBookmark = editor.selection.getBookmark(2, true);
                        } catch (e) {}

                        var fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.accept = 'image/*';
                        fileInput.onchange = function () {
                            var file = this.files[0];
                            if (!file) return;

                            var notif = editor.notificationManager.open({
                                text: 'Uploading ' + file.name + '...',
                                type: 'info'
                            });

                            compressImageIfLarge(file, function (optimizedFile) {
                                var formData = new FormData();
                                var tokenInput = document.querySelector('input[name="_token"]');
                                if (tokenInput) {
                                    formData.append('_token', tokenInput.value);
                                }
                                formData.append('upload', optimizedFile, file.name);

                                var xhr = new XMLHttpRequest();
                                xhr.withCredentials = true;
                                xhr.open('POST', '/admin/upload-image');
                                if (tokenInput) {
                                    xhr.setRequestHeader('X-CSRF-TOKEN', tokenInput.value);
                                }

                                xhr.onload = function () {
                                    notif.close();
                                    if (xhr.status >= 200 && xhr.status < 300) {
                                        try {
                                            var json = JSON.parse(xhr.responseText);
                                            var imageUrl = json.location || json.url;
                                            if (imageUrl) {
                                                editor.focus();
                                                // Restore cursor position bookmark
                                                if (savedBookmark) {
                                                    try {
                                                        editor.selection.moveToBookmark(savedBookmark);
                                                    } catch (e) {}
                                                }
                                                // Collapse selection to end so existing typed text is NEVER replaced or wiped out!
                                                editor.selection.collapse(false);

                                                var cleanImgHtml = '<p><img src="' + imageUrl + '" alt="' + file.name.replace(/\.[^/.]+$/, "") + '" class="mg-article-img" style="max-width: 100%; margin: 1.5rem auto; display: block;" /></p><p><br></p>';
                                                editor.insertContent(cleanImgHtml);

                                                editor.notificationManager.open({
                                                    text: 'Image inserted! Select it to drag resize in width/length or click ❌ to remove.',
                                                    type: 'success',
                                                    timeout: 3500
                                                });
                                                syncLivePreview();
                                                return;
                                            }
                                        } catch (e) {}
                                    }
                                    var errMsg = 'Image upload failed. Please try again.';
                                    if (xhr.status === 413) {
                                        errMsg = 'Image file is too large for the server. Upload limit is 64MB.';
                                    } else {
                                        try {
                                            var errJson = JSON.parse(xhr.responseText);
                                            if (errJson && errJson.error && errJson.error.message) {
                                                errMsg = errJson.error.message;
                                            } else if (errJson && errJson.message) {
                                                errMsg = errJson.message;
                                            }
                                        } catch (e) {}
                                    }
                                    editor.notificationManager.open({
                                        text: errMsg,
                                        type: 'error',
                                        timeout: 5000
                                    });
                                };

                                xhr.onerror = function () {
                                    notif.close();
                                    editor.notificationManager.open({
                                        text: 'Network error while uploading image.',
                                        type: 'error',
                                        timeout: 4000
                                    });
                                };

                                xhr.send(formData);
                            });
                        };
                        fileInput.click();
                    }
                });

                // Helper: Get active selected or targeted image reliably
                function getSelectedImg() {
                    if (!editor || !editor.selection) return null;

                    // If text is actively selected across characters, NO image is selected!
                    try {
                        if (!editor.selection.isCollapsed()) {
                            var content = editor.selection.getContent({ format: 'text' });
                            if (content && content.trim().length > 0) {
                                return null;
                            }
                        }
                    } catch (e) {}

                    var node = editor.selection.getNode();
                    if (node && node.nodeName && node.nodeName.toLowerCase() === 'img') return node;

                    // Check data-mce-selected attribute only if current node is that image or its container
                    var body = editor.getBody();
                    if (body) {
                        var selImg = body.querySelector('img[data-mce-selected]');
                        if (selImg && (node === selImg || node === selImg.parentElement)) return selImg;
                    }

                    // Check if node or parent has an image and no other significant text
                    if (node) {
                        var img = node.querySelector('img');
                        if (img) {
                            var txt = (node.textContent || '').trim();
                            if (!txt || txt.length === 0) return img;
                        }
                        var parent = node.parentElement;
                        if (parent && parent.nodeName.toLowerCase() === 'p') {
                            var pImg = parent.querySelector('img');
                            if (pImg) {
                                var pTxt = (parent.textContent || '').trim();
                                if (!pTxt || pTxt.length === 0) return pImg;
                            }
                        }
                    }
                    return null;
                }

                function deleteSelectedImg() {
                    var img = getSelectedImg();
                    if (img) {
                        editor.undoManager.transact(function () {
                            var parent = img.parentElement;
                            img.remove();
                            if (parent && parent.nodeName.toLowerCase() === 'p' && (parent.innerHTML.trim() === '' || parent.innerHTML === '<br>')) {
                                parent.remove();
                            }
                            editor.nodeChanged();
                            syncLivePreview();
                            updateChecklist();
                        });
                    }
                }

                function setImgWidth(val) {
                    var img = getSelectedImg();
                    if (img) {
                        editor.undoManager.transact(function () {
                            img.style.width = val;
                            img.removeAttribute('width');
                            editor.nodeChanged();
                            syncLivePreview();
                        });
                    }
                }

                function adjustImgWidth(delta) {
                    var img = getSelectedImg();
                    if (img) {
                        editor.undoManager.transact(function () {
                            var curr = img.clientWidth || img.offsetWidth || 300;
                            img.style.width = Math.max(40, curr + delta) + 'px';
                            img.removeAttribute('width');
                            editor.nodeChanged();
                            syncLivePreview();
                        });
                    }
                }

                function adjustImgHeight(delta) {
                    var img = getSelectedImg();
                    if (img) {
                        editor.undoManager.transact(function () {
                            var curr = img.clientHeight || img.offsetHeight || 200;
                            img.style.height = Math.max(30, curr + delta) + 'px';
                            img.removeAttribute('height');
                            editor.nodeChanged();
                            syncLivePreview();
                        });
                    }
                }

                function resetImgAuto() {
                    var img = getSelectedImg();
                    if (img) {
                        editor.undoManager.transact(function () {
                            img.style.width = '';
                            img.style.height = '';
                            img.removeAttribute('width');
                            img.removeAttribute('height');
                            editor.nodeChanged();
                            syncLivePreview();
                        });
                    }
                }

                function setImgAlign(align) {
                    var img = getSelectedImg();
                    if (!img) return;
                    editor.undoManager.transact(function () {
                        var parent = img.parentElement;

                        // Clear parent block text-align so normal LTR typing is preserved
                        if (parent) {
                            parent.style.removeProperty('text-align');
                            if (parent.style.textAlign) parent.style.textAlign = '';
                            parent.removeAttribute('align');
                        }
                        img.style.removeProperty('text-align');
                        img.removeAttribute('align');

                        if (align === 'left') {
                            img.style.float = 'left';
                            img.style.margin = '0.5rem 1.5rem 1rem 0';
                            img.style.removeProperty('display');
                        } else if (align === 'right') {
                            img.style.float = 'right';
                            img.style.margin = '0.5rem 0 1rem 1.5rem';
                            img.style.removeProperty('display');
                        } else {
                            img.style.float = 'none';
                            img.style.margin = '1.5rem auto';
                            img.style.display = 'block';
                        }
                        editor.nodeChanged();
                        syncLivePreview();
                        updateChecklist();
                    });
                }

                // Move Image Up / Down across paragraphs
                function moveImgUp() {
                    var img = getSelectedImg();
                    if (!img) return;
                    editor.undoManager.transact(function () {
                        var block = editor.dom.getParent(img, 'p,h1,h2,h3,h4,h5,h6,div,blockquote,table');
                        if (block && block.previousElementSibling) {
                            block.parentNode.insertBefore(block, block.previousElementSibling);
                            editor.selection.select(img);
                            editor.nodeChanged();
                            syncLivePreview();
                            updateChecklist();
                        }
                    });
                }

                function moveImgDown() {
                    var img = getSelectedImg();
                    if (!img) return;
                    editor.undoManager.transact(function () {
                        var block = editor.dom.getParent(img, 'p,h1,h2,h3,h4,h5,h6,div,blockquote,table');
                        if (block && block.nextElementSibling) {
                            block.parentNode.insertBefore(block.nextElementSibling, block);
                            editor.selection.select(img);
                            editor.nodeChanged();
                            syncLivePreview();
                            updateChecklist();
                        }
                    });
                }

                // Register 3-Dots Vertical SVG Icon
                editor.ui.registry.addIcon('dots-vertical', '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2.2"/><circle cx="12" cy="12" r="2.2"/><circle cx="12" cy="19" r="2.2"/></svg>');

                var isImageToolbarExpanded = false;

                // 1. 3-Dots Menu Button: Displays compact ⋮ icon with full editing tools dropdown
                editor.ui.registry.addMenuButton('img_menu_3dot', {
                    icon: 'dots-vertical',
                    text: 'Options',
                    tooltip: 'Image Options (Move, Resize, Align, Dimensions)',
                    fetch: function (callback) {
                        var items = [
                            {
                                type: 'menuitem',
                                text: '❌ Delete Image',
                                onAction: function () {
                                    deleteSelectedImg();
                                }
                            },
                            {
                                type: 'separator'
                            },
                            {
                                type: 'menuitem',
                                text: '✍️ Type Text Above Image (New Paragraph)',
                                onAction: function () {
                                    var img = getSelectedImg();
                                    if (!img) return;
                                    editor.undoManager.transact(function () {
                                        var block = editor.dom.getParent(img, 'p,h1,h2,h3,h4,h5,h6,div,blockquote') || img;
                                        var newP = editor.dom.create('p', {}, '<br>');
                                        block.parentNode.insertBefore(newP, block);
                                        editor.selection.setCursorLocation(newP, 0);
                                        editor.focus();
                                        syncLivePreview();
                                    });
                                }
                            },
                            {
                                type: 'menuitem',
                                text: '✍️ Type Text Beside / Below Image',
                                onAction: function () {
                                    var img = getSelectedImg();
                                    if (!img) return;
                                    editor.undoManager.transact(function () {
                                        var block = editor.dom.getParent(img, 'p,h1,h2,h3,h4,h5,h6,div,blockquote') || img;
                                        var newP = editor.dom.create('p', {}, '<br>');
                                        if (block.nextSibling) {
                                            block.parentNode.insertBefore(newP, block.nextSibling);
                                        } else {
                                            block.parentNode.appendChild(newP);
                                        }
                                        editor.selection.setCursorLocation(newP, 0);
                                        editor.focus();
                                        syncLivePreview();
                                    });
                                }
                            },
                            {
                                type: 'separator'
                            },
                            {
                                type: 'nestedmenuitem',
                                text: '↕️ Move Position (Up / Down)',
                                getSubmenuItems: function () {
                                    return [
                                        {
                                            type: 'menuitem',
                                            text: '▲ Move Above Previous Paragraph',
                                            onAction: function () { moveImgUp(); }
                                        },
                                        {
                                            type: 'menuitem',
                                            text: '▼ Move Below Next Paragraph',
                                            onAction: function () { moveImgDown(); }
                                        }
                                    ];
                                }
                            },
                            {
                                type: 'nestedmenuitem',
                                text: '📐 Width Presets',
                                getSubmenuItems: function () {
                                    return [
                                        { type: 'menuitem', text: '100% Full Width', onAction: function () { setImgWidth('100%'); } },
                                        { type: 'menuitem', text: '75% Width', onAction: function () { setImgWidth('75%'); } },
                                        { type: 'menuitem', text: '50% Width', onAction: function () { setImgWidth('50%'); } },
                                        { type: 'menuitem', text: '25% Width', onAction: function () { setImgWidth('25%'); } }
                                    ];
                                }
                            },
                            {
                                type: 'nestedmenuitem',
                                text: '↔️ Adjust Width (W +/-)',
                                getSubmenuItems: function () {
                                    return [
                                        { type: 'menuitem', text: 'Wider: Width +50px (W +)', onAction: function () { adjustImgWidth(50); } },
                                        { type: 'menuitem', text: 'Narrower: Width -50px (W -)', onAction: function () { adjustImgWidth(-50); } }
                                    ];
                                }
                            },
                            {
                                type: 'nestedmenuitem',
                                text: '↕️ Adjust Length (L +/-)',
                                getSubmenuItems: function () {
                                    return [
                                        { type: 'menuitem', text: 'Taller: Length +50px (L +)', onAction: function () { adjustImgHeight(50); } },
                                        { type: 'menuitem', text: 'Shorter: Length -50px (L -)', onAction: function () { adjustImgHeight(-50); } }
                                    ];
                                }
                            },
                            {
                                type: 'menuitem',
                                text: '🔄 Reset to Auto Dimensions',
                                onAction: function () {
                                    resetImgAuto();
                                }
                            },
                            {
                                type: 'separator'
                            },
                            {
                                type: 'nestedmenuitem',
                                text: '🧭 Alignment & Wrapping',
                                getSubmenuItems: function () {
                                    return [
                                        { type: 'menuitem', icon: 'align-left', text: 'Align Left (Wrap Text)', onAction: function () { setImgAlign('left'); } },
                                        { type: 'menuitem', icon: 'align-center', text: 'Align Center (Block)', onAction: function () { setImgAlign('center'); } },
                                        { type: 'menuitem', icon: 'align-right', text: 'Align Right (Wrap Text)', onAction: function () { setImgAlign('right'); } }
                                    ];
                                }
                            },
                            {
                                type: 'separator'
                            },
                            {
                                type: 'menuitem',
                                icon: 'preferences',
                                text: '⚙️ Exact Dimensions Dialog...',
                                onAction: function () {
                                    editor.execCommand('mceImage');
                                }
                            },
                            {
                                type: 'menuitem',
                                text: '🗛 Show All Buttons (Expand Bar)',
                                onAction: function () {
                                    isImageToolbarExpanded = true;
                                    editor.nodeChanged();
                                }
                            }
                        ];
                        callback(items);
                    }
                });

                // 2. Compact Delete (❌) Button
                editor.ui.registry.addButton('img_delete', {
                    text: '❌',
                    tooltip: 'Delete this image',
                    onAction: function () {
                        deleteSelectedImg();
                    }
                });

                // 3. Move Up & Down Buttons
                editor.ui.registry.addButton('img_move_up', {
                    text: '▲ Up',
                    tooltip: 'Move Image Above (Previous Paragraph)',
                    onAction: function () { moveImgUp(); }
                });

                editor.ui.registry.addButton('img_move_down', {
                    text: '▼ Down',
                    tooltip: 'Move Image Below (Next Paragraph)',
                    onAction: function () { moveImgDown(); }
                });

                // 4. Collapse Bar Button (Used on expanded bar to return to compact 3-dots)
                editor.ui.registry.addButton('img_collapse_bar', {
                    text: '◀ 3-Dots',
                    tooltip: 'Minimize toolbar to compact 3-dots',
                    onAction: function () {
                        isImageToolbarExpanded = false;
                        editor.nodeChanged();
                    }
                });

                // 5. Width Preset Buttons (for expanded bar)
                editor.ui.registry.addButton('imgsize_25', {
                    text: '25%',
                    tooltip: 'Set width to 25%',
                    onAction: function () { setImgWidth('25%'); }
                });

                editor.ui.registry.addButton('imgsize_50', {
                    text: '50%',
                    tooltip: 'Set width to 50%',
                    onAction: function () { setImgWidth('50%'); }
                });

                editor.ui.registry.addButton('imgsize_75', {
                    text: '75%',
                    tooltip: 'Set width to 75%',
                    onAction: function () { setImgWidth('75%'); }
                });

                editor.ui.registry.addButton('imgsize_100', {
                    text: '100%',
                    tooltip: 'Set full width (100%)',
                    onAction: function () { setImgWidth('100%'); }
                });

                // 6. Manual Width & Length Step Adjustment Buttons (for expanded bar)
                editor.ui.registry.addButton('img_w_minus', {
                    text: 'W -',
                    tooltip: 'Decrease Width (-50px)',
                    onAction: function () { adjustImgWidth(-50); }
                });

                editor.ui.registry.addButton('img_w_plus', {
                    text: 'W +',
                    tooltip: 'Increase Width (+50px)',
                    onAction: function () { adjustImgWidth(50); }
                });

                editor.ui.registry.addButton('img_h_minus', {
                    text: 'L -',
                    tooltip: 'Decrease Length / Height (-50px)',
                    onAction: function () { adjustImgHeight(-50); }
                });

                editor.ui.registry.addButton('img_h_plus', {
                    text: 'L +',
                    tooltip: 'Increase Length / Height (+50px)',
                    onAction: function () { adjustImgHeight(50); }
                });

                editor.ui.registry.addButton('img_auto', {
                    text: 'Auto',
                    tooltip: 'Reset to natural proportions',
                    onAction: function () { resetImgAuto(); }
                });

                // 7. Alignment Buttons (for expanded bar)
                editor.ui.registry.addButton('imgalign_left', {
                    icon: 'align-left',
                    tooltip: 'Align Left (Wrap Text around image)',
                    onAction: function () { setImgAlign('left'); }
                });

                editor.ui.registry.addButton('imgalign_center', {
                    icon: 'align-center',
                    tooltip: 'Align Center (Block on own line)',
                    onAction: function () { setImgAlign('center'); }
                });

                editor.ui.registry.addButton('imgalign_right', {
                    icon: 'align-right',
                    tooltip: 'Align Right (Wrap Text around image)',
                    onAction: function () { setImgAlign('right'); }
                });

                editor.ui.registry.addButton('img_edit_props', {
                    icon: 'preferences',
                    tooltip: 'Exact Dimensions & Aspect Ratio Dialog',
                    text: '⚙️ Size',
                    onAction: function () {
                        editor.execCommand('mceImage');
                    }
                });

                // Context Toolbar A: COMPACT 3-DOTS (Default - ONLY when image itself is strictly selected!)
                editor.ui.registry.addContextToolbar('image-compact-tools', {
                    predicate: function (node) {
                        return node && node.nodeName && node.nodeName.toLowerCase() === 'img' && !isImageToolbarExpanded;
                    },
                    items: 'img_menu_3dot img_move_up img_move_down img_delete',
                    position: 'node',
                    scope: 'node'
                });

                // Context Toolbar B: EXPANDED ALL BUTTONS (ONLY when image itself is strictly selected!)
                editor.ui.registry.addContextToolbar('image-expanded-tools', {
                    predicate: function (node) {
                        return node && node.nodeName && node.nodeName.toLowerCase() === 'img' && isImageToolbarExpanded;
                    },
                    items: 'img_collapse_bar | img_delete | img_move_up img_move_down | imgsize_25 imgsize_50 imgsize_75 imgsize_100 | img_w_minus img_w_plus | img_h_minus img_h_plus | img_auto | imgalign_left imgalign_center imgalign_right | img_edit_props',
                    position: 'node',
                    scope: 'node'
                });

                // Ensure all images are explicitly draggable="true"
                function ensureDraggableImages() {
                    var body = editor.getBody();
                    if (!body) return;
                    var imgs = body.querySelectorAll('img');
                    imgs.forEach(function (img) {
                        if (img.getAttribute('draggable') !== 'true') {
                            img.setAttribute('draggable', 'true');
                        }
                    });
                }

                // Smooth Free HTML5 Drag-and-Drop: Drag any image freely to any paragraph or position on page!
                var draggedImgNode = null;
                var draggedImgHtml = '';

                editor.on('dragstart', function (e) {
                    var target = e.target;
                    if (target && target.nodeName && target.nodeName.toLowerCase() === 'img') {
                        draggedImgNode = target;
                        draggedImgHtml = target.outerHTML;
                        if (e.dataTransfer) {
                            e.dataTransfer.effectAllowed = 'move';
                            try {
                                e.dataTransfer.setData('text/html', draggedImgHtml);
                                e.dataTransfer.setData('text/plain', target.src || '');
                            } catch (err) {}
                        }
                    }
                });

                editor.on('dragover', function (e) {
                    if (draggedImgNode) {
                        e.preventDefault(); // Allows drop anywhere in the editor
                        if (e.dataTransfer) {
                            e.dataTransfer.dropEffect = 'move';
                        }
                    }
                });

                editor.on('drop', function (e) {
                    if (draggedImgNode && draggedImgHtml) {
                        e.preventDefault();
                        e.stopPropagation();

                        var doc = editor.getDoc();
                        var range = null;

                        if (doc.caretRangeFromPoint) {
                            range = doc.caretRangeFromPoint(e.clientX, e.clientY);
                        } else if (doc.caretPositionFromPoint) {
                            var pos = doc.caretPositionFromPoint(e.clientX, e.clientY);
                            if (pos) {
                                range = doc.createRange();
                                range.setStart(pos.offsetNode, pos.offset);
                                range.collapse(true);
                            }
                        }

                        editor.undoManager.transact(function () {
                            var oldNode = draggedImgNode;
                            var oldParent = oldNode ? oldNode.parentElement : null;
                            var htmlToInsert = draggedImgHtml || (oldNode ? oldNode.outerHTML : '');

                            if (range) {
                                editor.selection.setRng(range);
                            }
                            if (htmlToInsert) {
                                editor.insertContent(htmlToInsert);
                            }

                            if (oldNode && oldNode.parentNode) {
                                oldNode.parentNode.removeChild(oldNode);
                            }
                            if (oldParent && oldParent.nodeName.toLowerCase() === 'p' && (oldParent.innerHTML.trim() === '' || oldParent.innerHTML === '<br>')) {
                                oldParent.remove();
                            }

                            ensureDraggableImages();
                            editor.nodeChanged();
                            syncLivePreview();
                            updateChecklist();
                        });

                        draggedImgNode = null;
                        draggedImgHtml = '';
                    }

                    // Auto-dismiss any spurious "Dropped file type is not supported" alert
                    setTimeout(function () {
                        try {
                            var notifs = editor.notificationManager.getNotifications();
                            notifs.forEach(function (n) {
                                if (n && n.text && n.text.indexOf('Dropped file type') !== -1) {
                                    n.close();
                                }
                            });
                        } catch (err) {}
                    }, 40);
                });

                editor.on('dragend', function () {
                    draggedImgNode = null;
                    draggedImgHtml = '';
                    setTimeout(function () {
                        try {
                            var notifs = editor.notificationManager.getNotifications();
                            notifs.forEach(function (n) {
                                if (n && n.text && n.text.indexOf('Dropped file type') !== -1) {
                                    n.close();
                                }
                            });
                        } catch (err) {}
                    }, 40);
                });

                // Intercept Top Toolbar Alignment buttons (Align Left, Align Right, Align Center) when an image is selected
                editor.on('PreExecCommand', function (e) {
                    var cmd = (e.command || '').toLowerCase();
                    if (cmd === 'justifyleft' || cmd === 'justifyright' || cmd === 'justifycenter' || cmd === 'justifyfull') {
                        var img = getSelectedImg();
                        if (img) {
                            e.preventDefault();
                            e.stopPropagation();
                            if (cmd === 'justifyleft') setImgAlign('left');
                            else if (cmd === 'justifyright') setImgAlign('right');
                            else if (cmd === 'justifycenter' || cmd === 'justifyfull') setImgAlign('center');
                            return false;
                        }
                    }
                });

                editor.on('ExecCommand', function (e) {
                    var cmd = (e.command || '').toLowerCase();
                    if (cmd === 'justifyleft' || cmd === 'justifyright' || cmd === 'justifycenter' || cmd === 'justifyfull') {
                        var img = getSelectedImg();
                        if (img) {
                            var parent = img.parentElement;
                            if (parent && parent.style.textAlign) {
                                parent.style.removeProperty('text-align');
                                if (parent.style.textAlign) parent.style.textAlign = '';
                            }
                            if (cmd === 'justifyleft' && img.style.float !== 'left') setImgAlign('left');
                            else if (cmd === 'justifyright' && img.style.float !== 'right') setImgAlign('right');
                            else if ((cmd === 'justifycenter' || cmd === 'justifyfull') && img.style.float !== 'none') setImgAlign('center');
                        }
                    }
                });

                // Auto-sanitize paragraphs: ensure images with parent text-align are converted to clean floats so typing is ALWAYS normal LTR
                function fixImageParagraphAlignments() {
                    var body = editor.getBody();
                    if (!body) return;
                    var imgs = body.querySelectorAll('img');
                    imgs.forEach(function (img) {
                        var parent = img.parentElement;
                        if (parent && parent.nodeName.toLowerCase() === 'p') {
                            var textAlign = (parent.style.textAlign || parent.getAttribute('align') || '').toLowerCase();
                            if (textAlign === 'right' && img.style.float !== 'right') {
                                img.style.float = 'right';
                                img.style.margin = '0.5rem 0 1rem 1.5rem';
                                img.style.removeProperty('display');
                                parent.style.removeProperty('text-align');
                                if (parent.style.textAlign) parent.style.textAlign = '';
                                parent.removeAttribute('align');
                            } else if (textAlign === 'left' && img.style.float !== 'left' && !img.style.margin) {
                                img.style.float = 'left';
                                img.style.margin = '0.5rem 1.5rem 1rem 0';
                                img.style.removeProperty('display');
                                parent.style.removeProperty('text-align');
                                if (parent.style.textAlign) parent.style.textAlign = '';
                                parent.removeAttribute('align');
                            }
                        }
                    });
                }

                // Helper: Is text currently selected?
                function hasSelectedText() {
                    try {
                        if (!editor || !editor.selection) return false;
                        if (!editor.selection.isCollapsed()) return true;
                        var sel = editor.selection.getSel();
                        if (sel && !sel.isCollapsed && sel.toString().length > 0) return true;
                    } catch (e) {}
                    return false;
                }

                // Smart click-to-type: ONLY assist when clicking directly on empty body/html background
                // NEVER touch or collapse text selection, and NEVER interfere with normal clicks in paragraphs/headings
                editor.on('click', function (e) {
                    // NEVER destroy or touch text selection!
                    if (hasSelectedText()) return;

                    var target = e.target;
                    if (!target) return;
                    if (target.nodeName.toLowerCase() === 'img') return;

                    var doc = editor.getDoc();
                    if (!doc) return;

                    // Only assist if user clicked directly on the empty body or documentElement outside text blocks
                    if (target === doc.body || target === doc.documentElement) {
                        if (doc.caretRangeFromPoint) {
                            var range = doc.caretRangeFromPoint(e.clientX, e.clientY);
                            if (range) {
                                editor.selection.setRng(range);
                                editor.focus();
                            }
                        }
                    }
                });

                // Crucial: Prevent Enter key from pushing floated images down into newly created paragraphs!
                // The image MUST remain firmly anchored at its position while text creates new lines/paragraphs.
                editor.on('keydown', function (e) {
                    if (e.keyCode === 13 || e.key === 'Enter') {
                        var node = editor.selection.getNode();
                        if (!node) return;
                        var block = editor.dom.getParent(node, 'p,h1,h2,h3,h4,h5,h6,div,blockquote');
                        if (block) {
                            var img = block.querySelector('img');
                            if (img) {
                                var isFloated = (img.style.float === 'left' || img.style.float === 'right');
                                if (isFloated) {
                                    // Move image to be the first child of this block so splitting the block NEVER carries the image down
                                    if (block.firstChild !== img) {
                                        block.insertBefore(img, block.firstChild);
                                    }
                                }
                            }
                        }
                    }
                });

                editor.on('keyup', function (e) {
                    if (e.keyCode === 13 || e.key === 'Enter') {
                        // Guard: If Enter pushed a floated image down into the new block, move it back up to the top block!
                        var node = editor.selection.getNode();
                        if (!node) return;
                        var block = editor.dom.getParent(node, 'p,h1,h2,h3,h4,h5,h6,div,blockquote');
                        if (block && block.previousElementSibling) {
                            var prevBlock = block.previousElementSibling;
                            var currentImg = block.querySelector('img');
                            var prevImg = prevBlock.querySelector('img');

                            // If current block got the floated image pushed into it from prevBlock:
                            if (currentImg && !prevImg) {
                                var isFloated = (currentImg.style.float === 'left' || currentImg.style.float === 'right');
                                if (isFloated) {
                                    prevBlock.insertBefore(currentImg, prevBlock.firstChild);
                                    editor.nodeChanged();
                                    syncLivePreview();
                                }
                            }
                        }
                    }
                });

                // Listen to every content and node change for INSTANT real-time live preview sync
                editor.on('init input keyup change NodeChange SetContent ExecCommand undo redo', function () {
                    ensureDraggableImages();
                    fixImageParagraphAlignments();
                    updateWordCount(editor);
                    updateChecklist();
                    syncLivePreview();
                });

                editor.on('NodeChange click keydown', function () {
                    if (!getSelectedImg()) {
                        isImageToolbarExpanded = false;
                    }
                });
            }
        });

        // 2. Form Variables & Inputs
        var titleInput = document.getElementById('articleTitle');
        var slugInput = document.getElementById('articleSlug');
        var authorInput = document.getElementById('authorName');
        var slugBadge = document.getElementById('slugBadge');
        var googlePreviewTitle = document.getElementById('googlePreviewTitle');
        var googlePreviewSlug = document.getElementById('googlePreviewSlug');
        var titleCount = document.getElementById('titleCount');
        var appContainer = document.getElementById('blogAppContainer');
        var isSlugAuto = appContainer ? (appContainer.getAttribute('data-exists') !== '1') : true;

        function slugify(text) {
            return text.toString().toLowerCase()
                .trim()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }

        // 3. Central Real-time Live Preview Synchronizer
        function syncLivePreview() {
            var titleVal = titleInput.value.trim();
            var fallbackTitle = 'Your Article Title Goes Here';
            
            // Sync Titles
            document.querySelectorAll('.live-sim-title').forEach(function (el) {
                el.textContent = titleVal || fallbackTitle;
            });
            document.querySelectorAll('.live-sim-breadcrumb-title').forEach(function (el) {
                el.textContent = titleVal || 'Article Title';
            });

            // Sync Slugs
            var currentSlug = slugInput.value.trim() || slugify(titleVal) || 'your-slug';
            document.querySelectorAll('.live-sim-slug').forEach(function (el) {
                el.textContent = currentSlug;
            });

            // Sync Author
            var authorVal = authorInput.value.trim() || 'Admin';
            document.querySelectorAll('.live-sim-author').forEach(function (el) {
                el.textContent = authorVal;
            });

            // Sync Read Time
            var readingTimeDisplay = document.getElementById('readingTimeDisplay');
            var readTimeVal = readingTimeDisplay ? readingTimeDisplay.textContent : '~1 min read';
            document.querySelectorAll('.live-sim-read-time').forEach(function (el) {
                el.textContent = readTimeVal;
            });

            // Sync Cover Image Hyperlink
            var coverLinkInput = document.getElementById('coverImageLinkInput');
            var liveSimCoverLink = document.getElementById('liveSimCoverLink');
            var liveSimLinkBadge = document.getElementById('liveSimLinkBadge');
            var liveSimLinkText = document.getElementById('liveSimLinkText');
            var coverLinkThumbnailBadge = document.getElementById('coverLinkThumbnailBadge');
            var coverLinkThumbnailText = document.getElementById('coverLinkThumbnailText');

            if (coverLinkInput && liveSimCoverLink) {
                var linkVal = coverLinkInput.value.trim();
                if (linkVal) {
                    liveSimCoverLink.href = linkVal;
                    liveSimCoverLink.target = '_blank';
                    liveSimCoverLink.title = 'Redirects to: ' + linkVal;
                    if (liveSimLinkBadge) {
                        liveSimLinkBadge.classList.remove('hidden');
                        liveSimLinkBadge.classList.add('flex');
                    }
                    if (liveSimLinkText) liveSimLinkText.textContent = linkVal;
                    if (coverLinkThumbnailBadge) {
                        coverLinkThumbnailBadge.classList.remove('hidden');
                        coverLinkThumbnailBadge.classList.add('flex');
                    }
                    if (coverLinkThumbnailText) coverLinkThumbnailText.textContent = linkVal;
                } else {
                    liveSimCoverLink.href = 'javascript:void(0)';
                    liveSimCoverLink.target = '_self';
                    liveSimCoverLink.title = 'Cover Image';
                    if (liveSimLinkBadge) {
                        liveSimLinkBadge.classList.add('hidden');
                        liveSimLinkBadge.classList.remove('flex');
                    }
                    if (coverLinkThumbnailBadge) {
                        coverLinkThumbnailBadge.classList.add('hidden');
                        coverLinkThumbnailBadge.classList.remove('flex');
                    }
                }
            }

            // Sync TinyMCE Body HTML
            var editorInstance = tinymce.get('tinymceEditor');
            if (editorInstance) {
                var htmlContent = editorInstance.getContent();
                var hasContent = htmlContent && htmlContent.trim().length > 0;
                var renderedHtml = hasContent ? htmlContent : '<p class="text-stone-400 italic text-center py-8 text-sm">Start typing article content, headers, or adding images in the editor on the left to see your live formatted post rendered here...</p>';
                
                // CRITICAL: Normalize any relative storage URLs to absolute /storage/ so images NEVER 404
                renderedHtml = renderedHtml.replace(/src=["'](?:\.\.\/)+storage\//gi, 'src="/storage/');

                document.querySelectorAll('.live-sim-content').forEach(function (el) {
                    el.innerHTML = renderedHtml;
                });
            }
        }

        // Cover Link Input Event
        var coverLinkInput = document.getElementById('coverImageLinkInput');
        if (coverLinkInput) {
            coverLinkInput.addEventListener('input', function () {
                syncLivePreview();
                updateChecklist();
            });
        }

        // Title Input Event
        titleInput.addEventListener('input', function () {
            var len = this.value.length;
            titleCount.textContent = len + ' / 100';

            if (isSlugAuto) {
                var generatedSlug = slugify(this.value);
                slugInput.value = generatedSlug;
                slugBadge.textContent = generatedSlug || 'your-slug-here';
                googlePreviewSlug.textContent = generatedSlug || 'post-slug';
            }

            var metaTitle = document.getElementById('metaTitleInput').value;
            if (!metaTitle) {
                googlePreviewTitle.textContent = this.value ? this.value + ' — MunchGud' : 'Article Title Goes Here — MunchGud';
            }

            syncLivePreview();
            updateChecklist();
        });

        // Slug Input Event
        slugInput.addEventListener('input', function () {
            isSlugAuto = false;
            var clean = slugify(this.value);
            slugBadge.textContent = clean || 'your-slug-here';
            googlePreviewSlug.textContent = clean || 'post-slug';
            syncLivePreview();
            updateChecklist();
        });

        // Author Input Event
        authorInput.addEventListener('input', function () {
            syncLivePreview();
        });

        // Toggle Slug Auto-sync
        document.getElementById('toggleSlugSyncBtn').addEventListener('click', function () {
            isSlugAuto = true;
            var generatedSlug = slugify(titleInput.value);
            slugInput.value = generatedSlug;
            slugBadge.textContent = generatedSlug || 'your-slug-here';
            googlePreviewSlug.textContent = generatedSlug || 'post-slug';
            syncLivePreview();
            updateChecklist();
        });

        // Copy Permalink
        document.getElementById('copyLinkBtn').addEventListener('click', function () {
            var slug = slugInput.value || slugify(titleInput.value) || 'your-slug';
            var fullUrl = 'https://munchgud.com/blogs/' + slug;
            navigator.clipboard.writeText(fullUrl).then(function () {
                var copyText = document.getElementById('copyLinkText');
                copyText.textContent = 'Copied!';
                setTimeout(function () {
                    copyText.textContent = 'Copy URL';
                }, 2000);
            });
        });

        // 4. Meta Title & Meta Description Counters
        var metaTitleInput = document.getElementById('metaTitleInput');
        var metaTitleCount = document.getElementById('metaTitleCount');
        var metaTitleBar = document.getElementById('metaTitleBar');

        metaTitleInput.addEventListener('input', function () {
            var len = this.value.length;
            metaTitleCount.textContent = len + ' / 60 characters';
            var pct = Math.min(100, (len / 60) * 100);
            metaTitleBar.style.width = pct + '%';
            
            if (len > 60) {
                metaTitleBar.className = 'h-1 bg-amber-500 transition-all duration-300';
            } else {
                metaTitleBar.className = 'h-1 bg-emerald-500 transition-all duration-300';
            }

            googlePreviewTitle.textContent = this.value ? this.value : (titleInput.value ? titleInput.value + ' — MunchGud' : 'Article Title Goes Here — MunchGud');
            updateChecklist();
        });

        var metaDescInput = document.getElementById('metaDescInput');
        var metaDescCount = document.getElementById('metaDescCount');
        var metaDescBar = document.getElementById('metaDescBar');
        var googlePreviewDesc = document.getElementById('googlePreviewDesc');

        metaDescInput.addEventListener('input', function () {
            var len = this.value.length;
            metaDescCount.textContent = len + ' / 160 characters';
            var pct = Math.min(100, (len / 160) * 100);
            metaDescBar.style.width = pct + '%';

            if (len > 160) {
                metaDescBar.className = 'h-1 bg-amber-500 transition-all duration-300';
            } else {
                metaDescBar.className = 'h-1 bg-emerald-500 transition-all duration-300';
            }

            googlePreviewDesc.textContent = this.value || 'Discover our latest insights on healthy roasted makhana, nutritional superfoods, and wellness recipes crafted by MunchGud.';
            updateChecklist();
        });

        // 5. Real-time Cover Image Sync & Dropzone
        var coverInput = document.getElementById('coverImageInput');
        var coverName = document.getElementById('coverImageName');
        var previewContainer = document.getElementById('imagePreviewContainer');
        var previewImg = document.getElementById('liveImagePreview');
        var uploadPlaceholder = document.getElementById('uploadPlaceholder');
        var removeImageBtn = document.getElementById('removeImageBtn');

        coverInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var file = this.files[0];
                coverName.textContent = file.name;
                
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Update Sidebar Preview
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    uploadPlaceholder.classList.add('hidden');

                    // Update Live Previews (Side-by-side and Modal)
                    document.querySelectorAll('.live-sim-cover-img').forEach(function (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    });
                    document.querySelectorAll('.live-sim-cover-placeholder').forEach(function (ph) {
                        ph.classList.add('hidden');
                    });
                    document.querySelectorAll('.live-sim-cover-wrapper').forEach(function (wr) {
                        wr.classList.remove('hidden');
                    });

                    updateChecklist();
                };
                reader.readAsDataURL(file);
            }
        });

        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function () {
                coverInput.value = '';
                coverName.textContent = 'No file chosen';
                previewContainer.classList.add('hidden');
                uploadPlaceholder.classList.remove('hidden');

                document.querySelectorAll('.live-sim-cover-img').forEach(function (img) {
                    img.src = '';
                    img.classList.add('hidden');
                });
                document.querySelectorAll('.live-sim-cover-placeholder').forEach(function (ph) {
                    ph.classList.remove('hidden');
                });

                updateChecklist();
            });
        }

        // 6. Word Count & Reading Time
        function updateWordCount(editor) {
            var content = editor.getContent({ format: 'text' });
            var words = content.trim().split(/\s+/).filter(function (w) { return w.length > 0; }).length;
            document.getElementById('wordCountDisplay').textContent = words + ' words';

            var mins = Math.max(1, Math.ceil(words / 200));
            var readTimeStr = '~' + mins + ' min read';
            document.getElementById('readingTimeDisplay').textContent = readTimeStr;
            
            document.querySelectorAll('.live-sim-read-time').forEach(function (el) {
                el.textContent = readTimeStr;
            });
        }

        // 7. Quality Checklist
        function updateChecklist() {
            setCheck('checkTitle', titleInput.value.trim().length > 0);
            setCheck('checkSlug', slugInput.value.trim().length > 0 || titleInput.value.trim().length > 0);
            
            var wordCountText = document.getElementById('wordCountDisplay').textContent;
            var words = parseInt(wordCountText) || 0;
            setCheck('checkContent', words >= 50);

            var initialHasImage = appContainer ? (appContainer.getAttribute('data-has-image') === '1') : false;
            var hasImage = (coverInput.files && coverInput.files.length > 0) || initialHasImage;
            setCheck('checkImage', hasImage);

            setCheck('checkMeta', metaDescInput.value.trim().length > 20);
        }

        function setCheck(id, ok) {
            var el = document.getElementById(id);
            if (!el) return;
            if (ok) {
                el.classList.remove('text-gray-400');
                el.classList.add('text-emerald-300');
                el.querySelector('span:first-child').innerHTML = '✓';
                el.querySelector('span:first-child').className = 'w-4 h-4 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-[10px] font-bold';
            } else {
                el.classList.remove('text-emerald-300');
                el.classList.add('text-gray-300');
                el.querySelector('span:first-child').innerHTML = '○';
                el.querySelector('span:first-child').className = 'w-4 h-4 rounded-full bg-white/10 flex items-center justify-center text-[10px]';
            }
        }

        // 8. Form Submit & Draft Shortcut with Guaranteed TinyMCE Flush
        var blogForm = document.getElementById('blogArticleForm');
        if (blogForm) {
            blogForm.addEventListener('submit', function () {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
            });
        }

        var saveDraftBtn = document.getElementById('saveDraftBtn');
        if (saveDraftBtn) {
            saveDraftBtn.addEventListener('click', function () {
                var statusBox = document.getElementById('publishStatusCheckbox');
                if (statusBox) {
                    statusBox.checked = false;
                }
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
                if (blogForm) {
                    blogForm.submit();
                }
            });
        }

        // 9. Full Page View (Wide Display) Toggle Handler
        var btnToggleFullDisplay = document.getElementById('btnToggleFullDisplay');
        var textExpand = document.getElementById('textExpand');

        function applyFullDisplay(isFull) {
            var adminWrapper = document.getElementById('adminContainerWrapper');
            var adminScroll = document.getElementById('adminMainScrollArea');
            if (isFull) {
                appContainer.classList.remove('max-w-7xl');
                appContainer.classList.add('w-full', 'max-w-none');
                if (adminWrapper) {
                    adminWrapper.classList.remove('max-w-7xl');
                    adminWrapper.classList.add('w-full', 'max-w-none');
                }
                if (adminScroll) {
                    adminScroll.classList.remove('p-4', 'sm:p-6', 'lg:p-8');
                    adminScroll.classList.add('p-3', 'sm:p-5');
                }
                textExpand.textContent = '◫ Standard View';
                btnToggleFullDisplay.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            } else {
                appContainer.classList.add('max-w-7xl');
                appContainer.classList.remove('w-full', 'max-w-none');
                if (adminWrapper) {
                    adminWrapper.classList.add('max-w-7xl');
                    adminWrapper.classList.remove('w-full', 'max-w-none');
                }
                if (adminScroll) {
                    adminScroll.classList.add('p-4', 'sm:p-6', 'lg:p-8');
                    adminScroll.classList.remove('p-3', 'sm:p-5');
                }
                textExpand.textContent = '⛶ Full Page View';
                btnToggleFullDisplay.classList.remove('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            }
            try {
                localStorage.setItem('mg_blog_full_display', isFull ? '1' : '0');
            } catch (e) {}
        }

        if (btnToggleFullDisplay) {
            btnToggleFullDisplay.addEventListener('click', function () {
                var isCurrentlyFull = appContainer.classList.contains('max-w-none');
                applyFullDisplay(!isCurrentlyFull);
            });

            // Restore saved preference
            try {
                if (localStorage.getItem('mg_blog_full_display') === '1') {
                    applyFullDisplay(true);
                }
            } catch (e) {}
        }

        // 9. Main Stage View Mode Switcher: Full Editor (Default), Live Customer Preview, Split (50/50)
        var mainStageGrid = document.getElementById('mainStageGrid');
        var editorCardContainer = document.getElementById('editorCardContainer');
        var previewCardContainer = document.getElementById('previewCardContainer');
        var btnModeEditor = document.getElementById('btnModeEditor');
        var btnModePreview = document.getElementById('btnModePreview');
        var btnModeSplit = document.getElementById('btnModeSplit');
        var btnEditorQuickPreview = document.getElementById('btnEditorQuickPreview');
        var btnEditorFooterPreview = document.getElementById('btnEditorFooterPreview');
        var btnPreviewBackToEditor = document.getElementById('btnPreviewBackToEditor');
        var btnPreviewFooterBack = document.getElementById('btnPreviewFooterBack');
        var stageModeDesc = document.getElementById('stageModeDesc');

        function setMainStageMode(mode) {
            if (!mainStageGrid || !editorCardContainer || !previewCardContainer) return;

            var activeClass = 'inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold bg-white text-gray-900 shadow-2xs transition';
            var inactiveClass = 'inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-bold text-gray-500 hover:text-gray-900 transition';

            if (mode === 'preview') {
                // Mode: Live Preview (Full Width customer view)
                mainStageGrid.className = 'w-full';
                editorCardContainer.classList.add('hidden');
                previewCardContainer.classList.remove('hidden');
                previewCardContainer.className = 'bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden flex flex-col w-full';

                if (btnModeEditor) btnModeEditor.className = inactiveClass;
                if (btnModePreview) btnModePreview.className = activeClass;
                if (btnModeSplit) btnModeSplit.className = inactiveClass;
                if (stageModeDesc) stageModeDesc.textContent = '— Live Customer Preview Simulation (Click "Back to Editor" anytime to make changes)';

                syncLivePreview();
                var previewCanvas = document.getElementById('previewScrollCanvas');
                if (previewCanvas) {
                    previewCanvas.scrollTop = 0;
                }
            } else if (mode === 'split') {
                // Mode: Split View (Side-by-side 50/50)
                mainStageGrid.className = 'grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch';
                editorCardContainer.classList.remove('hidden');
                editorCardContainer.className = 'bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 flex flex-col space-y-4';
                previewCardContainer.classList.remove('hidden');
                previewCardContainer.className = 'bg-white rounded-2xl shadow-sm border border-gray-200/80 overflow-hidden flex flex-col';

                if (btnModeEditor) btnModeEditor.className = inactiveClass;
                if (btnModePreview) btnModePreview.className = inactiveClass;
                if (btnModeSplit) btnModeSplit.className = activeClass;
                if (stageModeDesc) stageModeDesc.textContent = '— Side-by-Side: Article Content (Left) & Customer Preview (Right)';

                syncLivePreview();
            } else {
                // Mode: Full Editor (Default - 100% full width)
                mode = 'editor';
                mainStageGrid.className = 'w-full';
                editorCardContainer.classList.remove('hidden');
                editorCardContainer.className = 'bg-white rounded-2xl shadow-sm border border-gray-200/80 p-6 flex flex-col space-y-4 w-full';
                previewCardContainer.classList.add('hidden');

                if (btnModeEditor) btnModeEditor.className = activeClass;
                if (btnModePreview) btnModePreview.className = inactiveClass;
                if (btnModeSplit) btnModeSplit.className = inactiveClass;
                if (stageModeDesc) stageModeDesc.textContent = '— Full Page Article Editor (Click "Live Preview" to test customer view)';
            }

            try {
                localStorage.setItem('mg_blog_view_mode', mode);
            } catch (e) {}
        }

        if (btnModeEditor) {
            btnModeEditor.addEventListener('click', function () {
                setMainStageMode('editor');
            });
        }
        if (btnModePreview) {
            btnModePreview.addEventListener('click', function () {
                setMainStageMode('preview');
            });
        }
        if (btnModeSplit) {
            btnModeSplit.addEventListener('click', function () {
                setMainStageMode('split');
            });
        }
        if (btnEditorQuickPreview) {
            btnEditorQuickPreview.addEventListener('click', function () {
                setMainStageMode('preview');
            });
        }
        if (btnEditorFooterPreview) {
            btnEditorFooterPreview.addEventListener('click', function () {
                setMainStageMode('preview');
            });
        }
        if (btnPreviewBackToEditor) {
            btnPreviewBackToEditor.addEventListener('click', function () {
                setMainStageMode('editor');
            });
        }
        if (btnPreviewFooterBack) {
            btnPreviewFooterBack.addEventListener('click', function () {
                setMainStageMode('editor');
            });
        }

        // Initialize view mode - default is 'editor' (full width page)
        var initialViewMode = 'editor';
        try {
            var storedView = localStorage.getItem('mg_blog_view_mode');
            if (storedView === 'editor' || storedView === 'preview' || storedView === 'split') {
                initialViewMode = storedView;
            }
        } catch (e) {}
        setMainStageMode(initialViewMode);

        // Initial setup
        updateChecklist();
        syncLivePreview();
    });
</script>
@endsection
