<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceableZone;
use Illuminate\Http\Request;

class AdminServiceableZoneController extends Controller
{
    public function index()
    {
        $zones = ServiceableZone::orderBy('state')->get();
        $states = ServiceableZone::indianStates();
        $existingStates = $zones->pluck('state')->toArray();
        
        return view('admin.zones.index', compact('zones', 'states', 'existingStates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'state' => 'required|string|max:255|unique:serviceable_zones,state',
            'pincodes' => 'nullable|string',
            'is_active' => 'boolean',
            'cod_available' => 'boolean',
            'delivery_days' => 'nullable|integer|min:1|max:30',
            'extra_shipping' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['cod_available'] = $request->has('cod_available') ? 1 : 0;
        $validated['extra_shipping'] = $validated['extra_shipping'] ?? 0;

        ServiceableZone::create($validated);

        return redirect()->route('admin.zones.index')->with('success', "Zone for {$validated['state']} created successfully.");
    }

    public function update(Request $request, ServiceableZone $zone)
    {
        $validated = $request->validate([
            'pincodes' => 'nullable|string',
            'is_active' => 'boolean',
            'cod_available' => 'boolean',
            'delivery_days' => 'nullable|integer|min:1|max:30',
            'extra_shipping' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        $validated['cod_available'] = $request->has('cod_available') ? 1 : 0;
        $validated['extra_shipping'] = $validated['extra_shipping'] ?? 0;

        $zone->update($validated);

        return redirect()->route('admin.zones.index')->with('success', "Zone for {$zone->state} updated.");
    }

    public function destroy(ServiceableZone $zone)
    {
        $state = $zone->state;
        $zone->delete();
        return redirect()->route('admin.zones.index')->with('success', "Zone for {$state} removed.");
    }
}
