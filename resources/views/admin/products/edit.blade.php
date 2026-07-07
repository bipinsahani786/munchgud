@extends('admin.layouts.app')

@section('title', 'Edit: ' . $product->name)
@section('header', 'Products')

@section('content')
<!-- Back + Title -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.products.index') }}" class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">{{ $product->name }}</h1>
            <p class="text-xs text-gray-500 font-medium mt-1">Manage product details, images, and variants.</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View in Store
        </a>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-6">
        
        <form action="{{ route('admin.products.update', $product) }}" method="POST" id="product-form">
            @csrf
            @method('PATCH')
            <div class="space-y-6">
                <!-- Basic Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Basic Information</h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Product Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition" required>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Category <span class="text-red-500">*</span></label>
                                <select name="category_id" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Short Description</label>
                            <textarea name="short_description" rows="2" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition resize-none" placeholder="A brief summary for product cards">{{ old('short_description', $product->short_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Detailed Description -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Product Specifications</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Full Description</label>
                            <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition resize-y">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Ingredients</label>
                                <textarea name="ingredients" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition resize-none" placeholder="Comma-separated list or paragraphs">{{ old('ingredients', $product->ingredients) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Nutritional Info</label>
                                <textarea name="nutritional_info" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition resize-none" placeholder="Details about calories, macros, etc.">{{ old('nutritional_info', $product->nutritional_info) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-5 py-3 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">SEO Metadata</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Meta Description</label>
                            <textarea name="meta_description" rows="2" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition resize-none">{{ old('meta_description', $product->meta_description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Tags (Comma-separated)</label>
                            <input type="text" name="tags" value="{{ old('tags', is_array($product->tags) ? implode(', ', $product->tags) : $product->tags) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition" placeholder="healthy, snack, organic">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Variants (SKUs) Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Variants / SKUs</h2>
                </div>
                <!-- Create SKU Button triggers modal/form below -->
                <button type="button" onclick="document.getElementById('add-sku-form').classList.toggle('hidden')" class="px-3 py-1.5 bg-gray-900 text-white text-xs font-semibold rounded-lg hover:bg-gray-800 transition">
                    + Add Variant
                </button>
            </div>
            
            <!-- Add SKU Form (Hidden by default) -->
            <div id="add-sku-form" class="hidden p-5 border-b border-gray-100 bg-gray-50">
                <form action="{{ route('admin.products.skus.store', $product) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">SKU Code</label>
                            <input type="text" name="sku_code" required placeholder="e.g. FOX-NUT-100G" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none uppercase placeholder:normal-case">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">Variant Details</label>
                            <input type="text" name="name" placeholder="e.g. 100g Pack" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">MRP (₹)</label>
                            <input type="number" step="0.01" name="mrp" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">Sale Price (₹)</label>
                            <input type="number" step="0.01" name="sale_price" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">Stock Qty</label>
                            <input type="number" name="stock_qty" required value="10" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                        </div>
                        <div class="col-span-2 sm:col-span-1 pt-6">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_default" value="1" class="sr-only peer">
                                <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-emerald-600"></div>
                                <span class="ml-2 text-xs font-semibold text-gray-700">Default SKU</span>
                            </label>
                        </div>
                        <div class="col-span-2 sm:col-span-2 flex items-end justify-end">
                            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition">Save Variant</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="p-0">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">SKU Details</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">MRP</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Sale Price</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Stock</th>
                            <th class="px-5 py-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($product->skus as $sku)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-gray-900">{{ $sku->sku_code }}</span>
                                    @if($sku->is_default)
                                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full">Default</span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500 mt-1">{{ $sku->name }}</div>
                            </td>
                            <td class="px-5 py-4 text-right text-gray-500 line-through">₹{{ $sku->mrp }}</td>
                            <td class="px-5 py-4 text-right font-bold text-gray-900">₹{{ $sku->sale_price }}</td>
                            <td class="px-5 py-4 text-right">
                                <span class="px-2 py-1 rounded-lg text-xs font-semibold {{ $sku->stock_qty <= $sku->low_stock_threshold ? 'bg-red-50 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $sku->stock_qty }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right flex justify-end gap-1">
                                <button type="button" onclick="document.getElementById('edit-sku-form-{{ $sku->id }}').classList.toggle('hidden')" class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition" title="Edit Variant">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('admin.products.skus.destroy', $sku) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this SKU?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition" title="Delete Variant">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Form Row -->
                        <tr id="edit-sku-form-{{ $sku->id }}" class="hidden bg-gray-50 border-b border-gray-100">
                            <td colspan="5" class="px-5 py-4">
                                <form action="{{ route('admin.products.skus.update', $sku) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 items-end">
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">MRP (₹)</label>
                                            <input type="number" step="0.01" name="mrp" value="{{ $sku->mrp }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">Sale Price (₹)</label>
                                            <input type="number" step="0.01" name="sale_price" value="{{ $sku->sale_price }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wide mb-1.5">Stock Qty</label>
                                            <input type="number" name="stock_qty" value="{{ $sku->stock_qty }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-xs font-semibold rounded-lg hover:bg-emerald-700 transition">Update</button>
                                            <button type="button" onclick="document.getElementById('edit-sku-form-{{ $sku->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg hover:bg-gray-300 transition">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center">
                                <p class="text-sm text-gray-400 font-medium">No variants added yet. Your product needs at least one SKU to be purchasable.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Organization & Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Status & Visibility</h2>
            </div>
            <div class="p-5 space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900">Active</p>
                        <p class="text-xs text-gray-500">Visible on storefront</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <!-- We use form="product-form" here so it submits with the main patch request above -->
                        <input type="hidden" name="is_active" value="0" form="product-form">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" form="product-form" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900">Featured</p>
                        <p class="text-xs text-gray-500">Show in featured sections</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="is_featured" value="0" form="product-form">
                        <input type="checkbox" name="is_featured" value="1" class="sr-only peer" form="product-form" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </label>
                </div>

                <button type="submit" form="product-form" class="w-full mt-4 px-5 py-3 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition shadow-sm">
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Tax & Payment -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Tax & Payment</h2>
            </div>
            <div class="p-5 space-y-5">
                <!-- Tax Type -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Tax Type</label>
                    <div class="flex gap-3">
                        <label class="flex-1 border rounded-lg px-4 py-3 flex items-center gap-2 cursor-pointer has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 transition">
                            <input type="radio" name="tax_type" value="inclusive" form="product-form" {{ old('tax_type', $product->tax_type ?? 'inclusive') === 'inclusive' ? 'checked' : '' }} class="text-emerald-600 focus:ring-emerald-500">
                            <div>
                                <span class="text-sm font-bold text-gray-900">Inclusive</span>
                                <p class="text-[10px] text-gray-500">Price includes GST</p>
                            </div>
                        </label>
                        <label class="flex-1 border rounded-lg px-4 py-3 flex items-center gap-2 cursor-pointer has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 transition">
                            <input type="radio" name="tax_type" value="exclusive" form="product-form" {{ old('tax_type', $product->tax_type ?? 'inclusive') === 'exclusive' ? 'checked' : '' }} class="text-emerald-600 focus:ring-emerald-500">
                            <div>
                                <span class="text-sm font-bold text-gray-900">Exclusive</span>
                                <p class="text-[10px] text-gray-500">GST added extra</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- GST % -->
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">GST Rate (%)</label>
                    <input type="number" step="0.01" name="gst_percent" form="product-form" value="{{ old('gst_percent', $product->gst_percent) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" placeholder="Leave blank to use default ({{ settings('gst_percent', 18) }}%)">
                    <p class="text-[10px] text-gray-400 mt-1">Default: {{ settings('gst_percent', 18) }}% (from Settings)</p>
                </div>

                <!-- COD Allowed -->
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900">COD Allowed</p>
                        <p class="text-xs text-gray-500">Cash on Delivery</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="cod_allowed" value="0" form="product-form">
                        <input type="checkbox" name="cod_allowed" value="1" class="sr-only peer" form="product-form" {{ old('cod_allowed', $product->cod_allowed ?? true) ? 'checked' : '' }}>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-emerald-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Product Gallery</h2>
            </div>
            <div class="p-5">
                <!-- Image Grid -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    @forelse($product->images as $image)
                        <div class="relative group rounded-xl overflow-hidden aspect-square border border-gray-200 shadow-sm hover:shadow-md transition-all">
                            <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" onerror="this.src='https://placehold.co/400x400/f3f4f6/a1a1aa?text=Image+Missing'">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            @if($image->is_primary)
                                <span class="absolute top-3 left-3 bg-emerald-500 text-white text-[10px] font-bold px-2 py-1 rounded shadow-sm flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Primary
                                </span>
                            @endif
                            
                            <!-- Actions -->
                            <div class="absolute top-3 right-3 flex flex-col gap-2">
                                <form action="{{ route('admin.products.images.delete', $image) }}" method="POST" class="m-0" onsubmit="return confirm('Delete this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-lg border border-red-700" title="Delete Image">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>

                                @if(!$image->is_primary)
                                    <form action="{{ route('admin.products.images.primary', $image) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 bg-white text-gray-900 rounded-lg hover:bg-gray-100 transition shadow-lg border border-gray-200" title="Set as Primary">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 flex flex-col items-center justify-center py-10 px-4 bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl text-gray-400">
                            <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 mb-1">No images yet</h3>
                            <p class="text-xs font-medium text-center max-w-xs">Upload high-quality images to showcase your product.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Drag & Drop Uploader -->
                <form action="{{ route('admin.products.images.upload', $product) }}" method="POST" enctype="multipart/form-data" id="upload-form">
                    @csrf
                    <div class="relative border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 hover:border-emerald-500 transition-colors group cursor-pointer" id="drop-zone" onclick="document.getElementById('file-input').click()">
                        <input type="file" name="image" id="file-input" accept="image/png, image/jpeg, image/webp" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer hidden" onchange="document.getElementById('upload-form').submit()">
                        <div class="px-6 py-8 flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900">Click to upload or drag and drop</h3>
                            <p class="text-[11px] font-medium text-gray-500 mt-1">SVG, PNG, JPG or WEBP (Max 2MB)</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple drag and drop visual feedback
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-emerald-500', 'bg-emerald-50');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-emerald-500', 'bg-emerald-50');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        
        if(files.length) {
            fileInput.files = files;
            document.getElementById('upload-form').submit();
        }
    }
</script>
@endsection
