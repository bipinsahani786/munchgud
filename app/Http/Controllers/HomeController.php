<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomepageSection;
use App\Models\Theme;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Review;

class HomeController extends Controller
{
    public function index() {
        $sections = HomepageSection::active()->get();
        $activeTheme = Theme::active();
        $featuredProducts = Product::active()->featured()->with('primaryImage','skus')->take(8)->get();
        $categories = Category::active()->whereNull('parent_id')->get();
        $banners = Banner::active()->orderBy('sort_order')->get();
        $testimonials = Review::approved()->latest()->take(6)->get();
        $wishlistSkus = auth()->check() ? auth()->user()->wishlists()->pluck('product_sku_id')->toArray() : [];
        $page = \App\Models\Page::where('slug', 'home')->first();
        $recipes = \App\Models\Recipe::where('status', 'approved')->latest()->take(4)->get();
        
        return view('storefront.home', compact('sections','activeTheme','featuredProducts','categories','banners','testimonials','wishlistSkus', 'page', 'recipes'));
    }
}
