<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group'
    ];

    protected static function booted()
    {
        static::saved(function ($setting) {
            Cache::forget('global_settings');
        });

        static::deleted(function ($setting) {
            Cache::forget('global_settings');
        });
    }

    public static function allCached()
    {
        return Cache::rememberForever('global_settings', function () {
            return self::pluck('value', 'key')->toArray();
        });
    }

    public static function get(string $key, $default = null)
    {
        $settings = self::allCached();
        return $settings[$key] ?? $default;
    }
}
