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
<article class="pt-10 pb-20 max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
    <!-- Header -->
    <header class="max-w-3xl mx-auto text-center mb-12">
        <div class="flex items-center justify-center gap-4 text-sm font-bold text-mg-green uppercase tracking-widest mb-6">
            <span>{{ $blog->created_at->format('M d, Y') }}</span>
            <span class="w-1.5 h-1.5 rounded-full bg-mg-green/30"></span>
            <span>BY {{ $blog->author_name ?? 'MunchGud' }}</span>
        </div>
        <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-mg-dark leading-tight mb-8">
            {{ $blog->title }}
        </h1>
        
        @if($blog->image)
            <div class="rounded-3xl overflow-hidden aspect-[21/9] bg-mg-cream shadow-xl border border-mg-dark/5">
                <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
            </div>
        @endif
    </header>

    <!-- Content -->
    <div class="max-w-3xl mx-auto prose prose-lg prose-mg lg:prose-xl">
        {!! $blog->content !!}
    </div>

    <!-- Back to Blogs -->
    <div class="max-w-3xl mx-auto mt-16 pt-10 border-t border-mg-dark/10 text-center">
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
    /* Custom Prose Styles for the blog content */
    .prose-mg {
        color: #334155;
    }
    .prose-mg h2, .prose-mg h3, .prose-mg h4 {
        color: #1a1a1a;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        margin-top: 2.5em;
        margin-bottom: 1em;
    }
    .prose-mg a {
        color: #2E8B57;
        text-decoration: none;
        font-weight: 700;
        border-bottom: 2px solid transparent;
        transition: all 0.2s;
    }
    .prose-mg a:hover {
        border-bottom-color: #2E8B57;
    }
    .prose-mg p {
        margin-bottom: 1.5em;
        line-height: 1.8;
    }
    .prose-mg ul {
        list-style-type: disc;
        padding-left: 1.5em;
        margin-bottom: 1.5em;
    }
    .prose-mg li {
        margin-bottom: 0.5em;
    }
    .prose-mg img {
        border-radius: 1rem;
        margin: 2em auto;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .prose-mg blockquote {
        border-left: 4px solid #2E8B57;
        background: rgba(46, 139, 87, 0.05);
        padding: 1.5em;
        border-radius: 0 1rem 1rem 0;
        font-style: italic;
        color: #475569;
        margin: 2em 0;
    }
</style>
@endsection
