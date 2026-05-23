@extends('storefront.layout')

@section('title', 'MunchGud — Munch Gud. Feel Gud. | Premium Makhana Snacks')

@section('content')



{{-- ══════════════════════════════════════════
     3. HERO SECTION
     ══════════════════════════════════════════ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-mg-cream grain">
    <div class="absolute top-20 right-[10%] w-80 h-80 bg-mg-green/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-[5%] w-96 h-96 bg-mg-leaf/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 lg:py-0">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
            <div class="reveal">
                <div class="inline-flex items-center gap-2 bg-mg-green/8 text-mg-green text-xs font-bold px-4 py-2 rounded-full mb-6 tracking-widest uppercase border border-mg-green/10">
                    <span class="w-2 h-2 bg-mg-green rounded-full animate-pulse"></span>
                    {{ $page->sections['hero_badge'] ?? 'Direct from Bihar Farms' }}
                </div>
                <h1 class="font-heading text-5xl sm:text-6xl lg:text-7xl xl:text-[5.5rem] font-black text-mg-dark leading-[0.95] tracking-tight mb-6">
                    {!! $page->sections['hero_title'] ?? 'Munch Gud.<br><span class="text-mg-green italic">Feel Gud.</span>' !!}
                </h1>
                <p class="text-lg sm:text-xl text-mg-dark/50 max-w-lg mb-8 leading-relaxed font-light">
                    {{ $page->sections['hero_subtitle'] ?? "Premium roasted makhana — high protein, gluten-free, and irresistibly crunchy. Snack smarter with India's most loved fox nut brand." }}
                </p>
                <div class="flex flex-wrap gap-4 mb-10">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2.5 bg-mg-green text-white font-bold text-base px-8 py-4 rounded-full hover:bg-mg-green-dark hover:scale-105 active:scale-95 transition-all shadow-lg shadow-mg-green/20">
                        Shop Now
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="{{ route('story') }}" class="inline-flex items-center gap-2 border-2 border-mg-dark/15 text-mg-dark font-semibold text-base px-8 py-4 rounded-full hover:border-mg-green hover:text-mg-green hover:bg-mg-green/5 transition-all">
                        Our Story
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-2">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Happy Customer" class="w-9 h-9 rounded-full object-cover border-2 border-mg-cream relative z-30">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Happy Customer" class="w-9 h-9 rounded-full object-cover border-2 border-mg-cream relative z-20">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Happy Customer" class="w-9 h-9 rounded-full object-cover border-2 border-mg-cream relative z-10">
                        <div class="w-9 h-9 rounded-full bg-mg-green border-2 border-mg-cream flex items-center justify-center text-[10px] font-black text-white relative z-0">5K+</div>
                    </div>
                    <div>
                        <div class="text-mg-gold text-sm tracking-wider">★★★★★</div>
                        <p class="text-[11px] text-mg-dark/35 font-medium">5,000+ Happy Snackers</p>
                    </div>
                </div>
            </div>
            <!-- Hero Visual -->
            <div class="relative flex justify-center reveal">
                <div class="w-72 h-72 sm:w-80 sm:h-80 lg:w-[400px] lg:h-[400px] rounded-full bg-gradient-to-br from-mg-green/15 via-mg-leaf/10 to-mg-cream flex items-center justify-center parallax-hero">
                    <div class="w-56 h-56 sm:w-64 sm:h-64 lg:w-80 lg:h-80 rounded-full bg-gradient-to-br from-mg-green/20 to-mg-cream flex items-center justify-center float overflow-hidden">
                        <img src="{{ isset($page->sections['hero_image']) ? Storage::url($page->sections['hero_image']) : asset('images/hero_bg.png') }}" class="w-full h-full object-cover" alt="Hero Makhana">
                    </div>
                </div>
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-2xl shadow-lg float" style="animation-delay:0.5s">
                    <p class="text-xs font-bold text-mg-green">✓ 100% Natural</p>
                </div>
                <div class="absolute bottom-12 -left-2 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-2xl shadow-lg float" style="animation-delay:1.2s">
                    <p class="text-xs font-bold text-mg-orange">🔥 Roasted, Not Fried</p>
                </div>
                <div class="absolute bottom-1/3 -right-2 bg-mg-green-dark text-white px-4 py-2 rounded-2xl shadow-lg float" style="animation-delay:0.8s">
                    <p class="text-xs font-bold font-mono">₹199 <span class="text-mg-leaf">only</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
        <span class="text-[10px] font-semibold text-mg-dark/25 tracking-widest uppercase">Scroll</span>
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="text-mg-dark/25"><path d="M12 5v14m-7-7 7 7 7-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
</section>

{{-- ══════════════════════════════════════════
     4. MARQUEE TRUST STRIP
     ══════════════════════════════════════════ --}}
<div class="bg-mg-green-dark py-3.5 overflow-hidden">
    <div class="flex whitespace-nowrap">
        <div class="marquee-track flex items-center gap-8 text-white/80 text-sm font-medium">
            @php 
                $marqueeText = $page->sections['marquee_text'] ?? '🌿 No Artificial Flavours✦✨ High Protein✦🔥 Air Roasted✦💚 Gluten Free✦⭐ 5,000+ Happy Snackers✦🇮🇳 Made in India✦🌱 100% Vegan✦♻️ Eco-Friendly Packaging';
                $marqueeItems = explode('✦', $marqueeText);
            @endphp
            @for($i=0; $i<2; $i++)
                @foreach($marqueeItems as $item)
                    <span>{{ trim($item) }}</span><span class="text-mg-leaf">✦</span>
                @endforeach
            @endfor
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════
     5. BRAND PROMISE — 3 PILLARS
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-10 lg:gap-20">
            @php $pillars = [
                ['icon'=>'🔥', 'num'=>$page->sections['pillar_1_num'] ?? '0g', 'title'=>$page->sections['pillar_1_title'] ?? 'Oil Used', 'desc'=>$page->sections['pillar_1_desc'] ?? 'Pure hot-air roasting technology. Zero oil, maximum crunch, guilt-free snacking at its finest.'],
                ['icon'=>'🌿', 'num'=>$page->sections['pillar_2_num'] ?? '100%', 'title'=>$page->sections['pillar_2_title'] ?? 'Natural', 'desc'=>$page->sections['pillar_2_desc'] ?? 'What you see on the label is what\'s inside. No preservatives, no artificial colours, nothing hidden.'],
                ['icon'=>'💪', 'num'=>$page->sections['pillar_3_num'] ?? '15g', 'title'=>$page->sections['pillar_3_title'] ?? 'Protein per 100g', 'desc'=>$page->sections['pillar_3_desc'] ?? 'The perfect post-workout or evening snack. Plant-based protein that actually tastes incredible.'],
            ]; @endphp
            @foreach($pillars as $i=>$p)
            <div class="reveal text-center group" style="transition-delay:{{ $i*0.15 }}s">
                <div class="w-16 h-16 bg-mg-green/8 rounded-2xl mx-auto mb-5 flex items-center justify-center text-3xl group-hover:bg-mg-green/15 transition-colors">{{ $p['icon'] }}</div>
                <p class="font-heading text-5xl font-black text-mg-green mb-1">{{ $p['num'] }}</p>
                <h3 class="font-heading text-lg font-bold text-mg-dark mb-3">{{ $p['title'] }}</h3>
                <p class="text-mg-muted text-sm leading-relaxed max-w-xs mx-auto">{{ $p['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     6. FEATURED PRODUCTS
     ══════════════════════════════════════════ --}}
<section id="products" class="py-20 lg:py-28 bg-mg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <span class="inline-block bg-mg-green/8 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4 border border-mg-green/10">{{ $page->sections['collections_badge'] ?? 'Our Collection' }}</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">{!! $page->sections['collections_title'] ?? 'Our Star <span class="italic text-mg-green">Flavours</span>' !!}</h2>
            <p class="text-mg-muted max-w-md mx-auto text-sm">{{ $page->sections['collections_subtitle'] ?? 'Six uniquely crafted flavours. Popped, seasoned, and sealed at peak freshness.' }}</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-7">
            @foreach($featuredProducts as $i=>$p)
            @php
                // Get default SKU, or fallback to an in-stock one
                $sku = $p->skus->where('is_default', true)->first();
                if (!$sku || $sku->stock_qty <= 0) {
                    $sku = $p->skus->where('stock_qty', '>', 0)->first() ?? $p->skus->first();
                }
                
                $price = $sku ? $sku->sale_price : 0;
                $mrp = $sku ? $sku->mrp : 0;
                $discount = $mrp > 0 ? round((1 - $price / $mrp) * 100) : 0;
                $badge = $discount > 0 ? "-{$discount}% OFF" : '🔥 Bestseller';
                $bc = $discount > 0 ? 'bg-mg-orange' : 'bg-red-500';
                $g = 'from-orange-50 to-red-50';
                $rating = $p->average_rating;
                $reviewsCount = $p->review_count;
                $isOutOfStock = !$sku || $sku->stock_qty <= 0;
            @endphp
            <div class="reveal group bg-white rounded-3xl border border-mg-dark/[0.04] overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-mg-green/8 transition-all duration-500" style="transition-delay:{{ $i*0.07 }}s">
                <a href="{{ route('products.show', $p->slug) }}" class="relative aspect-square bg-gradient-to-br {{ $g }} flex items-center justify-center overflow-hidden block">
                    <img src="{{ $p->primaryImage ? Storage::url($p->primaryImage->path) : asset('images/product_shot.png') }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
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
                                        window.dispatchEvent(new CustomEvent('toast', { detail: { 
                                            message: data.status === 'added' ? 'Added to Wishlist' : 'Removed from Wishlist',
                                            icon: data.status === 'added' ? 'success' : 'removed'
                                        }}));
                                    }
                                } catch (e) {}
                            }
                        }" 
                        @click.prevent="toggle"
                        class="absolute top-3 right-3 w-9 h-9 backdrop-blur-sm rounded-full flex items-center justify-center transition-all shadow-sm z-10"
                        :class="inWishlist ? 'opacity-100 bg-white text-mg-orange' : 'opacity-0 group-hover:opacity-100 bg-white/80 text-mg-dark hover:bg-mg-cream hover:text-mg-orange'">
                    <svg width="15" height="15" :class="inWishlist ? 'fill-mg-orange' : 'fill-none'" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                
                <div class="p-5">
                    <p class="text-[10px] font-semibold text-mg-muted uppercase tracking-[0.15em] mb-1">{{ $p->category->name ?? 'Roasted Makhana' }}</p>
                    <a href="{{ route('products.show', $p->slug) }}" class="block"><h4 class="font-heading text-[17px] font-bold text-mg-dark mb-1.5 leading-snug hover:text-mg-green transition-colors">{{ $p->name }}</h4></a>
                    <div class="flex items-center gap-1 mb-3 text-mg-gold text-[13px]">
                        @for($r=1; $r<=5; $r++)
                            <span class="{{ $r <= round($rating) ? 'text-mg-gold' : 'text-mg-dark/10' }}">★</span>
                        @endfor
                        <span class="text-mg-muted text-[11px] ml-1">({{ $reviewsCount }})</span>
                    </div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="font-mono text-xl font-bold text-mg-dark">₹{{ $price }}</span>
                        <span class="font-mono text-sm text-mg-muted line-through">₹{{ $mrp }}</span>
                        @if($discount > 0)
                        <span class="text-[10px] font-bold text-mg-green bg-mg-green/8 px-2 py-0.5 rounded-full">SAVE {{ $discount }}%</span>
                        @endif
                    </div>
                    @if($isOutOfStock)
                    <button type="button" disabled
                            class="w-full py-3 bg-gray-200 text-gray-500 text-sm font-bold rounded-2xl flex items-center justify-center cursor-not-allowed">
                        Out of Stock
                    </button>
                    @else
                    <button type="button" x-data @click="window.addToCart({{ $sku ? $sku->id : 0 }}, 1, $event.currentTarget)" 
                            class="w-full py-3 bg-mg-green text-white text-sm font-bold rounded-2xl hover:bg-mg-green-dark active:scale-[0.98] transition-all flex items-center justify-center gap-2 shadow-sm shadow-mg-green/15">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0" stroke-linecap="round"/></svg>
                        Quick Add
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     7. BESTSELLER SPOTLIGHT
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="reveal relative">
                <div class="absolute -inset-6 bg-mg-green/8 rounded-[3rem] -rotate-3"></div>
                <div class="relative aspect-[4/5] rounded-3xl bg-gradient-to-br from-mg-green/20 via-mg-leaf/10 to-mg-cream flex items-center justify-center overflow-hidden">
                    <img src="{{ isset($page->sections['bestseller_image']) ? Storage::url($page->sections['bestseller_image']) : asset('images/ingredient_macro.png') }}" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="reveal">
                <span class="inline-block bg-mg-green/8 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-6 border border-mg-green/10">{{ $page->sections['bestseller_badge'] ?? '★ #1 Bestseller' }}</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-6 leading-tight">{!! $page->sections['bestseller_title'] ?? 'The One That<br><span class="italic text-mg-green">Started It All</span>' !!}</h2>
                <p class="text-mg-muted leading-relaxed mb-6 text-[17px]">{{ $page->sections['bestseller_desc'] ?? 'Our Peri Peri Makhana is where the MunchGud story began. Bold, spicy, and impossibly addictive — the flavour that launched a revolution.' }}</p>
                <ul class="space-y-3 mb-8">
                    @php
                        $bestsellerBenefits = isset($page->sections['bestseller_benefits']) 
                            ? explode("\n", $page->sections['bestseller_benefits']) 
                            : ['Hand-picked lotus seeds from Bihar ponds','Air-roasted at 180°C for maximum crunch','Bold peri peri seasoning — not for the faint-hearted','Sealed within 2 hours of roasting'];
                    @endphp
                    @foreach($bestsellerBenefits as $b)
                    <li class="flex items-start gap-3"><span class="mt-0.5 w-5 h-5 bg-mg-green/10 rounded-full flex items-center justify-center flex-shrink-0"><svg width="12" height="12" fill="none" stroke="#2B6E2F" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg></span><span class="text-sm text-mg-dark/55">{{ trim($b) }}</span></li>
                    @endforeach
                </ul>
                <div class="flex items-center gap-4 mb-8">
                    <span class="font-mono text-3xl font-bold text-mg-dark">₹199</span>
                    <span class="font-mono text-lg text-mg-muted line-through">₹249</span>
                    <span class="bg-mg-green/10 text-mg-green text-xs font-bold px-3 py-1 rounded-full">SAVE 20%</span>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-mg-green text-white font-bold px-8 py-4 rounded-full hover:bg-mg-green-dark hover:scale-105 transition-all shadow-lg shadow-mg-green/20">Try Bestseller →</a>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     8. HEALTH BENEFITS (Dark Green)
     ══════════════════════════════════════════ --}}
<section id="health" class="py-20 lg:py-28 bg-mg-green-dark text-white relative grain overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-mg-leaf/5 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-white/10 text-white text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4">{{ $page->sections['health_badge'] ?? 'Science-Backed' }}</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black mb-4">{!! $page->sections['health_title'] ?? 'Why <span class="italic text-mg-leaf">Makhana</span>?' !!}</h2>
            <p class="text-white/40 max-w-md mx-auto text-sm">{{ $page->sections['health_subtitle'] ?? 'The ancient Indian superfood, now in flavours you\'ll actually crave.' }}</p>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-16">
            @php 
                $benefits = isset($page->sections['health_benefits_json']) 
                    ? json_decode($page->sections['health_benefits_json'], true)
                    : [
                        ['n'=>'Protein Power', 'v'=>'15g', 'd'=>'Per 100g. Excellent for muscle recovery.'],
                        ['n'=>'Antioxidant Rich', 'v'=>'High', 'd'=>'Fights free radicals and aging.'],
                        ['n'=>'Glycemic Index', 'v'=>'Low', 'd'=>'Perfect for sustained energy levels.'],
                        ['n'=>'Gluten Free', 'v'=>'100%', 'd'=>'Naturally free from gluten.'],
                        ['n'=>'Fat Content', 'v'=>'Low', 'd'=>'Significantly lower than popcorn.'],
                        ['n'=>'Minerals', 'v'=>'Iron+', 'd'=>'Rich in Magnesium & Potassium.']
                    ]; 
            @endphp
            @foreach($benefits as $index => $b)
            <div class="reveal text-center bg-white/5 backdrop-blur-sm rounded-3xl p-6 border border-white/8 hover:bg-white/10 transition-all">
                <p class="font-heading text-4xl lg:text-5xl font-black text-mg-leaf">{{ $b['v'] }}</p>
                <h4 class="font-bold text-white mt-3 mb-1">{{ $b['n'] }}</h4>
                <p class="text-white/40 text-xs">{{ $b['d'] }}</p>
            </div>
            @endforeach
        </div>
        <div class="grid md:grid-cols-3 gap-5">
            @php $benefits = [
                ['title'=>'Weight Management','desc'=>'Low calorie, high fiber. Keeps you full longer — the smartest snacking swap.','icon'=>'⚖️'],
                ['title'=>'Heart Health','desc'=>'Rich in potassium and magnesium for cardiovascular wellness.','icon'=>'❤️'],
                ['title'=>'Antioxidant Rich','desc'=>'Kaempferol fights inflammation and supports cellular health.','icon'=>'🛡️'],
            ]; @endphp
            @foreach($benefits as $i=>$b)
            <div class="reveal bg-white/5 backdrop-blur-sm rounded-3xl p-8 border border-white/8 hover:bg-white/10 hover:-translate-y-1 transition-all" style="transition-delay:{{ $i*0.1 }}s">
                <span class="text-4xl mb-4 block">{{ $b['icon'] }}</span>
                <h4 class="font-heading text-xl font-bold text-white mb-3">{{ $b['title'] }}</h4>
                <p class="text-white/45 text-sm leading-relaxed">{{ $b['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     9. PROCESS TIMELINE
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-32 bg-mg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <!-- Image Side -->
            <div class="reveal relative rounded-[3rem] overflow-hidden aspect-[4/5] lg:aspect-[3/4] shadow-2xl">
                <img src="{{ isset($page->sections['process_image']) ? Storage::url($page->sections['process_image']) : asset('images/story_farmer.png') }}" class="w-full h-full object-cover" alt="Makhana Harvesting">
                <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/80 via-mg-dark/20 to-transparent flex flex-col justify-end p-10 lg:p-14">
                    <h3 class="text-white font-heading text-3xl font-bold mb-3">Rooted in Tradition</h3>
                    <p class="text-white/80 font-medium text-lg leading-snug max-w-md">Every batch is hand-harvested by our farmer partners in Bihar, ensuring the highest quality from pond to pouch.</p>
                </div>
            </div>

            <!-- Timeline Side -->
            <div>
                <div class="mb-14 reveal">
                    <span class="text-mg-green font-bold tracking-widest uppercase text-sm mb-3 block">{{ $page->sections['process_badge'] ?? 'The Process' }}</span>
                    <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark leading-tight">{!! $page->sections['process_title'] ?? 'From Pond <br/><span class="italic text-mg-green font-light">to Pouch</span>' !!}</h2>
                </div>
                
                <div class="space-y-0">
                    @php $steps = [
                        ['n'=>'01', 't'=>$page->sections['process_1_title'] ?? 'Harvested', 'd'=>$page->sections['process_1_desc'] ?? 'Hand-harvested from pristine ponds in Mithilanchal, Bihar.', 'i'=>'🌿'],
                        ['n'=>'02', 't'=>$page->sections['process_2_title'] ?? 'Sun-Dried', 'd'=>$page->sections['process_2_desc'] ?? 'Naturally sun-dried for 48 hours to lock in nutrients.', 'i'=>'☀️'],
                        ['n'=>'03', 't'=>$page->sections['process_3_title'] ?? 'Air-Roasted', 'd'=>$page->sections['process_3_desc'] ?? 'Roasted at 180°C with zero oil. Maximum crunch guaranteed.', 'i'=>'🔥'],
                        ['n'=>'04', 't'=>$page->sections['process_4_title'] ?? 'Seasoned', 'd'=>$page->sections['process_4_desc'] ?? 'Tossed in natural spice blends. No MSG, no artificial colours.', 'i'=>'🧂'],
                        ['n'=>'05', 't'=>$page->sections['process_5_title'] ?? 'Sealed & Shipped', 'd'=>$page->sections['process_5_desc'] ?? 'Nitrogen-flushed and sealed fresh. Door delivery in 3-5 days.', 'i'=>'📦'],
                    ]; @endphp
                    @foreach($steps as $i=>$s)
                    <div class="reveal flex gap-8 {{ $i<4 ? 'pb-10' : '' }}" style="transition-delay:{{ $i*0.1 }}s">
                        <div class="flex flex-col items-center">
                            <div class="w-14 h-14 bg-white border border-mg-green/20 text-mg-green rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-lg shadow-mg-green/10">{{ $s['i'] }}</div>
                            @if($i<4)<div class="w-px flex-1 bg-gradient-to-b from-mg-green/20 to-transparent mt-4"></div>@endif
                        </div>
                        <div class="pb-2 pt-1">
                            <span class="font-mono text-[10px] text-mg-green font-black tracking-widest uppercase bg-mg-green/10 px-3 py-1 rounded-full mb-3 inline-block">STEP {{ $s['n'] }}</span>
                            <h4 class="font-heading text-2xl font-bold text-mg-dark mt-1 mb-2">{{ $s['t'] }}</h4>
                            <p class="text-mg-muted text-[15px] leading-relaxed max-w-sm">{{ $s['d'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     10. INGREDIENTS TRANSPARENCY
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-mg-cream/50 via-white to-white pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark">{!! $page->sections['ingredients_title'] ?? 'Know What\'s <span class="italic text-mg-green">Inside</span>' !!}</h2>
            <p class="text-mg-muted mt-4 max-w-2xl mx-auto text-lg">{{ $page->sections['ingredients_subtitle'] ?? 'We believe in complete transparency. What you see on the label is exactly what goes into your body.' }}</p>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-8 lg:gap-10 items-center">
            
            <!-- What's IN -->
            <div class="reveal bg-mg-green/5 border-2 border-mg-green/10 rounded-[2.5rem] p-10 hover:-translate-y-2 hover:shadow-xl hover:shadow-mg-green/10 transition-all duration-300 h-full flex flex-col justify-center">
                <h3 class="font-heading text-2xl font-black text-mg-green mb-8 flex items-center gap-4"><span class="w-12 h-12 bg-mg-green text-white rounded-2xl flex items-center justify-center shadow-lg shadow-mg-green/20">✓</span>What's IN</h3>
                <div class="space-y-4">
                @php
                    $ingredientsList = isset($page->sections['ingredients_list']) 
                        ? explode("\n", $page->sections['ingredients_list']) 
                        : ['Premium Makhana (Fox Nuts)','Himalayan Pink Salt','Cold-pressed spice extracts','Natural flavour powders','Love & good vibes ✨'];
                @endphp
                @foreach($ingredientsList as $item)
                <p class="flex items-center gap-4 text-base font-semibold text-mg-dark/80"><span class="w-6 h-6 bg-mg-green/15 rounded-full flex items-center justify-center flex-shrink-0"><svg width="12" height="12" fill="none" stroke="#2B6E2F" stroke-width="3" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg></span>{{ trim($item) }}</p>
                @endforeach
                </div>
            </div>

            <!-- Center Image -->
            <div class="reveal hidden lg:block rounded-[3rem] overflow-hidden aspect-[4/5] shadow-2xl relative" style="transition-delay: 0.1s">
                <img src="{{ isset($page->sections['ingredients_image']) ? Storage::url($page->sections['ingredients_image']) : asset('images/ingredient_macro.png') }}" class="w-full h-full object-cover" alt="Pure Ingredients">
                <div class="absolute inset-0 border-4 border-white/20 rounded-[3rem] m-4 pointer-events-none"></div>
            </div>

            <!-- What's NOT -->
            <div class="reveal bg-red-50 border-2 border-red-100 rounded-[2.5rem] p-10 hover:-translate-y-2 hover:shadow-xl hover:shadow-red-500/10 transition-all duration-300 h-full flex flex-col justify-center" style="transition-delay: 0.2s">
                <h3 class="font-heading text-2xl font-black text-red-600 mb-8 flex items-center gap-4"><span class="w-12 h-12 bg-red-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-red-500/20">✕</span>What's NOT</h3>
                <div class="space-y-4">
                @php
                    $whatsNotList = isset($page->sections['whats_not_list']) 
                        ? explode("\n", $page->sections['whats_not_list']) 
                        : ['No MSG or Ajinomoto','No artificial colours','No trans fats or palm oil','No preservatives — ever','No refined sugar'];
                @endphp
                @foreach($whatsNotList as $item)
                <p class="flex items-center gap-4 text-base font-semibold text-mg-dark/80"><span class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0"><svg width="12" height="12" fill="none" stroke="#DC2626" stroke-width="3" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/></svg></span>{{ trim($item) }}</p>
                @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     11. COMBO PACKS
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-mg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark">{!! $page->sections['combo_title'] ?? 'Mix, Match & <span class="italic text-mg-green">Save</span>' !!}</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @php 
                $bundles = isset($page->sections['combo_packs_json'])
                    ? json_decode($page->sections['combo_packs_json'], true)
                    : [
                        ['n'=>'Starter Pack','it'=>'3 Flavours','p'=>399,'m'=>519,'s'=>120,'pop'=>false],
                        ['n'=>'Snack Box','it'=>'6 Flavours','p'=>699,'m'=>999,'s'=>300,'pop'=>true],
                        ['n'=>'Family Pack','it'=>'12 Units','p'=>1199,'m'=>1799,'s'=>600,'pop'=>false],
                    ]; 
            @endphp
            @foreach($bundles as $i=>$b)
            <div class="reveal relative bg-white rounded-3xl border {{ $b['pop']?'border-mg-green border-2 shadow-xl shadow-mg-green/8':'border-mg-dark/5' }} p-8 text-center hover:-translate-y-2 hover:shadow-2xl transition-all duration-500">
                @if($b['pop'])<span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-mg-green text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">Most Popular</span>@endif
                <div class="w-16 h-16 bg-mg-green/8 rounded-3xl mx-auto mb-5 flex items-center justify-center text-3xl">📦</div>
                <h3 class="font-heading text-2xl font-bold text-mg-dark mb-1">{{ $b['n'] }}</h3>
                <p class="text-mg-muted text-sm mb-5">{{ $b['it'] }}</p>
                <p class="font-mono text-3xl font-bold text-mg-dark">₹{{ $b['p'] }} <span class="text-sm text-mg-muted line-through">₹{{ $b['m'] }}</span></p>
                <span class="inline-block bg-mg-green/8 text-mg-green text-xs font-bold px-3 py-1 rounded-full mt-2 mb-6">Save ₹{{ $b['s'] }}</span>
                <a href="{{ route('build-a-box') }}" class="block w-full py-3.5 {{ $b['pop']?'bg-mg-green text-white':'bg-mg-dark text-white' }} font-bold rounded-2xl hover:opacity-90 transition text-sm">Buy Bundle</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     11.5 BEYOND SNACKING (RECIPES)
     ══════════════════════════════════════════ --}}
@if(isset($recipes) && $recipes->count() > 0)
<section class="py-20 lg:py-28 bg-mg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark">Beyond <span class="italic text-mg-green">Snacking</span></h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php 
                $bgColors = ['bg-amber-50', 'bg-cyan-50', 'bg-emerald-50', 'bg-rose-50']; 
            @endphp
            @foreach($recipes as $index => $recipe)
            <div class="reveal bg-white rounded-[2rem] border border-black/5 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300 group flex flex-col h-full" style="transition-delay: {{ $index * 0.1 }}s">
                <a href="{{ route('recipes.show', $recipe->slug) }}" class="flex-grow flex flex-col">
                    <div class="h-48 relative overflow-hidden flex items-center justify-center p-6 {{ $bgColors[$index % count($bgColors)] }}">
                        <img src="{{ str_starts_with($recipe->image, 'http') ? $recipe->image : asset($recipe->image) }}" class="w-full h-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500 shadow-sm" alt="{{ $recipe->title }}">
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-3 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6l4 2"/></svg>
                                {{ $recipe->time }} <span class="mx-1">•</span> {{ $recipe->difficulty }}
                            </p>
                            <h3 class="font-heading text-xl font-black text-mg-dark group-hover:text-mg-green transition-colors line-clamp-2 mb-4">{{ $recipe->title }}</h3>
                        </div>
                        <span class="text-sm font-bold text-mg-green flex items-center gap-1 group-hover:gap-2 transition-all">View Recipe <span aria-hidden="true">&rarr;</span></span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12 reveal">
            <a href="{{ route('recipes') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-mg-dark/10 text-mg-dark text-sm font-bold rounded-full hover:bg-mg-dark hover:text-white transition-all shadow-sm">
                View All Recipes
            </a>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     12. REVIEWS
     ══════════════════════════════════════════ --}}
<section id="reviews" class="py-20 lg:py-28 bg-mg-green-dark text-white overflow-hidden grain">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black">{!! $page->sections['reviews_title'] ?? 'Snackers <span class="italic text-mg-leaf">Speak</span>' !!}</h2>
            <div class="flex items-center justify-center gap-2 mt-4">
                <span class="text-mg-gold text-lg">★★★★★</span>
                <span class="text-white/35 text-sm">{{ $page->sections['reviews_subtitle'] ?? '4.9/5 from 2,847 reviews' }}</span>
            </div>
        </div>
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
            @forelse($testimonials as $i => $r)
            @php 
                $colors = ['from-pink-400 to-rose-500', 'from-blue-400 to-indigo-500', 'from-green-400 to-emerald-500', 'from-orange-400 to-amber-500'];
                $cl = $colors[$i % count($colors)];
            @endphp
            <div class="break-inside-avoid bg-white/5 backdrop-blur-sm border border-white/8 rounded-3xl p-8 hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-black/10 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $cl }} flex items-center justify-center text-white text-lg font-bold shadow-inner group-hover:scale-110 transition-transform">{{ substr($r->user->name ?? 'Guest',0,1) }}</div>
                        <div>
                            <p class="font-bold text-base text-white">{{ $r->user->name ?? 'Guest' }}</p>
                            <p class="text-xs text-white/50 flex items-center gap-1 mt-0.5"><svg class="w-3.5 h-3.5 text-mg-leaf" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> Verified Buyer</p>
                        </div>
                    </div>
                    <div class="text-mg-gold text-sm flex gap-0.5">
                        @for($k=0; $k<$r->rating; $k++)<span>★</span>@endfor
                    </div>
                </div>
                <p class="text-white/80 text-base leading-relaxed font-medium italic">"{{ $r->review }}"</p>
            </div>
            @empty
            @php
                $staticReviews = [
                    ['r' => 5, 't' => 'The peri-peri makhana is dangerously addictive! Perfect midnight snack without the guilt. I\'ve already ordered my second batch.', 'n' => 'Priya S.', 'c' => 'from-pink-400 to-rose-500'],
                    ['r' => 5, 't' => 'Finally a brand that gets roasting right. Not too oily, incredibly crunchy, and the flavors are spot on. Highly recommend the cream & onion.', 'n' => 'Rahul M.', 'c' => 'from-blue-400 to-indigo-500'],
                    ['r' => 5, 't' => 'My kids love these in their lunchbox and I love that it\'s actually healthy. The subscription box is a lifesaver.', 'n' => 'Anita K.', 'c' => 'from-green-400 to-emerald-500'],
                    ['r' => 4, 't' => 'Great quality makhanas. The classic salted is my favorite with evening chai. Very fresh and crunchy.', 'n' => 'Vikram D.', 'c' => 'from-orange-400 to-amber-500'],
                    ['r' => 5, 't' => 'I swapped out my evening potato chips with these and I already feel lighter. The cheese flavor is so good!', 'n' => 'Simran J.', 'c' => 'from-purple-400 to-fuchsia-500'],
                    ['r' => 5, 't' => 'Best packaging and super fast delivery. The makhana stayed crisp for weeks. 10/10 would recommend to anyone.', 'n' => 'Karan T.', 'c' => 'from-teal-400 to-cyan-500']
                ];
            @endphp
            @foreach($staticReviews as $sr)
            <div class="break-inside-avoid bg-white/5 backdrop-blur-sm border border-white/8 rounded-3xl p-8 hover:bg-white/10 hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-black/10 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $sr['c'] }} flex items-center justify-center text-white text-lg font-bold shadow-inner group-hover:scale-110 transition-transform">{{ substr($sr['n'],0,1) }}</div>
                        <div>
                            <p class="font-bold text-base text-white">{{ $sr['n'] }}</p>
                            <p class="text-xs text-white/50 flex items-center gap-1 mt-0.5"><svg class="w-3.5 h-3.5 text-mg-leaf" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> Verified Buyer</p>
                        </div>
                    </div>
                    <div class="text-mg-gold text-sm flex gap-0.5">
                        @for($k=0; $k<$sr['r']; $k++)<span>★</span>@endfor
                    </div>
                </div>
                <p class="text-white/80 text-base leading-relaxed font-medium italic">"{{ $sr['t'] }}"</p>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     13. INSTAGRAM
     ══════════════════════════════════════════ --}}
@php
    $instagramEmbedUrl = $page->sections['instagram_video_1'] ?? \App\Models\Setting::get('instagram_embed_url', '');
    if ($instagramEmbedUrl) {
        if (strpos($instagramEmbedUrl, '?') !== false) {
            $instagramEmbedUrl = substr($instagramEmbedUrl, 0, strpos($instagramEmbedUrl, '?'));
        }
        $instagramEmbedUrl = rtrim($instagramEmbedUrl, '/');
        if (!str_ends_with($instagramEmbedUrl, '/embed')) {
            $instagramEmbedUrl .= '/embed';
        }
    }
@endphp

<section class="py-20 lg:py-24 bg-mg-cream relative overflow-hidden">
    <!-- Subtle background blob -->
    <div class="absolute -top-10 -right-10 w-72 h-72 bg-mg-green/5 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-mg-orange/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-12 reveal">
            <span class="inline-block bg-mg-green/10 text-mg-green text-[11px] font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-3">{{ $page->sections['instagram_badge'] ?? '#MunchGudMoments' }}</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark">{!! $page->sections['instagram_title'] ?? 'Tag Us <a href="https://instagram.com/munchgud" target="_blank" rel="noopener" class="italic text-mg-green hover:underline">@munchgud</a>' !!}</h2>
            <p class="text-mg-muted text-sm mt-3 max-w-md mx-auto">{{ $page->sections['instagram_subtitle'] ?? 'Share your snack love and get featured! Join our premium snacking community.' }}</p>
        </div>

        @if($instagramEmbedUrl)
            <div class="grid lg:grid-cols-12 gap-8 items-center">
                <!-- Column 1: Live Instagram Post Smartphone Frame -->
                <div class="lg:col-span-5 flex justify-center reveal">
                    <div class="relative w-full max-w-[360px] aspect-[9/16] bg-mg-dark rounded-[48px] p-3 shadow-2xl border-4 border-mg-dark/80 ring-8 ring-mg-dark/10 overflow-hidden">
                        <!-- Top Speaker / Notch -->
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-32 h-6 bg-mg-dark rounded-b-2xl z-50 flex items-center justify-center">
                            <span class="w-12 h-1 bg-white/20 rounded-full"></span>
                        </div>
                        <!-- Status Bar -->
                        <div class="absolute top-6 left-6 right-6 flex justify-between text-[10px] text-white/40 font-semibold font-mono z-40">
                            <span>MunchGud 5G</span>
                            <div class="flex items-center gap-1">
                                <span>📶</span>
                                <span>100% 🔋</span>
                            </div>
                        </div>
                        <!-- Iframe container -->
                        <div class="w-full h-full rounded-[38px] overflow-hidden bg-white pt-10 relative">
                            <iframe src="{{ $instagramEmbedUrl }}" class="w-full h-full border-0" scrolling="no" allowtransparency="true" allowfullscreen="true"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Gorgeous complementary feed grid -->
                <div class="lg:col-span-7 reveal">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach([
                            ['img' => '/images/story_farmer.png', 'likes' => '3.1K', 'comments' => '124', 'tag' => 'Mithila Sourced'],
                            ['img' => '/images/ingredient_macro.png', 'likes' => '1.8K', 'comments' => '89', 'tag' => 'Pure Protein'],
                            ['img' => '/images/product_shot.png', 'likes' => '2.5K', 'comments' => '142', 'tag' => 'Gourmet Roasted'],
                            ['img' => '/images/hero_bg.png', 'likes' => '4.2K', 'comments' => '210', 'tag' => 'Snack Gud']
                        ] as $item)
                            <div class="aspect-square rounded-3xl bg-white relative group overflow-hidden border border-mg-dark/5 shadow-md shadow-mg-dark/[0.02]">
                                <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Instagram Post">
                                <span class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm text-[10px] font-bold text-mg-green px-3 py-1 rounded-full uppercase tracking-wider shadow-sm z-10">{{ $item['tag'] }}</span>
                                <div class="absolute inset-0 bg-mg-green-dark/65 opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-center gap-3 z-20">
                                    <div class="flex items-center gap-4 text-white">
                                        <span class="font-bold text-sm flex items-center gap-1">❤️ {{ $item['likes'] }}</span>
                                        <span class="font-bold text-sm flex items-center gap-1">💬 {{ $item['comments'] }}</span>
                                    </div>
                                    <a href="{{ route('products.index') }}" class="bg-white text-mg-green text-[11px] font-bold px-4 py-1.5 rounded-full hover:bg-mg-orange hover:text-white transition shadow-lg">Shop Flavor</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Beautiful full interactive 6-column grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 lg:gap-4">
                @foreach([
                    ['img' => '/images/story_farmer.png', 'likes' => '3.8K', 'comments' => '189', 'tag' => 'Source', 'label' => 'Mithila Sourced'],
                    ['img' => '/images/ingredient_macro.png', 'likes' => '2.4K', 'comments' => '95', 'tag' => 'Healthy', 'label' => 'Pure Protein'],
                    ['img' => '/images/product_shot.png', 'likes' => '4.1K', 'comments' => '212', 'tag' => 'Snack', 'label' => 'Roasted Makhana'],
                    ['img' => '/images/hero_bg.png', 'likes' => '1.9K', 'comments' => '73', 'tag' => 'Vibe', 'label' => 'Air Roasted'],
                    ['img' => '/images/story_farmer.png', 'likes' => '2.9K', 'comments' => '104', 'tag' => 'Farms', 'label' => 'Direct to You'],
                    ['img' => '/images/ingredient_macro.png', 'likes' => '3.5K', 'comments' => '142', 'tag' => 'Nature', 'label' => 'Gluten Free']
                ] as $item)
                    <div class="reveal aspect-square rounded-3xl bg-white relative group overflow-hidden border border-mg-dark/5 shadow-md shadow-mg-dark/[0.02]">
                        <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-115 transition-transform duration-700" alt="Instagram Post">
                        <!-- Custom Tag -->
                        <span class="absolute top-3.5 left-3.5 bg-white/90 backdrop-blur-sm text-[9px] font-black text-mg-dark px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm z-10">{{ $item['tag'] }}</span>
                        <!-- Glassmorphic hover overlay -->
                        <div class="absolute inset-0 bg-mg-green-dark/70 opacity-0 group-hover:opacity-100 transition-all duration-400 flex flex-col items-center justify-center p-4 text-center z-20">
                            <span class="text-white/80 text-[10px] font-bold uppercase tracking-widest mb-1">{{ $item['label'] }}</span>
                            <div class="flex items-center gap-3 text-white mb-4">
                                <span class="font-bold text-xs flex items-center gap-1 select-none cursor-pointer hover:scale-110 active:scale-95 transition-all">❤️ {{ $item['likes'] }}</span>
                                <span class="font-bold text-xs flex items-center gap-1">💬 {{ $item['comments'] }}</span>
                            </div>
                            <a href="{{ route('products.index') }}" class="bg-mg-orange text-white text-[10px] font-bold px-4 py-2 rounded-full hover:bg-white hover:text-mg-green transition shadow-md">Shop Flavor</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ══════════════════════════════════════════
     14. SUBSCRIPTION
     ══════════════════════════════════════════ --}}
{{-- 
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <span class="inline-block bg-mg-orange/10 text-mg-orange text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-6">Subscribe & Save</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-6">Never Run Out<br>of <span class="italic text-mg-orange">Snacks</span></h2>
                <p class="text-mg-muted leading-relaxed mb-8">Curated flavours delivered monthly. Pause or cancel anytime.</p>
                @foreach(['New & exclusive flavours first','Free shipping every month','Skip, pause, cancel anytime','10% off vs one-time purchase'] as $b)
                <p class="flex items-center gap-3 text-sm text-mg-dark/55 py-1.5"><span class="text-mg-green">✦</span>{{ $b }}</p>
                @endforeach
            </div>
            <div class="reveal grid sm:grid-cols-3 gap-4">
                @foreach([
                    ['n'=>'Monthly','p'=>'299','per'=>'/mo','pop'=>false,'link'=>'monthly'],
                    ['n'=>'Quarterly','p'=>'799','per'=>'/3mo','pop'=>true,'link'=>'quarterly'],
                    ['n'=>'Annual','p'=>'2,799','per'=>'/yr','pop'=>false,'link'=>'annual']
                ] as $pl)
                <div class="relative bg-white rounded-3xl border {{ $pl['pop']?'border-mg-green border-2 shadow-xl shadow-mg-green/10 scale-105 z-10':'border-mg-dark/5 shadow-sm' }} p-6 sm:p-8 text-center hover:-translate-y-2 transition-all duration-300">
                    @if($pl['pop'])<span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-mg-green text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-md">Best Value</span>@endif
                    <h4 class="font-heading text-xl font-bold text-mg-dark mb-2">{{ $pl['n'] }}</h4>
                    <div class="flex items-end justify-center gap-1 mb-6">
                        <span class="text-mg-dark font-bold text-lg">₹</span>
                        <span class="font-mono text-4xl font-black text-mg-dark leading-none">{{ $pl['p'] }}</span>
                        <span class="text-sm font-semibold text-mg-muted mb-1">{{ $pl['per'] }}</span>
                    </div>
                    <a href="{{ route('build-a-box') }}?subscribe={{ $pl['link'] }}" class="block text-center w-full py-3.5 {{ $pl['pop']?'bg-mg-green text-white hover:bg-mg-green-dark shadow-md':'bg-mg-cream text-mg-dark hover:bg-mg-dark hover:text-white' }} text-sm font-bold rounded-2xl transition-all duration-300 active:scale-95">Subscribe Now</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
--}}

{{-- ══════════════════════════════════════════
     15. RECIPES
     ══════════════════════════════════════════ --}}
<section id="recipes" class="py-20 lg:py-28 bg-mg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark">Beyond <span class="italic text-mg-green">Snacking</span></h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach([['n'=>'Makhana Kheer','t'=>'25 min','e'=>'🍮','g'=>'from-amber-50 to-yellow-50'],['n'=>'Trail Mix Bites','t'=>'10 min','e'=>'🥣','g'=>'from-green-50 to-emerald-50'],['n'=>'Salad Topping','t'=>'5 min','e'=>'🥗','g'=>'from-lime-50 to-green-50'],['n'=>'Spiced Chaat','t'=>'15 min','e'=>'🌶️','g'=>'from-orange-50 to-red-50']] as $i=>$rc)
            <div class="reveal group bg-white rounded-3xl border border-mg-dark/[0.04] overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-500" style="transition-delay:{{ $i*0.08 }}s">
                <div class="aspect-[4/3] bg-gradient-to-br {{ $rc['g'] }} flex items-center justify-center"><span class="text-5xl group-hover:scale-110 transition-transform">{{ $rc['e'] }}</span></div>
                <div class="p-5">
                    <p class="text-[11px] font-semibold text-mg-muted mb-1">⏱ {{ $rc['t'] }} · Easy</p>
                    <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">{{ $rc['n'] }}</h4>
                    <a href="{{ route('recipes') }}" class="text-sm font-semibold text-mg-green flex items-center gap-1 group-hover:gap-2 transition-all">View Recipe →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     16. FOUNDER
     ══════════════════════════════════════════ --}}
<section id="story" class="py-20 lg:py-28 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-5 gap-12 items-center">
            <div class="lg:col-span-2 reveal">
                <div class="aspect-[3/4] rounded-3xl bg-gradient-to-br from-mg-green-dark/20 via-mg-green/15 to-mg-cream flex items-center justify-center relative overflow-hidden">
                    <img src="{{ asset('images/story_farmer.png') }}" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4 right-4 bg-white/80 backdrop-blur-sm rounded-2xl p-3">
                        <p class="font-heading text-sm font-bold text-mg-dark">Founded in Bihar, 2023</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3 reveal">
                <span class="inline-block bg-mg-green/8 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-6 border border-mg-green/10">Our Story</span>
                <h2 class="font-heading text-3xl sm:text-4xl font-black text-mg-dark mb-6 italic leading-snug">"India deserves a snack that's actually good for you — and tastes incredible."</h2>
                <p class="text-mg-muted leading-relaxed mb-4">Growing up in Bihar, makhana was always on our table — but always plain. We knew this superfood deserved bold flavours, premium quality, and a brand young India could be proud of.</p>
                <p class="text-mg-muted leading-relaxed mb-6">Today, MunchGud sources from 200+ farming families across Mithilanchal. Every pack represents our promise: real food, real taste, real impact.</p>
                <p class="font-heading font-bold text-mg-dark">— The MunchGud Team 🌿</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     17. CERTIFICATIONS
     ══════════════════════════════════════════ --}}
<section class="py-14 bg-mg-cream border-y border-mg-dark/5">
    <div class="max-w-5xl mx-auto px-4">
        <p class="text-center text-[10px] font-bold text-mg-muted uppercase tracking-[0.2em] mb-8">Certified & Trusted</p>
        <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-14">
            @foreach([['🏅','FSSAI'],['🏅','ISO 22000'],['🌱','100% Vegan'],['🧬','Non-GMO'],['🇮🇳','Made in India']] as $c)
            <div class="text-center group">
                <div class="w-14 h-14 mx-auto bg-mg-dark/5 rounded-2xl flex items-center justify-center mb-2 group-hover:bg-mg-green/10 transition text-2xl">{{ $c[0] }}</div>
                <p class="text-[10px] font-bold text-mg-muted uppercase tracking-wider">{{ $c[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     18. GIFTING
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-gradient-to-br from-mg-green/5 via-mg-cream to-mg-leaf/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="reveal">
                <span class="inline-block bg-mg-gold/15 text-mg-dark text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-6">🎁 Gifting</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-6">The Gift of Good<br><span class="italic text-mg-green">Snacking</span></h2>
                <p class="text-mg-muted leading-relaxed mb-8">Premium gift hampers for Diwali, birthdays, corporate events. Customizable packaging, bulk discounts available.</p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="bg-white rounded-2xl p-5 border border-mg-dark/5"><p class="font-heading text-lg font-bold text-mg-dark mb-1">Festive Hamper</p><p class="text-xs text-mg-muted mb-2">6 flavours + box</p><p class="font-mono font-bold text-mg-green">From ₹899</p></div>
                    <div class="bg-white rounded-2xl p-5 border border-mg-dark/5"><p class="font-heading text-lg font-bold text-mg-dark mb-1">Corporate</p><p class="text-xs text-mg-muted mb-2">Branded + message</p><p class="font-mono font-bold text-mg-green">From ₹599</p></div>
                </div>
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-mg-green-dark text-white font-bold px-8 py-4 rounded-full hover:bg-mg-green hover:scale-105 transition-all">Enquire for Bulk Orders →</a>
            </div>
            <div class="reveal"><div class="aspect-square rounded-3xl bg-gradient-to-br from-mg-green/15 via-mg-leaf/10 to-mg-cream flex items-center justify-center"><span class="text-[8rem]">🎁</span></div></div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     19. NEWSLETTER
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-mg-green-dark text-white grain overflow-hidden relative">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-mg-leaf/10 via-transparent to-transparent pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-mg-leaf/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-mg-leaf/20 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-3xl mx-auto px-4 text-center relative z-10 reveal">
        <div class="w-20 h-20 bg-white/5 border border-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 shadow-[0_0_40px_rgba(255,255,255,0.05)]">
            <span class="text-4xl">✉️</span>
        </div>
        <h2 class="font-heading text-5xl sm:text-6xl font-black mb-6 tracking-tight">Get <span class="text-mg-leaf">₹50 Off</span><br><span class="italic font-light text-white/90">Your First Order</span></h2>
        <p class="text-white/60 mb-10 max-w-lg mx-auto text-base leading-relaxed">Join 5,000+ snack lovers. Get updates on new flavours, exclusive offers, and makhana wisdom delivered directly to your inbox.</p>
        
        <form class="flex flex-col sm:flex-row p-2 max-w-xl mx-auto bg-white rounded-3xl sm:rounded-full shadow-2xl shadow-black/20 focus-within:ring-4 focus-within:ring-mg-leaf/30 transition-all">
            <input type="email" placeholder="Enter your email address..." required class="flex-1 px-6 py-4 sm:py-0 bg-transparent border-none text-mg-dark placeholder-mg-dark/30 font-medium text-base focus:outline-none focus:ring-0 rounded-t-3xl sm:rounded-l-full sm:rounded-r-none">
            <button type="submit" class="px-8 py-4 bg-mg-green text-white font-bold rounded-2xl sm:rounded-full hover:bg-mg-green-dark active:scale-[0.98] transition-all text-sm shadow-md whitespace-nowrap">Claim Discount →</button>
        </form>
    </div>
</section>

{{-- ══════════════════════════════════════════
     20. FAQ
     ══════════════════════════════════════════ --}}
<section id="faq" class="py-24 lg:py-32 bg-white relative overflow-hidden border-t border-mg-dark/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ active: 0 }">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-mg-green/10 text-mg-green font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-4">Support</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Frequently Asked <span class="italic text-mg-green">Questions</span></h2>
            <p class="text-mg-muted text-lg max-w-lg mx-auto">Everything you need to know about MunchGud.</p>
        </div>
        
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-20">
            <!-- Left Side: Question List (Tabs) -->
            <div class="lg:col-span-5 space-y-3 reveal">
                @php 
                    $faqs = \App\Models\Faq::active()->orderBy('sort_order')->get(); 
                @endphp
                
                @foreach($faqs as $i=>$f)
                <button @click="active = {{ $i }}" 
                        class="w-full text-left p-5 rounded-2xl transition-all duration-300 border-2 focus:outline-none"
                        :class="active === {{ $i }} ? 'border-mg-green bg-mg-green/5 text-mg-green shadow-md' : 'border-transparent hover:bg-mg-cream text-mg-dark/70 hover:text-mg-dark'">
                    <div class="flex items-center gap-4">
                        <span class="font-mono text-sm font-bold opacity-40">0{{ $i+1 }}</span>
                        <span class="font-heading text-lg font-bold">{{ $f->question }}</span>
                    </div>
                </button>
                @endforeach
                
                <div class="mt-8 p-5 rounded-2xl bg-mg-cream/50 text-center border border-mg-dark/5">
                    <p class="text-mg-muted text-sm font-medium">Still have questions? <br/><a href="{{ route('contact') }}" class="text-mg-green font-bold hover:underline mt-1 inline-block">Contact our support team &rarr;</a></p>
                </div>
            </div>
            
            <!-- Right Side: Answer Display -->
            <div class="lg:col-span-7 reveal lg:border-l border-mg-dark/5 lg:pl-16 flex flex-col justify-center min-h-[300px]">
                @foreach($faqs as $i=>$f)
                <div x-show="active === {{ $i }}" 
                     x-transition:enter="transition ease-out duration-500" 
                     x-transition:enter-start="opacity-0 translate-y-8" 
                     x-transition:enter-end="opacity-100 translate-y-0" 
                     class="w-full"
                     style="{{ $i === 0 ? '' : 'display: none;' }}">
                     
                    <span class="inline-block w-16 h-1.5 bg-mg-green mb-8 rounded-full"></span>
                    <h3 class="font-heading text-3xl lg:text-4xl font-black text-mg-dark mb-6 leading-tight">{{ $f->question }}</h3>
                    <p class="text-xl text-mg-muted leading-relaxed font-medium">{{ $f->answer }}</p>
                    
                    @if($i === 0)
                        <div class="mt-10 flex gap-4">
                            <span class="px-5 py-2.5 bg-mg-green/10 text-mg-green rounded-xl font-bold text-sm border border-mg-green/20">🔥 89 Calories</span>
                            <span class="px-5 py-2.5 bg-mg-green/10 text-mg-green rounded-xl font-bold text-sm border border-mg-green/20">💧 Zero Oil</span>
                        </div>
                    @endif
                    @if($i === 2)
                        <div class="mt-10 flex gap-4">
                            <span class="px-5 py-2.5 bg-mg-green/10 text-mg-green rounded-xl font-bold text-sm border border-mg-green/20">🚚 Fast Shipping</span>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     21. SUSTAINABILITY
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-28 bg-mg-green-dark text-white grain overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-14 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black">Snacking with a <span class="italic text-mg-leaf">Conscience</span></h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([['♻️','Eco-Friendly Packaging','100% recyclable, biodegradable packaging. Working toward fully compostable by 2026.'],['🌾','Supporting Farmers','Fair trade pricing for 200+ farming families in Bihar. 30% above market rate.'],['🏭','Zero-Waste Production','All by-products converted to organic fertilizer. 99.2% waste diversion rate.']] as $i=>$pl)
            <div class="reveal bg-white/5 backdrop-blur-sm rounded-3xl p-8 border border-white/8 text-center hover:bg-white/10 transition-all">
                <span class="text-5xl mb-4 block">{{ $pl[0] }}</span>
                <h4 class="font-heading text-xl font-bold text-white mb-3">{{ $pl[1] }}</h4>
                <p class="text-white/45 text-sm leading-relaxed">{{ $pl[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     22. PRESS / AS SEEN IN
     ══════════════════════════════════════════ --}}
<section class="py-14 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <p class="text-center text-[10px] font-bold text-mg-muted uppercase tracking-[0.2em] mb-8">As Seen In</p>
        <div class="flex flex-wrap items-center justify-center gap-10 lg:gap-16">
            @foreach(['YourStory','Inc42','NDTV Food','The Hindu','Femina'] as $p)
            <span class="font-heading text-xl lg:text-2xl font-bold text-mg-dark/12 hover:text-mg-green transition-colors cursor-default select-none">{{ $p }}</span>
            @endforeach
        </div>
    </div>
</section>

@php
    $instaLinks = [];
    foreach(['instagram_video_1', 'instagram_video_2', 'instagram_video_3'] as $key) {
        $url = $page->sections[$key] ?? '';
        if (!$url && $key === 'instagram_video_1') {
            $url = \App\Models\Setting::get('instagram_embed_url', '');
        }
        if ($url) {
            if (strpos($url, '?') !== false) {
                $url = substr($url, 0, strpos($url, '?'));
            }
            $url = rtrim($url, '/');
            if (!str_ends_with($url, '/embed')) {
                $url .= '/embed';
            }
            $instaLinks[] = $url;
        }
    }
@endphp
<section class="py-24 lg:py-32 bg-mg-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 reveal">
            <div>
                <span class="inline-block bg-mg-green/10 text-mg-green font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-4">Community</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Join the <span class="italic text-mg-green">#MunchGudFam</span></h2>
                <p class="text-mg-muted text-lg">Follow us on Instagram for daily snacking inspiration.</p>
            </div>
            <a href="https://instagram.com/munchgud" target="_blank" class="inline-flex items-center gap-2 font-bold bg-white px-6 py-3 rounded-full shadow-sm hover:shadow-md text-mg-dark hover:text-mg-green transition-all">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                @munchgud
            </a>
        </div>
        
        <div class="reveal">
            @if(count($instaLinks) > 0)
                <div class="grid grid-cols-1 md:grid-cols-[{{ count($instaLinks) == 1 ? 'minmax(0,1fr)' : 'repeat('.count($instaLinks).',minmax(0,1fr))' }}] gap-8 max-w-{{ count($instaLinks) == 1 ? '2xl' : '7xl' }} mx-auto">
                    @foreach($instaLinks as $link)
                    <div class="w-full bg-white rounded-[2rem] shadow-2xl shadow-mg-dark/5 overflow-hidden border border-mg-dark/5 p-2 sm:p-4 md:p-6 lg:p-8">
                        <iframe src="{{ $link }}" width="100%" height="750" frameborder="0" scrolling="no" allowtransparency="true" class="rounded-xl bg-white"></iframe>
                    </div>
                    @endforeach
                </div>
            @else
                @php $ph = ['images/hero_bg.png', 'images/product_shot.png', 'images/story_farmer.png', 'images/ingredient_macro.png']; @endphp
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">
                    @for($i=0; $i<4; $i++)
                        <a href="https://instagram.com/munchgud" target="_blank" class="aspect-square rounded-[2rem] overflow-hidden relative group shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                            <img src="{{ asset($ph[$i]) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/80 via-mg-dark/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white">
                                <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </div>
                            </div>
                        </a>
                    @endfor
                </div>
            @endif
        </div>
    </div>
</section>

@endsection

