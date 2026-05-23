@extends('admin.layouts.app')

@section('title', 'Reports & Analytics')
@section('header', 'Reports & Analytics')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Sales Reports</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Analyze your store's performance over time.</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.reports.export', request()->all()) }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export CSV
        </a>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 p-4 mb-6">
    <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-col sm:flex-row items-end gap-4">
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Start Date</label>
            <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="w-full sm:w-48 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">End Date</label>
            <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="w-full sm:w-48 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
        </div>
        <button type="submit" class="px-5 py-2 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition text-sm">Apply Filter</button>
    </form>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Revenue</div>
        <div class="text-2xl font-bold text-gray-900">₹{{ number_format($metrics['total_revenue'], 2) }}</div>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Orders</div>
        <div class="text-2xl font-bold text-gray-900">{{ number_format($metrics['total_orders']) }}</div>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Avg. Order Value</div>
        <div class="text-2xl font-bold text-gray-900">₹{{ number_format($metrics['average_order_value'], 2) }}</div>
    </div>
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Cancelled</div>
        <div class="text-2xl font-bold text-red-600">{{ number_format($metrics['cancelled_orders']) }}</div>
    </div>
</div>

<!-- Daily Data Table -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Daily Breakdown</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Date</th>
                    <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Orders</th>
                    <th class="px-6 py-3 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Revenue</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($dailyRevenue as $day)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-3 font-medium text-gray-900">{{ \Carbon\Carbon::parse($day->date)->format('M d, Y') }}</td>
                        <td class="px-6 py-3 text-gray-600 text-right">{{ $day->orders }}</td>
                        <td class="px-6 py-3 font-bold text-gray-900 text-right">₹{{ number_format($day->revenue, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">No data available for this period.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
