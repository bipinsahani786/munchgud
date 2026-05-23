<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::active()->latest()->paginate(9);
        return view('storefront.blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::active()->where('slug', $slug)->firstOrFail();
        
        $relatedBlogs = Blog::active()
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();
            
        return view('storefront.blogs.show', compact('blog', 'relatedBlogs'));
    }
}
