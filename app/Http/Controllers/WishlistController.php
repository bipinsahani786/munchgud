<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ProductSku;
use App\Services\CartService;

class WishlistController extends Controller
{
    public function index() {
        $wishlists = auth()->user()->wishlists()->with(['sku.product.primaryImage', 'sku.product.category'])->get();
        return view('storefront.account.wishlist', compact('wishlists'));
    }

    public function toggle(ProductSku $sku) {
        $user = auth()->user();
        
        $existing = Wishlist::where('user_id', $user->id)
            ->where('product_sku_id', $sku->id)
            ->first();
            
        if ($existing) {
            $existing->delete();
            $status = 'removed';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_sku_id' => $sku->id
            ]);
            $status = 'added';
        }
        
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true, 
                'status' => $status, 
                'count' => $user->wishlists()->count()
            ]);
        }
        
        return back()->with('success', "Item {$status} wishlist.");
    }

    public function moveToCart(ProductSku $sku) {
        $user = auth()->user();
        
        // Add to cart
        $cartService = app(CartService::class);
        $cartService->addItem($sku->id, 1);
        
        // Remove from wishlist
        Wishlist::where('user_id', $user->id)
            ->where('product_sku_id', $sku->id)
            ->delete();
        
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Moved to cart',
                'wishlist_count' => $user->wishlists()->count(),
                'summary' => $cartService->getSummary()
            ]);
        }
        
        return back()->with('success', 'Item moved to cart.');
    }
}
