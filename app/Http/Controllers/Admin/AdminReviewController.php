<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index(Request $request) {
        $query = Review::with('product');

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('title', 'like', "%{$request->search}%");
        }

        if ($request->status) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $reviews = $query->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review) {
        $review->update(['is_approved' => true]);
        return back()->with('success', 'Review approved.');
    }

    public function reject(Review $review) {
        $review->update(['is_approved' => false]);
        return back()->with('success', 'Review rejected (hidden).');
    }

    public function destroy(Review $review) {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}
