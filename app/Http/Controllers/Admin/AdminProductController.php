<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\VariantType;
use App\Models\ActivityLog;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::with(['category', 'skus']);
        
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        
        $products = $query->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::active()->get();
        $variantTypes = VariantType::all();
        return view('admin.products.create', compact('categories', 'variantTypes'));
    }

    private function generateUniqueSlug($name, $ignoreId = null) {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        
        $query = Product::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        while ($query->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
            $query = Product::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
        }
        return $slug;
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'nutritional_info' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        if ($validated['tags']) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $product = Product::create($validated);
        
        ActivityLog::log('Created Product', "Product {$product->name} created");

        return redirect()->route('admin.products.edit', $product)->with('success', 'Product created successfully. Now add images and SKUs.');
    }

    public function show(Product $product) {
        return redirect()->route('admin.products.edit', $product);
    }

    public function edit(Product $product) {
        $product->load(['images', 'skus.variantOptions', 'category']);
        $categories = Category::active()->get();
        $variantTypes = VariantType::all();
        
        return view('admin.products.edit', compact('product', 'categories', 'variantTypes'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'nutritional_info' => 'nullable|string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        if ($validated['name'] !== $product->name) {
            $validated['slug'] = $this->generateUniqueSlug($validated['name'], $product->id);
        }
        
        if (isset($validated['tags']) && !is_array($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        }

        $product->update($validated);
        
        ActivityLog::log('Updated Product', "Product {$product->name} updated");

        return redirect()->route('admin.products.edit', $product)->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) {
        $name = $product->name;
        $product->delete();
        ActivityLog::log('Deleted Product', "Product {$name} deleted");
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
    public function uploadImage(Request $request, Product $product) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $path = $request->file('image')->store('products', 'public');
        
        $isPrimary = $product->images()->count() === 0;

        $product->images()->create([
            'path' => $path,
            'is_primary' => $isPrimary,
            'sort_order' => $product->images()->count()
        ]);

        ActivityLog::log('Uploaded Image', "Uploaded image for product {$product->name}");

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function deleteImage(ProductImage $image) {
        $product = $image->product;
        
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        
        $image->delete();
        
        // If it was primary, set another one as primary
        if ($image->is_primary && $product->images()->count() > 0) {
            $product->images()->first()->update(['is_primary' => true]);
        }

        ActivityLog::log('Deleted Image', "Deleted image for product {$product->name}");

        return redirect()->back()->with('success', 'Image deleted.');
    }

    public function setPrimaryImage(ProductImage $image) {
        $product = $image->product;
        
        $product->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        ActivityLog::log('Updated Primary Image', "Set primary image for product {$product->name}");

        return redirect()->back()->with('success', 'Primary image updated.');
    }
}
