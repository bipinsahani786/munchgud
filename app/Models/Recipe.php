<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category', 'time', 'difficulty', 'image',
        'description', 'featured', 'ingredients', 'steps', 
        'author_name', 'author_email', 'status'
    ];

    protected $casts = [
        'ingredients' => 'array',
        'steps' => 'array',
        'featured' => 'boolean'
    ];
}
