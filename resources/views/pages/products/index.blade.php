@extends('components.layout.app')

@section('title', 'Shop - MunchGud')

@section('content')
<div class="bg-munch-cream min-h-screen pb-24">
    <!-- Header Banner -->
    <div class="bg-munch-900 py-16 text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-serif mb-4">Shop The Collection</h1>
        <p class="text-munch-300 font-light max-w-2xl mx-auto">From savory classics to sweet indulgences, find your perfect crunch.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white p-6 border border-munch-200 premium-shadow sticky top-24">
                <h3 class="text-lg font-serif text-munch-900 mb-6 border-b border-munch-100 pb-2">Filters</h3>
                
                <form action="{{ route('products.index') }}" method="GET">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    
                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="font-medium text-munch-900 mb-3 text-sm uppercase tracking-wider">Category</h4>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="text-munch-accent focus:ring-munch-accent" onchange="this.form.submit()">
                                <span class="text-munch-700 text-sm">All Products</span>
                            </label>
                            @foreach($categories as $category)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="category" value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'checked' : '' }} class="text-munch-accent focus:ring-munch-accent" onchange="this.form.submit()">
                                <span class="text-munch-700 text-sm">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <h4 class="font-medium text-munch-900 mb-3 text-sm uppercase tracking-wider">Sort By</h4>
                        <select name="sort" class="w-full border-munch-200 text-sm focus:border-munch-accent focus:ring-0 p-2 border" onchange="this.form.submit()">
                            <option value="">Latest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} class="text-munch-accent focus:ring-munch-accent" onchange="this.form.submit()">
                            <span class="text-munch-700 text-sm">In Stock Only</span>
                        </label>
                    </div>

                    @if(request()->anyFilled(['category', 'sort', 'in_stock', 'search']))
                        <a href="{{ route('products.index') }}" class="text-sm text-munch-accent underline">Clear Filters</a>
                    @endif
                </form>
            </div>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
            @if(request('search'))
                <p class="mb-6 text-munch-600">Showing results for "{{ request('search') }}"</p>
            @endif

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="group bg-white p-4 premium-shadow border border-transparent hover:border-munch-200 transition-all duration-300">
                            <a href="{{ route('products.show', $product->slug) }}" class="block relative aspect-[4/5] mb-4 overflow-hidden bg-munch-50">
                                @if($product->primaryImage)
                                    <img src="{{ Storage::url($product->primaryImage->path) }}" alt="{{ $product->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-munch-300">No Image</div>
                                @endif
                                
                                @if($product->skus->first() && $product->skus->first()->stock_qty <= 0)
                                    <div class="absolute top-2 right-2 bg-black text-white text-xs font-bold px-2 py-1 uppercase tracking-wider">Out of Stock</div>
                                @endif
                            </a>
                            
                            <div class="text-center">
                                <h3 class="text-lg font-serif text-munch-900 mb-1"><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h3>
                                <p class="text-munch-500 text-sm mb-3">{{ $product->category->name ?? '' }}</p>
                                
                                @if($product->skus->first())
                                    <p class="font-medium text-munch-900">
                                        ₹{{ $product->skus->first()->sale_price }}
                                        @if($product->skus->first()->mrp > $product->skus->first()->sale_price)
                                            <span class="text-gray-400 line-through text-sm ml-2">₹{{ $product->skus->first()->mrp }}</span>
                                        @endif
                                    </p>
                                @endif
                                
                                @if($product->skus->first() && $product->skus->first()->stock_qty > 0)
                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="sku_id" value="{{ $product->skus->first()->id }}">
                                        <button type="submit" class="w-full bg-munch-900 text-white py-2 font-medium hover:bg-munch-accent transition-colors text-sm uppercase tracking-widest">Add to Cart</button>
                                    </form>
                                @else
                                    <button disabled class="w-full bg-gray-200 text-gray-500 py-2 font-medium mt-4 text-sm uppercase tracking-widest cursor-not-allowed">Sold Out</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white p-12 text-center border border-munch-200">
                    <h3 class="text-2xl font-serif text-munch-900 mb-2">No products found</h3>
                    <p class="text-munch-600 mb-6">Try adjusting your filters or search criteria.</p>
                    <a href="{{ route('products.index') }}" class="bg-munch-900 text-white px-6 py-2">View All Products</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
