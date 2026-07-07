<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function index() {
        $user = auth()->user();
        $recentOrders = $user->orders()->latest()->take(3)->get();
        return view('storefront.account.index', compact('user', 'recentOrders'));
    }

    public function profile() {
        $user = auth()->user();
        return view('storefront.account.profile', compact('user'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|max:2048'
        ]);

        $user = auth()->user();
        $data = $request->only(['name', 'phone']);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('account.profile')->with('success', 'Profile updated successfully.');
    }

    public function orders() {
        $orders = auth()->user()->orders()->with('items')->latest()->paginate(10);
        return view('storefront.account.orders', compact('orders'));
    }

    public function orderDetail(Order $order) {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load(['items.sku.product.primaryImage']);
        return view('storefront.account.order-detail', compact('order'));
    }

    public function orderMap(Order $order) {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        return view('storefront.account.order-map', compact('order'));
    }

    public function downloadInvoice(Order $order) {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        
        // Only allow viewing if order is delivered
        if ($order->status !== 'delivered') {
            return back()->with('error', 'Invoice will be available for printing once the order is delivered.');
        }
        
        return view('admin.orders.invoice-print', compact('order'));
    }

    public function addresses() {
        $addresses = auth()->user()->addresses()->get();
        return view('storefront.account.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request) {
        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'name' => 'required|string|max:50',
            'phone' => 'required|digits:10',
            'line1' => 'required|string|max:50',
            'line2' => 'required|string|max:50',
            'landmark' => 'nullable|string|max:50',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'pincode' => 'required|digits:6',
            'country' => 'required|string|max:50',
            'is_default' => 'boolean'
        ]);

        if (!empty($validated['is_default'])) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        auth()->user()->addresses()->create($validated);

        return back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(Request $request, Address $address) {
        if ($address->user_id !== auth()->id()) abort(403);
        
        $validated = $request->validate([
            'label' => 'nullable|string|max:50',
            'name' => 'required|string|max:50',
            'phone' => 'required|digits:10',
            'line1' => 'required|string|max:50',
            'line2' => 'required|string|max:50',
            'landmark' => 'nullable|string|max:50',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'pincode' => 'required|digits:6',
            'country' => 'required|string|max:50',
            'is_default' => 'boolean'
        ]);

        if (!empty($validated['is_default'])) {
            auth()->user()->addresses()->update(['is_default' => false]);
        }

        $address->update($validated);

        return back()->with('success', 'Address updated successfully.');
    }

    public function destroyAddress(Address $address) {
        if ($address->user_id !== auth()->id()) abort(403);
        $address->delete();
        return back()->with('success', 'Address removed.');
    }

    public function setDefaultAddress(Address $address) {
        if ($address->user_id !== auth()->id()) abort(403);
        auth()->user()->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);
        return back()->with('success', 'Default address updated.');
    }
}
