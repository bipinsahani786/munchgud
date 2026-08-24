<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {

        $recipes = Recipe::where('status', 'approved')->get();
        $featuredRecipe = $recipes->where('featured', true)->first();
        $otherRecipes = $recipes->where('featured', false);
        $page = \App\Models\Page::where('slug', 'recipes')->first();

        return view('storefront.recipes', compact('featuredRecipe', 'otherRecipes', 'page'));
    }

    public function show($slug)
    {
        $recipe = Recipe::where('slug', $slug)->where('status', 'approved')->firstOrFail();
        $otherRecipes = Recipe::where('status', 'approved')->where('id', '!=', $recipe->id)->take(3)->get();

        return view('storefront.recipes.show', compact('recipe', 'otherRecipes'));
    }

    public function create()
    {
        return view('storefront.recipes.submit');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_email' => 'required|email|max:255',
            'title' => 'required|string|max:255',
            'time' => 'required|string|max:50',
            'difficulty' => 'required|string|in:Easy,Medium,Hard',
            'category' => 'required|string|max:50',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
        ]);

        // Convert newline separated string into array
        $ingredients = array_filter(array_map('trim', explode("\n", $request->ingredients)));
        $steps = array_filter(array_map('trim', explode("\n", $request->steps)));

        $slug = Str::slug($request->title) . '-' . time();

        Recipe::create([
            'title' => $request->title,
            'slug' => $slug,
            'category' => $request->category,
            'time' => $request->time,
            'difficulty' => $request->difficulty,
            'ingredients' => $ingredients,
            'steps' => $steps,
            'author_name' => $request->author_name,
            'author_email' => $request->author_email,
            'status' => 'pending',
            'featured' => false,
        ]);

        return redirect()->back()->with('success', 'Thank you! Your recipe has been submitted and is under review.');
    }
}
