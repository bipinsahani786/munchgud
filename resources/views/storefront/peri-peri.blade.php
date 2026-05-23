@extends('storefront.layout')

@section('title', 'Premium Spicy Peri Peri Roasted Makhana — MunchGud')

@section('content')

<!-- Custom Styling for Fiery Theme & Hover Interactions -->
<style>
    .fiery-glass-card {
        background: rgba(255, 255, 255, 0.78);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.85);
        box-shadow: 0 30px 60px -15px rgba(224, 123, 42, 0.08);
    }
    .hover-spicy-lift {
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .hover-spicy-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 40px 80px -15px rgba(224, 123, 42, 0.15);
        border-color: rgba(224, 123, 42, 0.2);
    }
    .spicy-bullet-card {
        transition: all 0.3s ease;
    }
    .spicy-bullet-card:hover {
        border-color: rgba(224, 123, 42, 0.3);
        background-color: rgba(224, 123, 42, 0.03);
    }
</style>

{{-- ══════════════════════════════════════════
     1. HERO SECTION
     ══════════════════════════════════════════ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-mg-cream grain">
    <!-- Warm Background Accents -->
    <div class="absolute top-20 right-[5%] w-96 h-96 bg-mg-orange/8 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-[5%] w-[450px] h-[450px] bg-red-500/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <!-- Left Side: Content -->
            <div class="reveal">
                <div class="inline-flex items-center gap-2 bg-mg-orange/10 text-mg-orange text-xs font-bold px-4 py-2 rounded-full mb-6 tracking-widest uppercase border border-mg-orange/10">
                    <span class="w-2 h-2 bg-mg-orange rounded-full animate-ping"></span>
                    Bold & Spicy Flavour
                </div>
                <h1 class="font-heading text-5xl sm:text-6xl lg:text-7xl font-black text-mg-dark leading-[1.05] tracking-tight mb-8">
                    MunchGud Spicy <br class="hidden sm:inline">
                    <span class="text-mg-orange italic">Peri Peri</span> Makhana
                </h1>
                <p class="text-xl text-mg-dark/70 max-w-lg mb-8 leading-relaxed font-light">
                    Make your everyday snacking more exciting with MunchGud’s premium peri peri makhana. We prepare our crispy roasted peri peri makhana with bold flavour carefully so that every bite delivers spicy flavour with a crunchy bite that snack lovers enjoy. 
                </p>
                <p class="text-base text-mg-dark/50 max-w-lg mb-10 leading-relaxed font-light">
                    Our tasty flavored makhana is made for people who enjoy bold flavours but also want a lighter everyday snack option. Whether you are watching movies at home, travelling, working in an office, or having evening tea, MunchGud adds bold flavour and crispy snacking to your day. Enjoy the bold taste of Peri Peri and order your favourite flavour online today.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2.5 bg-mg-orange text-white font-bold text-base px-10 py-5 rounded-full hover:bg-mg-dark hover:scale-105 active:scale-95 transition-all shadow-lg shadow-mg-orange/20">
                        Order Spicy Peri Peri
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14m-7-7 7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right Side: Graphic Visual (Floating) -->
            <div class="relative flex justify-center reveal">
                <div class="w-80 h-80 sm:w-96 sm:h-96 lg:w-[480px] lg:h-[480px] rounded-full bg-gradient-to-br from-mg-orange/15 via-red-500/10 to-mg-cream flex items-center justify-center relative">
                    <div class="w-64 h-64 sm:w-80 sm:h-80 lg:w-[380px] lg:h-[380px] rounded-[3rem] bg-gradient-to-br from-mg-orange/20 to-mg-cream flex items-center justify-center float overflow-hidden shadow-2xl">
                        <img src="{{ isset($page->sections['hero_image']) && !str_starts_with($page->sections['hero_image'], 'images/') ? Storage::url($page->sections['hero_image']) : asset($page->sections['hero_image'] ?? 'images/peri_peri_hero.png') }}" class="w-full h-full object-cover" alt="MunchGud Peri Peri Roasted Makhana Bowl">
                    </div>
                </div>
                <div class="absolute top-8 left-4 bg-white/90 backdrop-blur-sm px-5 py-3 rounded-2xl shadow-lg float" style="animation-delay:0.5s">
                    <p class="text-sm font-bold text-red-600">🔥 Tangy & Fiery</p>
                </div>
                <div class="absolute bottom-12 right-2 bg-white/90 backdrop-blur-sm px-5 py-3 rounded-2xl shadow-lg float" style="animation-delay:1.2s">
                    <p class="text-sm font-bold text-mg-orange">🌶️ Air Roasted, Not Fried</p>
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
                <div class="absolute -inset-4 bg-mg-orange/5 rounded-[3.5rem] -rotate-2"></div>
                <div class="relative aspect-[4/5] sm:aspect-square lg:aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="{{ isset($page->sections['quality_image']) && !str_starts_with($page->sections['quality_image'], 'images/') ? Storage::url($page->sections['quality_image']) : asset($page->sections['quality_image'] ?? 'images/peri_peri_quality.png') }}" alt="Crispy Spicy Peri Peri Roasted Makhana Close Up" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/30 to-transparent"></div>
                </div>
                <!-- Mini Glass Card Overlay -->
                <div class="absolute bottom-6 right-6 left-6 fiery-glass-card p-6 rounded-2xl border border-white/40">
                    <p class="text-sm text-mg-dark/80 italic font-medium leading-relaxed">
                        "Every bite gives you a rich seasoning with a satisfying crunch that makes snacking enjoyable at any time of the day."
                    </p>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="reveal">
                <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Bold & Tangy Kick</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Product Introduction
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        Spicy snacks have always been loved by Indian snack lovers, and Peri Peri flavour is now one of the top choices for people who enjoy spicy and flavourful snacks. MunchGud’s premium peri peri makhana is made specially for people who love spicy flavour with crispy roasted texture. Every bite gives you a rich seasoning with a satisfying crunch that makes snacking enjoyable at any time of the day.
                    </p>
                    <p>
                        Our crunchy peri peri fox nuts are carefully roasted to give the perfect crispy texture without feeling too oily or heavy. The strong peri peri seasoning adds a spicy kick that satisfies cravings and gives a modern bold and enjoyable snacking experience. Whether you are relaxing at home, travelling, studying, working late, or watching movies with friends, peri peri makhana works well for every snacking moment. Today consumers prefer lighter snacks with better flavour, and MunchGud brings you a delicious roasted snack option for everyday munching. With satisfying crunch, exciting flavour, and easy to carry packaging, our peri peri makhana is made for busy lifestyles where people want flavour and convenience together.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     3. WHY PEOPLE LOVE PERI PERI FLAVOUR
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-mg-cream/60 grain relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <!-- Left Side: Content -->
            <div class="reveal">
                <span class="inline-block bg-red-500/10 text-red-600 font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Fiery Obsession</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Why Many Snack Lovers <br class="hidden sm:inline">Enjoy Peri Peri Flavour
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        The bold and exciting taste of Peri Peri has become a favourite for people who enjoy spicy and flavourful snacks. The mix of spicy, tangy, and savoury seasoning gives a rich spicy flavour that snack lovers enjoy regularly. MunchGud’s roasted peri peri makhana is made specially for snack lovers who want strong flavour with a light and crunchy texture that tastes great anytime during the day.
                    </p>
                    <p>
                        One of the main reasons people enjoy our peri peri fox nuts is the satisfying crunch in every bite. We carefully roast the makhana to give the perfect crispy texture so that the peri peri seasoning blends properly and delivers bold and balanced flavour in every bite. The spicy coating is bold enough to satisfy cravings while still feeling easy to enjoy regularly.
                    </p>
                    <p>
                        Unlike regular snacks that can feel too oily or heavy, our roasted makhana offers a lighter snacking option without compromising on taste. It is a great option for people who enjoy spicy snacks during office work, travel, study sessions, evening tea, or movie nights with family and friends. The combination of crunch and flavour makes it perfect for long snacking sessions whenever cravings start. At MunchGud, we focus on maintaining freshness and consistent flavour in every pack so customers can enjoy the same satisfying taste every time. Whether you are relaxing at home or searching for a quick spicy snack while travelling, our peri peri makhana gives you the right balance of bold flavour and lighter everyday snacking.
                    </p>
                </div>
            </div>

            <!-- Right Side: Image -->
            <div class="reveal relative">
                <div class="absolute -inset-4 bg-red-500/5 rounded-[3.5rem] rotate-2"></div>
                <div class="relative aspect-[4/5] sm:aspect-square lg:aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="{{ isset($page->sections['snack_image']) && !str_starts_with($page->sections['snack_image'], 'images/') ? Storage::url($page->sections['snack_image']) : asset($page->sections['snack_image'] ?? 'images/peri_peri_snack.jpeg') }}" alt="Premium MunchGud Peri Peri Snacking Lifestyle" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-mg-dark/30 to-transparent"></div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     4. LIGHTER SNACKING BENEFITS SECTION
     ══════════════════════════════════════════ --}}
<section class="py-24 lg:py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-4">Smarter Habit</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Lighter Snacking Benefits</h2>
            <p class="text-mg-muted max-w-2xl mx-auto text-lg">Indulge without the guilt. Discover why crisp air-roasted makhana is the perfect upgrade for busy modern lifestyles.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-16">
            
            <!-- Left Panel -->
            <div class="reveal bg-mg-cream/30 border border-mg-dark/5 p-8 sm:p-10 rounded-[2.5rem] hover-spicy-lift flex flex-col justify-between">
                <div>
                    <h3 class="font-heading text-2xl font-black text-mg-dark mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-mg-green/10 text-mg-green rounded-xl flex items-center justify-center text-xl">💡</span>
                        A Smarter, Lighter Swap
                    </h3>
                    <p class="text-mg-dark/70 text-base leading-relaxed mb-6 font-light">
                        As food habits are changing, consumers are becoming more conscious of the snacks they eat every day. Traditional fried snacks often feel oily and heavy, so many consumers now prefer smarter and lighter options. MunchGud brings premium healthy roasted snacks that give satisfying crunch along with convenient everyday snacking, making them perfect for everyday enjoyment.
                    </p>
                    <p class="text-mg-dark/70 text-base leading-relaxed font-light">
                        Roasted makhana has become a popular choice for people who want crispy snacks that feel lighter than deep fried products. Its light texture and crispy bite make it perfect for small hunger cravings during office hours, travel, evening tea, study sessions, or relaxing at home. Instead of choosing oily snacks, many people now enjoy lighter munching options that feel lighter and more satisfying.
                    </p>
                </div>
                <div class="mt-8 flex gap-2">
                    <span class="px-4 py-2 bg-mg-green/10 text-mg-green rounded-xl font-bold text-xs">✓ Light Crunchy Texture</span>
                    <span class="px-4 py-2 bg-mg-green/10 text-mg-green rounded-xl font-bold text-xs">✓ Guilt-Free Swap</span>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="reveal bg-mg-cream/30 border border-mg-dark/5 p-8 sm:p-10 rounded-[2.5rem] hover-spicy-lift flex flex-col justify-between">
                <div>
                    <h3 class="font-heading text-2xl font-black text-mg-dark mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-mg-orange/10 text-mg-orange rounded-xl flex items-center justify-center text-xl">📦</span>
                        Freshness & Doorstep Convenience
                    </h3>
                    <p class="text-mg-dark/70 text-base leading-relaxed mb-6 font-light">
                        Today consumers also look for easy snack options that fit busy routines that fit easily into busy lifestyles. Makhana has become a favourite choice for daily routines because it is easy to carry, easy to eat, and suitable for regular snacking during the day. Whether you are working late, watching movies, or simply craving something crunchy, roasted makhana gives a enjoyable snacking experience for busy lifestyles.
                    </p>
                    <p class="text-mg-dark/70 text-base leading-relaxed font-light">
                        With online shopping becoming more convenient, many people now prefer ordering roasted makhana online to enjoy fresh and flavourful snacks delivered directly to their doorstep. MunchGud focuses on freshness, crunch, and bold flavour to create snacks that feel flavourful and enjoyable for regular snacking.
                    </p>
                </div>
                <div class="mt-8 flex gap-2">
                    <span class="px-4 py-2 bg-mg-orange/10 text-mg-orange rounded-xl font-bold text-xs">✓ Easy To Carry Pouch</span>
                    <span class="px-4 py-2 bg-mg-orange/10 text-mg-orange rounded-xl font-bold text-xs">✓ Delivered Fresh</span>
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
                <span class="inline-block bg-white/10 text-white text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4">Pune's Healthy Snacking Hub</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black mb-6 leading-tight">
                    Order Premium Spicy Peri Peri Makhana in Pune
                </h2>
                <div class="text-white/80 text-lg leading-relaxed space-y-4 font-light">
                    <p>
                        Pune is becoming one of the top cities where consumers are choosing lighter and flavourful snack options for their everyday lifestyle. From fitness enthusiasts and working professionals to students and families, the demand for modern snack alternatives is growing fast. Customers searching for healthy snacks in pune often prefer lighter and flavourful options that fit easily into busy daily routines without compromising on taste.
                    </p>
                    <p>
                        As healthy snacking trends continue to grow, premium roasted makhana in pune has become a popular choice for people looking for crunchy and satisfying snacks with lighter texture than fried snacks. Peri Peri makhana with its bold flavour and crispy texture is especially popular among people who enjoy spicy flavours during tea time, office breaks, travel, or movie nights.
                    </p>
                    <p>
                        Online shopping has also made it easier for customers to order premium makhana snacks without going to multiple stores. Customers now prefer ordering fox nuts online pune to enjoy fresh and fresh and crunchy snacks delivered to their doorstep. MunchGud focuses on quality packaging, freshness, and flavour consistency to give customers a premium snacking experience across Pune. Whether you are looking for spicy snacks for daily munching or looking for premium peri peri makhana pune online, MunchGud offers easy ordering, exciting flavours, and modern healthy snacking made for today’s lifestyle.
                    </p>
                </div>
            </div>

            <!-- Visual Badge -->
            <div class="lg:col-span-5 flex justify-center reveal">
                <div class="glass-card bg-white/5 border-white/10 rounded-3xl p-10 text-center max-w-sm shadow-2xl relative">
                    <span class="text-6xl mb-6 block">⚡</span>
                    <h3 class="font-heading text-2xl font-bold mb-3 text-white">Pune Express Delivery</h3>
                    <p class="text-white/60 text-sm leading-relaxed mb-6 font-light">Get fresh, nitrogen-flushed, crunchy makhana delivered straight to your home or office in Pune.</p>
                    <a href="{{ route('products.index') }}" class="block w-full py-4 bg-white text-mg-green-dark hover:bg-mg-orange hover:text-white text-base font-bold rounded-full transition-all active:scale-[0.98]">Order Online in Pune</a>
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
                <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Our Commitment</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Product Quality & Freshness
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        At MunchGud, quality and freshness matter in every product we make. We know that customers searching for premium roasted makhana online expect good taste, satisfying crunch, and fresh snacks in every pack. That is why we focus carefully on ingredient selection, roasting quality, seasoning balance, and packaging standards to give a enjoyable snacking experience every time.
                    </p>
                    <p>
                        Our makhana is prepared using carefully selected ingredients and roasted carefully for a light and crispy texture that snack lovers enjoy. Every batch is seasoned with careful attention to flavour balance so the spicy peri peri flavour feels bold and satisfying without covering the natural crunch of the makhana.
                    </p>
                    <p>
                        Freshness is also an important part of making premium healthy roasted snacks. To maintain crunch and flavour quality, our products are packed in modern and hygienic packaging designed to keep freshness for a longer time. This helps customers enjoy the fresh crunch and flavour in every bite. At MunchGud, we believe better snacking starts with better preparation. From hygienic handling and roasting to flavour coating and packaging, every process is handled carefully so customers receive snacks that are fresh, flavourful, and enjoyable for everyday munching.
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
                        <span class="text-4xl mb-3 block">🌶️</span>
                        <h4 class="font-bold text-mg-dark mb-1">Peri Peri Mix</h4>
                        <p class="text-xs text-mg-muted">Naturally bold, spicy, and tangy blend.</p>
                    </div>
                </div>
                <div class="space-y-4 pt-8">
                    <div class="bg-mg-cream/30 p-6 rounded-3xl border border-mg-dark/5 text-center">
                        <span class="text-4xl mb-3 block">🛡️</span>
                        <h4 class="font-bold text-mg-dark mb-1">Strict Quality</h4>
                        <p class="text-xs text-mg-muted">Exacting standards from seed sorting to pack.</p>
                    </div>
                    <div class="bg-mg-cream/30 p-6 rounded-3xl border border-mg-dark/5 text-center">
                        <span class="text-4xl mb-3 block">🔒</span>
                        <h4 class="font-bold text-mg-dark mb-1">Nitrogen Sealed</h4>
                        <p class="text-xs text-mg-muted">Modern packaging locking in absolute crunch.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     7. WHY CHOOSE MUNCHGUD PERI PERI MAKAHANA
     ══════════════════════════════════════════ --}}
<section class="py-24 bg-mg-cream/40 grain relative border-t border-mg-dark/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            <!-- Left Side: Interactive Bullet Points -->
            <div class="reveal order-last lg:order-first grid gap-6">
                <div class="bg-white p-6 rounded-2xl border border-mg-dark/[0.04] shadow-sm flex items-start gap-4">
                    <span class="w-10 h-10 bg-mg-orange/10 text-mg-orange rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold">1</span>
                    <div>
                        <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">Exciting & Bold Flavours</h4>
                        <p class="text-mg-muted text-sm font-light">Specially prepared for people who love bold spicy taste with light and crunchy texture, using high quality natural spices.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-mg-dark/[0.04] shadow-sm flex items-start gap-4">
                    <span class="w-10 h-10 bg-mg-orange/10 text-mg-orange rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold">2</span>
                    <div>
                        <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">Suits All Age Groups</h4>
                        <p class="text-mg-muted text-sm font-light">The bold seasoning and roasted crunch create a premium snacking experience that both kids and adults enjoy.</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-mg-dark/[0.04] shadow-sm flex items-start gap-4">
                    <span class="w-10 h-10 bg-mg-orange/10 text-mg-orange rounded-xl flex items-center justify-center flex-shrink-0 text-xl font-bold">3</span>
                    <div>
                        <h4 class="font-heading text-lg font-bold text-mg-dark mb-2">Consistent Crunch & Quality</h4>
                        <p class="text-mg-muted text-sm font-light">Close attention to protective packaging, quality ingredients, and roasting standards for long-lasting freshness.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="reveal">
                <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Our Standout Features</span>
                <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-8 leading-tight">
                    Why Choose MunchGud <br class="hidden sm:inline">Peri Peri Makhana
                </h2>
                <div class="text-mg-dark/70 text-lg leading-relaxed space-y-6 font-light">
                    <p>
                        MunchGud is made for snack lovers who enjoy exciting flavours, premium quality, and a enjoyable everyday snacking experience. Our delicious peri peri makhana is specially prepared for people who love bold spicy taste with light and crunchy texture. Every pack is made with close attention to freshness, flavour balance, and satisfying crunch so snacking feels enjoyable at any time of the day.
                    </p>
                    <p>
                        As a flavoured makhana brand, we focus on creating snacks that suit busy daily routines. Whether you are working in the office, travelling, studying, watching movies, or relaxing at home, MunchGud makhana gives you a flavourful and convenient snack without the heaviness of traditional fried snacks. The bold peri peri seasoning and crispy roasted texture create a rich snacking experience that people of all age groups can enjoy.
                    </p>
                    <p>
                        With the growing demand for lighter snack choices and healthy snacks in pune, many people now look for products that combine flavour, convenience, and everyday snacking preferences. MunchGud focuses on quality ingredients, flavour consistency, and modern packaging that keeps every pack fresh and crunchy. From evening cravings to late night munching, our peri peri makhana is made for anytime snacking. With delicious flavour and premium quality in every bite, MunchGud brings an exciting flavour to everyday snacking.
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
            <span class="inline-block bg-mg-orange/10 text-mg-orange font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-4">FAQ</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Frequently Asked <span class="italic text-mg-orange">Questions</span></h2>
            <p class="text-mg-muted text-lg max-w-lg mx-auto">Everything you need to know about our bold Peri Peri makhana.</p>
        </div>
        
        <div class="space-y-4 reveal">
            @php
                $faqs = [
                    [
                        'q' => 'What is peri peri makhana?',
                        'a' => 'Peri peri makhana is a spicy and flavourful snack made using roasted fox nuts coated with peri peri seasoning. It gives you crispy texture with bold spicy flavour, which makes it a popular choice for people who enjoy flavourful crunchy snacks for everyday munching.'
                    ],
                    [
                        'q' => 'Is roasted peri peri makhana spicy?',
                        'a' => 'Yes, roasted peri peri makhana has a spicy and tangy flavour that gives an exciting kick in every bite. The seasoning is blended carefully so the taste feels bold and flavourful while still being enjoyable for regular snacking. It is a great option for people who enjoy spicy snacks with crunchy texture.'
                    ],
                    [
                        'q' => 'Why are peri peri fox nuts popular?',
                        'a' => 'Peri peri fox nuts are popular because they offer a tasty mix of spicy flavour and light crunch. Unlike regular fried snacks, roasted makhana feels lighter while still giving bold flavour, making it perfect for office snacks, movie nights, travel, or evening cravings.'
                    ],
                    [
                        'q' => 'Can makhana be eaten daily?',
                        'a' => 'Yes, makhana is often enjoyed as an everyday snack because of its light and crunchy texture. Roasted makhana is commonly enjoyed during daily snacking during tea time, work breaks, study sessions, or late-night munching.'
                    ],
                    [
                        'q' => 'Are makhana snacks healthier than chips?',
                        'a' => 'Many people prefer makhana as one of the lighter roasted snack options because it feels lighter compared to oily chips and heavily fried namkeen. Roasted makhana gives a crunchy snacking experience without the greasy feeling that people often get from traditional fried snacks.'
                    ],
                    [
                        'q' => 'Are makhana snacks considered protein rich snacks?',
                        'a' => 'Many consumers choose makhana when searching for convenient protein rich snacks that fit modern lifestyles. Its light texture and easy to carry nature make it a preferred option for people looking for smarter snacking choices during busy daily schedules.'
                    ],
                    [
                        'q' => 'Where can I order roasted makhana online?',
                        'a' => 'Customers searching for premium roasted makhana online can explore MunchGud’s flavour packed makhana collection and enjoy fresh snacks delivered directly to their doorstep. Online ordering makes it simple to enjoy crunchy and delicious makhana anytime.'
                    ],
                    [
                        'q' => 'Where can I buy roasted makhana in pune?',
                        'a' => 'If you are searching for premium roasted makhana in pune, MunchGud offers convenient online ordering with fresh delivery and exciting flavours. Customers looking for fox nuts online pune can easily order from our collection and enjoy delicious peri peri makhana at home.'
                    ],
                    [
                        'q' => 'Are makhana snacks good for evening cravings?',
                        'a' => 'Yes, makhana is a great option for evening snacking because it gives light crunch and satisfying flavour without feeling too heavy. Whether you enjoy spicy snacks during tea time, work breaks, or movie nights, peri peri makhana works perfectly as an everyday munching option.'
                    ]
                ];
            @endphp
            
            @foreach($faqs as $i => $faq)
            <div class="border border-mg-dark/5 rounded-2xl overflow-hidden bg-mg-cream/10">
                <button @click="active = (active === {{ $i }} ? null : {{ $i }})" 
                        class="w-full text-left p-6 font-heading text-lg font-bold text-mg-dark flex items-center justify-between transition-colors focus:outline-none"
                        :class="active === {{ $i }} ? 'bg-mg-orange/5 text-mg-orange' : 'hover:bg-mg-cream/30'">
                    <span>{{ $faq['q'] }}</span>
                    <svg :class="active === {{ $i }} ? 'rotate-180 text-mg-orange' : 'text-mg-dark/30'" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
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
<section class="py-24 bg-mg-orange text-white relative overflow-hidden grain">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-white/10 via-transparent to-transparent pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-red-500/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-red-500/20 rounded-full blur-[100px] pointer-events-none"></div>
    
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10 reveal">
        <div class="w-20 h-20 bg-white/5 border border-white/10 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 shadow-xl">
            <span class="text-4xl">🌶️</span>
        </div>
        <h2 class="font-heading text-4xl sm:text-6xl font-black mb-6 leading-tight">
            Ready for a Spicy <br class="hidden sm:inline">
            <span class="text-mg-dark italic">Peri Peri Kick?</span>
        </h2>
        <p class="text-white mb-10 max-w-xl mx-auto text-base sm:text-lg leading-relaxed font-light">
            Enjoy the bold taste and satisfying crunch of MunchGud’s premium peri peri makhana and make your snack time more exciting every day. Made for modern snack lovers, our spicy makhana delivers bold flavour with crispy texture for anytime munching. Whether you are searching for lighter everyday snacks or exploring premium roasted makhana online, MunchGud brings freshness, flavour, and convenience directly to your doorstep. Make your everyday snacking more enjoyable with delicious and crunchy makhana made for modern lifestyles. If you are looking for premium healthy snacks in pune, explore our exciting flavours and order online today.
        </p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('products.index') }}" class="px-10 py-5 bg-mg-dark text-white hover:bg-white hover:text-mg-orange font-bold rounded-full transition-all duration-300 text-lg shadow-xl hover:scale-105 active:scale-95">
                Shop Peri Peri Online Today →
            </a>
        </div>
    </div>
</section>

@endsection
