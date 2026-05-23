@extends('storefront.layout')

@section('title', 'Health Benefits | MunchGud')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="relative min-h-[80vh] flex items-center justify-center overflow-hidden bg-mg-cream grain">
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-mg-green/20 rounded-full blur-[120px] translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-mg-orange/15 rounded-full blur-[100px] -translate-x-1/3 translate-y-1/3"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(ellipse_at_center,rgba(255,255,255,0.5)_0%,transparent_70%)]"></div>

    <div class="relative z-10 text-center max-w-5xl mx-auto px-4 reveal">
        <span class="inline-block bg-mg-green/10 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-6 border border-mg-green/20">The Ancient Superfood</span>
        <h1 class="font-heading text-6xl md:text-8xl font-black text-mg-dark leading-tight mb-8">
            Healthy shouldn't taste<br><span class="italic text-mg-green">like a compromise.</span>
        </h1>
        <p class="text-xl md:text-2xl text-mg-muted font-medium max-w-3xl mx-auto leading-relaxed">
            Discover why Makhana is the ultimate guilt-free snack. Better than popcorn, healthier than chips, and packed with ancient Ayurvedic wisdom.
        </p>
    </div>
</section>

{{-- 2. NUTRITIONAL SHOWDOWN --}}
<section class="py-24 bg-white relative overflow-hidden border-b border-mg-dark/[0.03]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-6">The Snack Showdown</h2>
            <p class="text-mg-muted text-lg max-w-2xl mx-auto">See how roasted Makhana stacks up against your usual 4 PM cravings.</p>
        </div>
        
        <div class="bg-mg-cream/50 border border-mg-dark/5 rounded-[2.5rem] overflow-hidden reveal shadow-xl shadow-mg-dark/5">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-mg-dark/5">
                            <th class="p-6 text-mg-muted font-medium w-1/4">Per 100g serving</th>
                            <th class="p-6 bg-mg-green text-white text-2xl font-black font-heading w-1/4 text-center rounded-t-2xl relative shadow-[0_-10px_40px_rgba(43,110,47,0.2)] z-10">MunchGud Makhana 🌟</th>
                            <th class="p-6 text-mg-dark font-bold w-1/4 text-center">Popcorn (Movie Style)</th>
                            <th class="p-6 text-mg-dark font-bold w-1/4 text-center">Potato Chips</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-mg-dark/5">
                        <tr class="hover:bg-white transition-colors">
                            <td class="p-6 font-bold text-mg-dark">Protein</td>
                            <td class="p-6 text-center font-bold text-white bg-mg-green/90 shadow-[0_0_20px_rgba(43,110,47,0.1)] relative z-10">9.7g <span class="text-xs font-medium opacity-80 block mt-1">Highest</span></td>
                            <td class="p-6 text-center text-mg-muted font-medium">3.2g</td>
                            <td class="p-6 text-center text-mg-muted font-medium">5.5g</td>
                        </tr>
                        <tr class="hover:bg-white transition-colors">
                            <td class="p-6 font-bold text-mg-dark">Calories</td>
                            <td class="p-6 text-center font-bold text-white bg-mg-green shadow-[0_0_20px_rgba(43,110,47,0.1)] relative z-10">347 kcal <span class="text-xs font-medium opacity-80 block mt-1">Lowest</span></td>
                            <td class="p-6 text-center text-mg-muted font-medium">530 kcal</td>
                            <td class="p-6 text-center text-mg-muted font-medium">536 kcal</td>
                        </tr>
                        <tr class="hover:bg-white transition-colors">
                            <td class="p-6 font-bold text-mg-dark">Fat</td>
                            <td class="p-6 text-center font-bold text-white bg-mg-green/90 shadow-[0_0_20px_rgba(43,110,47,0.1)] relative z-10">0.1g <span class="text-xs font-medium opacity-80 block mt-1">Almost Zero</span></td>
                            <td class="p-6 text-center text-mg-muted font-medium">28.1g</td>
                            <td class="p-6 text-center text-mg-muted font-medium">34g</td>
                        </tr>
                        <tr class="hover:bg-white transition-colors">
                            <td class="p-6 font-bold text-mg-dark">Glycemic Index</td>
                            <td class="p-6 text-center font-bold text-white bg-mg-green rounded-b-2xl shadow-[0_10px_20px_rgba(43,110,47,0.1)] relative z-10">Low <span class="text-xs font-medium opacity-80 block mt-1">Sustained Energy</span></td>
                            <td class="p-6 text-center text-mg-muted font-medium">High</td>
                            <td class="p-6 text-center text-mg-muted font-medium">High</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- 3. THE 6 CORE BENEFITS (BENTO GRID) --}}
<section class="py-24 bg-mg-cream grain">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <span class="inline-block bg-mg-green/10 text-mg-green text-xs font-bold px-4 py-1.5 rounded-full tracking-widest uppercase mb-4 border border-mg-green/20">Holistic Wellness</span>
            <h2 class="font-heading text-4xl sm:text-5xl font-black text-mg-dark mb-4">Nature's Multivitamin</h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Benefit 1 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-black/5 hover:-translate-y-2 transition-transform duration-300 reveal group">
                <div class="w-14 h-14 bg-mg-green/10 text-mg-green rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-mg-green group-hover:text-white transition-all">💪</div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-3">High Protein</h3>
                <p class="text-mg-muted leading-relaxed text-sm">Packed with essential amino acids, making it the perfect post-workout recovery snack or afternoon energy booster.</p>
            </div>

            <!-- Benefit 2 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-black/5 hover:-translate-y-2 transition-transform duration-300 reveal group" style="transition-delay: 0.1s">
                <div class="w-14 h-14 bg-mg-green/10 text-mg-green rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-mg-green group-hover:text-white transition-all">🌾</div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-3">100% Gluten-Free</h3>
                <p class="text-mg-muted leading-relaxed text-sm">Naturally gluten-free and easy to digest. Say goodbye to bloating and stomach discomfort after snacking.</p>
            </div>

            <!-- Benefit 3 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-black/5 hover:-translate-y-2 transition-transform duration-300 reveal group" style="transition-delay: 0.2s">
                <div class="w-14 h-14 bg-mg-green/10 text-mg-green rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-mg-green group-hover:text-white transition-all">❤️</div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-3">Heart Healthy</h3>
                <p class="text-mg-muted leading-relaxed text-sm">Low in cholesterol, saturated fat, and sodium. Rich in magnesium and potassium which helps regulate blood pressure.</p>
            </div>

            <!-- Benefit 4 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-black/5 hover:-translate-y-2 transition-transform duration-300 reveal group">
                <div class="w-14 h-14 bg-mg-green/10 text-mg-green rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-mg-green group-hover:text-white transition-all">🔥</div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-3">Low GI</h3>
                <p class="text-mg-muted leading-relaxed text-sm">Releases energy slowly into the bloodstream, keeping you full longer and completely preventing sugar crashes.</p>
            </div>

            <!-- Benefit 5 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-black/5 hover:-translate-y-2 transition-transform duration-300 reveal group" style="transition-delay: 0.1s">
                <div class="w-14 h-14 bg-mg-green/10 text-mg-green rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-mg-green group-hover:text-white transition-all">🧘‍♀️</div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-3">Ayurvedic Calm</h3>
                <p class="text-mg-muted leading-relaxed text-sm">Traditionally known as 'Lotus Seeds', Ayurvedic medicine uses them to balance doshas, calm the mind, and improve sleep.</p>
            </div>

            <!-- Benefit 6 -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-black/5 hover:-translate-y-2 transition-transform duration-300 reveal group" style="transition-delay: 0.2s">
                <div class="w-14 h-14 bg-mg-green/10 text-mg-green rounded-2xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-mg-green group-hover:text-white transition-all">✨</div>
                <h3 class="font-heading text-2xl font-black text-mg-dark mb-3">Anti-Aging Properties</h3>
                <p class="text-mg-muted leading-relaxed text-sm">Rich in antioxidants and a special enzyme that helps repair damaged proteins, promoting youthful skin and vitality.</p>
            </div>
        </div>
    </div>
</section>

{{-- 4. FINAL CTA --}}
<section class="py-24 bg-white text-center">
    <div class="max-w-3xl mx-auto px-4 reveal">
        <h2 class="font-heading text-4xl lg:text-6xl font-black text-mg-dark mb-6">Ready to snack smarter?</h2>
        <p class="text-lg text-mg-muted mb-10">Treat your body to the crunch it deserves.</p>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-mg-green text-white font-bold text-lg px-10 py-5 rounded-full hover:bg-mg-green-dark hover:scale-105 transition-all shadow-xl shadow-mg-green/30">
            Shop Healthy Snacks
        </a>
    </div>
</section>

@endsection
