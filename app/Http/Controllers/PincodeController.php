<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceableZone;
use App\Models\Setting;

class PincodeController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'pincode' => 'required|digits:6',
        ]);

        $zone = ServiceableZone::forPincode($request->pincode);

        if ($zone) {
            return response()->json([
                'deliverable' => true,
                'cod_available' => $zone->cod_available,
                'delivery_days' => $zone->delivery_days ?? 5,
                'state' => $zone->state,
            ]);
        }

        // Fallback to global settings if no zones are configured
        if (ServiceableZone::count() === 0) {
            $settingPincodes = Setting::get('serviceable_pincodes');
            
            if (empty($settingPincodes)) {
                return response()->json([
                    'deliverable' => true,
                    'cod_available' => Setting::get('cod_enabled', '1') == '1',
                    'delivery_days' => 5,
                    'state' => 'India',
                ]);
            } else {
                $allowedPincodes = array_map('trim', explode(',', $settingPincodes));
                if (in_array($request->pincode, $allowedPincodes)) {
                    return response()->json([
                        'deliverable' => true,
                        'cod_available' => Setting::get('cod_enabled', '1') == '1',
                        'delivery_days' => 5,
                        'state' => 'Your Area',
                    ]);
                }
            }
        }

        return response()->json([
            'deliverable' => false,
            'message' => 'Sorry, we do not deliver to this pincode.',
        ]);
    }
}
