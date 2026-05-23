@extends('storefront.layout')

@section('title', 'Build A Box - MunchGud')

@section('content')
<div class="bg-mg-cream min-h-screen pb-24" x-data="{
    selectedItems: [],
    maxItems: 4,
    addItem(id) {
        if (this.selectedItems.length < this.maxItems) {
            this.selectedItems.push(id);
        }
    },
    removeItem(id) {
        const index = this.selectedItems.indexOf(id);
        if (index > -1) {
            this.selectedItems.splice(index, 1);
        }
    },
    countItem(id) {
        return this.selectedItems.filter(itemId => itemId === id).length;
    }
}">
    <!-- Header Section (No gap at top) -->
    <div class="bg-mg-green-dark text-white py-20 lg:py-28 px-4 text-center mb-16 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-mg-leaf/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-mg-green/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="relative z-10 max-w-3xl mx-auto reveal">
            <span class="inline-block bg-white/10 text-white font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full mb-6">Custom Pack</span>
            <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-black mb-6">Build Your Custom Box</h1>
            <p class="text-white/60 text-lg max-w-2xl mx-auto mb-10">Select any 4 flavors to curate your perfect snacking experience and save 15%.</p>
            
            <!-- Progress Bar -->
            <div class="max-w-lg mx-auto bg-white/5 backdrop-blur-sm border border-white/10 p-5 rounded-3xl">
                <div class="flex justify-between text-xs font-bold uppercase tracking-wider mb-3 text-white/60">
                    <span>Selected: <span x-text="selectedItems.length" class="text-white text-sm"></span> / 4</span>
                    <span x-text="selectedItems.length === 4 ? 'Ready to Checkout!' : 'Keep adding flavors'" :class="selectedItems.length === 4 ? 'text-mg-leaf' : ''"></span>
                </div>
                <div class="h-3 bg-white/10 rounded-full overflow-hidden flex">
                    <div class="h-full bg-mg-leaf transition-all duration-500 ease-out relative" :style="'width: ' + (selectedItems.length * 25) + '%'">
                        <div class="absolute inset-0 bg-white/20 w-full" style="animation: pulse-dot 2s infinite"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Sticky Action Bar when ready -->
        <div x-show="selectedItems.length === 4" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="sticky top-24 z-40 bg-white p-4 sm:p-6 rounded-3xl border border-mg-dark/5 shadow-2xl shadow-mg-green/10 mb-10 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-mg-green/10 text-mg-green rounded-full flex items-center justify-center text-xl">🎉</div>
                <div>
                    <h3 class="font-heading text-xl font-bold text-mg-dark mb-0.5">Custom Box Complete</h3>
                    <p class="text-sm text-mg-green font-bold">15% Discount Applied</p>
                </div>
            </div>
            <form @submit.prevent="
                    $refs.btn.classList.add('opacity-75', 'pointer-events-none');
                    fetch('{{ route('build-a-box.add') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ skus: selectedItems })
                    }).then(r => r.json()).then(data => {
                        if(data.success) {
                            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.summary.items_count } }));
                            window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Custom Box Added to Cart', icon: 'success' } }));
                            selectedItems = [];
                        } else {
                            let msg = data.message || 'Could not add to cart';
                            if(data.errors) msg = Object.values(data.errors)[0][0];
                            window.dispatchEvent(new CustomEvent('toast', { detail: { message: msg, icon: 'removed' } }));
                        }
                    }).catch(e => {
                        window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'An error occurred', icon: 'removed' } }));
                    }).finally(() => {
                        $refs.btn.classList.remove('opacity-75', 'pointer-events-none');
                    })
                " class="w-full sm:w-auto">
                <button type="submit" x-ref="btn" class="w-full sm:w-auto bg-mg-green text-white px-8 py-3.5 font-bold rounded-full hover:bg-mg-green-dark hover:scale-105 active:scale-95 transition-all shadow-lg shadow-mg-green/30">
                    Add to Cart &rarr;
                </button>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8 reveal">
            @foreach($skus as $sku)
                <div class="bg-white rounded-3xl border transition-all duration-300 overflow-hidden relative group"
                     :class="countItem({{ $sku->id }}) > 0 ? 'border-mg-green shadow-xl shadow-mg-green/10 scale-[1.02] z-10' : 'border-mg-dark/5 shadow-sm hover:shadow-lg hover:-translate-y-1'">
                    
                    <!-- Badge -->
                    <div x-show="countItem({{ $sku->id }}) > 0" x-cloak 
                         class="absolute top-4 right-4 w-8 h-8 bg-mg-green text-white rounded-full flex items-center justify-center font-bold z-20 shadow-lg"
                         x-transition.scale>
                        <span x-text="countItem({{ $sku->id }})"></span>
                    </div>

                    <!-- Image -->
                    <div class="aspect-square bg-mg-cream relative overflow-hidden group-hover:bg-mg-cream/50 transition-colors">
                        @php
                            $imgUrl = $sku->product->primaryImage ? Storage::url($sku->product->primaryImage->path) : asset('images/product_shot.png');
                        @endphp
                        <img src="{{ $imgUrl }}" onerror="this.src='{{ asset('images/product_shot.png') }}'" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5 text-center">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-mg-muted mb-1.5">{{ $sku->variantOptions->pluck('value')->implode(' / ') ?: 'Standard' }}</p>
                        <h3 class="font-heading font-bold text-lg text-mg-dark line-clamp-1 mb-2">{{ $sku->product->name }}</h3>
                        <p class="font-mono text-lg font-black text-mg-dark mb-5">₹{{ $sku->sale_price }}</p>
                        
                        <!-- Interactive Actions -->
                        <div class="flex items-center justify-center gap-3">
                            <button type="button" @click.stop="removeItem({{ $sku->id }})" 
                                    class="w-10 h-10 rounded-full border border-mg-dark/10 flex items-center justify-center text-mg-dark hover:bg-mg-cream hover:border-mg-dark/30 transition-all disabled:opacity-30 disabled:cursor-not-allowed"
                                    :disabled="countItem({{ $sku->id }}) === 0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                            </button>
                            
                            <button type="button" @click.stop="addItem({{ $sku->id }})" 
                                    class="flex-1 h-10 rounded-full bg-mg-cream text-mg-dark font-bold text-sm hover:bg-mg-green hover:text-white transition-all disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-mg-cream disabled:hover:text-mg-dark"
                                    :disabled="selectedItems.length >= maxItems">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
