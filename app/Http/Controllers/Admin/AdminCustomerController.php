<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminCustomerController extends Controller
{
    public function index(Request $request) {
        $query = User::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $customers = $query->withCount('orders')->latest()->paginate(20)->withQueryString();
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $user) {
        $user->load(['orders' => function($q) {
            $q->latest()->take(10);
        }, 'addresses']);
        
        $totalSpent = $user->orders()->where('payment_status', 'paid')->sum('total');
        
        return view('admin.customers.show', compact('user', 'totalSpent'));
    }

    public function toggle(User $user) {
        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'Customer status updated.');
    }
}
