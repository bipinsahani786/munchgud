<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::active()->with('primaryImage','skus','category');
        
        $searchTerm = $request->q ?? $request->search;
        if ($searchTerm) $query->where('name','like',"%{$searchTerm}%");
        if ($request->category) $query->whereHas('category', fn($q)=>$q->where('slug',$request->category));
        if ($request->min_price || $request->max_price) {
            $query->whereHas('skus', function($q) use ($request) {
                if ($request->min_price) $q->where('sale_price','>=',$request->min_price);
                if ($request->max_price) $q->where('sale_price','<=',$request->max_price);
            });
        }
        if ($request->in_stock) $query->whereHas('skus', fn($q)=>$q->where('stock_qty','>',0));
        
        $query->when($request->sort, fn($q) => match($request->sort) {
            'price_asc' => $q->orderByRaw('(SELECT MIN(sale_price) FROM product_skus WHERE product_id = products.id)'),
            'price_desc' => $q->orderByRaw('(SELECT MAX(sale_price) FROM product_skus WHERE product_id = products.id) DESC'),
            default => $q->latest()
        });
        
        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->get();
        $wishlistSkus = auth()->check() ? auth()->user()->wishlists()->pluck('product_sku_id')->toArray() : [];
        return view('storefront.products.index', compact('products','categories','wishlistSkus'));
    }

    public function show(string $slug) {
        $product = Product::active()->where('slug',$slug)
            ->with('images','skus.variantOptions.variantType','category','reviews')
            ->firstOrFail();
            
        $defaultSku = $product->skus->where('is_default',true)->first();
        if (!$defaultSku || $defaultSku->stock_qty <= 0) {
            $defaultSku = $product->skus->where('stock_qty', '>', 0)->first() ?? $product->skus->first();
        }
        
        $variantTypes = $product->skus->flatMap->variantOptions->groupBy('variantType.name');
        
        $relatedProducts = Product::active()->where('category_id',$product->category_id)
            ->where('id','!=',$product->id)->with('primaryImage','skus')->take(4)->get();
            
        $skuMatrix = $product->skus->map(fn($sku) => [
            'id' => $sku->id,
            'options' => $sku->variantOptions->pluck('id')->toArray(),
            'price' => $sku->sale_price,
            'mrp' => $sku->mrp,
            'stock' => $sku->stock_qty,
            'is_active' => $sku->is_active,
        ]);
        
        $wishlistSkus = auth()->check() ? auth()->user()->wishlists()->pluck('product_sku_id')->toArray() : [];
        
        return view('storefront.products.show', compact('product','defaultSku','variantTypes','relatedProducts','skuMatrix','wishlistSkus'));
    }

    public function category(string $slug)
    {
        return redirect()->route('products.index', ['category' => $slug]);
    }

    public function searchSuggestions(Request $request) {
        $q = $request->q;
        if(!$q) return response()->json([]);
        $products = Product::active()
                    ->where('name', 'like', "%{$q}%")
                    ->with('primaryImage')
                    ->take(5)
                    ->get()
                    ->map(function($p) {
                        return [
                            'name' => $p->name,
                            'url' => route('products.show', $p->slug),
                            'image' => $p->primaryImage ? \Illuminate\Support\Facades\Storage::url($p->primaryImage->path) : asset('images/product_shot_new.png')
                        ];
                    });
        return response()->json($products);
    }
}
