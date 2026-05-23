<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme_id',
        'type',
        'title',
        'subtitle',
        'content',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
