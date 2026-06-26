@extends('storefront.layout')

@section('title', 'Sitemap - MunchGud')
@section('meta_description', 'View the sitemap of MunchGud to easily find our premium roasted makhana products, blogs, and static pages.')

@section('content')
<div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-10 py-16">
    <h1 class="text-4xl md:text-5xl font-bold text-mg-dark mb-10 text-center">Site Map</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Pages -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-mg-green/10">
            <h2 class="text-xl font-bold text-mg-dark mb-4 border-b border-mg-green/10 pb-2">Main Pages</h2>
            <ul class="space-y-3">
                @foreach($staticPages as $page)
                <li>
                    <a href="{{ $page['url'] }}" class="text-[15px] font-medium text-mg-dark/80 hover:text-mg-green transition">
                        {{ $page['title'] }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-mg-green/10">
            <h2 class="text-xl font-bold text-mg-dark mb-4 border-b border-mg-green/10 pb-2">Categories</h2>
            <ul class="space-y-3">
                @foreach($categories as $category)
                <li>
                    <a href="{{ url('/category/' . $category->slug) }}" class="text-[15px] font-medium text-mg-dark/80 hover:text-mg-green transition">
                        {{ $category->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Products -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-mg-green/10">
            <h2 class="text-xl font-bold text-mg-dark mb-4 border-b border-mg-green/10 pb-2">Products</h2>
            <ul class="space-y-3">
                @foreach($products as $product)
                <li>
                    <a href="{{ url('/products/' . $product->slug) }}" class="text-[15px] font-medium text-mg-dark/80 hover:text-mg-green transition">
                        {{ $product->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Blogs -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-mg-green/10">
            <h2 class="text-xl font-bold text-mg-dark mb-4 border-b border-mg-green/10 pb-2">Blogs</h2>
            <ul class="space-y-3">
                @foreach($blogs as $blog)
                <li>
                    <a href="{{ url('/blogs/' . $blog->slug) }}" class="text-[15px] font-medium text-mg-dark/80 hover:text-mg-green transition">
                        {{ $blog->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
@endsection
