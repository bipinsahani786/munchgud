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
