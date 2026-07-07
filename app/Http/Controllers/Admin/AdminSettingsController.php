<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ActivityLog;

use Illuminate\Support\Facades\Storage;

class AdminSettingsController extends Controller
{
    public function index() {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request) {
        $data = $request->except(['_token']);
        
        if ($request->has('instagram_reels_list')) {
            $reels = $request->input('instagram_reels_list');
            $data['instagram_reels_list'] = is_array($reels)
                ? implode("\n", array_filter(array_map('trim', $reels)))
                : trim($reels);
        } else {
            $data['instagram_reels_list'] = '';
        }
        
        // Handle file uploads separately
        $fileKeys = ['company_logo', 'company_favicon', 'company_signature', 'home_hero_image', 'default_product_image'];
        foreach ($fileKeys as $key) {
            if ($request->hasFile($key)) {
                $oldFile = Setting::get($key);
                if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
                $data[$key] = $request->file($key)->store('settings', 'public');
            } else {
                // Prevent unsetting the existing file if no new file is uploaded
                unset($data[$key]);
            }
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        
        ActivityLog::log('Updated Settings', "Global settings updated");
        
        return back()->with('success', 'Settings updated successfully.');
    }
}
