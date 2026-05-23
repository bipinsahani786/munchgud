<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product) {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:150',
            'body' => 'required|string|max:1000'
        ]);

        $user = auth()->user();
        $validated['user_id'] = $user->id;
        $validated['name'] = $user->name;
        $validated['email'] = $user->email;
        $validated['is_approved'] = true; // Auto-approve by default

        $product->reviews()->create($validated);

        return back()->with('success', 'Thank you! Your review has been submitted for approval.');
    }
}
