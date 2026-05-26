<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceableZone extends Model
{
    protected $fillable = [
        'state',
        'pincodes',
        'is_active',
        'cod_available',
        'delivery_days',
        'extra_shipping',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'cod_available' => 'boolean',
        'extra_shipping' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if a given pincode is serviceable.
     */
    public static function forPincode(string $pincode): ?self
    {
        $zones = self::active()->get();
        
        foreach ($zones as $zone) {
            if (empty($zone->pincodes)) {
                // Ignore zones with no pincodes configured to enforce strict checking
                continue;
            }
            $pins = array_map('trim', explode(',', $zone->pincodes));
            if (in_array($pincode, $pins)) {
                return $zone;
            }
        }
        
        return null;
    }

    /**
     * Get all Indian states.
     */
    public static function indianStates(): array
    {
        return [
            'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar',
            'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana',
            'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala',
            'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya',
            'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
            'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana',
            'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal',
            // Union Territories
            'Andaman and Nicobar Islands', 'Chandigarh',
            'Dadra and Nagar Haveli and Daman and Diu',
            'Delhi', 'Jammu and Kashmir', 'Ladakh',
            'Lakshadweep', 'Puducherry',
        ];
    }
}
