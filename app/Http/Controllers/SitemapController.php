<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        if (file_exists(public_path('sitemap.xml'))) {
            return response(file_get_contents(public_path('sitemap.xml')), 200)
                ->header('Content-Type', 'application/xml');
        }

        return response(view('sitemap'), 200)
            ->header('Content-Type', 'application/xml');
    }

    public function html()
    {
        $products = Product::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        $blogs = Blog::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        $staticPages = [
            ['title' => 'Home', 'url' => url('/')],
            ['title' => 'Shop All Products', 'url' => url('/products')],
            ['title' => 'Our Story', 'url' => url('/story')],
            ['title' => 'Blogs', 'url' => url('/blogs')],
            ['title' => 'Recipes', 'url' => url('/recipes')],
            ['title' => 'Contact Us', 'url' => url('/contact')],
            ['title' => 'Build a Box', 'url' => url('/build-a-box')],
            ['title' => 'Cream and Onion', 'url' => url('/cream-and-onion')],
            ['title' => 'Peri Peri Makhana', 'url' => url('/peri-peri-makhana')],
            ['title' => 'Privacy Policy', 'url' => url('/privacy-policy')],
            ['title' => 'Terms of Service', 'url' => url('/terms')],
            ['title' => 'Refund Policy', 'url' => url('/refund-policy')],
            ['title' => 'Shipping Policy', 'url' => url('/shipping-policy')],
        ];

        return view('sitemap-html', compact('products', 'categories', 'blogs', 'staticPages'));
    }
}
