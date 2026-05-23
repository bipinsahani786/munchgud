<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('name')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $sections = $request->input('sections', []);
        
        // Process dynamically added sections
        $newKeys = $request->input('new_section_keys', []);
        $newValues = $request->input('new_section_values', []);
        foreach ($newKeys as $index => $key) {
            if (!empty($key)) {
                // Convert to snake_case for consistency
                $formattedKey = \Str::slug($key, '_');
                $sections[$formattedKey] = $newValues[$index] ?? '';
            }
        }

        // Handle image uploads inside sections
        if ($request->hasFile('section_images')) {
            foreach ($request->file('section_images') as $key => $file) {
                $path = $file->store('pages', 'public');
                $sections[$key] = $path;
            }
        }

        $validated['sections'] = $sections;

        $page->update($validated);

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Page content and SEO settings updated successfully.');
    }
}
