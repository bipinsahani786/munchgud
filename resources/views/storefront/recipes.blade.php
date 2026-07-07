@extends('storefront.layout')

@section('title', 'Makhana Recipes | MunchGud')
@section('meta_description', 'Discover delicious and healthy makhana recipes by MunchGud. Quick, easy, and guilt-free recipes using roasted fox nuts for everyday snacking.')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="pt-32 pb-24 lg:pt-40 lg:pb-32 bg-mg-cream grain overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            {{-- TEXT CONTENT --}}
            <div class="lg:w-5/12 text-center lg:text-left relative z-10 reveal">
                <div class="absolute -top-20 -left-20 w-64 h-64 bg-mg-green/10 rounded-full blur-[60px] -z-10"></div>
                
                <span class="inline-block bg-mg-green/10 text-mg-green text-xs font-bold px-5 py-2 rounded-full tracking-[0.2em] uppercase mb-8 border border-mg-green/20">{{ $page->sections['hero_badge'] ?? 'The Culinary Canvas' }}</span>
                <h1 class="font-heading text-6xl md:text-8xl font-black text-mg-dark leading-[1.1] mb-8">
                    {!! $page->sections['hero_title'] ?? 'MunchGud<br><span class="italic text-mg-orange">Recipes.</span>' !!}
                </h1>
                <p class="text-xl md:text-2xl text-mg-muted font-medium max-w-lg mx-auto lg:mx-0 leading-relaxed mb-10">
                    {{ $page->sections['hero_desc'] ?? 'Elevate your culinary game. Discover quick, healthy, and incredibly tasty makhana-based recipes.' }}
                </p>
                <div class="flex items-center justify-center lg:justify-start gap-6">
                    <a href="#featured" class="bg-mg-dark text-white font-bold px-8 py-4 rounded-full hover:bg-mg-green transition-all shadow-lg hover:-translate-y-1">
                        Explore Recipes
                    </a>
                    <a href="{{ route('products.index') }}" class="text-mg-dark font-bold hover:text-mg-orange transition-colors flex items-center gap-2 group">
                        Shop Ingredients <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            {{-- IMAGE COLLAGE --}}
            <div class="lg:w-7/12 relative w-full reveal" style="transition-delay: 0.2s;">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-mg-orange/10 rounded-full blur-[80px] -z-10"></div>
                
                <div class="relative h-[450px] sm:h-[600px] w-full max-w-lg mx-auto lg:max-w-none mt-10 lg:mt-0 lg:ml-auto lg:pl-10">
                    <!-- Main large image -->
                    <div class="absolute top-0 right-0 lg:right-4 w-[85%] lg:w-[80%] h-[80%] rounded-[3rem] overflow-hidden shadow-2xl shadow-mg-dark/10 border-8 border-white bg-mg-cream z-10 transform hover:scale-105 transition-transform duration-500">
                        <img src="{{ isset($page->sections['hero_image_main']) ? Storage::url($page->sections['hero_image_main']) : 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?q=80&w=1000&auto=format&fit=crop' }}" class="w-full h-full object-cover" alt="Healthy Food">
                    </div>
                    <!-- Overlapping small image bottom left -->
                    <div class="absolute bottom-10 left-0 lg:left-8 w-[55%] h-[50%] rounded-[2rem] overflow-hidden shadow-2xl shadow-mg-dark/15 border-8 border-white bg-mg-cream z-20 transform -rotate-6 hover:rotate-0 hover:scale-105 transition-all duration-500">
                        <img src="{{ isset($page->sections['hero_image_small']) ? Storage::url($page->sections['hero_image_small']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=800&auto=format&fit=crop' }}" class="w-full h-full object-cover" alt="Smoothie Bowl">
                    </div>
                    <!-- Small accent element -->
                    <div class="absolute top-16 -left-4 sm:-left-8 lg:left-0 bg-white px-6 py-4 rounded-2xl shadow-xl z-30 flex items-center gap-3 animate-bounce" style="animation-duration: 3s;">
                        <span class="text-2xl">✨</span>
                        <div>
                            <p class="text-xs font-bold text-mg-muted uppercase tracking-wider">100% Healthy</p>
                            <p class="font-heading font-black text-mg-dark leading-tight">Guilt-Free</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 2. FEATURED RECIPE (HERO CARD) --}}
@if($featuredRecipe)
<section id="featured" class="py-24 bg-white relative">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 reveal">
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-mg-dark/10 overflow-hidden flex flex-col md:flex-row group border border-white">
            <div class="md:w-1/2 lg:w-3/5 relative overflow-hidden h-[400px] md:h-[500px]">
                <img src="{{ $featuredRecipe['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $featuredRecipe['title'] }}">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 md:hidden"></div>
                <div class="absolute top-6 left-6 bg-white/90 backdrop-blur text-mg-dark text-xs font-bold px-4 py-2 rounded-full shadow-lg uppercase tracking-wider flex items-center gap-2 z-10">
                    <span class="text-mg-orange">★</span> Featured
                </div>
            </div>
            <div class="md:w-1/2 lg:w-2/5 p-10 lg:p-12 flex flex-col justify-center bg-mg-cream/30">
                <div class="flex gap-4 mb-6">
                    <span class="bg-white text-mg-orange text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-mg-orange/10">{{ $featuredRecipe['category'] }}</span>
                    <span class="bg-white text-mg-dark text-xs font-bold px-3 py-1 rounded-full shadow-sm flex items-center gap-1 border border-mg-dark/5"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> {{ $featuredRecipe['time'] }}</span>
                </div>
                <h2 class="font-heading text-4xl font-black text-mg-dark mb-4 group-hover:text-mg-green transition-colors">{{ $featuredRecipe['title'] }}</h2>
                <p class="text-mg-muted text-lg mb-8 leading-relaxed">{{ $featuredRecipe['description'] }}</p>
                <div class="mt-auto">
                    <a href="{{ route('recipes.show', $featuredRecipe['slug']) }}" class="inline-flex items-center gap-2 bg-mg-dark text-white font-bold px-8 py-4 rounded-full hover:bg-mg-green transition-all shadow-lg shadow-mg-dark/20 group-hover:-translate-y-1">
                        View Recipe &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- 3. RECIPE GRID --}}
<section class="py-24 bg-white relative">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($otherRecipes as $index => $recipe)
            <div class="bg-mg-cream/30 rounded-[2.5rem] border border-black/5 overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-mg-green/10 transition-all duration-500 reveal group" style="transition-delay: {{ $index * 0.1 }}s">
                <a href="{{ route('recipes.show', $recipe['slug']) }}" class="block">
                    <div class="aspect-video relative overflow-hidden bg-mg-cream">
                        <img src="{{ $recipe['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $recipe['title'] }}">
                        <div class="absolute bottom-4 left-4 flex flex-wrap gap-2">
                            <span class="bg-white/90 backdrop-blur text-mg-dark text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $recipe['category'] }}</span>
                            <span class="bg-white/90 backdrop-blur text-mg-dark text-xs font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> {{ $recipe['time'] }}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="font-heading text-2xl font-black text-mg-dark mb-3 group-hover:text-mg-green transition-colors line-clamp-1">{{ $recipe['title'] }}</h3>
                        <p class="text-mg-muted leading-relaxed mb-6 line-clamp-3">{{ $recipe['description'] }}</p>
                        <span class="font-bold text-mg-green border-b-2 border-mg-green/20 pb-1 group-hover:border-mg-green transition-colors">Read Recipe &rarr;</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- 4. SUBMIT BANNER --}}
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 reveal">
        
        @if(session('success'))
            <div class="mb-8 bg-mg-green/10 border border-mg-green text-mg-green-dark px-6 py-4 rounded-2xl flex items-center gap-3">
                <span class="text-2xl">✅</span>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif
        
        <div class="bg-mg-green-dark rounded-[3rem] p-12 lg:p-20 text-white relative overflow-hidden text-center shadow-2xl">
            <div class="absolute -right-20 -top-20 w-96 h-96 bg-mg-leaf/20 rounded-full blur-[80px]"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-mg-gold/10 rounded-full blur-[80px]"></div>
            
            <div class="relative z-10">
                <span class="text-5xl mb-6 block">👨‍🍳</span>
                <h2 class="font-heading text-4xl lg:text-5xl font-black mb-6">{!! $page->sections['banner_title'] ?? 'Got a unique recipe?' !!}</h2>
                <p class="text-white/80 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">{{ $page->sections['banner_desc'] ?? 'Share your own creative way to eat MunchGud. The best recipes will get featured on our website and social media, and you might just win a free box of snacks!' }}</p>
                <a href="{{ route('recipes.create') }}" class="inline-block bg-mg-gold text-mg-dark font-bold text-lg px-10 py-4 rounded-full hover:scale-105 hover:bg-white transition-all shadow-xl shadow-black/20">
                    Submit Your Recipe
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
