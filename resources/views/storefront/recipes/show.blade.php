@extends('storefront.layout')

@section('title', $recipe['title'] . ' | MunchGud Recipes')

@section('content')

{{-- 1. HERO SECTION --}}
<section class="relative pt-32 pb-20 bg-mg-cream grain">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="flex items-center justify-center gap-4 mb-6 reveal">
            <span class="bg-white text-mg-orange text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $recipe['category'] }}</span>
            <span class="bg-white text-mg-dark text-xs font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1"><svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> {{ $recipe['time'] }}</span>
            <span class="bg-white text-mg-green text-xs font-bold px-3 py-1.5 rounded-full shadow-sm border border-mg-green/20">{{ $recipe['difficulty'] }}</span>
            @if($recipe['author_name'])
                <span class="bg-mg-dark text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">By {{ $recipe['author_name'] }}</span>
            @endif
        </div>
        <h1 class="font-heading text-5xl md:text-7xl font-black text-mg-dark leading-tight mb-6 reveal" style="transition-delay: 0.1s;">
            {{ $recipe['title'] }}
        </h1>
        <p class="text-xl text-mg-muted leading-relaxed max-w-2xl mx-auto reveal" style="transition-delay: 0.2s;">
            {{ $recipe['description'] }}
        </p>
    </div>
</section>

{{-- 2. HERO IMAGE --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10 reveal">
    <div class="rounded-[3rem] overflow-hidden shadow-2xl shadow-mg-dark/10 h-[400px] md:h-[600px] border-[8px] border-white bg-mg-cream">
        <img src="{{ $recipe['image'] }}" class="w-full h-full object-cover" alt="{{ $recipe['title'] }}">
    </div>
</section>

{{-- 3. RECIPE CONTENT --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-16">
            
            {{-- INGREDIENTS --}}
            <div class="md:w-1/3 reveal">
                <div class="bg-mg-cream/30 p-8 rounded-[2.5rem] border border-black/5 sticky top-32">
                    <h3 class="font-heading text-3xl font-black text-mg-dark mb-6 flex items-center gap-3">
                        <span class="text-3xl">🛒</span> Ingredients
                    </h3>
                    <ul class="space-y-4 mb-8">
                        @foreach($recipe['ingredients'] as $ingredient)
                        <li class="flex items-start gap-3 text-mg-dark">
                            <svg class="w-6 h-6 text-mg-green shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            <span class="leading-relaxed">{{ $ingredient }}</span>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-black/5 text-center">
                        <p class="text-mg-dark font-bold mb-4">Need the core ingredient?</p>
                        <a href="{{ route('products.index') }}" class="block w-full bg-mg-green text-white font-bold py-3 rounded-full hover:bg-mg-green-dark transition-colors shadow-lg shadow-mg-green/20">
                            Shop Makhana
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- INSTRUCTIONS --}}
            <div class="md:w-2/3 reveal" style="transition-delay: 0.1s;">
                <h3 class="font-heading text-4xl font-black text-mg-dark mb-10 flex items-center gap-3">
                    <span class="text-4xl">👨‍🍳</span> Instructions
                </h3>
                
                <div class="space-y-12">
                    @foreach($recipe['steps'] as $index => $step)
                    <div class="flex gap-6 group">
                        <div class="shrink-0">
                            <div class="w-12 h-12 rounded-full bg-mg-cream text-mg-green font-heading font-black text-xl flex items-center justify-center border border-mg-green/20 group-hover:bg-mg-green group-hover:text-white transition-colors">
                                {{ $index + 1 }}
                            </div>
                        </div>
                        <div class="pt-2">
                            <p class="text-xl text-mg-dark leading-relaxed">{{ $step }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</section>

{{-- 4. MORE RECIPES --}}
@if($otherRecipes->count() > 0)
<section class="py-24 bg-mg-cream grain border-t border-mg-dark/5">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-heading text-4xl font-black text-mg-dark mb-12 text-center reveal">Hungry for more?</h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($otherRecipes as $index => $other)
            <div class="bg-white rounded-[2rem] border border-black/5 overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300 reveal group" style="transition-delay: {{ $index * 0.1 }}s">
                <a href="{{ route('recipes.show', $other['slug']) }}" class="block">
                    <div class="h-48 relative overflow-hidden bg-mg-cream">
                        <img src="{{ $other['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $other['title'] }}">
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-bold text-mg-orange uppercase tracking-wider mb-2 block">{{ $other['category'] }}</span>
                        <h3 class="font-heading text-xl font-black text-mg-dark group-hover:text-mg-green transition-colors line-clamp-1">{{ $other['title'] }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12 reveal">
            <a href="{{ route('recipes') }}" class="inline-flex items-center gap-2 text-mg-dark font-bold hover:text-mg-green transition-colors">
                &larr; Back to all recipes
            </a>
        </div>
    </div>
</section>
@endif

@endsection
