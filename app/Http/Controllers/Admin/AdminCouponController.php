<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Str;

class AdminCouponController extends Controller
{
    public function index(Request $request) {
        $query = Coupon::query();
        
        if ($request->search) {
            $query->where('code', 'like', "%{$request->search}%");
        }
        
        $coupons = $query->latest()->paginate(20);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create() {
        return view('admin.coupons.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'description' => 'nullable|string',
            'type' => 'required|in:percent,flat,free_shipping',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'is_active' => 'boolean'
        ]);

        Coupon::create($validated);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon) {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon) {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'description' => 'nullable|string',
            'type' => 'required|in:percent,flat,free_shipping',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'is_active' => 'boolean'
        ]);

        $coupon->update($validated);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon) {
        $coupon->delete();
        return back()->with('success', 'Coupon deleted.');
    }

    public function generateCode() {
        return response()->json(['code' => strtoupper(Str::random(8))]);
    }
}
