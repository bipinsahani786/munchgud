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
        
        // Handle file uploads separately
        $fileKeys = ['company_logo', 'company_favicon'];
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
