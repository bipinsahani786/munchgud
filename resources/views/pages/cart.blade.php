@extends('storefront.layout')

@section('title', 'Your Cart - MunchGud')

@section('content')
<div class="bg-mg-cream min-h-screen pt-8 pb-20" x-data="cartPage()" x-init="init()">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs text-mg-muted mb-6">
            <a href="/" class="hover:text-mg-green transition">Home</a>
            <span>/</span>
            <span class="text-mg-dark font-medium">Shopping Cart</span>
        </div>

        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl lg:text-4xl font-serif font-bold text-mg-dark">Shopping Cart</h1>
                <p class="text-sm text-mg-muted mt-1" x-show="cartItems.length > 0">
                    <span x-text="totalQty"></span> item(s) in your cart
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-mg-green hover:text-mg-green-dark transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                Continue Shopping
            </a>
        </div>

        <!-- Cart Content -->
        <template x-if="cartItems.length > 0">
            <div class="flex flex-col lg:flex-row gap-8 xl:gap-10">
                
                <!-- Left Column: Cart Items -->
                <div class="w-full lg:w-[62%] space-y-4">

                    <!-- Free Shipping Progress -->
                    <div class="bg-white rounded-2xl p-5 border border-mg-dark/5 shadow-sm">
                        <template x-if="shipping > 0">
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5 text-mg-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25m-2.25 0h-2.735a2.014 2.014 0 00-1.55.767L3 13.5m8.25-4.5V6.75a3.375 3.375 0 00-3.375-3.375h-.057c-1.88 0-3.62.98-4.593 2.587L.768 11.836"/></svg>
                                    <p class="text-sm font-bold text-mg-dark">
                                        Add <span class="text-mg-orange" x-text="'₹' + Math.max(0, freeShippingThreshold - Math.max(0, subtotal - discount)).toFixed(0)"></span> more for <span class="text-mg-green font-extrabold">FREE delivery!</span>
                                    </p>
                                </div>
                                <div class="w-full bg-mg-dark/5 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-mg-orange to-mg-green h-full rounded-full transition-all duration-700" 
                                         :style="'width:' + Math.min(100, (Math.max(0, subtotal - discount) / freeShippingThreshold) * 100) + '%'"></div>
                                </div>
                            </div>
                        </template>
                        <template x-if="shipping === 0 && subtotal > 0">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-mg-green/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                </div>
                                <p class="text-sm font-bold text-mg-green">🎉 You've unlocked FREE delivery!</p>
                            </div>
                        </template>
                    </div>

                    <!-- Cart Items List -->
                    <div class="bg-white rounded-2xl border border-mg-dark/5 shadow-sm overflow-hidden">
                        <template x-for="(item, idx) in cartItems" :key="item.id">
                            <div class="p-5 sm:p-6 border-b border-mg-dark/5 last:border-b-0 transition-all duration-300"
                                 :class="item.removing ? 'opacity-0 -translate-x-8 max-h-0 py-0 overflow-hidden' : 'opacity-100 translate-x-0'">
                                <div class="flex gap-4 sm:gap-5">
                                    <!-- Product Image -->
                                    <a :href="'/products/' + item.slug" class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-mg-cream overflow-hidden flex-shrink-0 border border-mg-dark/5 group">
                                        <img :src="item.image" :alt="item.name" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.src='/images/product_shot.png'">
                                    </a>
                                    
                                    <!-- Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-3">
                                            <div class="min-w-0">
                                                <span class="text-[10px] font-bold text-mg-green uppercase bg-mg-green/5 px-2 py-0.5 rounded-md" x-text="item.category"></span>
                                                <h3 class="font-heading text-base sm:text-lg font-bold text-mg-dark mt-1 leading-tight">
                                                    <a :href="'/products/' + item.slug" class="hover:text-mg-green transition" x-text="item.name"></a>
                                                </h3>
                                                <p class="text-xs text-mg-muted mt-0.5 font-medium" x-show="item.variant" x-text="item.variant"></p>
                                            </div>
                                            <!-- Action Buttons -->
                                            <div class="flex items-center gap-1 flex-shrink-0">
                                                <button @click="moveToWishlist(item)" class="p-2 rounded-xl text-mg-muted hover:text-red-400 hover:bg-red-50 transition-all" title="Move to Wishlist">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>
                                                </button>
                                                <button @click="removeItem(item)" class="p-2 rounded-xl text-mg-muted hover:text-red-500 hover:bg-red-50 transition-all" title="Remove">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Stock Status -->
                                        <div class="mt-2">
                                            <template x-if="item.stock <= 0">
                                                <span class="text-[10px] font-bold text-red-600 uppercase bg-red-50 px-2 py-0.5 rounded-md">Out of Stock</span>
                                            </template>
                                            <template x-if="item.stock > 0 && item.stock <= 5">
                                                <span class="text-[10px] font-bold text-mg-orange uppercase bg-mg-orange/5 px-2 py-0.5 rounded-md" x-text="'Only ' + item.stock + ' left!'"></span>
                                            </template>
                                            <template x-if="item.stock > 5">
                                                <span class="text-[10px] font-bold text-mg-green uppercase bg-mg-green/5 px-2 py-0.5 rounded-md">In Stock</span>
                                            </template>
                                        </div>

                                        <!-- Price + Qty Row -->
                                        <div class="flex flex-wrap sm:flex-nowrap items-center sm:items-end justify-between mt-3 gap-3">
                                            <!-- Pricing -->
                                            <div>
                                                <div class="flex items-baseline gap-1.5">
                                                    <span class="text-lg font-extrabold text-mg-dark" x-text="'₹' + (item.price * item.qty).toFixed(2)"></span>
                                                </div>
                                                <template x-if="item.mrp > item.price">
                                                    <div class="flex items-center gap-1.5 mt-0.5">
                                                        <span class="text-[11px] text-mg-muted line-through" x-text="'₹' + (item.mrp * item.qty).toFixed(2)"></span>
                                                        <span class="text-[10px] font-bold text-mg-green" x-text="'(' + Math.round((1 - item.price/item.mrp)*100) + '% OFF)'"></span>
                                                    </div>
                                                </template>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center bg-mg-cream rounded-xl border border-mg-dark/10 overflow-hidden">
                                                <button @click="updateQty(item, item.qty - 1)" 
                                                        class="w-9 h-9 flex items-center justify-center text-mg-dark hover:bg-mg-green hover:text-white transition-colors"
                                                        :disabled="item.updating"
                                                        :class="item.qty <= 1 ? 'text-red-400 hover:bg-red-500' : ''">
                                                    <svg x-show="item.qty > 1" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M5 12h14"/></svg>
                                                    <svg x-show="item.qty <= 1" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                                </button>
                                                <span class="w-10 h-9 flex items-center justify-center text-sm font-bold text-mg-dark border-x border-mg-dark/10 bg-white" x-text="item.qty"></span>
                                                <button @click="updateQty(item, item.qty + 1)" 
                                                        class="w-9 h-9 flex items-center justify-center text-mg-dark hover:bg-mg-green hover:text-white transition-colors"
                                                        :disabled="item.updating || item.qty >= item.stock">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 5v14m-7-7h14"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Available Coupons -->
                    @if($coupons->count() > 0)
                    <div class="bg-white rounded-2xl border border-mg-dark/5 shadow-sm p-5 sm:p-6">
                        <h3 class="font-heading text-lg font-bold text-mg-dark mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-mg-orange" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"/></svg>
                            Available Coupons
                        </h3>
                        <div class="space-y-3">
                            @foreach($coupons as $coupon)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 bg-gradient-to-r from-mg-green/[0.03] to-mg-orange/[0.03] rounded-xl border border-dashed border-mg-green/20 p-3 sm:px-4 sm:py-3 group hover:border-mg-green/40 transition">
                                <div class="flex items-center gap-3 w-full sm:w-auto">
                                    <div class="w-10 h-10 bg-mg-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-mg-green font-extrabold text-xs">%</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                                            <span class="font-extrabold text-sm text-mg-dark tracking-wider">{{ $coupon->code }}</span>
                                            <span class="text-[10px] font-bold bg-mg-green/10 text-mg-green px-2 py-0.5 rounded-full whitespace-nowrap">
                                                {{ $coupon->type === 'percent' ? $coupon->value . '% OFF' : '₹' . $coupon->value . ' OFF' }}
                                            </span>
                                        </div>
                                        <p class="text-[11px] text-mg-muted mt-0.5 truncate">
                                            {{ $coupon->description ?? 'Min order ₹' . number_format($coupon->min_order_amount, 0) }}
                                        </p>
                                    </div>
                                </div>
                                <button @click="applyCouponCode('{{ $coupon->code }}')" 
                                        class="w-full sm:w-auto text-xs font-bold text-mg-green border border-mg-green/20 bg-mg-green/[0.04] rounded-lg px-4 py-2 hover:bg-mg-green hover:text-white transition-all flex-shrink-0"
                                        :disabled="appliedCoupon === '{{ $coupon->code }}'"
                                        x-text="appliedCoupon === '{{ $coupon->code }}' ? '✓ Applied' : 'Apply'">
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Sidebar -->
                <div class="w-full lg:w-[38%]">
                    <div class="lg:sticky lg:top-[100px] space-y-4">

                        <!-- Order Summary -->
                        <div class="bg-white rounded-2xl border border-mg-dark/5 shadow-sm p-6">
                            <h3 class="font-heading text-xl font-bold text-mg-dark mb-5 flex items-center gap-2">
                                <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                                Order Summary
                            </h3>
                            
                            <div class="space-y-3 mb-5">
                                <template x-if="itemDiscount > 0">
                                    <div>
                                        <div class="flex justify-between text-sm mb-3">
                                            <span class="text-mg-muted">Total MRP</span>
                                            <span class="font-semibold text-mg-dark line-through" x-text="'₹' + mrpTotal.toFixed(2)"></span>
                                        </div>
                                        <div class="flex justify-between text-sm mb-3">
                                            <span class="text-mg-green">Discount on MRP</span>
                                            <span class="font-semibold text-mg-green" x-text="'-₹' + itemDiscount.toFixed(2)"></span>
                                        </div>
                                    </div>
                                </template>

                                <div class="flex justify-between text-sm">
                                    <span class="text-mg-muted">Subtotal (<span x-text="totalQty"></span> items)</span>
                                    <span class="font-semibold text-mg-dark" x-text="'₹' + subtotal.toFixed(2)"></span>
                                </div>
                                
                                <template x-if="discount > 0">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-mg-green font-medium flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/></svg>
                                            Coupon Discount
                                        </span>
                                        <span class="font-semibold text-mg-green" x-text="'-₹' + discount.toFixed(2)"></span>
                                    </div>
                                </template>

                                <div class="flex justify-between text-sm">
                                    <span class="text-mg-muted">Tax (GST)</span>
                                    <span class="font-semibold text-mg-dark" x-text="'₹' + tax.toFixed(2)"></span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="text-mg-muted">Delivery</span>
                                    <span class="font-semibold" :class="shipping === 0 ? 'text-mg-green' : 'text-mg-dark'" x-text="shipping === 0 ? 'FREE' : '₹' + shipping.toFixed(2)"></span>
                                </div>
                            </div>
                            
                            <!-- Coupon Applied Bar -->
                            <template x-if="appliedCoupon">
                                <div class="flex items-center justify-between bg-mg-green/5 px-4 py-3 rounded-xl border border-mg-green/10 mb-5">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                        <span class="text-sm font-bold text-mg-green" x-text="appliedCoupon"></span>
                                    </div>
                                    <button @click="removeCoupon()" class="text-xs text-red-500 hover:text-red-700 font-bold transition">Remove</button>
                                </div>
                            </template>

                            <!-- Coupon Input -->
                            <template x-if="!appliedCoupon">
                                <div class="flex gap-2 mb-5">
                                    <input type="text" x-model="couponInput" placeholder="Enter coupon code" 
                                           class="flex-1 min-w-0 border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm font-medium focus:border-mg-green focus:ring-1 focus:ring-mg-green/20 outline-none transition bg-mg-cream/50"
                                           @keydown.enter="applyCouponCode(couponInput)">
                                    <button @click="applyCouponCode(couponInput)" 
                                            class="bg-mg-dark text-white font-bold text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl hover:bg-mg-green transition-colors flex-shrink-0"
                                            :disabled="couponLoading">
                                        <span x-show="!couponLoading">Apply</span>
                                        <svg x-show="couponLoading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                    </button>
                                </div>
                            </template>

                            <!-- Total -->
                            <div class="flex justify-between items-center border-t border-mg-dark/5 pt-5 mb-6">
                                <span class="text-lg font-bold text-mg-dark">Total</span>
                                <span class="text-xl sm:text-2xl font-extrabold text-mg-dark font-heading truncate ml-4" x-text="'₹' + total.toFixed(2)"></span>
                            </div>

                            <!-- Savings -->
                            <template x-if="totalSavings > 0">
                                <div class="bg-mg-green/5 rounded-xl px-4 py-2.5 mb-5 flex items-center gap-2">
                                    <span class="text-mg-green text-sm">🎉</span>
                                    <span class="text-sm font-bold text-mg-green">You're saving ₹<span x-text="totalSavings.toFixed(2)"></span> on this order!</span>
                                </div>
                            </template>

                            <a href="{{ route('checkout.index') }}" class="block w-full bg-mg-green text-white text-center py-4 font-bold text-sm uppercase tracking-wider rounded-2xl hover:bg-mg-green-dark transition-all shadow-lg shadow-mg-green/20 hover:shadow-xl hover:shadow-mg-green/30 hover:-translate-y-0.5">
                                Proceed to Checkout
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>

                            <!-- Trust Badges -->
                            <div class="grid grid-cols-3 gap-3 mt-5 pt-5 border-t border-mg-dark/5">
                                <div class="text-center">
                                    <svg class="w-5 h-5 mx-auto text-mg-green mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                                    <p class="text-[10px] font-semibold text-mg-muted">Secure Payment</p>
                                </div>
                                <div class="text-center">
                                    <svg class="w-5 h-5 mx-auto text-mg-green mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25m-2.25 0h-2.735a2.014 2.014 0 00-1.55.767L3 13.5m8.25-4.5V6.75a3.375 3.375 0 00-3.375-3.375h-.057c-1.88 0-3.62.98-4.593 2.587L.768 11.836"/></svg>
                                    <p class="text-[10px] font-semibold text-mg-muted">Fast Delivery</p>
                                </div>
                                <div class="text-center">
                                    <svg class="w-5 h-5 mx-auto text-mg-green mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/></svg>
                                    <p class="text-[10px] font-semibold text-mg-muted">Easy Returns</p>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Check -->
                        <div class="bg-white rounded-2xl border border-mg-dark/5 shadow-sm p-5" 
                             x-data="{ 
                                 pincode: '', deliveryMsg: '', deliveryOk: null, checking: false,
                                 checkDelivery() {
                                     if (this.pincode.length !== 6 || !/^\d{6}$/.test(this.pincode)) {
                                         this.deliveryMsg = 'Please enter a valid 6-digit pincode';
                                         this.deliveryOk = false;
                                         return;
                                     }
                                     this.checking = true;
                                     setTimeout(() => {
                                         this.deliveryOk = true;
                                         this.deliveryMsg = 'Delivery available! Estimated 3-5 business days.';
                                         this.checking = false;
                                     }, 800);
                                 }
                             }">
                            <h4 class="font-bold text-sm text-mg-dark mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                Check Delivery
                            </h4>
                            <div class="flex gap-2">
                                <input type="text" x-model="pincode" placeholder="Enter pincode" maxlength="6" 
                                       class="flex-1 min-w-0 border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm font-medium focus:border-mg-green focus:ring-1 focus:ring-mg-green/20 outline-none transition bg-mg-cream/50"
                                       @keydown.enter="checkDelivery()">
                                <button @click="checkDelivery()" class="bg-mg-dark text-white font-bold text-xs px-4 py-2.5 rounded-xl hover:bg-mg-green transition flex-shrink-0" :disabled="checking">
                                    <span x-show="!checking">Check</span>
                                    <svg x-show="checking" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                </button>
                            </div>
                            <template x-if="deliveryMsg">
                                <div class="mt-3 flex items-center gap-2 text-sm font-medium" :class="deliveryOk ? 'text-mg-green' : 'text-red-500'">
                                    <svg x-show="deliveryOk" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    <svg x-show="!deliveryOk" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                                    <span x-text="deliveryMsg"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Empty Cart -->
        <template x-if="cartItems.length === 0 && !loading">
            <div class="bg-white rounded-3xl p-12 sm:p-16 text-center border border-mg-dark/5 shadow-xl shadow-mg-dark/5 max-w-2xl mx-auto">
                <div class="w-24 h-24 bg-mg-green/10 text-mg-green rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                </div>
                <h2 class="font-heading text-2xl font-bold text-mg-dark mb-3">Your cart is empty</h2>
                <p class="text-sm text-mg-muted max-w-sm mx-auto mb-8">Looks like you haven't added any snacks yet. Explore our premium makhana collection!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-mg-green text-white font-bold px-8 py-3.5 rounded-full hover:bg-mg-green-dark transition shadow-lg shadow-mg-green/20">
                    <span>Start Shopping</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
        </template>

        <!-- Wishlist Section -->
        @auth
        @if($wishlists->count() > 0)
        <div class="mt-16" x-show="cartItems.length > 0 || true">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading text-2xl font-bold text-mg-dark flex items-center gap-2">
                    <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    From Your Wishlist
                </h2>
                <a href="{{ route('account.wishlist') }}" class="text-sm font-semibold text-mg-green hover:text-mg-green-dark transition">View All →</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4" id="wishlistGrid">
                @foreach($wishlists as $wish)
                @if($wish->sku && $wish->sku->product)
                <div class="bg-white rounded-2xl overflow-hidden border border-mg-dark/5 shadow-sm group hover:shadow-xl hover:border-mg-green/10 transition-all duration-300 flex flex-col h-full" id="wishlist-card-{{ $wish->sku->id }}">
                    <a href="{{ route('products.show', $wish->sku->product->slug) }}" class="block aspect-square bg-mg-cream overflow-hidden">
                        <img src="{{ $wish->sku->product->primaryImage ? Storage::url($wish->sku->product->primaryImage->path) : asset('images/product_shot.png') }}" 
                             alt="{{ $wish->sku->product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="p-4 flex flex-col flex-grow">
                        <p class="text-[10px] font-bold text-mg-green uppercase">{{ $wish->sku->product->category->name ?? 'Snack' }}</p>
                        <h4 class="font-heading text-sm font-bold text-mg-dark mt-1 leading-tight line-clamp-1">{{ $wish->sku->product->name }}</h4>
                        <div class="flex items-baseline gap-1.5 mt-1.5">
                            <span class="text-base font-extrabold text-mg-dark">₹{{ $wish->sku->sale_price }}</span>
                            @if($wish->sku->mrp > $wish->sku->sale_price)
                            <span class="text-[11px] text-mg-muted line-through">₹{{ $wish->sku->mrp }}</span>
                            @endif
                        </div>
                        <div class="mt-auto pt-3">
                            @if($wish->sku->stock_qty > 0)
                            <button onclick="moveWishlistToCart({{ $wish->sku->id }}, this)" 
                                    class="w-full bg-mg-green/10 text-mg-green font-bold text-[10px] sm:text-[11px] uppercase tracking-wider py-2 sm:py-2.5 rounded-xl hover:bg-mg-green hover:text-white transition-all flex flex-col xl:flex-row items-center justify-center gap-1 xl:gap-1.5">
                                <svg class="w-4 h-4 sm:w-3.5 sm:h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                <span class="text-center leading-tight">Move to Cart</span>
                            </button>
                            @else
                            <span class="block w-full text-center text-[10px] sm:text-[11px] font-bold text-red-500 uppercase py-2.5">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
        @endauth

        <!-- Recommended Products -->
        @if($recommendedProducts->count() > 0)
        <div class="mt-16">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading text-2xl font-bold text-mg-dark">You May Also Like</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-mg-green hover:text-mg-green-dark transition">View All →</a>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide snap-x snap-mandatory -mx-4 px-4">
                @foreach($recommendedProducts as $rp)
                @php $rpSku = $rp->skus->first(); @endphp
                @if($rpSku)
                <div class="flex-shrink-0 w-[200px] sm:w-[220px] bg-white rounded-2xl overflow-hidden border border-mg-dark/5 shadow-sm group hover:shadow-xl hover:border-mg-green/10 transition-all duration-300 snap-start">
                    <a href="{{ route('products.show', $rp->slug) }}" class="block aspect-square bg-mg-cream overflow-hidden">
                        <img src="{{ $rp->primaryImage ? Storage::url($rp->primaryImage->path) : asset('images/product_shot.png') }}" 
                             alt="{{ $rp->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="p-4">
                        <p class="text-[10px] font-bold text-mg-green uppercase">{{ $rp->category->name ?? 'Snack' }}</p>
                        <h4 class="font-heading text-sm font-bold text-mg-dark mt-1 leading-tight line-clamp-2">{{ $rp->name }}</h4>
                        <div class="flex items-baseline gap-1.5 mt-2">
                            <span class="text-base font-extrabold text-mg-dark">₹{{ $rpSku->sale_price }}</span>
                            @if($rpSku->mrp > $rpSku->sale_price)
                            <span class="text-[11px] text-mg-muted line-through">₹{{ $rpSku->mrp }}</span>
                            @endif
                        </div>
                        <button onclick="window.addToCart({{ $rpSku->id }}, 1, this)" 
                                class="w-full mt-3 bg-mg-green/10 text-mg-green font-bold text-[10px] sm:text-[11px] uppercase tracking-wider py-2 sm:py-2.5 rounded-xl hover:bg-mg-green hover:text-white transition-all flex flex-col xl:flex-row items-center justify-center gap-1 xl:gap-1.5">
                            <svg class="w-4 h-4 sm:w-3.5 sm:h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                            <span class="text-center leading-tight">Add to Cart</span>
                        </button>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

@php
    $cartItemsJson = $summary['items']->map(function($item) {
        return [
            'id' => $item->id,
            'sku_id' => $item->sku->id,
            'name' => $item->sku->product->name,
            'slug' => $item->sku->product->slug,
            'category' => $item->sku->product->category->name ?? 'Snack',
            'image' => $item->sku->product->primaryImage ? Storage::url($item->sku->product->primaryImage->path) : asset('images/product_shot.png'),
            'variant' => $item->sku->variantOptions->pluck('value')->implode(' / '),
            'price' => (float) $item->sku->sale_price,
            'mrp' => (float) $item->sku->mrp,
            'qty' => $item->quantity,
            'stock' => $item->sku->stock_qty,
            'removing' => false,
            'updating' => false
        ];
    })->values();
@endphp
<script>
function cartPage() {
    return {
        loading: false,
        cartItems: @json($cartItemsJson),
        subtotal: {{ $summary['subtotal'] }},
        discount: {{ $summary['discount'] }},
        tax: {{ $summary['tax'] }},
        shipping: {{ $summary['shipping'] }},
        total: {{ $summary['total'] }},
        appliedCoupon: {!! $summary['coupon'] ? "'" . $summary['coupon']->code . "'" : 'null' !!},
        couponInput: '',
        couponLoading: false,
        freeShippingThreshold: {{ settings('free_shipping_threshold', 499) }},

        get totalQty() {
            return this.cartItems.reduce((sum, i) => sum + i.qty, 0);
        },
        get mrpTotal() {
            return this.cartItems.reduce((sum, i) => sum + (i.mrp * i.qty), 0);
        },
        get itemDiscount() {
            return Math.max(0, this.mrpTotal - this.subtotal);
        },
        get totalSavings() {
            return this.itemDiscount + this.discount;
        },

        init() {
            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: this.totalQty } }));
        },

        async updateQty(item, newQty) {
            if (item.updating) return;
            if (newQty <= 0) { this.removeItem(item); return; }
            if (newQty > item.stock) return;
            
            item.updating = true;
            const oldQty = item.qty;
            item.qty = newQty;
            
            try {
                const res = await fetch(`/cart/${item.id}/qty`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ qty: newQty })
                });
                const data = await res.json();
                if (data.success) {
                    this.updateSummary(data.summary);
                } else {
                    item.qty = oldQty;
                }
            } catch(e) {
                item.qty = oldQty;
                console.error(e);
            } finally {
                item.updating = false;
            }
        },

        async removeItem(item) {
            item.removing = true;
            try {
                const res = await fetch(`/cart/${item.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    setTimeout(() => {
                        this.cartItems = this.cartItems.filter(i => i.id !== item.id);
                        this.updateSummary(data.summary);
                        this.toast('Item removed from cart', 'removed');
                    }, 350);
                }
            } catch(e) {
                item.removing = false;
                console.error(e);
            }
        },

        async moveToWishlist(item) {
            item.removing = true;
            try {
                const res = await fetch(`/cart/${item.id}/move-to-wishlist`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    setTimeout(() => {
                        this.cartItems = this.cartItems.filter(i => i.id !== item.id);
                        this.updateSummary(data.summary);
                        this.toast('Moved to wishlist ❤️', 'success');
                        if (data.wishlist_count !== undefined) {
                            window.dispatchEvent(new CustomEvent('wishlist-updated', { detail: { count: data.wishlist_count } }));
                        }
                        // Reload page to update the server-rendered wishlist grid at the bottom
                        setTimeout(() => window.location.reload(), 600);
                    }, 350);
                } else {
                    item.removing = false;
                    this.toast(data.message || 'Could not move to wishlist', 'removed');
                }
            } catch(e) {
                item.removing = false;
                console.error(e);
            }
        },

        async applyCouponCode(code) {
            if (!code || code.trim() === '') return;
            this.couponLoading = true;
            try {
                const res = await fetch('/cart/coupon', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ code: code.trim() })
                });
                const data = await res.json();
                if (data.success) {
                    this.appliedCoupon = code.trim().toUpperCase();
                    this.couponInput = '';
                    if (data.summary) {
                        this.updateSummary(data.summary);
                    }
                    this.toast('Coupon applied! ' + data.message, 'success');
                } else {
                    this.toast(data.message || 'Invalid coupon', 'removed');
                }
            } catch(e) {
                this.toast('Could not apply coupon', 'removed');
                console.error(e);
            } finally {
                this.couponLoading = false;
            }
        },

        async removeCoupon() {
            try {
                const res = await fetch('/cart/coupon', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                if (data.success) {
                    this.appliedCoupon = null;
                    this.updateSummary(data.summary);
                    this.toast('Coupon removed', 'removed');
                }
            } catch(e) {
                console.error(e);
            }
        },



        updateSummary(summary) {
            this.subtotal = summary.subtotal;
            this.discount = summary.discount;
            this.tax = summary.tax;
            this.shipping = summary.shipping;
            this.total = summary.total;
            if (!summary.coupon) this.appliedCoupon = null;
            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: summary.items_count } }));
        },

        toast(message, icon = 'success') {
            window.dispatchEvent(new CustomEvent('toast', { detail: { message, icon } }));
        }
    };
}

async function moveWishlistToCart(skuId, btn) {
    const originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<svg class="w-4 h-4 animate-spin mx-auto" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';
    
    try {
        const res = await fetch(`/account/wishlist/${skuId}/move-to-cart`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        if (data.success) {
            // Animate card out
            const card = document.getElementById('wishlist-card-' + skuId);
            if (card) {
                card.style.transition = 'all 0.4s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8) translateY(-20px)';
                setTimeout(() => card.remove(), 400);
            }
            window.dispatchEvent(new CustomEvent('toast', { detail: { message: 'Moved to cart!', icon: 'success' } }));
            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.summary?.items_count || 0 } }));
            window.dispatchEvent(new CustomEvent('wishlist-updated', { detail: { count: data.wishlist_count || 0 } }));
            // Reload page to update cart items (since Alpine state needs the new item)
            setTimeout(() => window.location.reload(), 600);
        } else {
            btn.innerHTML = originalHTML;
            btn.disabled = false;
        }
    } catch(e) {
        btn.innerHTML = originalHTML;
        btn.disabled = false;
        console.error(e);
    }
}
</script>
@endsection
