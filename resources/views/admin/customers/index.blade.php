@extends('admin.layouts.app')

@section('title', 'Customers')
@section('header', 'Customers')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Customers</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Manage user accounts and their order history.</p>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 p-4 mb-6">
    <form action="{{ route('admin.customers.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or phone..." class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
        </div>
        <button type="submit" class="px-5 py-2 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition text-sm">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.customers.index') }}" class="px-5 py-2 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm flex items-center justify-center">Clear</a>
        @endif
    </form>
</div>

<!-- Data Table -->
<div class="bg-white rounded-2xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Customer Details</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Phone</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Orders</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">Status</th>
                    <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($customers as $customer)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">
                                    {{ substr($customer->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 text-sm">{{ $customer->name }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $customer->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $customer->phone ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center justify-center px-2 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded">
                                {{ $customer->orders_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($customer->is_active)
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-100 rounded">Active</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-red-50 text-red-700 border border-red-100 rounded">Blocked</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="p-1.5 bg-gray-50 text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 border border-gray-200 hover:border-emerald-200 rounded-lg transition" title="View Profile">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <form action="{{ route('admin.customers.toggle', $customer) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-1.5 {{ $customer->is_active ? 'bg-gray-50 text-gray-500 hover:text-red-600 hover:bg-red-50 border-gray-200 hover:border-red-200' : 'bg-gray-50 text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 border-gray-200 hover:border-emerald-200' }} border rounded-lg transition" title="{{ $customer->is_active ? 'Block Account' : 'Activate Account' }}">
                                        @if($customer->is_active)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No customers found</h3>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($customers->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $customers->links() }}
        </div>
    @endif
</div>
@endsection
