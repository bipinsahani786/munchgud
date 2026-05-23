<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::orderBy('created_at', 'desc')->get();
        return view('admin.recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('admin.recipes.form', ['recipe' => new Recipe()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRecipe($request);
        $validated['author_name'] = $request->input('author_name', auth()->user()->name ?? 'Admin');
        $validated['author_email'] = $request->input('author_email', auth()->user()->email ?? 'admin@munchgud.com');
        $validated['status'] = $request->input('status', 'approved');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('recipes', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        Recipe::create($validated);
        return redirect()->route('admin.recipes.index')->with('success', 'Recipe created successfully!');
    }

    public function edit(Recipe $recipe)
    {
        return view('admin.recipes.form', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $this->validateRecipe($request, $recipe->id);
        $validated['status'] = $request->input('status', 'approved');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('recipes', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        $recipe->update($validated);
        return redirect()->route('admin.recipes.index')->with('success', 'Recipe updated successfully!');
    }

    private function validateRecipe(Request $request, $id = null)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:recipes,slug,' . $id,
            'category' => 'required|string|max:50',
            'time' => 'required|string|max:50',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'featured' => 'boolean',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['ingredients'] = array_filter(array_map('trim', explode("\n", $validated['ingredients'])));
        $validated['steps'] = array_filter(array_map('trim', explode("\n", $validated['steps'])));
        $validated['featured'] = $request->has('featured');

        return $validated;
    }

    public function approve(Recipe $recipe)
    {
        $recipe->update(['status' => 'approved']);
        return back()->with('success', 'Recipe approved successfully!');
    }

    public function reject(Recipe $recipe)
    {
        $recipe->update(['status' => 'rejected']);
        return back()->with('success', 'Recipe rejected.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return back()->with('success', 'Recipe deleted.');
    }
}
