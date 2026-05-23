@extends('storefront.layout')

@section('title', 'Submit Your Recipe | MunchGud')

@section('content')

{{-- HERO SECTION --}}
<section class="pt-32 pb-20 bg-mg-cream grain">
    <div class="max-w-4xl mx-auto px-4 text-center reveal">
        <h1 class="font-heading text-5xl md:text-7xl font-black text-mg-dark leading-tight mb-6">
            Share Your <span class="italic text-mg-green">Creation.</span>
        </h1>
        <p class="text-xl text-mg-muted leading-relaxed max-w-2xl mx-auto">
            Got a unique way to enjoy MunchGud Makhana? Submit your recipe below! The best ones get featured on our site, and you might just win a free box of snacks.
        </p>
    </div>
</section>

{{-- FORM SECTION --}}
<section class="py-20 bg-white relative z-10 -mt-10 reveal" style="transition-delay: 0.1s;">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-mg-dark/10 p-8 md:p-12 border-8 border-mg-cream">
            
            @if(session('success'))
                <div class="mb-8 bg-mg-green/10 border border-mg-green text-mg-green-dark px-6 py-4 rounded-2xl flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <p class="font-bold">{{ session('success') }}</p>
                </div>
            @endif
            
            @if ($errors->any())
                <div class="mb-8 bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('recipes.submit') }}" method="POST" class="space-y-8">
                @csrf
                
                {{-- AUTHOR DETAILS --}}
                <div class="bg-mg-cream/30 p-6 rounded-3xl border border-black/5">
                    <h3 class="font-heading text-xl font-black text-mg-dark mb-6 flex items-center gap-2">
                        <span class="text-2xl">🧑‍🍳</span> About You
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-mg-dark mb-2">Your Name</label>
                            <input type="text" name="author_name" required class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors" placeholder="John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-mg-dark mb-2">Your Email</label>
                            <input type="email" name="author_email" required class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors" placeholder="john@example.com">
                        </div>
                    </div>
                </div>

                {{-- RECIPE DETAILS --}}
                <div class="bg-mg-cream/30 p-6 rounded-3xl border border-black/5">
                    <h3 class="font-heading text-xl font-black text-mg-dark mb-6 flex items-center gap-2">
                        <span class="text-2xl">🍲</span> Recipe Details
                    </h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-mg-dark mb-2">Recipe Title</label>
                            <input type="text" name="title" required class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors" placeholder="e.g. Spicy Peri Peri Pasta">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-mg-dark mb-2">Category</label>
                                <input type="text" name="category" required class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors" placeholder="Dinner, Snack...">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-mg-dark mb-2">Prep Time</label>
                                <input type="text" name="time" required class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors" placeholder="20 Mins">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-mg-dark mb-2">Difficulty</label>
                                <select name="difficulty" required class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors">
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INGREDIENTS & STEPS --}}
                <div class="bg-mg-cream/30 p-6 rounded-3xl border border-black/5">
                    <h3 class="font-heading text-xl font-black text-mg-dark mb-6 flex items-center gap-2">
                        <span class="text-2xl">📝</span> The Method
                    </h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-mg-dark mb-2">Ingredients (One per line)</label>
                            <textarea name="ingredients" required rows="5" class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors resize-none" placeholder="2 cups MunchGud Makhana&#10;1 tsp salt&#10;1 tbsp ghee..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-mg-dark mb-2">Instructions (One step per line)</label>
                            <textarea name="steps" required rows="6" class="w-full bg-white border border-black/5 rounded-xl px-4 py-3 focus:outline-none focus:border-mg-green focus:ring-1 focus:ring-mg-green transition-colors resize-none" placeholder="1. Roast the makhana for 5 mins.&#10;2. Mix spices in a separate bowl.&#10;..."></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 flex items-center justify-between">
                    <a href="{{ route('recipes') }}" class="font-bold text-mg-muted hover:text-mg-dark transition-colors">&larr; Back to Recipes</a>
                    <button type="submit" class="bg-mg-dark text-white font-bold px-10 py-4 rounded-full hover:bg-mg-green transition-colors shadow-xl shadow-mg-dark/20 text-lg group flex items-center gap-2">
                        Submit Recipe <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>

@endsection
