<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

class AdminThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::where('is_active', true)->first() ?? Theme::first();
        if (!$theme) {
            $theme = Theme::create([
                'name' => 'Default Theme',
                'primary_color' => '#1B4332',
                'secondary_color' => '#E07B2A',
                'bg_color' => '#FAF7F0',
                'text_color' => '#1A1A1A',
                'heading_font' => 'Playfair Display',
                'is_active' => true,
            ]);
        }
        return view('admin.themes.index', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'primary_color' => 'required|string|max:50',
            'secondary_color' => 'required|string|max:50',
            'bg_color' => 'required|string|max:50',
            'text_color' => 'required|string|max:50',
            'heading_font' => 'required|string|max:100',
        ]);

        $theme->update($validated);

        return redirect()->route('admin.themes.index')->with('success', 'Theme updated successfully.');
    }

    public function activate(Theme $theme)
    {
        // Deactivate all themes
        Theme::query()->update(['is_active' => false]);
        
        // Activate the selected theme
        $theme->update(['is_active' => true]);

        return redirect()->route('admin.themes.index')->with('success', "Theme '{$theme->name}' activated successfully.");
    }
}
