@extends('storefront.layout')

@section('title', isset($page) && $page->meta_title ? $page->meta_title : 'The MunchGud Blog — Stories & Healthy Snacking Tips')
@section('meta_description', isset($page) && $page->meta_description ? $page->meta_description : 'Read our latest blog posts about makhana, healthy snacking, recipes, and wellness tips from MunchGud.')
@section('meta_keywords', isset($page) && $page->meta_keywords ? $page->meta_keywords : 'makhana blog, healthy snacking articles, nutrition tips, bihar makhana')

@section('content')
<!-- Page Header -->
<div class="bg-mg-cream py-16 lg:py-20 border-b border-black/5 relative overflow-hidden">
    <div class="absolute inset-0 opacity-30 pointer-events-none" style="background-image: radial-gradient(#2E8B57 1px, transparent 1px); background-size: 32px 32px;"></div>
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10 relative z-10 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-black text-mg-dark mb-4 lg:mb-6 uppercase tracking-tight">The <span class="text-mg-green">MunchGud</span> Blog</h1>
        <p class="text-lg sm:text-xl text-mg-muted font-medium max-w-2xl mx-auto">Explore our latest articles, healthy snacking tips, and the amazing world of Makhana.</p>
    </div>
</div>

<!-- Blog Listing -->
<div class="py-16 lg:py-24 max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
    @if($blogs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-mg-dark/5 flex flex-col group">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="block relative aspect-[16/10] overflow-hidden bg-mg-cream">
                        @if($blog->image)
                            <img src="{{ Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-mg-green/20">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"/></svg>
                            </div>
                        @endif
                    </a>
                    <div class="p-6 sm:p-8 flex-1 flex flex-col">
                        <div class="flex items-center gap-3 text-xs font-bold text-mg-green uppercase tracking-widest mb-4">
                            <span>{{ $blog->created_at->format('M d, Y') }}</span>
                            <span class="w-1 h-1 rounded-full bg-mg-green/30"></span>
                            <span>{{ $blog->author_name ?? 'MunchGud' }}</span>
                        </div>
                        <h2 class="font-heading text-xl sm:text-2xl font-bold text-mg-dark mb-4 leading-tight group-hover:text-mg-green transition-colors">
                            <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                        </h2>
                        <div class="text-mg-muted text-sm line-clamp-3 mb-6 flex-1 font-medium leading-relaxed">
                            {{ Str::limit(strip_tags($blog->content), 120) }}
                        </div>
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="inline-flex items-center gap-2 font-bold text-mg-dark hover:text-mg-green transition group/btn mt-auto">
                            Read Article
                            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-16 flex justify-center">
            {{ $blogs->links() }}
        </div>
    @else
        <div class="text-center max-w-lg mx-auto py-12">
            <div class="w-20 h-20 bg-mg-green/10 rounded-full flex items-center justify-center mx-auto mb-6 text-mg-green">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15M9 11l3 3m0 0l3-3m-3 3V8"/></svg>
            </div>
            <h2 class="font-heading text-2xl font-bold text-mg-dark mb-3">No posts yet!</h2>
            <p class="text-mg-muted font-medium">We're working on some exciting content. Check back soon for healthy tips and articles.</p>
        </div>
    @endif
</div>
@endsection
