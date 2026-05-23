@extends('storefront.account.layout')

@section('account_content')
<div class="flex items-center justify-between mb-8">
    <h2 class="font-heading text-3xl font-bold text-mg-dark">My Wishlist</h2>
    <span class="text-sm font-semibold text-mg-muted bg-white px-4 py-1.5 rounded-full border border-mg-dark/5 shadow-sm">
        {{ $wishlists->count() }} {{ Str::plural('item', $wishlists->count()) }}
    </span>
</div>

@if($wishlists->isEmpty())
    <div class="bg-white rounded-3xl p-12 text-center border border-mg-dark/5 shadow-xl shadow-mg-dark/5">
        <div class="w-20 h-20 bg-mg-orange/10 text-mg-orange rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </div>
        <h3 class="font-heading text-xl font-bold text-mg-dark mb-2">Your wishlist is empty</h3>
        <p class="text-sm text-mg-muted max-w-sm mx-auto mb-8">Explore our healthy snacks and roasted makhanas to add items to your wishlist and save them for later!</p>
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-mg-green text-white font-bold px-8 py-3 rounded-full hover:bg-mg-green-dark transition shadow-lg shadow-mg-green/20">
            <span>Browse Products</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
@else
    <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($wishlists as $item)
            @if($item->sku && $item->sku->product)
                <div class="bg-white rounded-3xl overflow-hidden border border-mg-dark/5 shadow-xl shadow-mg-dark/5 flex flex-col group hover:shadow-2xl hover:border-mg-green/10 transition-all duration-300">
                    
                    <!-- Product Image & Badge -->
                    <div class="relative aspect-square bg-mg-cream overflow-hidden">
                        <a href="{{ route('products.show', $item->sku->product->slug) }}" class="block w-full h-full">
                            @if($item->sku->product->primaryImage)
                                <img src="{{ Storage::url($item->sku->product->primaryImage->path) }}" alt="{{ $item->sku->product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="{{ asset('images/product_shot.png') }}" alt="{{ $item->sku->product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </a>
                        
                        <!-- Quick remove button in top right -->
                        <form action="{{ route('account.wishlist.toggle', $item->sku->id) }}" method="POST" class="absolute top-4 right-4 z-10">
                            @csrf
                            <button type="submit" class="w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm text-red-500 flex items-center justify-center shadow-md hover:bg-red-500 hover:text-white transition-all duration-200" title="Remove from Wishlist">
                                <svg class="w-4.5 h-4.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Details -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-1.5">
                                <span class="text-[10px] font-bold text-mg-green uppercase bg-mg-green/5 px-2 py-0.5 rounded-md">
                                    {{ $item->sku->product->category->name ?? 'Snack' }}
                                </span>
                                @if($item->sku->stock_qty <= 0)
                                    <span class="text-[10px] font-bold text-red-600 uppercase bg-red-50 px-2 py-0.5 rounded-md">
                                        Out of stock
                                    </span>
                                @elseif($item->sku->stock_qty <= 5)
                                    <span class="text-[10px] font-bold text-mg-orange uppercase bg-mg-orange/5 px-2 py-0.5 rounded-md">
                                        Only {{ $item->sku->stock_qty }} Left
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="font-heading text-lg font-bold text-mg-dark mb-1 leading-tight group-hover:text-mg-green transition">
                                <a href="{{ route('products.show', $item->sku->product->slug) }}">
                                    {{ $item->sku->product->name }}
                                </a>
                            </h3>

                            <!-- SKU Option details -->
                            <p class="text-xs text-mg-muted mb-3 font-medium">
                                {{ $item->sku->variantOptions->pluck('value')->implode(' / ') }}
                            </p>

                            <!-- Pricing -->
                            <div class="flex items-baseline gap-2 mb-4">
                                <span class="text-xl font-extrabold text-mg-dark">₹{{ $item->sku->sale_price }}</span>
                                @if($item->sku->mrp > $item->sku->sale_price)
                                    <span class="text-xs text-mg-muted line-through font-semibold">₹{{ $item->sku->mrp }}</span>
                                    <span class="text-xs text-mg-green font-bold">
                                        ({{ round((($item->sku->mrp - $item->sku->sale_price) / $item->sku->mrp) * 100) }}% OFF)
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-2 pt-4 border-t border-mg-dark/5">
                            @if($item->sku->stock_qty > 0)
                                <form action="{{ route('account.wishlist.moveToCart', $item->sku->id) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full bg-mg-green text-white font-bold text-xs uppercase tracking-wider py-3 px-4 rounded-xl hover:bg-mg-green-dark transition shadow-md shadow-mg-green/5 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        Move to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full bg-mg-dark/5 text-mg-muted font-bold text-xs uppercase tracking-wider py-3 px-4 rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                    Out Of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif
@endsection
