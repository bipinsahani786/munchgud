@extends('storefront.layout')

@section('title', 'Premium Cream & Onion Roasted Makhana — MunchGud')

@section('content')

<!-- Custom Styling for Scroll Animations & Smooth Gradients -->
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.85);
        box-shadow: 0 30px 60px -15px rgba(43, 110, 47, 0.08);
    }
    .hover-lift {
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hover-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 40px 80px -15px rgba(43, 110, 47, 0.15);
    }
    .bullet-card {
        transition: all 0.3s ease;
    }
    .bullet-card:hover {
        border-color: rgba(43, 110, 47, 0.3);
        background-color: rgba(43, 110, 47, 0.03);
    }
</style>

{{-- ══════════════════════════════════════════
     1. HERO SECTION
     ══════════════════════════════════════════ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-mg-cream grain">
    <!-- Curved Background Blobs -->
    <div class="absolute top-20 right-[5%] w-96 h-96 bg-mg-green/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-[5%] w-[450px] h-[450px] bg-mg-leaf/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <!-- Left Side: Content -->
            <div class="reveal">
                <div class="inline-flex items-center gap-2 bg-mg-green/8 text-mg-green text-xs font-bold px-4 py-2 rounded-full mb-6 tracking-widest uppercase border border-mg-green/10">
                    <span class="w-2 h-2 bg-mg-green rounded-full animate-pulse"></span>
                    Premium Flavours
                </div>
                <h1 class="font-heading text-5xl sm:text-6xl lg:text-7xl font-black text-mg-dark leading-[1.05] tracking-tight mb-8">
                    MunchGud Cream <br class="hidden sm:inline">
                    <span class="text-mg-green italic">& Onion</span> Makhana
                </h1>
                <p class="text-xl text-mg-dark/70 max-w-lg mb-8 leading-relaxed font-light">
                    Enjoy the rich and satisfying taste of cream and onion makhana from MunchGud. It is created for people who enjoy rich flavour and easy everyday snacking. Our flavored makhana has that creamy seasoning with a light crunchy texture, delivering rich flavour in every bite.
                </p>
                <p class="text-base text-mg-dark/50 max-w-lg mb-10 leading-relaxed font-light">
                    We prepare this makhana cream and onion carefully so that every pack stays fresh, crunchy and full of flavour. It is perfect for tea-time cravings, office breaks, late night movies, travel, or just casual snacking at home. This cream & onion makhana gives you a rich and satisfying snacking experience without feeling too heavy. It is ideal for moments when you want something crunchy, flavourful, and light. So if you are looking for a better snacking option, try our flavored makhana and enjoy creamy flavour with satisfying crunch in every bite. Order your favourite makhana online and experience the simple joy of good snacking.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2.5 bg-mg-green text-white font-bold text-base px-10 py-5 rounded-full hover:bg-mg-green-dark hover:scale-105 active:scale-95 transition-all shadow-lg shadow-mg-green/20">
                        Shop Now Online
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right Side: Graphic Visual (Floating) -->
            <div class="relative flex justify-center reveal">
                <div class="w-80 h-80 sm:w-96 sm:h-96 lg:w-[480px] lg:h-[480px] rounded-full bg-gradient-to-br from-mg-green/15 via-mg-leaf/10 to-mg-cream flex items-center justify-center relative">
                    <div class="w-64 h-64 sm:w-80 sm:h-80 lg:w-[380px] lg:h-[380px] rounded-[3rem] bg-gradient-to-br from-mg-green/20 to-mg-cream flex items-center justify-center float overflow-hidden shadow-2xl">
                        <img src="{{ isset($page->sections['hero_image']) ? Storage::url($page->sections['hero_image']) : asset('images/cream_onion_hero.png') }}" class="w-full h-full object-cover" alt="MunchGud Cream and Onion Makhana Bowl">
                    </div>
                </div>
                <div class="absolute top-8 left-4 bg-white/90 backdrop-blur-sm px-5 py-3 rounded-2xl shadow-lg float" style="animation-delay:0.5s">
                    <p class="text-sm font-bold text-mg-green">🧅 Rich & Creamy</p>
                </div>
                <div class="absolute bottom-12 right-2 bg-white/90 backdrop-blur-sm px-5 py-3 rounded-2xl shadow-lg float" style="animation-delay:1.2s">
                    <p class="text-sm font-bold text-mg-orange">🔥 Extra Crunchy</p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     2. PRODUCT INTRODUCTION SECTION
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <!-- Left Side: Image (Alternating) -->
            <div class="reveal relative order-last lg:order-first">
                <div class="absolute -inset-4 bg-mg-green/5 rounded-[3.5rem] -rotate-2"></div>
                <div class="relative aspect-[4/5] sm:aspect-square lg:aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="{{ isset($page->sections['quality_image']) ? Storage::url($page->sections['quality_image']) : asset('images/cream_onion_quality.png') }}" alt="Crunchy Cream and Onion Roasted Makhana Close Up" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/30 to-transparent"></div>
                </div>
                <!-- Mini Glass Card Overlay -->
                <div class="absolute bottom-6 right-6 left-6 glass-card p-6 rounded-2xl border border-white/40">
                    <p class="text-sm text-mg-dark/80 italic font-medium leading-relaxed">
                        "Our tasty flavored makhana brings a creamy seasoning blended with a light crispy roasted texture, giving you a rich and comforting flavour in every bite."
                    </p>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="reveal">
                <span class="inline-block bg-mg-green/10 text-mg-green font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Smooth & Savoury</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Product Introduction
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        Enjoy the rich and satisfying taste of MunchGud’s rich cream and onion makhana, made for modern snack lovers in cities like Pune who enjoy flavourful and crunchy snacking anytime during the day. Our tasty flavored makhana brings a creamy seasoning blended with a light crispy roasted texture, giving you a rich and comforting flavour in every bite.
                    </p>
                    <p>
                        We prepare this makhana cream and onion with care so you always get freshness and satisfying crunch in every pack. This cream & onion makhana is a good choice for tea time cravings, office breaks, movie nights, travelling, or anytime you just feel like snacking something crunchy and enjoyable. With this flavored makhana, you get a lighter everyday snacking option that feels easy to enjoy anytime. So go ahead, enjoy the creamy and crunchy taste of Cream & Onion and order your favourite makhana online today.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     3. WHY PEOPLE LOVE CREAM & ONION FLAVOUR
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-mg-cream/60 grain relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <!-- Left Side: Content -->
            <div class="reveal">
                <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Unmatched Flavor Profile</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Why People Love <br class="hidden sm:inline">Cream & Onion Flavour
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        The smooth and comforting taste of Cream & Onion has always been a favourite among snack lovers of all age groups. The mix of creamy flavour and savoury seasoning gives a rich and satisfying taste that feels familiar and really enjoyable. MunchGud’s carefully prepared cream & onion makhana brings this classic flavour together with light and crunchy roasted makhana, creating a simple but modern snacking experience.
                    </p>
                    <p>
                        One of the main reasons people enjoy our cream and onion makhana is the smooth flavour in every bite. The creamy flavour blends nicely with the crispy roasted texture, giving a smooth and crunchy feel that keeps you reaching for more from the first bite itself. Unlike heavy fried snacks, roasted makhana gives you a lighter option while still keeping full flavour and proper crunch.
                    </p>
                    <p>
                        Whether it is evening tea, movie time with family, late night work, or travel breaks, our delicious flavored makhana fits easily into every mood and occasion. The comforting taste and crunchy texture make it perfect for regular snacking without feeling boring. At MunchGud, we make sure every pack maintains proper freshness, taste and quality so customers get the same experience every time. With its creamy seasoning and crispy crunch, cream and onion makhana offers a top-quality snacking experience made for everyday modern lifestyle.
                    </p>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="reveal relative">
                <div class="absolute -inset-4 bg-mg-orange/5 rounded-[3.5rem] rotate-2"></div>
                <div class="relative aspect-[4/5] sm:aspect-square lg:aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="{{ isset($page->sections['snack_image']) ? Storage::url($page->sections['snack_image']) : asset('images/cream_onion_snack.png') }}" alt="Premium MunchGud Cream & Onion Snacking Vibe" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/30 to-transparent"></div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     4. LIGHT & MODERN SNACKING SECTION
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-mg-green/10 text-mg-green font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-4">Smarter Choices</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Light & Modern Snacking</h2>
            <p class="text-mg-muted max-w-2xl mx-auto text-lg">Mindful snacking that fits naturally into your daily routine—delivering high-quality taste and proper crunch.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            
            <!-- Left Panel -->
            <div class="reveal bg-mg-cream/30 border border-mg-dark/5 p-8 sm:p-10 rounded-[2.5rem] hover-lift flex flex-col justify-between">
                <div>
                    <h3 class="font-heading text-2xl font-black text-mg-dark mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-mg-green/10 text-mg-green rounded-xl flex items-center justify-center text-xl">🧘</span>
                        Enjoyable Everyday Comfort
                    </h3>
                    <p class="text-mg-dark/70 text-base leading-relaxed mb-6 font-light">
                        Modern lifestyles are changing the way people snack every day. More and more consumers are moving away from oily and heavily fried snacks and choosing lighter options that feel tasty, convenient, and better suited for regular munching. MunchGud’s rich flavored makhana range is made for people who want enjoyable snacking without giving up on flavour or everyday comfort.
                    </p>
                    <p class="text-mg-dark/70 text-base leading-relaxed font-light">
                        Unlike traditional snacks that often feel greasy or too heavy, roasted makhana gives a light and crunchy experience that fits well into today’s eating habits. Whether it is office work, evening tea, travel, study time, or movie nights at home, makhana has become a go to choice for people who prefer smarter snacking throughout the day.
                    </p>
                </div>
                <div class="mt-8 flex gap-2">
                    <span class="px-4 py-2 bg-mg-green/10 text-mg-green rounded-xl font-bold text-xs">✓ Light & Crunchy</span>
                    <span class="px-4 py-2 bg-mg-green/10 text-mg-green rounded-xl font-bold text-xs">✓ Sourced Honestly</span>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="reveal bg-mg-cream/30 border border-mg-dark/5 p-8 sm:p-10 rounded-[2.5rem] hover-lift flex flex-col justify-between">
                <div>
                    <h3 class="font-heading text-2xl font-black text-mg-dark mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-mg-orange/10 text-mg-orange rounded-xl flex items-center justify-center text-xl">💡</span>
                        Mindful Snacking & Smart Choices
                    </h3>
                    <p class="text-mg-dark/70 text-base leading-relaxed mb-6 font-light">
                        Our tasty cream and onion makhana brings creamy seasoning together with a crispy roasted texture, giving a snack that feels both comforting and enjoyable. The balanced flavour and crunchy bite make it perfect for guilt free munching during small hunger moments without the heaviness of fried snacks.
                    </p>
                    <p class="text-mg-dark/70 text-base leading-relaxed font-light">
                        Today, mindful snacking has become a big part of modern lifestyles. People want snacks that are easy to carry, easy to enjoy, and fit naturally into daily routines. At MunchGud, we focus on creating flavourful roasted makhana that delivers high-quality taste, proper crunch, and a modern snacking experience for consumers who prefer lighter and smarter food choices. Whether at work, during travel, or relaxing at home, our flavored makhana is made for anytime enjoyment.
                    </p>
                </div>
                <div class="mt-8 flex gap-2">
                    <span class="px-4 py-2 bg-mg-orange/10 text-mg-orange rounded-xl font-bold text-xs">✓ Easy To Carry</span>
                    <span class="px-4 py-2 bg-mg-orange/10 text-mg-orange rounded-xl font-bold text-xs">✓ Zero Oil Roasting</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     5. PUNE SEO SECTION (Curved banner)
     ══════════════════════════════════════════ --}}
<section class="py-20 lg:py-24 bg-mg-green-dark text-white relative grain overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-mg-leaf/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-mg-leaf/5 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            <!-- Banner Content -->
            <div class="lg:col-span-7 reveal">
                <span class="inline-block bg-white/10 text-white text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4">Pune Delivery Hub</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black mb-6 leading-tight">
                    Order Fresh Fox Nuts Online in Pune
                </h2>
                <div class="text-white/80 text-lg leading-relaxed space-y-4 font-light">
                    <p>
                        Pune is becoming one of the leading cities where people are actively choosing smarter and more flavourful snacking choices for their daily lifestyle. From office professionals and college students to families and fitness-conscious consumers, the demand for lighter and modern snacks is growing very fast. People now want snacks that are tasty, convenient, and suitable for regular munching without feeling too heavy.
                    </p>
                    <p>
                        As online shopping habits continue to increase, many customers now prefer ordering fox nuts online pune for easy access to carefully prepared and flavour-packed snacks directly from home or office. Online ordering makes it simple for snack lovers to enjoy fresh makhana delivered at their doorstep without wasting time searching in local stores.
                    </p>
                    <p>
                        MunchGud’s delicious cream and onion makhana is specially made for modern snack lovers who enjoy smooth creamy flavour with a crispy roasted crunch. Whether it is tea time snacks, office munching, travel breaks, or movie night cravings, cream and onion makhana gives a tasty and convenient snacking option for every moment. At MunchGud, we focus on freshness, flavour consistency, and proper packaging so customers always receive crunchy and flavourful makhana every time they order online. With easy availability and online convenience, enjoying premium makhana snacks in Pune has become much simpler and more enjoyable.
                    </p>
                </div>
            </div>

            <!-- Visual Badge -->
            <div class="lg:col-span-5 flex justify-center reveal">
                <div class="glass-card bg-white/5 border-white/10 rounded-3xl p-10 text-center max-w-sm shadow-2xl relative">
                    <span class="text-6xl mb-6 block">🚀</span>
                    <h3 class="font-heading text-2xl font-bold mb-3 text-white">Pune Fast Delivery</h3>
                    <p class="text-white/60 text-sm leading-relaxed mb-6 font-light">Get fresh, nitrogen-flushed, crunchy makhana delivered straight to your home or office in Pune.</p>
                    <a href="{{ route('products.index') }}" class="block w-full py-4 bg-white text-mg-green-dark hover:bg-mg-orange hover:text-white text-base font-bold rounded-full transition-all active:scale-[0.98]">Order Fox Nuts in Pune</a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     6. PRODUCT QUALITY & FRESHNESS SECTION
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-20 items-center">
            
            <!-- Left Content Block -->
            <div class="reveal">
                <span class="inline-block bg-mg-green/10 text-mg-green font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Our Dedication</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Product Quality & Freshness
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        At MunchGud, we believe good snacking always starts with proper quality ingredients, freshness, and consistent flavour. Our carefully prepared cream and onion makhana is carefully prepared to give the right balance of creamy taste and crispy crunch in every bite. From selecting ingredients to final packing, everything is handled with care so customers get a proper high-quality snacking experience every time they open a pack.
                    </p>
                    <p>
                        The smooth and savoury seasoning used in our flavored makhana is made in a way that gives rich taste without covering the natural crunch of roasted makhana. Each batch is roasted carefully to keep the texture light and crispy, which people enjoy during tea time, office breaks, travel, or movie nights.
                    </p>
                    <p>
                        Freshness is very important for us. That is why MunchGud products are packed using hygienic and modern packaging that helps maintain crunch, flavour, and quality for a longer time. This ensures customers always receive makhana that feels fresh, crispy, and flavourful from first bite to last. At MunchGud, our focus is simple: deliver snacks that bring creamy flavour, crunchy texture, clean preparation, and reliable packaging in one product. Our aim is to make makhana a trusted everyday snack for modern healthy snacking habits.
                    </p>
                </div>
            </div>

            <!-- Right Visual Layout -->
            <div class="reveal grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <div class="bg-mg-cream/30 p-6 rounded-3xl border border-mg-dark/5 text-center">
                        <span class="text-4xl mb-3 block">🔥</span>
                        <h4 class="font-bold text-mg-dark mb-1">Air-Roasted</h4>
                        <p class="text-xs text-mg-muted">No oil, hot-air popped for peak crispness.</p>
                    </div>
                    <div class="bg-mg-cream/30 p-6 rounded-3xl border border-mg-dark/5 text-center">
                        <span class="text-4xl mb-3 block">🧅</span>
                        <h4 class="font-bold text-mg-dark mb-1">Gourmet Seasoning</h4>
                        <p class="text-xs text-mg-muted">Naturally balanced cream and chives blend.</p>
                    </div>
                </div>
                <div class="space-y-4 pt-8">
                    <div class="bg-mg-cream/30 p-6 rounded-3xl border border-mg-dark/5 text-center">
                        <span class="text-4xl mb-3 block">🛡️</span>
                        <h4 class="font-bold text-mg-dark mb-1">Hygienic Prep</h4>
                        <p class="text-xs text-mg-muted">Strict quality checks from seed to pouch.</p>
                    </div>
                    <div class="bg-mg-cream/30 p-6 rounded-3xl border border-mg-dark/5 text-center">
                        <span class="text-4xl mb-3 block">📦</span>
                        <h4 class="font-bold text-mg-dark mb-1">Freshly Sealed</h4>
                        <p class="text-xs text-mg-muted">Premium packaging preserves maximum shelf-life.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     7. WHY CHOOSE MUNCHGUD CREAM & ONION MAKAHANA
     ══════════════════════════════════════════ --}}
<section class="py-24 bg-mg-cream/40 grain relative border-t border-mg-dark/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <!-- Left Side: Interactive Bullet Points -->
            <div class="reveal order-last lg:order-first grid gap-6">
                <div class="bg-white p-6 rounded-2xl border border-mg-dark/[0.04] shadow-sm flex items-start gap-4">
                    <span class="w-10 h-10 bg-mg-green/10 text-mg-green rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold">1</span>
                    <div>
                        <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">Quality consistency</h4>
                        <p class="text-mg-muted text-sm font-light">We make sure the flavour stays consistent so customers get the same delicious taste every time they open a pack.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-mg-dark/[0.04] shadow-sm flex items-start gap-4">
                    <span class="w-10 h-10 bg-mg-green/10 text-mg-green rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold">2</span>
                    <div>
                        <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">Snack for all ages</h4>
                        <p class="text-mg-muted text-sm font-light">Our delicious makhana cream and onion flavour combines creamy seasoning with crunchy makhana to create a comforting snack that suits all age groups.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-mg-dark/[0.04] shadow-sm flex items-start gap-4">
                    <span class="w-10 h-10 bg-mg-green/10 text-mg-green rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold">3</span>
                    <div>
                        <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">Freshness & quality</h4>
                        <p class="text-mg-muted text-sm font-light">As a modern flavored makhana brand, we focus on freshness, quality ingredients, proper packaging, and flavour that feels enjoyable every single day.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="reveal">
                <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Our Standout Features</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Why Choose MunchGud <br class="hidden sm:inline">Cream & Onion Makhana
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        MunchGud is made for people who genuinely enjoy flavourful snacks with rich quality and a satisfying crunch in every bite. Our tasty cream and onion makhana is specially created for modern snack lovers who prefer a smooth, savoury taste without the heaviness of regular fried snacks. With balanced seasoning, crispy roasted texture, and rich flavour, every pack gives a proper top-quality snacking experience for daily enjoyment.
                    </p>
                    <p>
                        At MunchGud, we make sure the flavour stays consistent so customers get the same delicious taste every time they open a pack. Our delicious makhana cream and onion flavour combines creamy seasoning with crunchy roasted makhana to create a comforting snack that suits all age groups. Whether it is kids enjoying movie time, office professionals taking short breaks, or families sharing evening snacks, cream and onion makhana fits easily into every moment.
                    </p>
                    <p>
                        As a modern flavored makhana brand, we clearly understand how snacking habits are changing today. People now want snacks that are easy to carry, simple to enjoy, and perfect for anytime munching during travel, tea time, work, or relaxation. That is why at MunchGud we focus on freshness, quality ingredients, proper packaging, and flavour that feels enjoyable every single day.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     8. FAQ SECTION (Accordion)
     ══════════════════════════════════════════ --}}
<section id="faq" class="py-24 lg:py-32 bg-white relative overflow-hidden border-t border-mg-dark/5">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ active: 0 }">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-mg-green/10 text-mg-green font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-4">FAQ</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Frequently Asked <span class="italic text-mg-green">Questions</span></h2>
            <p class="text-mg-muted text-lg max-w-lg mx-auto">Everything you need to know about our Cream & Onion makhana.</p>
        </div>
        
        <div class="space-y-4 reveal">
            @php
                $faqs = [
                    [
                        'q' => 'What is cream and onion makhana?',
                        'a' => 'Cream and onion makhana is a crunchy roasted snack made from fox nuts and coated with creamy and savoury seasoning. It combines smooth flavour with crispy texture, making it a popular choice for people who enjoy flavourful and modern snacking.'
                    ],
                    [
                        'q' => 'What does cream & onion makhana taste like?',
                        'a' => 'Cream & onion makhana offers a rich, creamy, and slightly savoury flavour that gives rich flavour in every bite. The balanced seasoning with crispy roasted texture gives a comforting snack experience loved by both kids and adults.'
                    ],
                    [
                        'q' => 'Is cream and onion makhana good for daily snacking?',
                        'a' => 'Yes, many people enjoy cream and onion makhana as part of their everyday snacking routine because it is light, crunchy, and easy to enjoy regularly. It is perfect for office breaks, evening cravings, tea-time snacks, study sessions, and casual movie-time munching.'
                    ],
                    [
                        'q' => 'Why is flavored makhana becoming popular?',
                        'a' => 'The demand for flavored makhana is increasing because people are now looking for snacks that deliver flavourful and lighter snacking options. Flavours like cream and onion make makhana more interesting and enjoyable compared to plain traditional snacks.'
                    ],
                    [
                        'q' => 'Can cream and onion makhana be eaten during tea time?',
                        'a' => 'Absolutely. The smooth and savoury flavour of cream and onion makhana goes very well with evening tea or coffee. Its crunchy texture and balanced taste make it a popular tea-time snack in many households.'
                    ],
                    [
                        'q' => 'Where can I order fox nuts online in Pune?',
                        'a' => 'Customers looking for fox nuts online pune can explore MunchGud’s makhana range and place orders online easily. Our snacks are packed carefully to keep them fresh, crunchy, and full of flavour during delivery.'
                    ],
                    [
                        'q' => 'Is makhana suitable for movie and travel snacking?',
                        'a' => 'Yes, roasted makhana is perfect for movie nights, travel, office work, and study sessions because it is light, easy to carry, and easy to enjoy during long snacking sessions. The crispy texture and flavour make it a great anytime snack.'
                    ],
                    [
                        'q' => 'Why do people prefer cream and onion flavour?',
                        'a' => 'Many snack lovers enjoy creamy and savoury flavours because they feel comforting and easy to eat regularly. MunchGud’s premium makhana cream and onion flavour blends smooth seasoning with crunchy roasted makhana to create a satisfying snack enjoyed by people of all age groups.'
                    ]
                ];
            @endphp
            
            @foreach($faqs as $i => $faq)
            <div class="border border-mg-dark/5 rounded-2xl overflow-hidden bg-mg-cream/10">
                <button @click="active = (active === {{ $i }} ? null : {{ $i }})" 
                        class="w-full text-left p-6 font-heading text-lg font-bold text-mg-dark flex items-center justify-between transition-colors focus:outline-none"
                        :class="active === {{ $i }} ? 'bg-mg-green/5 text-mg-green' : 'hover:bg-mg-cream/30'">
                    <span>{{ $faq['q'] }}</span>
                    <svg :class="active === {{ $i }} ? 'rotate-180 text-mg-green' : 'text-mg-dark/30'" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="active === {{ $i }}" 
                     x-collapse
                     x-transition:enter="transition ease-out duration-300"
                     class="p-6 bg-white border-t border-mg-dark/[0.03] text-mg-dark/70 font-light leading-relaxed">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     9. FINAL CTA SECTION
     ══════════════════════════════════════════ --}}
<section class="py-24 bg-mg-green-dark text-white relative overflow-hidden grain">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-mg-leaf/10 via-transparent to-transparent pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-mg-leaf/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-mg-leaf/20 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 reveal">
        <div class="w-20 h-20 bg-white/5 border border-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
            <span class="text-4xl">🧅</span>
        </div>
        <h2 class="font-heading text-4xl sm:text-6xl font-black mb-6 leading-tight">
            Try Cream & Onion <br class="hidden sm:inline">
            <span class="text-mg-leaf italic">By MunchGud Today</span>
        </h2>
        <p class="text-white/80 mb-10 max-w-xl mx-auto text-base sm:text-lg leading-relaxed font-light">
            Enjoy the rich taste and satisfying crunch of MunchGud’s high-quality cream and onion makhana and make your everyday snacking more exciting. Made for modern snack lovers, our tasty flavored makhana brings creamy seasoning, crispy texture, and a premium crunchy experience in every bite. Whether you are relaxing at home, working, travelling, or enjoying movie nights, MunchGud makes everyday snacking more flavourful and enjoyable in your daily routine. Explore our exciting makhana flavours and enjoy lighter snacking that suits modern lifestyles. If you are looking for rich fox nuts online pune, order fresh and crunchy and flavourful makhana from MunchGud today.
        </p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('products.index') }}" class="px-10 py-5 bg-white text-mg-green-dark hover:bg-mg-orange hover:text-white font-bold rounded-full transition-all duration-300 text-lg shadow-xl hover:scale-105 active:scale-95">
                Order Fresh Pack Online →
            </a>
        </div>
    </div>
</section>

@endsection
