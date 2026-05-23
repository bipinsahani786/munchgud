@extends('admin.layouts.app')

@section('title', 'Inventory Management')
@section('header', 'Inventory')

@section('content')
<div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Inventory Management</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Manage stock levels for all your product variants.</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.inventory.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <label class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm cursor-pointer inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Import CSV
                <input type="file" name="file" class="hidden" onchange="this.form.submit()">
            </label>
        </form>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 p-4 mb-6">
    <form action="{{ route('admin.inventory.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by SKU code, name, or product..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
        </div>
        <div class="w-full sm:w-48">
            <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" onchange="this.form.submit()">
                <option value="">All Stock Status</option>
                <option value="low_stock" {{ request('status') === 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                <option value="out_of_stock" {{ request('status') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
            </select>
        </div>
        <button type="submit" class="px-5 py-2 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition text-sm">Filter</button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.inventory.index') }}" class="px-5 py-2 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm flex items-center justify-center">Clear</a>
        @endif
    </form>
</div>

<!-- Data Table -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden" x-data="{ editingId: null }">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">SKU Details</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Product</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Price</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 w-48">Stock Level</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($skus as $sku)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900 text-sm">{{ $sku->sku_code }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">{{ $sku->sku_name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                                @if($sku->product->primaryImage)
                                    <img src="{{ Storage::url($sku->product->primaryImage->path) }}" class="w-8 h-8 rounded-lg object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-lg">🥜</div>
                                @endif
                                <a href="{{ route('admin.products.edit', $sku->product) }}" class="hover:text-emerald-600 transition">{{ $sku->product->name }}</a>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">₹{{ number_format($sku->sale_price, 2) }}</div>
                            @if($sku->mrp > $sku->sale_price)
                                <div class="text-xs text-gray-400 line-through">₹{{ number_format($sku->mrp, 2) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div x-show="editingId !== {{ $sku->id }}" class="flex items-center gap-3">
                                <span class="font-bold text-lg {{ $sku->stock_qty === 0 ? 'text-red-600' : ($sku->stock_qty <= config('munchgud.low_stock_threshold', 10) ? 'text-amber-500' : 'text-emerald-600') }}">
                                    {{ $sku->stock_qty }}
                                </span>
                                @if($sku->stock_qty === 0)
                                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-red-50 text-red-700 border border-red-100 rounded">Out of Stock</span>
                                @elseif($sku->stock_qty <= config('munchgud.low_stock_threshold', 10))
                                    <span class="px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-100 rounded">Low</span>
                                @endif
                            </div>
                            
                            <!-- Inline Edit Form -->
                            <form x-cloak x-show="editingId === {{ $sku->id }}" action="{{ route('admin.inventory.update', $sku) }}" method="POST" class="flex items-center gap-2" @click.away="editingId = null">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="stock_qty" value="{{ $sku->stock_qty }}" min="0" class="w-20 border border-gray-300 rounded px-2 py-1 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                                <button type="submit" class="p-1.5 bg-emerald-100 text-emerald-700 hover:bg-emerald-200 rounded transition" title="Save">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                <button type="button" @click="editingId = null" class="p-1.5 bg-gray-100 text-gray-500 hover:bg-gray-200 rounded transition" title="Cancel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button @click="editingId = {{ $sku->id }}" x-show="editingId !== {{ $sku->id }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-50 border border-gray-200 text-gray-600 text-xs font-semibold rounded-lg hover:bg-white hover:text-emerald-600 hover:border-emerald-200 transition shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Adjust
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No inventory records found</h3>
                                <p class="text-gray-500 text-sm font-medium">Add products to populate your inventory.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($skus->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $skus->links() }}
        </div>
    @endif
</div>
@endsection
