<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\HomepageSection;

class AdminStorefrontController extends Controller
{
    public function index() {
        $activeTheme = Theme::active();
        $sections = HomepageSection::active()->get();
        return view('admin.storefront.index', compact('activeTheme', 'sections'));
    }

    public function storeSection(Request $request) {
        $validated = $request->validate([
            'theme_id' => 'required|exists:themes,id',
            'type' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|array',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        HomepageSection::create($validated);
        return back()->with('success', 'Section added to storefront.');
    }

    public function updateSection(Request $request, HomepageSection $section) {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        $section->update($validated);
        return back()->with('success', 'Section updated.');
    }

    public function destroySection(HomepageSection $section) {
        $section->delete();
        return back()->with('success', 'Section removed.');
    }

    public function reorder(Request $request) {
        // Logic for drag and drop reordering
        foreach ($request->orders as $id => $order) {
            HomepageSection::where('id', $id)->update(['sort_order' => $order]);
        }
        return response()->json(['success' => true]);
    }
}
