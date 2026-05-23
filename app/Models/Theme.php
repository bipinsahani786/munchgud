<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'primary_color',
        'secondary_color',
        'bg_color',
        'text_color',
        'heading_font',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public static function scopeActive($query)
    {
        return self::where('is_active', true)->first();
    }
}
