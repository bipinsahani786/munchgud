<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function index()
    {
        $theme = Theme::where('is_active', true)->first();
        if (!$theme) {
            $theme = Theme::first();
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
            } else {
                $theme->update(['is_active' => true]);
            }
        }
        
        return view('admin.themes.index', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        $validated = $request->validate([
            'primary_color' => 'required|string',
            'secondary_color' => 'required|string',
            'bg_color' => 'required|string',
            'text_color' => 'required|string',
            'heading_font' => 'required|string',
        ]);

        $theme->update($validated);

        return back()->with('success', 'Theme updated successfully!');
    }
}
