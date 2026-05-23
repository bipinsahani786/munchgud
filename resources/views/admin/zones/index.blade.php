@extends('admin.layouts.app')

@section('title', 'Delivery Zones')
@section('header', 'Delivery Zones')

@section('content')
<div class="mb-6">
    <h1 class="text-xl font-bold text-gray-900">Delivery Zones</h1>
    <p class="text-sm text-gray-500 font-medium mt-0.5">Manage state-wise delivery zones, pincodes, and COD availability.</p>
</div>

@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm font-semibold text-emerald-700 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif

<!-- Add New Zone -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Add New Zone</h2>
    </div>
    <form action="{{ route('admin.zones.store') }}" method="POST">
        @csrf
        <div class="p-6 grid md:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">State / UT</label>
                <select name="state" required class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
                    <option value="">Select State</option>
                    @foreach($states as $state)
                        @if(!in_array($state, $existingStates))
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Delivery Days</label>
                <input type="number" name="delivery_days" value="5" min="1" max="30" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Extra Shipping (₹)</label>
                <input type="number" step="0.01" name="extra_shipping" value="0" min="0" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none">
            </div>
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                    <span class="text-xs font-bold text-gray-700">Active</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="cod_available" value="1" checked class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                    <span class="text-xs font-bold text-gray-700">COD</span>
                </label>
            </div>
            <div>
                <button type="submit" class="w-full px-4 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-xl hover:bg-gray-800 transition shadow-sm">
                    + Add Zone
                </button>
            </div>
        </div>
        <div class="px-6 pb-5">
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-1.5">Pincodes (comma separated) — Leave blank to allow all pincodes in this state</label>
            <textarea name="pincodes" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none" placeholder="e.g. 800001, 800002, 800003 (leave empty for all pincodes)"></textarea>
        </div>
    </form>
</div>

<!-- Zones List -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">All Zones ({{ $zones->count() }})</h2>
        </div>
    </div>

    @if($zones->count() > 0)
        <div class="divide-y divide-gray-50">
            @foreach($zones as $zone)
            <form action="{{ route('admin.zones.update', $zone) }}" method="POST" class="p-5 hover:bg-gray-50/50 transition-colors">
                @csrf
                @method('PATCH')
                <div class="grid md:grid-cols-6 gap-4 items-center">
                    <!-- State Name -->
                    <div class="md:col-span-1">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl {{ $zone->is_active ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center font-bold text-sm flex-shrink-0">
                                {{ strtoupper(substr($zone->state, 0, 2)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $zone->state }}</p>
                                <p class="text-[10px] text-gray-500">{{ $zone->pincodes ? count(explode(',', $zone->pincodes)) . ' pincodes' : 'All pincodes' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pincodes -->
                    <div class="md:col-span-2">
                        <textarea name="pincodes" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none resize-none" placeholder="All pincodes">{{ $zone->pincodes }}</textarea>
                    </div>

                    <!-- Delivery Days & Extra Shipping -->
                    <div class="flex gap-3">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Days</label>
                            <input type="number" name="delivery_days" value="{{ $zone->delivery_days }}" min="1" max="30" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500/20 outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Extra ₹</label>
                            <input type="number" step="0.01" name="extra_shipping" value="{{ $zone->extra_shipping }}" min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs focus:ring-2 focus:ring-emerald-500/20 outline-none">
                        </div>
                    </div>

                    <!-- Toggles -->
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-1.5 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $zone->is_active ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 rounded border-gray-300 focus:ring-emerald-500">
                            <span class="text-[11px] font-bold {{ $zone->is_active ? 'text-emerald-700' : 'text-gray-400' }}">Active</span>
                        </label>
                        <label class="flex items-center gap-1.5 cursor-pointer">
                            <input type="checkbox" name="cod_available" value="1" {{ $zone->cod_available ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="text-[11px] font-bold {{ $zone->cod_available ? 'text-blue-700' : 'text-gray-400' }}">COD</span>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 justify-end">
                        <button type="submit" class="px-3 py-2 bg-gray-900 text-white text-xs font-semibold rounded-lg hover:bg-gray-800 transition">
                            Save
                        </button>
                        <button type="button" onclick="if(confirm('Delete zone for {{ $zone->state }}?')) document.getElementById('delete-zone-{{ $zone->id }}').submit();" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </form>
            <form id="delete-zone-{{ $zone->id }}" action="{{ route('admin.zones.destroy', $zone) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
            @endforeach
        </div>
    @else
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full mx-auto flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            </div>
            <h3 class="font-bold text-gray-900 mb-1">No Delivery Zones</h3>
            <p class="text-sm text-gray-500">Add zones above to manage state-wise delivery.</p>
            <p class="text-xs text-gray-400 mt-2">If no zones are configured, delivery will be available everywhere (using global settings).</p>
        </div>
    @endif
</div>
@endsection
