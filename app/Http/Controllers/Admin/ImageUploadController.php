<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $extension = $file->getClientOriginalExtension();
            $filename = 'ckeditor_' . time() . '.' . $extension;
            
            $path = $file->storeAs('cms/images', $filename, 'public');
            $url = Storage::url($path);
            
            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
        
        return response()->json(['uploaded' => 0, 'error' => ['message' => 'Upload failed']]);
    }
}
