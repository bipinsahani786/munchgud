<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShiprocketController extends Controller
{
    public function checkPincode(Request $request) {
        $request->validate([
            'pincode' => 'required|digits:6',
            'weight' => 'nullable|numeric' // For more accurate ETA if needed
        ]);

        $settingPincodes = \App\Models\Setting::get('serviceable_pincodes');
        
        $isServiceable = true;
        if (!empty($settingPincodes)) {
            // Convert comma-separated string to array, trimming whitespace
            $allowedPincodes = array_map('trim', explode(',', $settingPincodes));
            $isServiceable = in_array($request->pincode, $allowedPincodes);
        }
        
        if ($isServiceable) {
            $deliveryDate = now()->addDays(rand(2, 5))->format('D, M j');
            return response()->json([
                'success' => true,
                'serviceable' => true,
                'delivery_date' => $deliveryDate,
                'courier_name' => 'Delhivery Surface'
            ]);
        }

        return response()->json([
            'success' => true,
            'serviceable' => false,
            'message' => 'Sorry, we do not deliver to this pincode yet.'
        ]);
    }
}
