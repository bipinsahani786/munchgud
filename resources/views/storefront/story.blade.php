@extends('storefront.layout')

@section('title', 'Our Story | MunchGud')

@section('content')

<style>
    /* Parallax & Animations */
    .parallax-bg {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .timeline-dot::before {
        content: '';
        position: absolute;
        top: 0; left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: rgba(43, 110, 47, 0.15);
        z-index: 0;
    }
    .marquee-container {
        display: flex;
        overflow: hidden;
        width: 100%;
        position: relative;
    }
    .marquee-content {
        display: flex;
        width: max-content;
        animation: marquee 35s linear infinite;
    }
    .marquee-content:hover {
        animation-play-state: paused;
    }
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05);
    }
</style>

{{-- 1. HERO SECTION (THE VISION) --}}
<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-mg-cream grain">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-mg-green/20 rounded-full blur-[120px] translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-mg-orange/15 rounded-full blur-[100px] -translate-x-1/3 translate-y-1/3"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.5)_0%,transparent_70%)]"></div>

    <div class="relative z-10 text-center max-w-5xl mx-auto px-4 reveal">
        <span class="inline-block bg-mg-green/10 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-6 border border-mg-green/20">{{ $page->sections['hero_badge'] ?? 'Our Genesis' }}</span>
        <h1 class="font-heading text-6xl md:text-8xl font-black text-mg-dark leading-tight mb-8">
            {!! $page->sections['hero_title'] ?? 'Rooted in <span class="italic text-mg-green">Tradition.</span><br>Crafted for <span class="italic text-mg-orange">Today.</span>' !!}
        </h1>
        <p class="text-xl md:text-2xl text-mg-muted font-medium max-w-3xl mx-auto leading-relaxed">
            {{ $page->sections['hero_subtitle'] ?? 'We are on a mission to bring India\'s ancient superfood to the world, roasted to absolute perfection.' }}
        </p>
    </div>
</section>

{{-- 2. THE ORIGIN (THE PROBLEM) --}}
<section class="py-24 bg-mg-cream grain">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative reveal">
                <div class="aspect-square rounded-[3rem] overflow-hidden">
                    <img src="{{ isset($page->sections['problem_image']) ? Storage::url($page->sections['problem_image']) : 'https://images.unsplash.com/photo-1603569283847-aa295f0d016a?q=80&w=1000&auto=format&fit=crop' }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" alt="Junk Food">
                </div>
                <div class="absolute -bottom-8 -right-8 bg-white p-8 rounded-[2rem] shadow-2xl max-w-xs">
                    <p class="font-heading text-2xl font-black text-mg-dark mb-2">{{ $page->sections['problem_badge'] ?? 'The Snacking Dilemma' }}</p>
                    <p class="text-mg-muted text-sm">{{ $page->sections['problem_desc'] ?? 'Healthy meant boring. Tasty meant unhealthy. We refused to compromise.' }}</p>
                </div>
            </div>
            <div class="reveal" style="transition-delay: 0.2s">
                <h2 class="font-heading text-5xl font-black text-mg-dark mb-8">{!! $page->sections['problem_title'] ?? 'The spark that started it all.' !!}</h2>
                <div class="prose prose-lg text-mg-dark/70">
                    <p>For decades, the snack aisle has been dominated by deep-fried chips, artificial flavors, and empty calories. When we sought a guilt-free alternative for our 4 PM cravings, we found ourselves staring at a stark choice: tasteless diet snacks or heavily processed junk food.</p>
                    <p>We realized that modern snacking was fundamentally broken. We needed something that was genuinely nutritious, incredibly satisfying, and didn't leave a greasy residue on our fingers.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. THE DISCOVERY ('AHA' MOMENT) --}}
<section class="py-32 bg-mg-green text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/5 rounded-full blur-[100px] translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-5xl mx-auto px-4 text-center reveal">
        <span class="text-4xl mb-8 block">💡</span>
        <h2 class="font-heading text-4xl md:text-6xl font-black mb-10 leading-tight">
            {!! $page->sections['discovery_title'] ?? 'Then, we looked back at our roots and rediscovered <span class="text-mg-gold italic">Makhana</span>.' !!}
        </h2>
        <p class="text-xl text-white/80 font-light max-w-3xl mx-auto leading-relaxed">
            Fox nuts have been a staple of Ayurvedic medicine and Indian fasting rituals for centuries. They are a powerhouse of protein, inherently gluten-free, and lighter than popcorn. But for too long, they were confined to traditional, uninspiring preparations. We decided to change that.
        </p>
    </div>
</section>

{{-- 4. OUR ROOTS (DIRECT FROM BIHAR) --}}
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center flex-row-reverse">
            <div class="order-2 lg:order-1 reveal">
                <div class="inline-flex items-center gap-2 bg-mg-green/10 text-mg-green text-xs font-bold px-4 py-2 rounded-full mb-6 uppercase tracking-wider">
                    {{ $page->sections['roots_badge'] ?? '📍 Mithilanchal, Bihar' }}
                </div>
                <h2 class="font-heading text-5xl font-black text-mg-dark mb-6">{!! $page->sections['roots_title'] ?? 'Sourced from the Makhana Capital of the World.' !!}</h2>
                <p class="text-lg text-mg-muted mb-8">{{ $page->sections['roots_desc'] ?? 'Over 80% of the world\'s Makhana is grown in the pristine water bodies of Bihar, India. We bypassed the middlemen and established direct relationships with the generational farmers of the Mithilanchal region.' }}</p>
                <div class="flex gap-8">
                    <div>
                        <p class="text-4xl font-black text-mg-green mb-2">{{ $page->sections['roots_stat_1_num'] ?? '200+' }}</p>
                        <p class="text-sm font-bold text-mg-dark uppercase tracking-wider">{{ $page->sections['roots_stat_1_label'] ?? 'Partner Farmers' }}</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black text-mg-orange mb-2">{{ $page->sections['roots_stat_2_num'] ?? '100%' }}</p>
                        <p class="text-sm font-bold text-mg-dark uppercase tracking-wider">{{ $page->sections['roots_stat_2_label'] ?? 'Traceable' }}</p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 reveal relative">
                <img src="{{ isset($page->sections['roots_image_main']) ? Storage::url($page->sections['roots_image_main']) : asset('images/story_farmer.png') }}" alt="Farmers in Bihar" class="rounded-[2rem] shadow-2xl w-full object-cover aspect-[4/5]">
                <div class="absolute -left-12 top-12 bg-white/90 backdrop-blur p-4 rounded-2xl shadow-xl rotate-[-5deg]">
                    <img src="{{ isset($page->sections['roots_image_small']) ? Storage::url($page->sections['roots_image_small']) : 'https://images.unsplash.com/photo-1596647225141-8f5bc6518a4a?q=80&w=200&auto=format&fit=crop' }}" class="w-24 h-24 rounded-xl object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 5. THE PROCESS (SEED TO SNACK TIMELINE) --}}
<section class="py-24 bg-mg-cream grain">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 reveal">
            <h2 class="font-heading text-5xl font-black text-mg-dark mb-4">{!! $page->sections['process_title'] ?? 'The Seed to Snack Journey' !!}</h2>
            <p class="text-lg text-mg-muted max-w-2xl mx-auto">{{ $page->sections['process_desc'] ?? 'It takes meticulous care and traditional wisdom to craft the perfect crunch.' }}</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8 relative timeline-dot">
            @php $steps = [
                ['icon' => '🪷', 'title' => $page->sections['process_step_1_title'] ?? 'Harvesting', 'desc' => $page->sections['process_step_1_desc'] ?? 'Seeds are hand-collected from the bottom of water lily ponds by skilled divers.'],
                ['icon' => '☀️', 'title' => $page->sections['process_step_2_title'] ?? 'Sun-Drying', 'desc' => $page->sections['process_step_2_desc'] ?? 'The raw seeds are cleaned and left to dry naturally under the Indian sun.'],
                ['icon' => '💥', 'title' => $page->sections['process_step_3_title'] ?? 'Popping', 'desc' => $page->sections['process_step_3_desc'] ?? 'Roasted in earthen pots and cracked open manually to reveal the white puff.'],
                ['icon' => '🔥', 'title' => $page->sections['process_step_4_title'] ?? 'Flavoring', 'desc' => $page->sections['process_step_4_desc'] ?? 'Slow-air-roasted (never fried) and coated in our proprietary gourmet spice blends.']
            ]; @endphp
            
            @foreach($steps as $index => $step)
            <div class="reveal bg-white rounded-[2rem] p-8 text-center relative z-10 shadow-lg border border-black/5 hover:-translate-y-2 transition-transform duration-300" style="transition-delay: {{ $index * 0.15 }}s">
                <div class="w-16 h-16 bg-mg-green text-white rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-mg-green/30">
                    {{ $step['icon'] }}
                </div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-4">{{ $step['title'] }}</h3>
                <p class="text-mg-muted text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 6. CORE VALUES & PHILOSOPHY --}}
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-mg-green/10 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4 border border-mg-green/20">{{ $page->sections['values_badge'] ?? 'Our DNA' }}</span>
            <h2 class="font-heading text-5xl font-black text-mg-dark mb-6">{!! $page->sections['values_title'] ?? 'Our Philosophy' !!}</h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-mg-cream/50 border border-mg-dark/5 rounded-[2.5rem] p-10 reveal hover:-translate-y-2 hover:shadow-2xl hover:shadow-mg-green/10 transition-all duration-300">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm border border-mg-dark/5">🌱</div>
                <h3 class="text-2xl font-heading font-black text-mg-dark mb-4">{!! $page->sections['values_1_title'] ?? 'Unapologetically Natural' !!}</h3>
                <p class="text-mg-muted leading-relaxed">{{ $page->sections['values_1_desc'] ?? 'If an ingredient sounds like a science experiment, it doesn\'t go in our bags. No artificial colors, flavors, or preservatives. Ever.' }}</p>
            </div>
            
            <div class="bg-mg-cream/50 border border-mg-dark/5 rounded-[2.5rem] p-10 reveal hover:-translate-y-2 hover:shadow-2xl hover:shadow-mg-green/10 transition-all duration-300" style="transition-delay: 0.1s;">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm border border-mg-dark/5">⚖️</div>
                <h3 class="text-2xl font-heading font-black text-mg-dark mb-4">{!! $page->sections['values_2_title'] ?? 'Fair Trade Always' !!}</h3>
                <p class="text-mg-muted leading-relaxed">{{ $page->sections['values_2_desc'] ?? 'We believe in shared prosperity. By partnering directly with farmers, we ensure they receive a premium price for their painstaking labor.' }}</p>
            </div>
            
            <div class="bg-mg-cream/50 border border-mg-dark/5 rounded-[2.5rem] p-10 reveal hover:-translate-y-2 hover:shadow-2xl hover:shadow-mg-green/10 transition-all duration-300" style="transition-delay: 0.2s;">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm border border-mg-dark/5">🏆</div>
                <h3 class="text-2xl font-heading font-black text-mg-dark mb-4">{!! $page->sections['values_3_title'] ?? 'Flavor First' !!}</h3>
                <p class="text-mg-muted leading-relaxed">{{ $page->sections['values_3_desc'] ?? 'Healthy shouldn\'t taste like cardboard. We spend months perfecting our spice blends to ensure every bite is an explosion of flavor.' }}</p>
            </div>
        </div>
    </div>
</section>

{{-- 7. MEET THE TEAM / FOUNDERS --}}
@php
    $founder1Name = $page->sections['team_1_name'] ?? null;
    $founder2Name = $page->sections['team_2_name'] ?? null;
    
    $hasFounder1 = !empty($founder1Name) && ($page->sections['team_1_is_active'] ?? '0') == '1';
    $hasFounder2 = !empty($founder2Name) && ($page->sections['team_2_is_active'] ?? '0') == '1';
    $founderCount = ($hasFounder1 ? 1 : 0) + ($hasFounder2 ? 1 : 0);
@endphp

@if($founderCount > 0)
<section class="py-24 bg-mg-cream grain">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <h2 class="font-heading text-5xl font-black text-mg-dark mb-4">{!! $page->sections['team_title'] ?? 'The Faces Behind the Crunch' !!}</h2>
            <p class="text-lg text-mg-muted max-w-2xl mx-auto">{{ $page->sections['team_desc'] ?? 'A team of snack-enthusiasts, nutrition nerds, and flavor scientists.' }}</p>
        </div>
        
        <div class="grid {{ $founderCount == 1 ? 'grid-cols-1 max-w-sm' : 'md:grid-cols-2 max-w-4xl' }} gap-12 mx-auto">
            @if($hasFounder1)
            <!-- Founder 1 -->
            <div class="reveal group">
                <div class="aspect-[4/5] rounded-[2rem] overflow-hidden mb-6 relative bg-white">
                    <img src="{{ isset($page->sections['team_1_image']) ? Storage::url($page->sections['team_1_image']) : 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <p class="text-white italic">{!! $page->sections['team_1_quote'] ?? '' !!}</p>
                    </div>
                </div>
                <h3 class="font-heading text-3xl font-black text-mg-dark">{{ $founder1Name }}</h3>
                <p class="text-mg-green font-bold uppercase tracking-wider text-sm mt-1">{{ $page->sections['team_1_role'] ?? '' }}</p>
            </div>
            @endif
            
            @if($hasFounder2)
            <!-- Founder 2 -->
            <div class="reveal group" style="transition-delay: 0.2s">
                <div class="aspect-[4/5] rounded-[2rem] overflow-hidden mb-6 relative bg-white">
                    <img src="{{ isset($page->sections['team_2_image']) ? Storage::url($page->sections['team_2_image']) : 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=600&auto=format&fit=crop' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                        <p class="text-white italic">{!! $page->sections['team_2_quote'] ?? '' !!}</p>
                    </div>
                </div>
                <h3 class="font-heading text-3xl font-black text-mg-dark">{{ $founder2Name }}</h3>
                <p class="text-mg-orange font-bold uppercase tracking-wider text-sm mt-1">{{ $page->sections['team_2_role'] ?? '' }}</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- 8. IMPACT & SUSTAINABILITY --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-mg-green-dark rounded-[3rem] p-12 lg:p-20 text-white relative overflow-hidden reveal">
            <div class="absolute -right-20 -top-20 w-96 h-96 bg-mg-leaf/20 rounded-full blur-[80px]"></div>
            
            <div class="grid lg:grid-cols-2 gap-16 relative z-10 items-center">
                <div>
                    <h2 class="font-heading text-4xl lg:text-5xl font-black mb-6">{!! $page->sections['impact_title'] ?? 'Snacking that gives back.' !!}</h2>
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $page->sections['impact_desc'] ?? 'We are committed to leaving the planet better than we found it. From utilizing eco-friendly packaging materials to empowering rural farming communities, sustainability is baked into our DNA.' }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-5xl font-black text-mg-gold mb-2">{{ $page->sections['impact_stat_1_num'] ?? '100%' }}</p>
                        <p class="text-sm font-bold uppercase tracking-wider text-white/70">{{ $page->sections['impact_stat_1_label'] ?? 'Recyclable Pouches' }}</p>
                    </div>
                    <div>
                        <p class="text-5xl font-black text-mg-leaf mb-2">{{ $page->sections['impact_stat_2_num'] ?? '0' }}</p>
                        <p class="text-sm font-bold uppercase tracking-wider text-white/70">{{ $page->sections['impact_stat_2_label'] ?? 'Plastic Waste' }}</p>
                    </div>
                    <div>
                        <p class="text-5xl font-black text-mg-orange mb-2">30%</p>
                        <p class="text-sm font-bold uppercase tracking-wider text-white/70">Income Increase for Farmers</p>
                    </div>
                    <div>
                        <p class="text-5xl font-black text-white mb-2">1%</p>
                        <p class="text-sm font-bold uppercase tracking-wider text-white/70">Of Sales to Charity</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 9. LIFESTYLE GALLERY (MARQUEE) --}}
<!-- <section class="py-20 bg-mg-cream grain overflow-hidden">
    <div class="text-center mb-12 reveal">
        <h2 class="font-heading text-4xl font-black text-mg-dark">The MunchGud Fam</h2>
    </div>
    
    <div class="marquee-container reveal" style="transition-delay: 0.2s">
        <div class="marquee-content gap-6 px-3">
            @php
                $gallery = [
                    isset($page->sections['gallery_1']) ? Storage::url($page->sections['gallery_1']) : 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?q=80&w=400&auto=format&fit=crop',
                    isset($page->sections['gallery_2']) ? Storage::url($page->sections['gallery_2']) : 'https://images.unsplash.com/photo-1511556532299-8f662fc26c06?q=80&w=400&auto=format&fit=crop',
                    isset($page->sections['gallery_3']) ? Storage::url($page->sections['gallery_3']) : 'https://images.unsplash.com/photo-1539125530496-3ca408f9c2d9?q=80&w=400&auto=format&fit=crop',
                    isset($page->sections['gallery_4']) ? Storage::url($page->sections['gallery_4']) : 'https://images.unsplash.com/photo-1464863979621-258859e62245?q=80&w=400&auto=format&fit=crop',
                    isset($page->sections['gallery_5']) ? Storage::url($page->sections['gallery_5']) : 'https://images.unsplash.com/photo-1502323777036-f29e3972d82f?q=80&w=400&auto=format&fit=crop',
                ];
            @endphp
            {{-- Loop twice for infinite effect --}}
            @for($i=0; $i<2; $i++)
                @foreach($gallery as $index => $img)
                @php 
                    // Alternate rotations for polaroid effect
                    $rotation = $index % 2 == 0 ? 'rotate-2' : '-rotate-2';
                    $mt = $index % 2 == 0 ? 'mt-4' : 'mt-8';
                @endphp
                <div class="w-64 shrink-0 bg-white p-3 pb-12 rounded-lg shadow-xl shadow-mg-dark/5 {{ $rotation }} {{ $mt }} transition-transform hover:scale-105 hover:z-10 hover:rotate-0 duration-300">
                    <div class="w-full h-64 overflow-hidden rounded bg-mg-cream">
                        <img src="{{ $img }}" class="w-full h-full object-cover">
                    </div>
                </div>
                @endforeach
            @endfor
        </div>
    </div>
</section> -->

{{-- FEATURED PRODUCTS --}}
@php
    $featuredProducts = \App\Models\Product::with(['skus', 'category', 'primaryImage'])
                        ->active()
                        ->take(3)
                        ->get();
    
    $wishlistSkus = [];
    if (Auth::check()) {
        $wishlistSkus = \App\Models\Wishlist::where('user_id', Auth::id())->pluck('product_sku_id')->toArray();
    }
@endphp
<section class="py-24 bg-white border-t border-black/[0.03]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Taste the Crunch</h2>
            <p class="text-lg text-mg-muted max-w-2xl mx-auto">Experience the snacks that started the revolution.</p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
            @foreach($featuredProducts as $i => $p)
            @php
                $sku = $p->skus->first();
                $price = $sku ? $sku->sale_price : 0;
                $mrp = $sku ? $sku->mrp : 0;
                $discount = $mrp > 0 ? round((1 - $price / $mrp) * 100) : 0;
                $badge = $discount > 0 ? "-{$discount}% OFF" : '🔥 Bestseller';
                $bc = $discount > 0 ? 'bg-mg-orange' : 'bg-red-500';
                $g = 'from-mg-cream to-white';
                $rating = $p->average_rating ?? 5;
                $reviewsCount = $p->review_count ?? 20;
            @endphp
            <div class="reveal group bg-mg-cream/30 rounded-3xl border border-mg-dark/[0.04] overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-mg-green/8 transition-all duration-500 relative" style="transition-delay:{{ $i*0.1 }}s">
                <a href="{{ route('products.show', $p->slug) }}" class="relative aspect-square bg-gradient-to-br {{ $g }} flex items-center justify-center overflow-hidden block">
                    <img src="{{ $p->primaryImage ? Storage::url($p->primaryImage->path) : asset('images/product_shot_new.png') }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @if($discount > 0 || $badge)
                    <span class="absolute top-3 left-3 {{ $bc }} text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $badge }}</span>
                    @endif
                </a>
                
                <button x-data="{
                            inWishlist: {{ $sku && in_array($sku->id, $wishlistSkus) ? 'true' : 'false' }},
                            async toggle() {
                                if (!{{ $sku ? $sku->id : 'null' }}) return;
                                try {
                                    const res = await fetch(`/account/wishlist/{{ $sku ? $sku->id : '' }}`, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content,
                                            'Accept': 'application/json'
                                        }
                                    });
                                    if (res.status === 401) { window.location.href = '/login'; return; }
                                    const data = await res.json();
                                    if (data.success) { 
                                        this.inWishlist = data.status === 'added'; 
                                        window.dispatchEvent(new CustomEvent('wishlist-updated', { detail: { count: data.count } }));
                                        window.dispatchEvent(new CustomEvent('toast', { detail: { message: data.message, icon: data.status === 'added' ? 'success' : 'removed' } }));
                                    }
                                } catch (e) {}
                            }
                        }" 
                        @click.prevent="toggle"
                        class="absolute top-3 right-3 w-9 h-9 backdrop-blur-sm rounded-full flex items-center justify-center transition-all shadow-sm z-10"
                        :class="inWishlist ? 'opacity-100 bg-white text-mg-orange' : 'opacity-0 group-hover:opacity-100 bg-white/80 text-mg-dark hover:bg-mg-cream hover:text-mg-orange'">
                    <svg width="15" height="15" :class="inWishlist ? 'fill-mg-orange' : 'fill-none'" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                
                <div class="p-6">
                    <p class="text-[10px] font-semibold text-mg-muted uppercase tracking-[0.15em] mb-1.5">{{ $p->category->name ?? 'Roasted Makhana' }}</p>
                    <a href="{{ route('products.show', $p->slug) }}" class="block"><h4 class="font-heading text-lg font-bold text-mg-dark mb-2 hover:text-mg-green transition-colors">{{ $p->name }}</h4></a>
                    <div class="flex items-center gap-1.5 mb-4 text-mg-gold text-[13px]">
                        @for($r=1; $r<=5; $r++)
                            <span class="{{ $r <= round($rating) ? 'text-mg-gold' : 'text-mg-dark/10' }}">★</span>
                        @endfor
                        <span class="text-mg-muted text-[11px] font-medium ml-1">({{ $reviewsCount }})</span>
                    </div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-xl font-black text-mg-dark">₹{{ $price }}</span>
                            @if($mrp > $price)
                            <span class="font-mono text-sm text-mg-muted line-through">₹{{ $mrp }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="button" x-data @click="window.addToCart({{ $sku ? $sku->id : 0 }}, 1, $event.currentTarget)" 
                            class="w-full py-3 bg-mg-green/10 text-mg-green text-sm font-bold rounded-xl hover:bg-mg-green hover:text-white active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0" stroke-linecap="round"/></svg>
                        Quick Add
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 10. FINAL CTA --}}
<section class="py-32 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4 reveal">
        <h2 class="font-heading text-5xl lg:text-7xl font-black text-mg-dark mb-8">Ready to snack smarter?</h2>
        <p class="text-xl text-mg-muted mb-12">Join over 5,000 happy snackers who have made the switch to MunchGud.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('products.index') }}" class="bg-mg-green text-white font-bold text-lg px-10 py-5 rounded-full hover:bg-mg-green-dark hover:scale-105 transition-all shadow-xl shadow-mg-green/30">
                Shop the Collection
            </a>
            <a href="{{ route('build-a-box') }}" class="bg-mg-cream border-2 border-mg-dark/10 text-mg-dark font-bold text-lg px-10 py-5 rounded-full hover:border-mg-orange hover:text-mg-orange transition-all">
                Build a Box
            </a>
        </div>
    </div>
</section>

@endsection
