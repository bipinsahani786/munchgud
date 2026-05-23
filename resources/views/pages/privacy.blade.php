@extends('storefront.layout')

@section('title', 'Privacy Policy - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header -->
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Legal & Security</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Privacy Policy</h1>
            <p class="text-sm text-munch-300 font-light">Last Updated: May 2026</p>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 lg:sticky lg:top-24 bg-white border border-munch-200 rounded-2xl p-6 space-y-2 flex-shrink-0">
                <h4 class="text-munch-900 font-serif font-bold text-base mb-4 pb-2 border-b border-munch-100">Sections</h4>
                <a href="#intro" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">1. Introduction</a>
                <a href="#info-collect" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">2. Information We Collect</a>
                <a href="#info-use" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">3. How We Use Information</a>
                <a href="#info-share" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">4. Sharing Your Data</a>
                <a href="#cookies" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">5. Cookies & Tracking</a>
                <a href="#security" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">6. Security & Storage</a>
                <a href="#your-rights" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">7. Your Rights & Choices</a>
            </aside>

            <!-- Text Content -->
            <article class="flex-grow bg-white border border-munch-200 rounded-3xl p-8 md:p-12 space-y-10 text-munch-800 leading-relaxed font-light">
                {!! \Illuminate\Support\Facades\Blade::render($page->content ?? '', ['global_settings' => $global_settings ?? []]) !!}
            </article>
        </div>
    </div>
</div>
@endsection
