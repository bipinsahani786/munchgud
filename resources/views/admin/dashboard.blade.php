@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Welcome -->
<div class="mb-5 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Welcome back, {{ auth('admin')->user()->name }} 👋</h1>
        <p class="text-xs text-gray-500 font-medium mt-1">Here's what's happening with your store today.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-white border border-gray-200 text-gray-700 text-xs font-semibold rounded-lg hover:bg-gray-50 transition shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            Orders
        </a>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-1.5 px-3 py-2 bg-gray-900 text-white text-xs font-semibold rounded-lg hover:bg-gray-800 transition shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Product
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <!-- Revenue -->
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Revenue</span>
        </div>
        <div class="text-xl font-extrabold text-gray-900 tracking-tight">₹{{ number_format($todayRevenue ?? 0, 2) }}</div>
        <p class="text-[10px] text-gray-400 font-medium mt-1">Yesterday: ₹{{ number_format($yesterdayRevenue ?? 0, 2) }}</p>
    </div>
    
    <!-- Orders -->
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Orders</span>
        </div>
        <div class="text-xl font-extrabold text-gray-900 tracking-tight">{{ $todayOrders ?? 0 }}</div>
        <p class="text-[10px] text-gray-400 font-medium mt-1">Today's orders</p>
    </div>
    
    <!-- Pending -->
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pending</span>
        </div>
        <div class="text-xl font-extrabold {{ ($pendingOrders ?? 0) > 0 ? 'text-amber-600' : 'text-gray-900' }} tracking-tight">{{ $pendingOrders ?? 0 }}</div>
        @if(($pendingOrders ?? 0) > 0)
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="text-[10px] font-semibold text-amber-600 hover:text-amber-700 mt-1 inline-flex items-center gap-1">
                Process now <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <p class="text-[10px] text-gray-400 font-medium mt-1">All caught up!</p>
        @endif
    </div>
    
    <!-- Customers -->
    <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow group">
        <div class="flex items-center gap-2 mb-3">
            <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customers</span>
        </div>
        <div class="text-xl font-extrabold text-gray-900 tracking-tight">{{ $totalCustomers ?? 0 }}</div>
        <p class="text-[10px] text-gray-400 font-medium mt-1">Total registered</p>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    
    <!-- Left Column (Chart + Orders) -->
    <div class="lg:col-span-2 space-y-4">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-5">
            <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide mb-4">Revenue (Last 30 Days)</h2>
            <div class="h-64 w-full">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-[11px] font-semibold text-gray-500 hover:text-gray-900 transition">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-5 py-2.5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Order</th>
                            <th class="px-5 py-2.5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Customer</th>
                            <th class="px-5 py-2.5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                            <th class="px-5 py-2.5 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs">
                        @forelse($recentOrders ?? [] as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors group cursor-pointer" onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                                <td class="px-5 py-3">
                                    <span class="font-bold text-gray-900 group-hover:text-emerald-600 transition text-xs">{{ $order->order_number }}</span>
                                </td>
                                <td class="px-5 py-3 text-gray-600 font-medium">{{ $order->user->name ?? 'Guest' }}</td>
                                <td class="px-5 py-3">
                                    <span class="px-2 py-0.5 text-[9px] font-bold rounded border inline-block
                                        {{ $order->status === 'delivered' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                        {{ $order->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                        {{ $order->status === 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' : '' }}
                                        {{ !in_array($order->status, ['delivered','pending','cancelled']) ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                    ">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td class="px-5 py-3 font-bold text-gray-900 text-right">₹{{ number_format($order->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-8 text-center text-gray-400 text-xs">No recent orders.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="space-y-4">
        <!-- Top Products -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Top Products</h2>
            </div>
            <div class="p-2">
                @forelse($topProducts ?? [] as $item)
                    <div class="flex justify-between items-center px-3 py-2 hover:bg-gray-50 rounded-lg transition">
                        <span class="font-semibold text-xs text-gray-800 truncate pr-3">{{ $item->product_name }}</span>
                        <span class="font-bold text-[10px] text-gray-600 bg-gray-100 px-1.5 py-0.5 rounded flex-shrink-0">{{ $item->total_sold }}</span>
                    </div>
                @empty
                    <div class="px-3 py-4 text-center text-xs text-gray-400">No sales data yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-xs font-bold text-gray-900 uppercase tracking-wide">Low Stock</h2>
                @if(count($lowStockSkus ?? []) > 0)
                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                @endif
            </div>
            <div class="p-2">
                @forelse($lowStockSkus ?? [] as $sku)
                    <div class="flex justify-between items-center px-3 py-2 hover:bg-red-50/50 rounded-lg transition">
                        <div class="min-w-0 pr-3">
                            <p class="font-semibold text-xs text-gray-900 truncate">{{ $sku->product->name }}</p>
                            <p class="text-[9px] text-gray-400 font-mono mt-0.5">{{ $sku->sku }}</p>
                        </div>
                        <span class="font-bold text-[10px] text-red-700 bg-red-50 border border-red-100 px-1.5 py-0.5 rounded flex-shrink-0">{{ $sku->stock_qty }} left</span>
                    </div>
                @empty
                    <div class="px-3 py-5 text-center">
                        <div class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center mx-auto mb-1.5">
                            <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-[11px] text-emerald-600 font-medium">All stock healthy</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueData = @json($revenueChart ?? []);
        
        const labels = revenueData.map(item => item.date);
        const data = revenueData.map(item => item.total);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue (₹)',
                    data: data,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 10,
                        titleFont: { family: 'Inter', size: 12 },
                        bodyFont: { family: 'Inter', size: 13, weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4], color: '#f3f4f6' },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#9ca3af', callback: value => '₹' + value }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#9ca3af', maxTicksLimit: 7 }
                    }
                }
            }
        });
    });
</script>
@endsection
