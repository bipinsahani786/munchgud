@extends('storefront.layout')

@section('title', !empty($blog->meta_title) ? $blog->meta_title : ($blog->title . ' — MunchGud'))
@section('meta_description', !empty($blog->meta_description) ? $blog->meta_description : Str::limit(strip_tags($blog->content), 155))
@section('meta_keywords', !empty($blog->meta_keywords) ? $blog->meta_keywords : 'makhana blog, ' . Str::slug($blog->title, ', '))
@section('meta_image', $blog->image ? Storage::url($blog->image) : asset('images/hero_bg.png'))

@section('structured_data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Article",
    "headline": "{{ $blog->title }}",
    "description": "{{ Str::limit(strip_tags($blog->content), 200) }}",
    @if($blog->image)
    "image": "{{ Storage::url($blog->image) }}",
    @endif
    "author": {
        "@@type": "Organization",
        "name": "{{ $blog->author_name ?? 'MunchGud' }}"
    },
    "publisher": {
        "@@type": "Organization",
        "name": "MunchGud",
        "logo": {
            "@@type": "ImageObject",
            "url": "{{ asset('images/logo.jpg') }}"
        }
    },
    "datePublished": "{{ $blog->created_at->toAtomString() }}",
    "dateModified": "{{ $blog->updated_at->toAtomString() }}",
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": "{{ url()->current() }}"
    }
}
</script>
@endsection

@section('content')
<article class="relative max-w-4xl mx-auto py-10 px-5 sm:py-16 sm:px-12 lg:px-16 bg-white shadow-[0_8px_30px_rgba(0,0,0,0.08)] rounded-3xl my-8 sm:my-12 border border-mg-dark/5">
    <!-- Header -->
    <header class="text-center mb-10">
        <div class="flex items-center justify-center gap-4 text-xs sm:text-sm font-bold text-mg-green uppercase tracking-widest mb-5">
            <span>{{ $blog->created_at->format('M d, Y') }}</span>
            <span class="w-1.5 h-1.5 rounded-full bg-mg-green/30"></span>
            <span>BY {{ $blog->author_name ?? 'MunchGud' }}</span>
        </div>
        <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl font-black text-mg-dark leading-tight mb-8">
            {{ $blog->title }}
        </h1>
        
        @if($blog->image)
            @if(!empty($blog->cover_image_link))
                <a href="{{ $blog->cover_image_link }}" target="_blank" rel="noopener noreferrer" class="group block rounded-3xl overflow-hidden aspect-[21/9] bg-mg-cream shadow-xl border border-mg-dark/5 relative transition-all duration-300 hover:shadow-2xl hover:scale-[1.008]">
                    <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-95">
                    <div class="absolute bottom-4 right-4 bg-black/70 backdrop-blur-md text-white px-3.5 py-1.5 rounded-full text-xs font-semibold flex items-center gap-1.5 shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>Click to view link</span>
                    </div>
                </a>
            @else
                <div class="rounded-3xl overflow-hidden aspect-[21/9] bg-mg-cream shadow-xl border border-mg-dark/5">
                    <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                </div>
            @endif
        @endif
    </header>

    <!-- Content -->
    <div class="prose max-w-none prose-mg">
        {!! $blog->content !!}
    </div>

    <!-- Back to Blogs -->
    <div class="mt-16 pt-10 border-t border-mg-dark/10 text-center">
        <a href="{{ route('blogs.index') }}" class="inline-flex items-center gap-2 font-bold text-mg-dark hover:text-mg-green transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
            Back to all articles
        </a>
    </div>
</article>

<!-- Related Articles -->
@if($relatedBlogs->count() > 0)
<section class="bg-mg-cream py-16 lg:py-24 border-t border-mg-dark/5">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
        <h2 class="font-heading text-3xl md:text-4xl font-black text-mg-dark mb-10 text-center">Read Next</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedBlogs as $related)
                <a href="{{ route('blogs.show', $related->slug) }}" class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-mg-dark/5 flex flex-col">
                    <div class="relative aspect-[16/10] overflow-hidden bg-mg-cream">
                        @if($related->image)
                            <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-heading text-xl font-bold text-mg-dark mb-3 leading-tight group-hover:text-mg-green transition-colors">
                            {{ $related->title }}
                        </h3>
                        <div class="text-mg-muted text-sm line-clamp-2 font-medium">
                            {{ Str::limit(strip_tags($related->content), 100) }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@section('styles')
<style>
    /* Complete Typography & Formatting Styles for Blog Articles - 100% IDENTICAL to Editor & Preview */
    .prose-mg, .prose-mg * {
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
    }
    .prose-mg {
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
    }
    .prose-mg h3 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem !important;
        font-weight: 700 !important;
        line-height: 1.4 !important;
        color: #1f2937 !important;
        margin-top: 1.5rem !important;
        margin-bottom: 0.65rem !important;
    }
    .prose-mg h4 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.15rem !important;
        font-weight: 700 !important;
        line-height: 1.4 !important;
        color: #1f2937 !important;
        margin-top: 1.25rem !important;
        margin-bottom: 0.5rem !important;
    }
    .prose-mg p {
        margin-bottom: 1.25rem !important;
        color: #374151;
        line-height: 1.8;
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
    .prose-mg pre, .prose-mg code {
        background: #f1f5f9;
        color: #0f172a;
        padding: 0.2rem 0.4rem;
        border-radius: 0.375rem;
        font-family: monospace;
        font-size: 0.9em;
    }
    .prose-mg::after {
        content: "";
        display: table;
        clear: both;
    }
    @media (max-width: 640px) {
        .prose-mg img[style*="float: left"],
        .prose-mg img[style*="float:left"],
        .prose-mg img[style*="float: right"],
        .prose-mg img[style*="float:right"] {
            float: none !important;
            margin: 1.5rem auto !important;
            display: block !important;
            max-width: 100% !important;
            height: auto !important;
        }
    }
</style>
@endsection
