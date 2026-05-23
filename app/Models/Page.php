<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 
        'content', 'sections', 'is_active'
    ];

    protected $casts = [
        'sections' => 'array',
        'is_active' => 'boolean',
    ];
}
