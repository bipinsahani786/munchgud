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
        $products = Product::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        $categories = Category::where('is_active', true)->orderBy('updated_at', 'desc')->get();
        $blogs = Blog::where('is_active', true)->orderBy('updated_at', 'desc')->get();

        // Static pages
        $staticPages = [
            ['url' => url('/'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['url' => url('/products'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['url' => url('/story'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['url' => url('/blogs'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['url' => url('/recipes'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['url' => url('/contact'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.5'],
            ['url' => url('/build-a-box'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['url' => url('/cream-and-onion'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['url' => url('/peri-peri-makhana'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['url' => url('/privacy-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.3'],
            ['url' => url('/terms'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.3'],
            ['url' => url('/refund-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.3'],
            ['url' => url('/shipping-policy'), 'lastmod' => now()->toAtomString(), 'changefreq' => 'yearly', 'priority' => '0.3'],
        ];

        $content = view('sitemap', compact('products', 'categories', 'blogs', 'staticPages'));

        return response($content, 200)
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
