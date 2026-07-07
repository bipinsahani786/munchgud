<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShiprocketService;

class ShiprocketController extends Controller
{
    public function checkPincode(Request $request)
    {
        $request->validate([
            'pincode' => 'required|digits:6',
            'weight'  => 'nullable|numeric|min:0.1',
        ]);

        $pincode = $request->pincode;
        $weight  = (float) ($request->weight ?? config('shiprocket.default_weight', 0.5));

        // Try real Shiprocket API first
        if (config('shiprocket.email') && config('shiprocket.password')) {
            try {
                $shiprocket = app(ShiprocketService::class);
                $result = $shiprocket->checkServiceability($pincode, $weight);

                if (isset($result['serviceable'])) {
                    if ($result['serviceable'] === true) {
                        return response()->json([
                            'success'       => true,
                            'serviceable'   => true,
                            'delivery_date' => $result['delivery_date'],
                            'courier_name'  => $result['courier_name'],
                        ]);
                    } elseif ($result['serviceable'] === false) {
                        return response()->json([
                            'success'     => true,
                            'serviceable' => false,
                            'message'     => 'Sorry, we do not deliver to this pincode yet.',
                        ]);
                    }
                }
                // If null (API error), fall through to database check
            } catch (\Exception $e) {
                // Fall through to database check on exception
            }
        }

        // Fallback: Database serviceable zones / settings list
        $settingPincodes = \App\Models\Setting::get('serviceable_pincodes');

        $isServiceable = true;
        if (!empty($settingPincodes)) {
            $allowedPincodes = array_map('trim', explode(',', $settingPincodes));
            $isServiceable   = in_array($pincode, $allowedPincodes);
        }

        if ($isServiceable) {
            $deliveryDate = now()->addDays(rand(3, 5))->format('D, M j');
            return response()->json([
                'success'       => true,
                'serviceable'   => true,
                'delivery_date' => $deliveryDate,
                'courier_name'  => 'Our Courier Partner',
            ]);
        }

        return response()->json([
            'success'     => true,
            'serviceable' => false,
            'message'     => 'Sorry, we do not deliver to this pincode yet.',
        ]);
    }
}
