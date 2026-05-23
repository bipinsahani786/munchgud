@extends('components.layout.app')

@section('title', $product->name . ' - MunchGud')
@section('meta_description', Str::limit($product->short_description, 150))

@section('content')
<div class="bg-munch-cream min-h-screen py-12" x-data="productData()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="text-sm font-medium mb-8">
            <ol class="list-none p-0 inline-flex text-munch-500">
                <li class="flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-munch-900">Home</a>
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('products.index') }}" class="hover:text-munch-900">Products</a>
                    <svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </li>
                <li class="text-munch-900">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
            
            <!-- Images -->
            <div class="w-full lg:w-1/2">
                <div class="sticky top-24">
                    <div class="aspect-square bg-white border border-munch-200 overflow-hidden mb-4 relative">
                        <img :src="currentImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($product->images as $image)
                                <button @click="currentImage = '{{ Storage::url($image->path) }}'" 
                                        class="aspect-square bg-white border cursor-pointer hover:border-munch-900 transition-colors"
                                        :class="currentImage === '{{ Storage::url($image->path) }}' ? 'border-munch-900' : 'border-munch-200'">
                                    <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="w-full lg:w-1/2">
                @if($product->is_featured)
                    <span class="bg-munch-accent text-white text-xs font-bold uppercase tracking-wider px-2 py-1 mb-4 inline-block">Featured</span>
                @endif
                <h1 class="text-4xl lg:text-5xl font-serif text-munch-900 mb-2">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex text-munch-accent">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <a href="#reviews" class="text-sm text-munch-600 underline">{{ $product->reviews->count() }} Reviews</a>
                </div>

                <div class="mb-8">
                    <div class="text-3xl text-munch-900 font-medium flex items-center gap-3">
                        <span x-text="'₹' + currentSku.price"></span>
                        <span x-show="currentSku.mrp > currentSku.price" x-text="'₹' + currentSku.mrp" class="text-xl text-gray-400 line-through"></span>
                    </div>
                    <p class="text-sm text-green-600 font-medium mt-1">Inclusive of all taxes</p>
                </div>

                <p class="text-munch-700 leading-relaxed mb-8">{{ $product->short_description }}</p>

                <!-- Variants Selection -->
                @if($variantTypes->count() > 0)
                    <div class="space-y-6 mb-8">
                        @foreach($variantTypes as $typeName => $options)
                            <div>
                                <h4 class="font-medium text-munch-900 mb-3 uppercase tracking-wider text-sm">{{ $typeName }}</h4>
                                <div class="flex flex-wrap gap-3">
                                    @foreach($options->unique('id') as $option)
                                        <button type="button" 
                                                @click="selectOption({{ $option->id }})"
                                                :class="selectedOptions.includes({{ $option->id }}) ? 'border-munch-900 bg-munch-900 text-white' : 'border-munch-300 bg-white text-munch-700 hover:border-munch-500'"
                                                class="border px-4 py-2 text-sm transition-colors min-w-[3rem] text-center">
                                            {{ $option->value }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Add to Cart Form -->
                <div class="bg-white p-6 border border-munch-200 premium-shadow">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sku_id" :value="currentSku.id">
                        
                        <div x-show="currentSku.stock <= 0" x-cloak class="text-red-600 font-medium mb-4">
                            Currently Out of Stock
                        </div>
                        
                        <div class="flex gap-4 mb-4" x-show="currentSku.stock > 0">
                            <div class="flex items-center border border-munch-300">
                                <button type="button" @click="if(qty > 1) qty--" class="px-4 py-3 text-munch-600 hover:bg-munch-50 transition-colors">-</button>
                                <input type="number" name="qty" x-model="qty" min="1" :max="currentSku.stock" class="w-16 text-center border-0 focus:ring-0 text-lg p-0" readonly>
                                <button type="button" @click="if(qty < currentSku.stock) qty++" class="px-4 py-3 text-munch-600 hover:bg-munch-50 transition-colors">+</button>
                            </div>
                            
                            <button type="submit" class="flex-1 bg-munch-900 text-white font-medium hover:bg-munch-accent transition-colors uppercase tracking-widest">
                                Add to Cart
                            </button>
                            
                            <button type="button" @click="toggleWishlist" class="px-4 border border-munch-300 text-munch-900 hover:bg-munch-50 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="inWishlist ? 'fill-munch-accent text-munch-accent' : ''"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </button>
                        </div>
                    </form>

                    <!-- Pincode Checker -->
                    <div class="mt-6 border-t border-munch-100 pt-6" x-data="{ pincode: '', result: null, checking: false }">
                        <h4 class="font-medium text-munch-900 mb-3 text-sm">Check Delivery Availability</h4>
                        <div class="flex gap-2">
                            <input type="text" x-model="pincode" placeholder="Enter Pincode" class="flex-1 border-munch-300 focus:border-munch-900 focus:ring-0 text-sm p-3">
                            <button @click="checkPincode" class="bg-munch-100 text-munch-900 px-4 py-2 font-medium hover:bg-munch-200 transition-colors text-sm" :disabled="checking">
                                <span x-show="!checking">Check</span>
                                <span x-show="checking">...</span>
                            </button>
                        </div>
                        <div x-show="result" x-cloak class="mt-3 text-sm" :class="result.serviceable ? 'text-green-600' : 'text-red-600'">
                            <span x-text="result.serviceable ? 'Delivery available by ' + result.delivery_date : result.message"></span>
                        </div>
                    </div>
                </div>

                <!-- Product Details Accordion -->
                <div class="mt-12 space-y-4" x-data="{ active: 'desc' }">
                    <div class="border-b border-munch-200">
                        <button @click="active = active === 'desc' ? null : 'desc'" class="w-full py-4 flex justify-between items-center text-lg font-serif text-munch-900">
                            Description
                            <svg class="w-5 h-5 transition-transform" :class="active === 'desc' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 'desc'" x-collapse class="pb-6 text-munch-700 leading-relaxed font-light text-sm prose">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                    
                    @if($product->ingredients)
                    <div class="border-b border-munch-200">
                        <button @click="active = active === 'ing' ? null : 'ing'" class="w-full py-4 flex justify-between items-center text-lg font-serif text-munch-900">
                            Ingredients
                            <svg class="w-5 h-5 transition-transform" :class="active === 'ing' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 'ing'" x-collapse class="pb-6 text-munch-700 leading-relaxed font-light text-sm prose">
                            {!! nl2br(e($product->ingredients)) !!}
                        </div>
                    </div>
                    @endif
                    
                    @if($product->nutritional_info)
                    <div class="border-b border-munch-200">
                        <button @click="active = active === 'nut' ? null : 'nut'" class="w-full py-4 flex justify-between items-center text-lg font-serif text-munch-900">
                            Nutritional Info
                            <svg class="w-5 h-5 transition-transform" :class="active === 'nut' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="active === 'nut'" x-collapse class="pb-6 text-munch-700 leading-relaxed font-light text-sm prose">
                            {!! nl2br(e($product->nutritional_info)) !!}
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productData', () => ({
            skus: @json($skuMatrix),
            defaultSkuId: {{ $defaultSku->id ?? 'null' }},
            currentSku: null,
            selectedOptions: [],
            qty: 1,
            currentImage: '{{ $product->primaryImage ? Storage::url($product->primaryImage->path) : '' }}',
            inWishlist: false,

            init() {
                if (this.defaultSkuId) {
                    this.currentSku = this.skus.find(s => s.id === this.defaultSkuId);
                    this.selectedOptions = this.currentSku.options;
                } else if (this.skus.length > 0) {
                    this.currentSku = this.skus[0];
                    this.selectedOptions = this.currentSku.options;
                }
            },

            selectOption(optionId) {
                // Determine which variant type this option belongs to based on server data
                // In a real robust implementation, we map options to their types precisely.
                // For this MVP, we simply overwrite the selected array with the new valid combination.
                // Simplified: Find first SKU that has this option
                let matchingSku = this.skus.find(s => s.options.includes(optionId) && s.is_active);
                if (matchingSku) {
                    this.currentSku = matchingSku;
                    this.selectedOptions = matchingSku.options;
                    this.qty = 1;
                }
            },

            toggleWishlist() {
                // AJAX call to wishlist endpoint
                fetch(`/account/wishlist/${this.currentSku.id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(res => res.json()).then(data => {
                    if(data.success) {
                        this.inWishlist = (data.status === 'added');
                    } else if(data.message === 'Unauthenticated.') {
                        window.location.href = '/login';
                    }
                });
            },

            async checkPincode() {
                if(this.pincode.length !== 6) return;
                this.checking = true;
                try {
                    let res = await fetch(`/pincode-check?pincode=${this.pincode}`);
                    this.result = await res.json();
                } catch(e) {
                    this.result = { serviceable: false, message: 'Error checking pincode' };
                }
                this.checking = false;
            }
        }))
    });
</script>
@endpush
@endsection
