<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSku;
use App\Services\CartService;

class BuildABoxController extends Controller
{
    public function index() {
        $skus = ProductSku::active()->inStock()->with(['product.primaryImage', 'variantOptions'])->get();
        
        // Group by flavor or category depending on setup
        // Assuming we group by some variant or simply show all for selection
        
        return view('pages.build-a-box', compact('skus'));
    }

    public function addToCart(Request $request, CartService $cartService) {
        $request->validate([
            'skus' => 'required|array|min:3', // e.g. min 3 for a box
            'skus.*' => 'exists:product_skus,id'
        ]);

        foreach ($request->skus as $skuId) {
            $cartService->addItem($skuId, 1);
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'summary' => $cartService->getSummary()]);
        }

        return redirect()->route('cart.index')->with('success', 'Custom box added to cart!');
    }
}
