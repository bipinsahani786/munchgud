@extends('storefront.layout')

@section('title', 'Checkout - MunchGud')

@section('content')
<div class="bg-mg-cream min-h-screen pt-8 pb-20">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-10">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs text-mg-muted mb-6">
            <a href="/" class="hover:text-mg-green transition">Home</a>
            <span>/</span>
            <a href="{{ route('cart.index') }}" class="hover:text-mg-green transition">Shopping Cart</a>
            <span>/</span>
            <span class="text-mg-dark font-medium">Checkout</span>
        </div>

        <h1 class="text-3xl lg:text-4xl font-serif font-bold text-mg-dark mb-8">Checkout</h1>
        
        <div class="flex flex-col lg:flex-row gap-8 xl:gap-10">
            
            <!-- Checkout Form -->
            <div class="w-full lg:w-[62%]" x-data="{ selectedAddressId: '{{ $addresses->where('is_default', true)->first()->id ?? ($addresses->first()->id ?? '') }}' }">
                
                <!-- Shipping Address Section (Outside Checkout Form) -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl border border-mg-dark/5 shadow-sm mb-6">
                    <h3 class="font-heading text-xl font-bold text-mg-dark mb-6 pb-4 border-b border-mg-dark/5 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-mg-green/10 text-mg-green flex items-center justify-center text-sm font-extrabold">1</span>
                        Shipping Address
                    </h3>
                    
                    @if($addresses->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            @foreach($addresses as $address)
                                <label class="border rounded-xl p-5 cursor-pointer hover:border-mg-green/40 hover:shadow-md transition-all"
                                       :class="selectedAddressId == '{{ $address->id }}' ? 'border-mg-green bg-mg-green/5 ring-1 ring-mg-green/20' : 'border-mg-dark/10 bg-white'">
                                    <div class="flex items-start gap-3">
                                        <input type="radio" x-model="selectedAddressId" value="{{ $address->id }}" class="mt-1 text-mg-green focus:ring-mg-green w-4 h-4">
                                        <div>
                                            <div class="font-bold text-mg-dark mb-1 flex items-center gap-2">
                                                {{ $address->name }}
                                                @if($address->label)<span class="text-[10px] font-extrabold tracking-wider uppercase bg-mg-dark/5 text-mg-dark px-2 py-0.5 rounded-md">{{ $address->label }}</span>@endif
                                            </div>
                                            <p class="text-sm text-mg-muted line-clamp-2 mb-2 font-medium">{{ $address->line1 }}, {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</p>
                                            <p class="text-sm font-semibold text-mg-dark">{{ $address->phone }}</p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-red-50 text-red-500 p-4 rounded-xl text-sm font-medium border border-red-100 flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Please add a shipping address to proceed.
                        </div>
                    @endif

                    <!-- Add New Address Accordion -->
                    <div x-data="{ showForm: {{ $addresses->count() == 0 ? 'true' : 'false' }} }" class="mt-4 border-t border-mg-dark/5 pt-4">
                        <button type="button" @click="showForm = !showForm" x-show="!showForm" class="text-mg-green font-bold text-sm flex items-center gap-1 hover:text-mg-green-dark transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            Add New Address
                        </button>

                        <div x-show="showForm" x-collapse class="bg-mg-cream/30 border border-mg-dark/5 rounded-xl p-5 mt-2">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-mg-dark text-sm uppercase tracking-wider">New Address</h4>
                                @if($addresses->count() > 0)
                                <button type="button" @click="showForm = false" class="text-mg-muted hover:text-mg-dark"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                                @endif
                            </div>
                            
                            <form method="POST" action="{{ route('account.addresses.store') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">Full Name</label>
                                    <input type="text" name="name" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">Phone Number</label>
                                    <input type="text" name="phone" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">Address Line 1</label>
                                    <input type="text" name="line1" required placeholder="House No., Building, Street" class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">Address Line 2 (Optional)</label>
                                    <input type="text" name="line2" placeholder="Locality, Area, Landmark" class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">Pincode</label>
                                    <input type="text" name="pincode" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">City</label>
                                    <input type="text" name="city" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-mg-muted uppercase tracking-wider mb-1.5">State</label>
                                    <input type="text" name="state" required class="w-full bg-white border border-mg-dark/10 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-mg-green/20 focus:border-mg-green outline-none transition">
                                </div>
                                <input type="hidden" name="country" value="India">
                                <input type="hidden" name="is_default" value="1">
                                <div class="sm:col-span-2 mt-2">
                                    <button type="submit" class="bg-mg-dark text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-mg-green transition w-full sm:w-auto">Save Address</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Checkout Form for Payment & Place Order -->
                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="address_id" :value="selectedAddressId">
                    
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-mg-dark/5 shadow-sm">
                        <h3 class="font-heading text-xl font-bold text-mg-dark mb-6 pb-4 border-b border-mg-dark/5 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-mg-green/10 text-mg-green flex items-center justify-center text-sm font-extrabold">2</span>
                            Payment Method
                        </h3>
                        
                        <div class="space-y-4">
                            <label class="border border-mg-dark/10 rounded-xl p-5 flex items-center gap-4 cursor-pointer hover:border-mg-green/40 hover:shadow-md transition-all bg-white has-[:checked]:border-mg-green has-[:checked]:bg-mg-green/5 has-[:checked]:ring-1 has-[:checked]:ring-mg-green/20">
                                <input type="radio" name="payment_method" value="razorpay" checked class="text-mg-green focus:ring-mg-green w-5 h-5">
                                <div class="flex-1">
                                    <div class="font-bold text-mg-dark">Pay Online</div>
                                    <div class="text-xs font-medium text-mg-muted mt-0.5">Credit Card, UPI, NetBanking (Secure via Razorpay)</div>
                                </div>
                                <div class="flex gap-1 opacity-60">
                                    <svg class="w-8 h-8 text-mg-dark" viewBox="0 0 32 32" fill="currentColor"><path d="M26.8 6.1H5.2C3.4 6.1 2 7.6 2 9.4v13.2c0 1.8 1.4 3.3 3.2 3.3h21.6c1.8 0 3.2-1.5 3.2-3.3V9.4c0-1.8-1.4-3.3-3.2-3.3zM5.2 8.3h21.6c.6 0 1.1.5 1.1 1.1v2.2H4.1V9.4c0-.6.5-1.1 1.1-1.1zm21.6 15.4H5.2c-.6 0-1.1-.5-1.1-1.1v-8.8h23.8v8.8c0 .6-.5 1.1-1.1 1.1z"/><path d="M6.3 19.3h4.3v2.2H6.3zM12.8 19.3h6.5v2.2h-6.5z"/></svg>
                                </div>
                            </label>
                            
                            @if($summary['cod_allowed'] ?? true)
                            <label class="border border-mg-dark/10 rounded-xl p-5 flex items-center gap-4 cursor-pointer hover:border-mg-green/40 hover:shadow-md transition-all bg-white has-[:checked]:border-mg-green has-[:checked]:bg-mg-green/5 has-[:checked]:ring-1 has-[:checked]:ring-mg-green/20">
                                <input type="radio" name="payment_method" value="cod" class="text-mg-green focus:ring-mg-green w-5 h-5">
                                <div class="flex-1">
                                    <div class="font-bold text-mg-dark">Cash on Delivery (COD)</div>
                                    <div class="text-xs font-medium text-mg-muted mt-0.5">Pay when your order arrives.</div>
                                </div>
                                <div class="flex gap-1 opacity-60">
                                    <svg class="w-8 h-8 text-mg-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </label>
                            @else
                            <div class="border border-mg-dark/10 rounded-xl p-5 flex items-center gap-4 bg-gray-50 opacity-60">
                                <input type="radio" disabled class="text-gray-300 w-5 h-5">
                                <div class="flex-1">
                                    <div class="font-bold text-gray-500">Cash on Delivery (COD)</div>
                                    <div class="text-xs font-medium text-red-500 mt-0.5">Not available for some items in your cart.</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class="mt-8">
                            <button type="submit" id="pay-btn" class="w-full bg-mg-green text-white py-4 font-bold rounded-2xl text-sm uppercase tracking-wider hover:bg-mg-green-dark shadow-lg shadow-mg-green/20 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span>Place Order (₹{{ number_format($summary['total'], 2) }})</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Order Summary Sidebar -->
            <div class="w-full lg:w-[38%]">
                <div class="bg-white rounded-2xl border border-mg-dark/5 shadow-sm p-6 lg:sticky lg:top-[100px]">
                    <h3 class="font-heading text-xl font-bold text-mg-dark mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-mg-green" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                        Order Summary
                    </h3>
                    
                    <!-- Items -->
                    <div class="space-y-4 mb-6 max-h-[300px] overflow-y-auto pr-2 scrollbar-hide">
                        @foreach($summary['items'] as $item)
                            <div class="flex gap-4">
                                <div class="relative flex-shrink-0">
                                    <div class="w-16 h-16 rounded-xl bg-mg-cream border border-mg-dark/5 overflow-hidden">
                                        @if($item->sku->product->primaryImage)
                                            <img src="{{ Storage::url($item->sku->product->primaryImage->path) }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('images/product_shot_new.png') }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <span class="absolute -top-2 -right-2 bg-mg-dark text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center ring-2 ring-white">{{ $item->quantity }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-sm text-mg-dark line-clamp-2 leading-tight">{{ $item->sku->product->name }}</div>
                                    <div class="text-[11px] font-medium text-mg-muted mt-0.5">{{ $item->sku->variantOptions->pluck('value')->implode(' / ') }}</div>
                                </div>
                                <div class="font-extrabold text-sm text-mg-dark text-right flex-shrink-0">
                                    ₹{{ number_format($item->sku->sale_price * $item->quantity, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Totals -->
                    <div class="space-y-3 mb-6 border-t border-mg-dark/5 pt-5 text-sm">
                        @if(isset($summary['item_discount']) && $summary['item_discount'] > 0)
                            <div class="flex justify-between text-mg-muted mb-3">
                                <span>Total MRP</span>
                                <span class="font-semibold text-mg-dark line-through">₹{{ number_format($summary['mrp_total'], 2) }}</span>
                            </div>
                            <div class="flex justify-between text-mg-green mb-3">
                                <span>Discount on MRP</span>
                                <span class="font-semibold">-₹{{ number_format($summary['item_discount'], 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-mg-muted">Subtotal ({{ $summary['items_count'] }} items)</span>
                            <span class="font-semibold text-mg-dark">₹{{ number_format($summary['subtotal'], 2) }}</span>
                        </div>
                        @if($summary['discount'] > 0)
                            <div class="flex justify-between text-mg-green font-medium">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/></svg>
                                    Coupon Discount
                                </span>
                                <span class="font-semibold">-₹{{ number_format($summary['discount'], 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-mg-muted">Tax (GST)</span>
                            <div class="text-right">
                                @if(isset($summary['tax_extra']) && $summary['tax_extra'] > 0)
                                    <div class="font-semibold text-mg-dark">₹{{ number_format($summary['tax_extra'], 2) }}</div>
                                @endif
                                @if(isset($summary['tax_included']) && $summary['tax_included'] > 0)
                                    <div class="text-[10px] text-mg-muted font-medium mt-0.5">(Includes ₹{{ number_format($summary['tax_included'], 2) }} GST)</div>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-mg-muted">Delivery</span>
                            <span class="font-semibold {{ $summary['shipping'] == 0 ? 'text-mg-green' : 'text-mg-dark' }}">
                                {{ $summary['shipping'] == 0 ? 'FREE' : '₹'.number_format($summary['shipping'], 2) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center border-t border-mg-dark/5 pt-5 mb-2">
                        <span class="text-lg font-bold text-mg-dark">Total</span>
                        <span class="text-xl sm:text-2xl font-extrabold text-mg-dark font-heading">₹{{ number_format($summary['total'], 2) }}</span>
                    </div>

                    @if((isset($summary['item_discount']) ? $summary['item_discount'] : 0) + $summary['discount'] > 0)
                        <div class="mt-4 bg-mg-green/5 rounded-xl px-4 py-2.5 flex items-center gap-2">
                            <span class="text-mg-green text-sm">🎉</span>
                            <span class="text-sm font-bold text-mg-green">You're saving ₹{{ number_format((isset($summary['item_discount']) ? $summary['item_discount'] : 0) + $summary['discount'], 2) }} on this order!</span>
                        </div>
                    @endif
                </div>
                
                <!-- Trust Badges -->
                <div class="grid grid-cols-3 gap-3 mt-6">
                    <div class="text-center bg-white rounded-xl p-3 border border-mg-dark/5 shadow-sm">
                        <svg class="w-5 h-5 mx-auto text-mg-green mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                        <p class="text-[10px] font-semibold text-mg-muted leading-tight">Secure<br>Payment</p>
                    </div>
                    <div class="text-center bg-white rounded-xl p-3 border border-mg-dark/5 shadow-sm">
                        <svg class="w-5 h-5 mx-auto text-mg-green mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25m-2.25 0h-2.735a2.014 2.014 0 00-1.55.767L3 13.5m8.25-4.5V6.75a3.375 3.375 0 00-3.375-3.375h-.057c-1.88 0-3.62.98-4.593 2.587L.768 11.836"/></svg>
                        <p class="text-[10px] font-semibold text-mg-muted leading-tight">Fast<br>Delivery</p>
                    </div>
                    <div class="text-center bg-white rounded-xl p-3 border border-mg-dark/5 shadow-sm">
                        <svg class="w-5 h-5 mx-auto text-mg-green mb-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182"/></svg>
                        <p class="text-[10px] font-semibold text-mg-muted leading-tight">Easy<br>Returns</p>
                    </div>
                </div>
            </div>
            
        </div>
</div>

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('checkout-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        const paymentMethod = formData.get('payment_method');
        const btn = document.getElementById('pay-btn');
        
        if(paymentMethod === 'cod') {
            form.submit();
            return;
        }
        
        // Razorpay flow
        btn.disabled = true;
        btn.innerText = 'Processing...';
        
        try {
            // 1. Create order on server
            const response = await fetch('{{ route('payment.create') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(Object.fromEntries(formData))
            });
            
            const data = await response.json();
            
            if(!data.success) {
                alert(data.message || 'Payment initialization failed.');
                btn.disabled = false;
                btn.innerText = 'Place Order';
                return;
            }
            
            // 2. Open Razorpay Checkout
            var options = {
                "key": data.key, 
                "amount": data.amount,
                "currency": "INR",
                "name": "MunchGud",
                "description": "Payment for Order",
                "image": "{{ asset('images/logo.jpg') }}",
                "order_id": data.razorpay_order_id,
                "handler": function (response){
                    // 3. Verify on server
                    fetch('{{ route('payment.verify') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(response)
                    }).then(res => res.json()).then(resData => {
                        if(resData.success) {
                            window.location.href = resData.redirect_url;
                        } else {
                            alert(resData.message || 'Payment verification failed. If money was deducted, it will be refunded.');
                            window.location.reload();
                        }
                    });
                },
                "prefill": {
                    "name": "{{ auth()->user()->name ?? '' }}",
                    "email": "{{ auth()->user()->email ?? '' }}",
                    "contact": "{{ auth()->user()->phone ?? '' }}"
                },
                "theme": {
                    "color": "#1B4332"
                }
            };
            var rzp = new Razorpay(options);
            rzp.on('payment.failed', function (response){
                alert("Payment Failed. Reason: " + response.error.description);
                btn.disabled = false;
                btn.innerText = 'Place Order';
            });
            rzp.open();
            
        } catch(err) {
            console.error(err);
            alert('Something went wrong.');
            btn.disabled = false;
            btn.innerText = 'Place Order';
        }
    });
</script>
@endsection
@endsection
