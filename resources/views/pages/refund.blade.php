@extends('storefront.layout')

@section('title', 'Refund & Return Policy - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header -->
    <div class="relative bg-munch-900 py-20 overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-3xl mx-auto px-4">
            <span class="text-munch-accent uppercase tracking-widest font-bold text-xs mb-3 block">Orders & Returns</span>
            <h1 class="text-4xl md:text-5xl font-serif text-white mb-4">Refund & Return Policy</h1>
            <p class="text-sm text-munch-300 font-light">Last Updated: May 2026</p>
        </div>
    </div>

    <!-- Body -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-64 lg:sticky lg:top-24 bg-white border border-munch-200 rounded-2xl p-6 space-y-2 flex-shrink-0">
                <h4 class="text-munch-900 font-serif font-bold text-base mb-4 pb-2 border-b border-munch-100">Sections</h4>
                <a href="#overview" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">1. Overview</a>
                <a href="#damages" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">2. Damages & Issues</a>
                <a href="#cancellations" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">3. Order Cancellations</a>
                <a href="#refund-process" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">4. Refund Process</a>
                <a href="#contact-us" class="block text-sm text-munch-600 hover:text-mg-green transition font-medium">5. Contact Customer Support</a>
            </aside>

            <!-- Text Content -->
            <article class="flex-grow bg-white border border-munch-200 rounded-3xl p-8 md:p-12 space-y-10 text-munch-800 leading-relaxed font-light">
                {!! \Illuminate\Support\Facades\Blade::render($page->content ?? '', ['global_settings' => $global_settings ?? []]) !!}
            </article>
        </div>
    </div>
</div>
@endsection
