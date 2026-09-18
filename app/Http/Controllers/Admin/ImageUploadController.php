<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('upload') ?? $request->file('file') ?? $request->file('image');

        if ($file && $file->isValid()) {
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = 'editor_' . time() . '_' . uniqid() . '.' . $extension;
            
            $path = $file->storeAs('cms/images', $filename, 'public');
            $url = Storage::url($path);

            // TinyMCE 6 expects { location: "url" }
            return response()->json([
                'location' => $url,
                'url'      => $url,
                'uploaded' => 1,
                'fileName' => $filename,
            ]);
        }
        
        $errorMsg = ($file && !$file->isValid()) ? $file->getErrorMessage() : 'No valid image file was uploaded.';
        $statusCode = ($file && $file->getError() === UPLOAD_ERR_INI_SIZE) ? 413 : 400;

        return response()->json([
            'uploaded' => 0, 
            'error'    => ['message' => $errorMsg]
        ], $statusCode);
    }
}
