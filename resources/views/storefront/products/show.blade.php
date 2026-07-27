@extends('storefront.layout')

@section('title', $product->name . ' | MunchGud')
@section('meta_description', Str::limit(strip_tags($product->short_description ?? $product->description), 155))

@section('structured_data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ Str::limit(strip_tags($product->short_description ?? $product->description), 200) }}",
    "image": "{{ $product->primaryImage ? Storage::url($product->primaryImage->path) : asset('images/product_shot_new.png') }}",
    "brand": {
        "@@type": "Brand",
        "name": "MunchGud"
    },
    "url": "{{ url()->current() }}",
    @if($product->skus->count() > 0)
    "offers": {
        "@@type": "AggregateOffer",
        "priceCurrency": "INR",
        "lowPrice": "{{ $product->skus->min('sale_price') ?? $product->skus->min('price') }}",
        "highPrice": "{{ $product->skus->max('price') }}",
        "offerCount": "{{ $product->skus->count() }}",
        "availability": "https://schema.org/InStock"
    }
    @endif
    @if($product->reviews && $product->reviews->count() > 0)
    ,"aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ round($product->reviews->avg('rating'), 1) }}",
        "reviewCount": "{{ $product->reviews->count() }}"
    }
    @endif
}
</script>
@endsection

@section('content')
<div class="pt-24 pb-20 bg-mg-cream grain min-h-screen" x-data="productPage()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-semibold tracking-wide text-mg-muted mb-8 uppercase">
            <a href="/" class="hover:text-mg-green transition">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-mg-green transition">Shop</a>
            <span>/</span>
            <span class="text-mg-dark">{{ $product->name }}</span>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 mb-24">
            <!-- Image Gallery -->
            <div class="space-y-4 relative w-full overflow-hidden">
                <div class="aspect-[4/5] sm:aspect-square bg-white rounded-[2rem] sm:rounded-[2.5rem] border border-mg-dark/5 flex items-center justify-center overflow-hidden relative group cursor-crosshair"
                     x-data="{ zoom: false, x: 50, y: 50 }"
                     @mouseenter="zoom = true"
                     @mouseleave="zoom = false"
                     @mousemove="
                         let rect = $el.getBoundingClientRect();
                         x = (($event.clientX - rect.left) / rect.width) * 100;
                         y = (($event.clientY - rect.top) / rect.height) * 100;
                     ">
                    
                    <img :src="currentImage" 
                         class="w-full h-full object-contain transition-transform duration-200 pointer-events-none"
                         :style="zoom ? `transform: scale(2); transform-origin: ${x}% ${y}%;` : 'transform: scale(1); transform-origin: center center;'"
                         alt="{{ $product->name }}">
                    
                    <template x-if="discount > 0">
                        <span class="absolute top-4 left-4 sm:top-6 sm:left-6 bg-mg-orange text-white text-[10px] sm:text-xs font-bold px-3 py-1 sm:px-4 sm:py-1.5 rounded-full uppercase tracking-wider shadow-sm z-10" x-text="`-${discount}% OFF`" x-show="!zoom"></span>
                    </template>
                    @if($product->secondary_badge_text)
                    <style>
                    @keyframes floatBadge {
                        0% { transform: translateY(0px); }
                        50% { transform: translateY(-6px); }
                        100% { transform: translateY(0px); }
                    }
                    </style>
                    <span class="absolute top-4 right-4 sm:top-6 sm:right-6 bg-mg-green text-white text-[10px] sm:text-xs font-bold px-3 py-1 sm:px-4 sm:py-1.5 rounded-full uppercase tracking-wider shadow-sm z-10" style="animation: floatBadge 3s ease-in-out infinite;" x-show="!zoom">
                        {{ $product->secondary_badge_text }}
                    </span>
                    @endif

                </div>
                
                @if($product->images->count() > 1)
                <div class="flex gap-3 sm:gap-4 overflow-x-auto snap-x pb-2 scrollbar-hide py-2 px-1">
                    @foreach($product->images->sortBy('sort_order') as $index => $img)
                    <button @click="currentImageIndex = {{ $index }}" 
                            class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 flex-shrink-0 snap-start bg-white rounded-xl sm:rounded-2xl border-2 transition-all overflow-hidden" 
                            :class="currentImageIndex === {{ $index }} ? 'border-mg-green scale-[1.02] shadow-md' : 'border-mg-dark/5 opacity-70 hover:opacity-100 hover:border-mg-green/50'">
                        <img src="{{ Storage::url($img->path) }}" alt="{{ $product->name }} gallery thumbnail" class="w-full h-full object-contain p-1 sm:p-2">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Details -->
            <div class="flex flex-col">
                <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-black text-mg-dark mb-3 lg:mb-4 leading-tight">{{ $product->name }}</h1>
                
                @php
                    $rating = $product->average_rating;
                    $reviewsCount = $product->review_count;
                @endphp
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex items-center text-mg-gold text-sm gap-1">
                        @for($r=1; $r<=5; $r++)
                            <span class="{{ $r <= round($rating) ? 'text-mg-gold' : 'text-mg-dark/10' }}">★</span>
                        @endfor
                    </div>
                    <a href="#reviews" class="text-sm font-semibold text-mg-green hover:underline">{{ $reviewsCount }} Reviews</a>
                </div>

                <div class="mb-6">
                    <div class="flex items-end gap-3 mb-2">
                        <span class="font-mono text-3xl font-black text-mg-dark" x-text="`₹${price}`"></span>
                        <span class="font-mono text-lg text-mg-muted line-through mb-1" x-show="mrp > price" x-text="`₹${mrp}`"></span>
                    </div>
                    <div class="text-xs text-mg-muted font-medium mb-3">
                        @if(($product->tax_type ?? 'inclusive') === 'inclusive')
                            (Inclusive of all taxes)
                        @else
                            + {{ $product->gst_percent ?? settings('gst_percent', 18) }}% GST extra
                        @endif
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-3">
                        @if(($product->cod_allowed ?? true) && settings('cod_enabled', '1') == '1')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold border border-green-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                Cash on Delivery Available
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold border border-red-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                No Cash on Delivery
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Pincode Checker -->
                <div class="bg-white border border-mg-dark/10 rounded-2xl p-4 sm:p-5 mb-8 shadow-sm" x-data="{
                    pincode: '', 
                    loading: false, 
                    result: null, 
                    error: null,
                    checkPincode() {
                        if(this.pincode.length !== 6) return;
                        this.loading = true;
                        this.result = null;
                        this.error = null;
                        fetch('/api/check-pincode', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                            body: JSON.stringify({ pincode: this.pincode, product_id: {{ $product->id }} })
                        })
                        .then(r => r.json())
                        .then(res => {
                            this.loading = false;
                            if(res.deliverable) {
                                this.result = res;
                            } else {
                                this.error = 'Sorry, we do not deliver to this pincode.';
                            }
                        })
                        .catch(err => {
                            this.loading = false;
                            this.error = 'Something went wrong. Try again.';
                        });
                    }
                }">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        <h4 class="text-sm font-bold text-mg-dark uppercase tracking-wide">Check Delivery & Estimated Time</h4>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" x-model="pincode" maxlength="6" @keyup.enter="checkPincode()" placeholder="Enter 6-digit Pincode" class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none font-mono">
                        <button @click="checkPincode()" :disabled="pincode.length !== 6 || loading" class="bg-mg-dark text-white px-5 py-2.5 rounded-xl text-sm font-bold disabled:opacity-50 transition hover:bg-mg-green flex items-center gap-2 min-w-[90px] justify-center">
                            <span x-show="!loading">Check</span>
                            <svg x-show="loading" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </button>
                    </div>
                    
                    <div x-show="result" x-collapse class="mt-4 pt-4 border-t border-gray-100" style="display: none;">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-mg-dark">Delivery is available</p>
                                <p class="text-xs text-mg-muted mt-0.5">Estimated delivery in <strong x-text="result.delivery_days" class="text-mg-green"></strong> days</p>
                                <template x-if="result.cod_available && {{ ($product->cod_allowed ?? true) ? 'true' : 'false' }}">
                                    <p class="text-[11px] font-bold text-blue-600 mt-1.5 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Cash on Delivery is available here</p>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div x-show="error" x-collapse class="mt-4 pt-4 border-t border-gray-100" style="display: none;">
                        <div class="flex items-center gap-2 text-red-600 text-sm font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span x-text="error"></span>
                        </div>
                    </div>
                </div>

                @if($product->short_description)
                <div class="text-mg-dark/80 text-base sm:text-lg font-medium leading-relaxed mb-6">{{ $product->short_description }}</div>
                @endif

                <!-- Variants -->
                <div class="space-y-6 mb-10">
                    @foreach($variantTypes as $typeName => $options)
                    <div>
                        <h4 class="text-sm font-bold text-mg-dark uppercase tracking-wider mb-3">{{ $typeName }}</h4>
                        <div class="flex flex-wrap gap-3">
                            @foreach($options->unique('id') as $opt)
                            <button @click="selectOption({{ $opt->variant_type_id }}, {{ $opt->id }})" 
                                    class="px-5 py-2.5 rounded-xl text-sm font-semibold border-2 transition-all"
                                    :class="selectedOptions[{{ $opt->variant_type_id }}] === {{ $opt->id }} ? 'border-mg-green bg-mg-green/5 text-mg-green' : 'border-mg-dark/10 text-mg-dark hover:border-mg-green/50'">
                                {{ $opt->value }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Add to Cart -->
                <form @submit.prevent="window.addToCart(currentSkuId, qty, $refs.btn)" class="space-y-4 mb-8">
                    <div class="flex flex-wrap sm:flex-nowrap gap-3 sm:gap-4">
                        <div class="flex items-center bg-white border border-mg-dark/10 rounded-2xl px-3 py-2 w-[110px] sm:w-32 justify-between shrink-0 h-[56px]">
                            <button type="button" @click="qty > 1 ? qty-- : null" class="text-mg-muted hover:text-mg-dark p-2 text-xl leading-none">-</button>
                            <input type="number" x-model="qty" class="w-10 text-center font-bold text-mg-dark bg-transparent border-none focus:ring-0 p-0 text-lg" min="1" :max="stock">
                            <button type="button" @click="qty < stock ? qty++ : null" class="text-mg-muted hover:text-mg-dark p-2 text-xl leading-none">+</button>
                        </div>
                        
                        <button type="submit" x-ref="btn" :disabled="!currentSkuId || stock < 1" class="flex-1 min-w-[180px] h-[56px] bg-mg-green text-white font-bold text-base sm:text-lg rounded-2xl flex items-center justify-center gap-2 hover:bg-mg-green-dark transition-all disabled:opacity-50 disabled:cursor-not-allowed shadow-xl shadow-mg-green/20">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke-linecap="round" stroke-linejoin="round"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0" stroke-linecap="round"/></svg>
                            <span x-text="stock > 0 ? 'Add to Cart' : 'Out of Stock'"></span>
                        </button>

                        <button type="button" @click="toggleWishlist" :disabled="!currentSkuId" class="w-[56px] h-[56px] border border-mg-dark/10 rounded-2xl flex items-center justify-center hover:bg-mg-cream hover:border-mg-dark/30 transition-all group shrink-0 disabled:opacity-50 disabled:cursor-not-allowed bg-white sm:bg-transparent">
                            <svg class="w-6 h-6 transition-all" 
                                 :class="inWishlist ? 'fill-mg-orange text-mg-orange scale-110' : 'text-mg-dark group-hover:text-mg-orange group-hover:scale-110'" 
                                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Product Details Accordion -->
                <div class="space-y-3">
                    @if($product->description)
                    <div x-data="{ open: true }" class="border border-mg-dark/10 rounded-2xl overflow-hidden bg-white/60 backdrop-blur-sm transition-all duration-300" :class="open ? 'shadow-md bg-white' : 'hover:bg-white'">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-5 sm:px-6 py-4 outline-none">
                            <span class="font-bold text-mg-dark text-[15px] sm:text-base">Product Description</span>
                            <div class="w-8 h-8 rounded-full bg-mg-green/5 flex items-center justify-center text-mg-green transition-transform duration-300" :class="open ? 'rotate-180 bg-mg-green/10' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>
                        <div x-show="open" x-collapse>
                            <div class="px-5 sm:px-6 pb-6 pt-1 text-mg-dark/70 text-sm sm:text-[15px] leading-relaxed">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($product->ingredients)
                    <div x-data="{ open: false }" class="border border-mg-dark/10 rounded-2xl overflow-hidden bg-white/60 backdrop-blur-sm transition-all duration-300" :class="open ? 'shadow-md bg-white' : 'hover:bg-white'">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-5 sm:px-6 py-4 outline-none">
                            <span class="font-bold text-mg-dark text-[15px] sm:text-base">Ingredients</span>
                            <div class="w-8 h-8 rounded-full bg-mg-green/5 flex items-center justify-center text-mg-green transition-transform duration-300" :class="open ? 'rotate-180 bg-mg-green/10' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>
                        <div x-show="open" x-collapse>
                            <div class="px-5 sm:px-6 pb-6 pt-1 text-mg-dark/70 text-sm sm:text-[15px] leading-relaxed">
                                {!! nl2br(e($product->ingredients)) !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($product->nutritional_info)
                    <div x-data="{ open: false }" class="border border-mg-dark/10 rounded-2xl overflow-hidden bg-white/60 backdrop-blur-sm transition-all duration-300" :class="open ? 'shadow-md bg-white' : 'hover:bg-white'">
                        <button @click="open = !open" class="w-full flex items-center justify-between px-5 sm:px-6 py-4 outline-none">
                            <span class="font-bold text-mg-dark text-[15px] sm:text-base">Nutritional Information</span>
                            <div class="w-8 h-8 rounded-full bg-mg-green/5 flex items-center justify-center text-mg-green transition-transform duration-300" :class="open ? 'rotate-180 bg-mg-green/10' : ''">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>
                        <div x-show="open" x-collapse>
                            <div class="px-5 sm:px-6 pb-6 pt-1 text-mg-dark/70 text-sm sm:text-[15px] leading-relaxed">
                                {!! nl2br(e($product->nutritional_info)) !!}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div class="mt-24 mb-16">
            <h2 class="font-heading text-3xl font-black text-mg-dark mb-8">You Might Also Like</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $rp)
                @php
                    $sku = $rp->skus->first();
                    $price = $sku ? $sku->sale_price : 0;
                    $mrp = $sku ? $sku->mrp : 0;
                    $discount = $mrp > 0 ? round((1 - $price / $mrp) * 100) : 0;
                @endphp
                <div class="group bg-white rounded-3xl border border-mg-dark/[0.04] overflow-hidden hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <a href="{{ route('products.show', $rp->slug) }}" class="relative aspect-square bg-gradient-to-br from-mg-cream to-white flex items-center justify-center overflow-hidden block">
                        <img src="{{ $rp->primaryImage ? Storage::url($rp->primaryImage->path) : (\App\Models\Setting::get('default_product_image') ? Storage::url(\App\Models\Setting::get('default_product_image')) : asset('images/product_shot_new.png')) }}" alt="{{ $rp->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                    <div class="p-5">
                        <a href="{{ route('products.show', $rp->slug) }}"><h4 class="font-heading text-[17px] font-bold text-mg-dark mb-2 leading-snug">{{ $rp->name }}</h4></a>
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-lg font-bold text-mg-dark">₹{{ $price }}</span>
                            @if($mrp > $price)
                            <span class="font-mono text-sm text-mg-muted line-through">₹{{ $mrp }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Reviews Section -->
        <div id="reviews" class="mt-16 bg-white rounded-[2.5rem] p-8 lg:p-12 border border-mg-dark/5">
            <h2 class="font-heading text-3xl font-black text-mg-dark mb-8">Customer Reviews</h2>
            <div class="grid lg:grid-cols-3 gap-12">
                <div class="lg:col-span-1 space-y-6">
                    <div class="flex items-center gap-4">
                        <span class="font-heading text-5xl font-black text-mg-dark">{{ number_format($rating, 1) }}</span>
                        <div>
                            <div class="text-mg-gold text-lg mb-1">
                                @for($r=1; $r<=5; $r++)
                                    <span class="{{ $r <= round($rating) ? 'text-mg-gold' : 'text-mg-dark/10' }}">★</span>
                                @endfor
                            </div>
                            <p class="text-sm text-mg-muted font-semibold">Based on {{ $reviewsCount }} reviews</p>
                        </div>
                    </div>
                    
                    @auth
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="bg-mg-cream rounded-2xl p-6 mt-8">
                            @csrf
                            <h4 class="font-bold text-mg-dark mb-4">Write a Review</h4>
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-2">Rating</label>
                                <select name="rating" class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2 text-sm focus:ring-mg-green">
                                    <option value="5">5 Stars - Excellent</option>
                                    <option value="4">4 Stars - Very Good</option>
                                    <option value="3">3 Stars - Average</option>
                                    <option value="2">2 Stars - Poor</option>
                                    <option value="1">1 Star - Terrible</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-2">Title</label>
                                <input type="text" name="title" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2 text-sm focus:ring-mg-green">
                            </div>
                            <div class="mb-4">
                                <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-2">Review</label>
                                <textarea name="body" rows="3" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2 text-sm focus:ring-mg-green"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-mg-dark text-white font-bold py-2.5 rounded-xl hover:bg-mg-green transition">Submit Review</button>
                        </form>
                    @else
                        <div class="bg-mg-cream rounded-2xl p-6 mt-8 text-center">
                            <p class="text-mg-dark mb-4 text-sm">Please login to write a review.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-mg-dark text-white font-bold py-2 px-6 rounded-xl hover:bg-mg-green transition">Login</a>
                        </div>
                    @endauth
                </div>
                
                <div class="lg:col-span-2 space-y-6">
                    @forelse($product->reviews()->approved()->latest()->take(10)->get() as $review)
                    @php
                        $reviewerName = $review->name ?? $review->user->name ?? 'Verified Buyer';
                        $initial = strtoupper(substr($reviewerName, 0, 1));
                    @endphp
                    <div class="border-b border-mg-dark/5 pb-8 last:border-0 pt-4">
                        <div class="flex items-start gap-4 mb-3">
                            <div class="w-12 h-12 rounded-full bg-mg-green/10 text-mg-green flex items-center justify-center font-bold text-lg shrink-0">
                                {{ $initial }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-mg-dark text-[15px]">{{ $reviewerName }}</span>
                                    <span class="bg-mg-green/10 text-mg-green text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        Verified
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="flex text-mg-gold text-[13px]">
                                        @for($r=1; $r<=5; $r++)
                                            <span class="{{ $r <= $review->rating ? 'text-mg-gold' : 'text-mg-dark/10' }}">★</span>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-mg-muted font-medium">{{ $review->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                        @if($review->title)
                        <h4 class="font-bold text-mg-dark text-[15px] mb-1.5 ml-16">{{ $review->title }}</h4>
                        @endif
                        <p class="text-[14px] text-mg-dark/80 ml-16 leading-relaxed">{{ $review->body }}</p>
                    </div>
                    @empty
                    <div class="text-center py-12 text-mg-muted">
                        No reviews yet. Be the first to review this product!
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('productPage', () => ({
        skus: @json($skuMatrix),
        selectedOptions: @json($defaultSku ? $defaultSku->variantOptions->pluck('id', 'variant_type_id') : (object)[]),
        currentSkuId: {{ $defaultSku ? $defaultSku->id : 'null' }},
        price: {{ $defaultSku ? $defaultSku->sale_price : 0 }},
        mrp: {{ $defaultSku ? $defaultSku->mrp : 0 }},
        stock: {{ $defaultSku ? $defaultSku->stock_qty : 0 }},
        qty: 1,
        
        images: [
            @if($product->images->count() > 0)
                @foreach($product->images->sortBy('sort_order') as $img)
                    '{{ Storage::url($img->path) }}',
                @endforeach
            @else
                '{{ \App\Models\Setting::get('default_product_image') ? Storage::url(\App\Models\Setting::get('default_product_image')) : asset('images/product_shot_new.png') }}'
            @endif
        ],
        currentImageIndex: 0,
        
        wishlistSkus: @json($wishlistSkus),
        
        get currentImage() {
            return this.images[this.currentImageIndex] || this.images[0];
        },
        
        nextImage() {
            if(this.images.length > 1) {
                this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
            }
        },
        
        prevImage() {
            if(this.images.length > 1) {
                this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
            }
        },

        get discount() {
            return this.mrp > 0 ? Math.round((1 - this.price / this.mrp) * 100) : 0;
        },

        get inWishlist() {
            return this.currentSkuId && this.wishlistSkus.includes(this.currentSkuId);
        },

        async toggleWishlist() {
            if (!this.currentSkuId) return;
            
            try {
                const res = await fetch(`/account/wishlist/${this.currentSkuId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });
                
                if (res.status === 401) {
                    window.location.href = '/login';
                    return;
                }
                
                const data = await res.json();
                if (data.success) {
                    if (data.status === 'added') {
                        this.wishlistSkus.push(this.currentSkuId);
                    } else {
                        this.wishlistSkus = this.wishlistSkus.filter(id => id !== this.currentSkuId);
                    }
                    window.dispatchEvent(new CustomEvent('wishlist-updated', { detail: { count: data.count } }));
                    window.dispatchEvent(new CustomEvent('toast', { detail: { 
                        message: data.status === 'added' ? 'Added to Wishlist' : 'Removed from Wishlist',
                        icon: data.status === 'added' ? 'success' : 'removed'
                    }}));
                }
            } catch (e) {
                console.error(e);
            }
        },

        selectOption(typeId, optId) {
            this.selectedOptions[typeId] = optId;
            this.updateSku();
        },

        updateSku() {
            const match = this.skus.find(s => {
                return Object.values(this.selectedOptions).every(optId => s.options.includes(optId));
            });
            if (match) {
                this.currentSkuId = match.id;
                this.price = match.price;
                this.mrp = match.mrp;
                this.stock = match.stock;
                if(this.qty > this.stock) this.qty = this.stock || 1;
            } else {
                this.currentSkuId = null;
                this.stock = 0;
            }
        }
    }));
});
</script>
@endsection
