<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.form', ['blog' => new Blog()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'author_name'      => 'nullable|string|max:255',
            'cover_image_link' => 'nullable|string|max:1000',
            'content'          => 'required',
            'image'            => 'nullable|image|max:3072',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        $data = $request->except(['image', '_token']);

        // Ensure all content image URLs are absolute /storage/...
        if (isset($data['content'])) {
            $data['content'] = preg_replace('/src=["\'](?:\.\.\/)+storage\//i', 'src="/storage/', $data['content']);
        }

        // Generate or sanitize slug
        $slug = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title);
        if (empty($slug)) {
            $slug = 'post-' . time();
        }

        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        $data['slug'] = $slug;

        // Active / Published status
        $data['is_active'] = $request->boolean('is_active');
        $data['author_name'] = $request->filled('author_name') ? $request->author_name : 'MunchGud';
        $data['cover_image_link'] = $request->filled('cover_image_link') ? trim($request->cover_image_link) : null;

        // Handle featured image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog article published successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255',
            'author_name'      => 'nullable|string|max:255',
            'cover_image_link' => 'nullable|string|max:1000',
            'content'          => 'required',
            'image'            => 'nullable|image|max:3072',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:1000',
        ]);

        $data = $request->except(['image', '_token', '_method']);

        // Ensure all content image URLs are absolute /storage/...
        if (isset($data['content'])) {
            $data['content'] = preg_replace('/src=["\'](?:\.\.\/)+storage\//i', 'src="/storage/', $data['content']);
        }

        $data['cover_image_link'] = $request->filled('cover_image_link') ? trim($request->cover_image_link) : null;

        // Handle slug customization
        if ($request->filled('slug')) {
            $slug = Str::slug($request->slug);
            if ($slug !== $blog->slug) {
                $originalSlug = $slug;
                $counter = 1;
                while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $data['slug'] = $slug;
            }
        }

        // Active / Published status
        $data['is_active'] = $request->boolean('is_active');
        $data['author_name'] = $request->filled('author_name') ? $request->author_name : 'MunchGud';

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog article updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog article deleted successfully.');
    }
}
