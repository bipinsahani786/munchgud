@extends('storefront.layout')

@section('title', 'Shop | MunchGud')

@section('content')
<div class="pt-32 pb-20 bg-mg-cream grain min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="font-heading text-5xl font-black text-mg-dark mb-4">Our <span class="italic text-mg-green">Flavours</span></h1>
                <p class="text-mg-muted text-lg max-w-xl">Explore our premium range of roasted makhana, packed with protein and crunch.</p>
            </div>
            
            <form action="{{ route('products.index') }}" method="GET" class="flex items-center gap-4">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <select name="sort" onchange="this.form.submit()" class="bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm font-semibold text-mg-dark focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                    <option value="">Sort by: Latest</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
                <label class="flex items-center gap-2 text-sm font-semibold text-mg-dark bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 cursor-pointer hover:bg-mg-green/5 transition">
                    <input type="checkbox" name="in_stock" value="1" onchange="this.form.submit()" {{ request('in_stock') ? 'checked' : '' }} class="w-4 h-4 text-mg-green focus:ring-mg-green rounded">
                    In Stock Only
                </label>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-64 flex-shrink-0 space-y-8">
                <div>
                    <h3 class="font-bold text-mg-dark mb-4 text-sm uppercase tracking-wider">Categories</h3>
                    <div class="space-y-2">
                        <a href="{{ route('products.index') }}" class="block text-sm {{ !request('category') ? 'font-bold text-mg-green' : 'text-mg-muted hover:text-mg-dark' }}">All Products</a>
                        @foreach($categories as $cat)
                            <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="block text-sm {{ request('category') === $cat->slug ? 'font-bold text-mg-green' : 'text-mg-muted hover:text-mg-dark' }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>

                <form action="{{ route('products.index') }}" method="GET">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <h3 class="font-bold text-mg-dark mb-4 text-sm uppercase tracking-wider">Price Range</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min ₹" class="w-full bg-white border border-mg-dark/10 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-mg-green">
                        <span class="text-mg-muted">-</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max ₹" class="w-full bg-white border border-mg-dark/10 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-mg-green">
                    </div>
                    <button type="submit" class="w-full bg-mg-dark text-white text-xs font-bold uppercase tracking-wider py-2.5 rounded-lg hover:bg-mg-green transition">Apply Filter</button>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    @forelse($products as $p)
                    @php
                        $sku = $p->skus->first();
                        $price = $sku ? $sku->sale_price : 0;
                        $mrp = $sku ? $sku->mrp : 0;
                        $discount = $mrp > 0 ? round((1 - $price / $mrp) * 100) : 0;
                        $rating = $p->average_rating;
                        $reviewsCount = $p->review_count;
                    @endphp
                    <div class="group bg-white rounded-3xl border border-mg-dark/[0.04] overflow-hidden hover:-translate-y-2 hover:shadow-xl hover:shadow-mg-green/5 transition-all duration-300 flex flex-col h-full">
                        <a href="{{ route('products.show', $p->slug) }}" class="relative aspect-square bg-gradient-to-br from-mg-cream to-white flex items-center justify-center overflow-hidden block">
                            @if($p->primaryImage)
                                <img src="{{ Storage::url($p->primaryImage->path) }}" alt="{{ $p->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="{{ asset('images/product_shot.png') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                            @if($discount > 0)
                                <span class="absolute top-4 left-4 bg-mg-orange text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">-{{ $discount }}% OFF</span>
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
                                class="absolute top-4 right-4 w-9 h-9 backdrop-blur-sm rounded-full flex items-center justify-center transition-all shadow-sm z-10"
                                :class="inWishlist ? 'opacity-100 bg-white text-mg-orange' : 'opacity-0 group-hover:opacity-100 bg-white/80 text-mg-dark hover:bg-mg-cream hover:text-mg-orange'">
                            <svg width="15" height="15" :class="inWishlist ? 'fill-mg-orange' : 'fill-none'" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-[10px] font-semibold text-mg-muted uppercase tracking-[0.15em] mb-1">{{ $p->category->name ?? 'Makhana' }}</p>
                            <a href="{{ route('products.show', $p->slug) }}"><h4 class="font-heading text-[19px] font-bold text-mg-dark mb-1.5 leading-snug">{{ $p->name }}</h4></a>
                            <div class="flex items-center gap-1 mb-3 text-mg-gold text-[13px]">
                                @for($r=1; $r<=5; $r++)
                                    <span class="{{ $r <= round($rating) ? 'text-mg-gold' : 'text-mg-dark/10' }}">★</span>
                                @endfor
                                <span class="text-mg-muted text-[11px] ml-1">({{ $reviewsCount }})</span>
                            </div>
                            <div class="flex items-center gap-2 mb-6 mt-auto">
                                <span class="font-mono text-xl font-bold text-mg-dark">₹{{ $price }}</span>
                                @if($mrp > $price)
                                <span class="font-mono text-sm text-mg-muted line-through">₹{{ $mrp }}</span>
                                @endif
                            </div>
                            <button type="button" x-data @click="window.addToCart({{ $sku ? $sku->id : 0 }}, 1, $event.currentTarget)" 
                                    class="w-full py-3 bg-mg-green/10 text-mg-green hover:bg-mg-green hover:text-white text-sm font-bold rounded-2xl transition-all flex items-center justify-center gap-2">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0" stroke-linecap="round"/></svg>
                                Quick Add
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center">
                        <span class="text-6xl mb-4 block">😢</span>
                        <h3 class="text-2xl font-bold text-mg-dark mb-2">No products found</h3>
                        <p class="text-mg-muted">Try adjusting your filters or search terms.</p>
                        <a href="{{ route('products.index') }}" class="mt-6 inline-block font-bold text-mg-green">Clear all filters</a>
                    </div>
                    @endforelse
                </div>
                
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
