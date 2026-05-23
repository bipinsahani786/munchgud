@extends('components.layout.app')

@section('content')

<!-- 1. Hero Section -->
<section class="relative h-[90vh] bg-munch-950 flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 w-full h-full">
        <!-- Using a placeholder gradient since we don't have a hero video -->
        <div class="absolute inset-0 bg-gradient-to-r from-munch-900 to-munch-800 opacity-90"></div>
        <!-- Decorative pattern -->
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#E07B2A 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <span class="text-munch-accent uppercase tracking-[0.3em] font-semibold text-sm mb-4 block">Premium Indian Snacking</span>
        <h1 class="text-5xl md:text-7xl font-serif text-munch-cream mb-6 leading-tight">Gourmet Makhana, <br><span class="italic font-light">Elevated.</span></h1>
        <p class="text-xl text-munch-200 mb-10 font-light max-w-2xl mx-auto">Discover the perfect crunch. Rooted in ancient tradition, crafted for the modern palate.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('products.index') }}" class="bg-munch-accent hover:bg-munch-cream hover:text-munch-900 text-white px-8 py-4 text-lg font-medium transition-all duration-300">Shop The Collection</a>
            <a href="{{ route('build-a-box') }}" class="bg-transparent border border-munch-cream text-munch-cream hover:bg-munch-cream hover:text-munch-900 px-8 py-4 text-lg font-medium transition-all duration-300">Build a Box</a>
        </div>
    </div>
</section>

<!-- 2. As Seen On -->
<section class="py-12 bg-munch-cream border-b border-munch-200">
    <div class="max-w-7xl mx-auto px-4">
        <p class="text-center text-sm font-semibold text-munch-600 uppercase tracking-widest mb-8">Loved by the best</p>
        <div class="flex flex-wrap justify-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
            <h2 class="text-2xl font-serif font-bold">VOGUE</h2>
            <h2 class="text-2xl font-serif font-bold italic">GQ</h2>
            <h2 class="text-2xl font-serif font-bold uppercase tracking-widest">Forbes</h2>
            <h2 class="text-2xl font-serif font-bold">ELLE</h2>
        </div>
    </div>
</section>

<!-- 3. The Philosophy -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-16">
        <div class="md:w-1/2">
            <div class="w-full h-[600px] bg-munch-100 rounded-t-full overflow-hidden relative">
                <img src="{{ asset('images/logo.jpg') }}" alt="MunchGud Philosophy" class="absolute inset-0 w-full h-full object-cover mix-blend-multiply opacity-50 p-20">
            </div>
        </div>
        <div class="md:w-1/2 space-y-6">
            <span class="text-munch-accent uppercase tracking-widest text-sm font-bold">Our Philosophy</span>
            <h2 class="text-4xl md:text-5xl font-serif text-munch-900">Snacking without compromise.</h2>
            <p class="text-lg text-munch-600 font-light leading-relaxed">We believe that indulgence shouldn't come at the cost of your health. Our makhana is ethically sourced from the finest lotus ponds in Bihar, gently roasted, and tossed in gourmet seasonings crafted by top chefs.</p>
            <a href="{{ route('about') }}" class="inline-block border-b-2 border-munch-900 text-munch-900 hover:text-munch-accent hover:border-munch-accent pb-1 font-medium transition-colors mt-4">Discover Our Story</a>
        </div>
    </div>
</section>

<!-- 4. Featured Categories -->
<section class="py-24 bg-munch-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif text-munch-900 mb-4">Curated Collections</h2>
            <p class="text-munch-600">Find your perfect flavor profile.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Category 1 -->
            <div class="group relative h-96 overflow-hidden bg-munch-200">
                <div class="absolute inset-0 bg-munch-900/20 group-hover:bg-munch-900/40 transition-colors duration-500 z-10"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center z-20">
                    <h3 class="text-2xl font-serif text-white mb-4">Savory Classics</h3>
                    <a href="{{ route('products.index', ['category'=>'savory']) }}" class="bg-white text-munch-900 px-6 py-2 uppercase tracking-wider text-sm font-semibold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">Explore</a>
                </div>
            </div>
            <!-- Category 2 -->
            <div class="group relative h-96 overflow-hidden bg-munch-300">
                <div class="absolute inset-0 bg-munch-900/20 group-hover:bg-munch-900/40 transition-colors duration-500 z-10"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center z-20">
                    <h3 class="text-2xl font-serif text-white mb-4">Sweet Indulgence</h3>
                    <a href="{{ route('products.index', ['category'=>'sweet']) }}" class="bg-white text-munch-900 px-6 py-2 uppercase tracking-wider text-sm font-semibold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">Explore</a>
                </div>
            </div>
            <!-- Category 3 -->
            <div class="group relative h-96 overflow-hidden bg-munch-accent/80">
                <div class="absolute inset-0 bg-munch-900/20 group-hover:bg-munch-900/40 transition-colors duration-500 z-10"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center z-20">
                    <h3 class="text-2xl font-serif text-white mb-4">Build A Box</h3>
                    <a href="{{ route('build-a-box') }}" class="bg-white text-munch-900 px-6 py-2 uppercase tracking-wider text-sm font-semibold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">Customize</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Best Sellers -->
<section class="py-24 bg-munch-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12 border-b border-munch-200 pb-4">
            <h2 class="text-4xl font-serif text-munch-900">Cult Favorites</h2>
            <a href="{{ route('products.index') }}" class="hidden sm:block text-munch-accent font-medium hover:text-munch-900 transition-colors">Shop All Best Sellers &rarr;</a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($featuredProducts as $product)
                <div class="group">
                    <a href="{{ route('products.show', $product->slug) }}" class="block relative bg-white aspect-[4/5] mb-4 overflow-hidden">
                        @if($product->primaryImage)
                            <img src="{{ Storage::url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-munch-100 flex items-center justify-center text-munch-400 group-hover:scale-105 transition-transform duration-700">
                                <span class="font-serif italic text-xl">MunchGud</span>
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sku_id" value="{{ $product->skus->first()->id ?? '' }}">
                                <button type="submit" class="w-full bg-white text-munch-900 py-3 font-semibold uppercase tracking-wider text-sm hover:bg-munch-accent hover:text-white transition-colors">Quick Add</button>
                            </form>
                        </div>
                    </a>
                    <div>
                        <h3 class="text-lg font-medium text-munch-900 mb-1"><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
                        <p class="text-munch-600 mb-2 text-sm line-clamp-1">{{ $product->short_description }}</p>
                        <p class="font-medium text-munch-900">
                            ₹{{ $product->skus->first()->sale_price ?? 'N/A' }}
                            @if($product->skus->first() && $product->skus->first()->mrp > $product->skus->first()->sale_price)
                                <span class="text-gray-400 line-through text-sm ml-2">₹{{ $product->skus->first()->mrp }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <!-- Demo Products -->
                @for($i=1; $i<=4; $i++)
                <div class="group">
                    <div class="block relative bg-white aspect-[4/5] mb-4 overflow-hidden border border-munch-200">
                        <div class="w-full h-full bg-munch-100 flex flex-col items-center justify-center text-munch-500 p-8 text-center group-hover:scale-105 transition-transform duration-700">
                            <img src="{{ asset('images/logo.jpg') }}" class="w-20 opacity-50 mb-4 mix-blend-multiply">
                            <span class="font-serif italic text-xl">Peri Peri Makhana</span>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-munch-900 mb-1">Peri Peri Makhana</h3>
                        <p class="font-medium text-munch-900">₹149.00</p>
                    </div>
                </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

<!-- 6. Why Makhana? -->
<section class="py-20 bg-munch-900 text-munch-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl md:text-5xl font-serif mb-8">The Superfood Secret</h2>
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full border border-munch-accent flex items-center justify-center text-munch-accent flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-white mb-2">Heart Healthy</h3>
                            <p class="text-munch-300 font-light">Low in cholesterol, fat, and sodium. Rich in magnesium to help maintain healthy blood pressure.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full border border-munch-accent flex items-center justify-center text-munch-accent flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-white mb-2">Protein Packed</h3>
                            <p class="text-munch-300 font-light">An excellent source of plant-based protein and essential amino acids for sustained energy.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full border border-munch-accent flex items-center justify-center text-munch-accent flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-medium text-white mb-2">Gluten-Free & Vegan</h3>
                            <p class="text-munch-300 font-light">Naturally free from gluten and completely plant-based. The ultimate inclusive snack.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative h-[500px]">
                <div class="absolute inset-0 border border-munch-700 m-4 -z-10"></div>
                <div class="w-full h-full bg-munch-800 p-8 flex items-center justify-center">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Superfood" class="max-w-xs mix-blend-screen opacity-40">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. New Arrivals -->
<section class="py-24 bg-white">
    <!-- Similar to Best sellers but alternate layout (e.g. 1 large, 2 small) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif text-munch-900 mb-4">Fresh Out The Roaster</h2>
            <p class="text-munch-600">Discover our newest flavor innovations.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-munch-50 p-12 flex flex-col justify-center relative overflow-hidden group">
                <div class="absolute top-4 left-4 bg-munch-accent text-white px-3 py-1 text-xs font-bold uppercase tracking-wider z-10">New</div>
                <div class="relative z-10 w-1/2">
                    <h3 class="text-3xl font-serif text-munch-900 mb-4">Truffle & Parmesan</h3>
                    <p class="text-munch-600 mb-8">An indulgent blend of earthy truffle and savory parmesan cheese. Our most luxurious flavor yet.</p>
                    <a href="{{ route('products.index') }}" class="bg-munch-900 text-white px-6 py-3 hover:bg-munch-accent transition-colors inline-block">Shop Now</a>
                </div>
                <div class="absolute right-0 top-0 bottom-0 w-1/2 bg-munch-200">
                    <!-- Image placeholder -->
                </div>
            </div>
            <div class="bg-munch-100 p-8 flex flex-col items-center justify-center text-center">
                <h3 class="text-2xl font-serif text-munch-900 mb-2">Mint Makhana</h3>
                <p class="text-munch-600 mb-6 text-sm">Refreshing & zesty.</p>
                <a href="{{ route('products.index') }}" class="border-b-2 border-munch-900 pb-1 font-medium hover:text-munch-accent hover:border-munch-accent transition-all">View Product</a>
            </div>
        </div>
    </div>
</section>

<!-- 8. Our Ingredients -->
<section class="py-24 bg-munch-cream overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="absolute right-0 top-1/2 transform -translate-y-1/2 text-[20rem] font-serif text-munch-200 opacity-20 pointer-events-none select-none italic">
            Pure.
        </div>
        <div class="max-w-2xl relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif text-munch-900 mb-8">Ingredients you can pronounce.</h2>
            <p class="text-xl text-munch-700 font-light leading-relaxed mb-10">No artificial preservatives. No synthetic colors. Just the finest Makhana sourced directly from the farmers of Bihar, tossed in premium olive oil and natural spices.</p>
            <ul class="space-y-4 font-medium text-munch-900">
                <li class="flex items-center gap-3"><span class="w-2 h-2 bg-munch-accent rounded-full"></span> 100% Phool Makhana</li>
                <li class="flex items-center gap-3"><span class="w-2 h-2 bg-munch-accent rounded-full"></span> Cold-Pressed Olive Oil</li>
                <li class="flex items-center gap-3"><span class="w-2 h-2 bg-munch-accent rounded-full"></span> Himalayan Pink Salt</li>
                <li class="flex items-center gap-3"><span class="w-2 h-2 bg-munch-accent rounded-full"></span> Authentic Whole Spices</li>
            </ul>
        </div>
    </div>
</section>

<!-- 9. The Process -->
<section class="py-20 bg-munch-900 text-munch-cream border-t border-munch-800">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-serif mb-12">The MunchGud Process</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="p-6">
                <div class="text-4xl font-serif text-munch-accent mb-4">01</div>
                <h3 class="text-xl font-medium mb-2">Harvest</h3>
                <p class="text-sm text-munch-300 font-light">Hand-picked from the deep ponds of Bihar.</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-serif text-munch-accent mb-4">02</div>
                <h3 class="text-xl font-medium mb-2">Sun Dry</h3>
                <p class="text-sm text-munch-300 font-light">Naturally dried under the sun for perfect texture.</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-serif text-munch-accent mb-4">03</div>
                <h3 class="text-xl font-medium mb-2">Slow Roast</h3>
                <p class="text-sm text-munch-300 font-light">Slow roasted in small batches, never fried.</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-serif text-munch-accent mb-4">04</div>
                <h3 class="text-xl font-medium mb-2">Season</h3>
                <p class="text-sm text-munch-300 font-light">Tossed in our proprietary gourmet spice blends.</p>
            </div>
        </div>
    </div>
</section>

<!-- 10. Flavor Spotlight -->
<section class="py-0 flex flex-col md:flex-row">
    <div class="md:w-1/2 bg-red-900 text-white p-16 md:p-24 flex flex-col justify-center items-start">
        <span class="uppercase tracking-widest text-sm font-bold text-red-300 mb-4">Spotlight</span>
        <h2 class="text-5xl font-serif mb-6">Fiery Peri Peri</h2>
        <p class="text-lg font-light leading-relaxed mb-8 text-red-100">A vibrant blend of African bird's eye chili, garlic, and citrus. For those who like their crunch with a kick.</p>
        <a href="{{ route('products.index') }}" class="bg-white text-red-900 px-8 py-3 font-medium hover:bg-transparent hover:text-white border border-white transition-all">Taste The Heat</a>
    </div>
    <div class="md:w-1/2 bg-red-800 min-h-[400px]">
        <!-- Image bg here -->
    </div>
</section>

<!-- 11. Build A Box Promo -->
<section class="py-24 bg-munch-100">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-4xl font-serif text-munch-900 mb-6">Can't Decide? Have It All.</h2>
        <p class="text-lg text-munch-700 mb-10">Curate your own custom box of 3, 6, or 9 flavors. The perfect gift for yourself or a loved one.</p>
        <a href="{{ route('build-a-box') }}" class="inline-block bg-munch-900 text-white px-10 py-4 font-medium text-lg hover:bg-munch-accent transition-colors shadow-lg">Start Building</a>
    </div>
</section>

<!-- 12. Reviews -->
<section class="py-24 bg-white" x-data="{ active: 0 }">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-serif text-munch-900 mb-16">What Our Community Says</h2>
        
        <div class="relative min-h-[200px]">
            @php
                $dummyReviews = [
                    ['text'=>"The Truffle flavor is absolutely insane. It feels like I'm eating at a Michelin star restaurant while sitting on my couch.", 'author'=>"Priya M.", 'rating'=>5],
                    ['text'=>"Finally a healthy snack that actually tastes good. I've completely replaced my evening potato chips with MunchGud.", 'author'=>"Rahul K.", 'rating'=>5],
                    ['text'=>"The packaging is beautiful and the makhana is perfectly crisp. My kids love the Cream & Onion flavor.", 'author'=>"Anita D.", 'rating'=>5],
                ];
            @endphp
            
            @foreach($dummyReviews as $index => $review)
            <div x-show="active === {{ $index }}" x-transition.opacity class="absolute inset-0 flex flex-col items-center justify-center">
                <div class="flex text-munch-accent mb-6">
                    @for($i=0; $i<$review['rating']; $i++)
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-2xl font-serif text-munch-900 italic mb-6 leading-relaxed">"{{ $review['text'] }}"</p>
                <span class="text-munch-600 font-medium uppercase tracking-widest text-sm">— {{ $review['author'] }}</span>
            </div>
            @endforeach
        </div>
        
        <div class="flex justify-center space-x-3 mt-12">
            @foreach($dummyReviews as $index => $review)
                <button @click="active = {{ $index }}" class="w-3 h-3 rounded-full transition-colors" :class="active === {{ $index }} ? 'bg-munch-900' : 'bg-munch-200'"></button>
            @endforeach
        </div>
    </div>
</section>

<!-- 13. Sustainability -->
<section class="py-24 bg-munch-950 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 relative z-10">
        <div>
            <h2 class="text-4xl font-serif mb-6">Rooted In Responsibility</h2>
            <p class="text-munch-300 text-lg font-light leading-relaxed mb-8">We work directly with the farmers in Bihar, ensuring fair wages and sustainable harvesting practices that protect the delicate pond ecosystems where lotus seeds grow.</p>
            <div class="grid grid-cols-2 gap-8">
                <div>
                    <h4 class="text-xl font-medium mb-2 text-munch-accent">Direct Trade</h4>
                    <p class="text-munch-400 text-sm">No middlemen. Better income for farmers.</p>
                </div>
                <div>
                    <h4 class="text-xl font-medium mb-2 text-munch-accent">Eco-Packaging</h4>
                    <p class="text-munch-400 text-sm">Working towards 100% recyclable materials.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 14. Instagram Shop -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center mb-12">
        <h2 class="text-3xl font-serif text-munch-900 mb-2">@MunchGud</h2>
        <p class="text-munch-600">Join the community. Tag us to be featured.</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-1">
        @for($i=0; $i<4; $i++)
            <div class="aspect-square bg-munch-100 group relative cursor-pointer overflow-hidden">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-10">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </div>
            </div>
        @endfor
    </div>
</section>

<!-- 15. FAQ -->
<section class="py-24 bg-munch-cream">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-3xl font-serif text-munch-900 text-center mb-12">Frequently Asked Questions</h2>
        <div class="space-y-4" x-data="{ selected: null }">
            <div class="border border-munch-300 bg-white">
                <button @click="selected !== 1 ? selected = 1 : selected = null" class="w-full text-left px-6 py-4 flex justify-between items-center text-munch-900 font-medium">
                    Are these fried or roasted?
                    <svg class="w-5 h-5 transition-transform" :class="selected === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="selected === 1" x-collapse class="px-6 pb-4 text-munch-600 font-light">
                    Our makhana is slow-roasted in small batches using premium olive oil. They are never fried, making them a much healthier alternative to potato chips.
                </div>
            </div>
            <div class="border border-munch-300 bg-white">
                <button @click="selected !== 2 ? selected = 2 : selected = null" class="w-full text-left px-6 py-4 flex justify-between items-center text-munch-900 font-medium">
                    Are your products vegan?
                    <svg class="w-5 h-5 transition-transform" :class="selected === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="selected === 2" x-collapse class="px-6 pb-4 text-munch-600 font-light">
                    Most of our flavors are 100% vegan. Please check the ingredients list on individual product pages for specific dietary information.
                </div>
            </div>
            <div class="border border-munch-300 bg-white">
                <button @click="selected !== 3 ? selected = 3 : selected = null" class="w-full text-left px-6 py-4 flex justify-between items-center text-munch-900 font-medium">
                    What is the shelf life?
                    <svg class="w-5 h-5 transition-transform" :class="selected === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="selected === 3" x-collapse class="px-6 pb-4 text-munch-600 font-light">
                    Our airtight packaging ensures freshness for up to 6 months from the date of manufacture when stored in a cool, dry place.
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
