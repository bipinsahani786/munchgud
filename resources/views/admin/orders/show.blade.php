@extends('admin.layouts.app')

@section('title', 'Order #' . $order->order_number)
@section('header', 'Order Details')

@section('content')
<!-- Back + Actions -->
<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.orders.index') }}" class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Order #{{ $order->order_number }}</h1>
            <p class="text-xs text-gray-500 font-medium mt-0.5">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.orders.label', $order) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Print Label
        </a>
        <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Print Invoice
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Order Items -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Order Items</h2>
                <span class="ml-auto text-xs font-medium text-gray-400">{{ $order->items->count() }} items</span>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($order->items as $item)
                    <div class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 transition">
                        <div class="w-14 h-14 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center flex-shrink-0 border border-gray-200">
                            @if($item->sku->product->primaryImage)
                                <img src="{{ Storage::url($item->sku->product->primaryImage->path) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl">🥜</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-gray-900 text-sm">{{ $item->product_name }}</h4>
                            <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-2">
                                <span>Qty: <strong class="text-gray-700">{{ $item->quantity }}</strong></span>
                                <span class="text-gray-300">•</span>
                                <span class="bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded text-[10px] font-semibold">{{ $item->sku_name }}</span>
                            </p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-gray-900">₹{{ number_format($item->total_price, 2) }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">₹{{ number_format($item->unit_price, 2) }} each</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Totals -->
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 space-y-2">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Subtotal</span>
                    <span class="font-medium text-gray-700">₹{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount_amount > 0)
                <div class="flex justify-between items-center text-sm text-emerald-600">
                    <span>Discount</span>
                    <span class="font-medium">-₹{{ number_format($order->discount_amount, 2) }}</span>
                </div>
                @endif
                <div class="flex justify-between items-center text-sm">
                    <span class="text-gray-500">Shipping</span>
                    <span class="font-medium text-gray-700">₹{{ number_format($order->shipping_amount, 2) }}</span>
                </div>
                <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                    <span class="text-base font-bold text-gray-900">Total</span>
                    <span class="text-xl font-extrabold text-gray-900">₹{{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Tracking -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Tracking Updates</h2>
            </div>
            
            <form action="{{ route('admin.orders.tracking', $order) }}" method="POST" class="px-6 py-4 border-b border-gray-100">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                    <input type="text" name="status" required placeholder="Status title, e.g. Arrived at Hub" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    <input type="text" name="location" placeholder="Location, e.g. Delhi, IN" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                </div>
                <div class="flex gap-3">
                    <textarea name="description" rows="1" placeholder="Additional details..." class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none resize-none"></textarea>
                    <button type="submit" class="px-5 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition flex-shrink-0">Add</button>
                </div>
            </form>

            <div class="px-6 py-4">
                @php
                    $trackings = \App\Models\OrderTracking::where('order_id', $order->id)->orderBy('tracked_at', 'desc')->get();
                @endphp
                @if($trackings->isEmpty())
                    <p class="text-sm text-gray-400 text-center py-4">No tracking updates yet.</p>
                @else
                    <div class="space-y-4">
                        @foreach($trackings as $i => $track)
                            <div class="flex gap-4 relative">
                                <div class="flex flex-col items-center">
                                    <div class="w-3 h-3 rounded-full {{ $i === 0 ? 'bg-emerald-500 ring-4 ring-emerald-50' : 'bg-gray-300' }} flex-shrink-0 mt-1"></div>
                                    @if(!$loop->last)
                                        <div class="w-px flex-1 bg-gray-200 mt-1"></div>
                                    @endif
                                </div>
                                <div class="pb-4">
                                    <p class="font-bold text-sm text-gray-900">{{ $track->status }}</p>
                                    @if($track->location)
                                        <p class="text-xs text-gray-500 mt-0.5">📍 {{ $track->location }}</p>
                                    @endif
                                    <p class="text-[11px] text-gray-400 mt-1">{{ $track->tracked_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="space-y-6">
        
        <!-- Status -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Order Status</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" x-data="{ status: '{{ $order->status }}' }">
                    @csrf
                    @method('PATCH')
                    <select name="status" x-model="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-medium mb-3">
                        @foreach(['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    
                    <div x-show="status === 'cancelled'" class="mb-3" x-cloak>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Cancellation Remarks</label>
                        <textarea name="cancelled_reason" rows="2" placeholder="Reason for cancellation..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-medium">{{ $order->cancelled_reason }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full px-4 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition">Update Status</button>
                </form>
                
                @if($order->status === 'cancelled' && $order->cancelled_reason)
                    <div class="mt-4 p-4 bg-red-50 border border-red-100 rounded-xl text-red-800 text-sm">
                        <span class="font-bold block mb-1">Cancellation Remarks:</span>
                        {{ $order->cancelled_reason }}
                    </div>
                @endif
                
                <div class="mt-5 pt-5 border-t border-gray-100 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 font-medium">Payment</span>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold {{ $order->payment_status == 'paid' ? 'text-emerald-700' : 'text-amber-700' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $order->payment_status == 'paid' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                {{ strtoupper($order->payment_status) }}
                            </span>
                            @if($order->payment_status === 'pending' && $order->payment_method === 'cod')
                                <form action="{{ route('admin.orders.payment', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="payment_status" value="paid">
                                    <button type="submit" class="text-[10px] px-2 py-0.5 bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold rounded-lg hover:bg-emerald-100 hover:border-emerald-300 transition" onclick="return confirm('Confirm payment collected?')">Mark Paid</button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500 font-medium">Method</span>
                        <span class="text-xs font-bold text-gray-900 uppercase">{{ $order->payment_method }}</span>
                    </div>
                    @if($order->payment)
                        <div class="border-t border-gray-100 mt-3 pt-3 space-y-2">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Transaction Details</h4>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500 font-medium">Payment ID</span>
                                <span class="text-[10px] font-mono text-gray-900 bg-gray-50 px-2 py-0.5 rounded border border-gray-200">{{ $order->payment->razorpay_payment_id }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500 font-medium">Order ID</span>
                                <span class="text-[10px] font-mono text-gray-900 bg-gray-50 px-2 py-0.5 rounded border border-gray-200">{{ $order->payment->razorpay_order_id }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ─── Shiprocket Card ──────────────────────────────────────── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <span class="text-lg">🚀</span>
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Shiprocket</h3>
                @if($order->isPushedToShiprocket())
                    <span class="ml-auto inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Pushed
                    </span>
                @else
                    <span class="ml-auto inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 bg-amber-50 border border-amber-100 px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Not Pushed
                    </span>
                @endif
            </div>
            <div class="p-6 space-y-4">

                @if($order->isPushedToShiprocket())
                    {{-- Shiprocket details --}}
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-medium">Shiprocket Order ID</span>
                            <span class="text-xs font-mono font-bold text-gray-900 bg-gray-50 border border-gray-200 px-2 py-0.5 rounded-lg">{{ $order->shiprocket_order_id }}</span>
                        </div>
                        @if($order->awb_code)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-medium">AWB / Tracking</span>
                            <span class="text-xs font-mono font-bold text-emerald-700 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-lg">{{ $order->awb_code }}</span>
                        </div>
                        @endif
                        @if($order->courier_name)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-medium">Courier</span>
                            <span class="text-xs font-bold text-gray-900">{{ $order->courier_name }}</span>
                        </div>
                        @endif
                        @if($order->shiprocket_status)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-medium">SR Status</span>
                            <span class="text-xs font-bold text-indigo-700 bg-indigo-50 border border-indigo-100 px-2 py-0.5 rounded-lg">{{ $order->shiprocket_status }}</span>
                        </div>
                        @endif
                        @if($order->shiprocket_pushed_at)
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-500 font-medium">Pushed At</span>
                            <span class="text-xs text-gray-500">{{ $order->shiprocket_pushed_at->format('d M Y, h:i A') }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Sync Tracking button --}}
                    @if($order->awb_code)
                    <form action="{{ route('admin.orders.shiprocket.sync', $order) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Sync Tracking
                        </button>
                    </form>
                    @else
                    <div class="text-xs text-amber-700 bg-amber-50 border border-amber-100 p-3 rounded-xl">
                        ⏳ AWB not assigned yet. Wait a minute and click Sync Tracking.
                    </div>
                    <form action="{{ route('admin.orders.shiprocket.sync', $order) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 transition">
                            🔄 Retry AWB Sync
                        </button>
                    </form>
                    @endif

                @else
                    <p class="text-xs text-gray-500 mb-3">Push this order to Shiprocket. The order will appear in your Shiprocket dashboard where you can enter actual weight/dimensions and generate the AWB.</p>
                    <form action="{{ route('admin.orders.shiprocket.push', $order) }}" method="POST"
                          onsubmit="return confirm('Push this order to Shiprocket?')">
                        @csrf
                        <div class="mb-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="auto_awb" value="1" class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                                <span class="text-sm font-bold text-gray-700">Auto-assign Courier & Generate AWB</span>
                            </label>
                            <p class="text-[11px] text-gray-500 mt-1 ml-6">If unchecked, you will handle weight, dimensions, and courier assignment manually in Shiprocket.</p>
                        </div>
                        <button type="submit"
                            class="w-full px-4 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 transition flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Push to Shiprocket
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- ─── Invoice Shipping Details ─────────────────────────────── --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Shipping & Invoice Info</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.orders.shipping', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">AWB Number</label>
                            <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" placeholder="e.g. 1234567890" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-medium">
                        </div>
                        
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Courier Name</label>
                            <input type="text" name="courier_name" value="{{ $order->courier_name }}" placeholder="e.g. Delhivery Surface" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-medium">
                        </div>
                        
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Invoice Remark</label>
                            <textarea name="remark" rows="2" placeholder="e.g. Handle with care" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none font-medium">{{ $order->remark }}</textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full mt-5 px-4 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 transition">Save Details</button>
                </form>
            </div>
        </div>

        <!-- Customer -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Customer</h3>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-700 font-bold text-sm">
                        {{ substr($order->user->name ?? 'G', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">{{ $order->user->name ?? 'Guest' }}</p>
                        <p class="text-xs text-gray-500">{{ $order->user->email ?? '' }}</p>
                    </div>
                </div>
                @if($order->user->phone ?? false)
                    <p class="text-xs text-gray-500 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $order->user->phone }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Shipping Address</h3>
            </div>
            <div class="p-6">
                @if($order->shipping_name)
                    <div class="text-sm text-gray-700 leading-relaxed">
                        <p class="font-semibold text-gray-900">{{ $order->shipping_name }}</p>
                        <p class="mt-1">{{ $order->shipping_line1 }}</p>
                        @if(!empty($order->shipping_line2)) <p>{{ $order->shipping_line2 }}</p> @endif
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_pincode }}</p>
                        @if(!empty($order->shipping_phone))
                            <p class="mt-2 text-gray-500 text-xs font-medium">📞 {{ $order->shipping_phone }}</p>
                        @endif
                    </div>
                @else
                    <p class="text-sm text-gray-400">No address provided.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
