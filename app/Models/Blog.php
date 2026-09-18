<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'image',
        'cover_image_link',
        'content',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = is_string($value) 
            ? preg_replace('/src=["\'](?:\.\.\/)+storage\//i', 'src="/storage/', $value) 
            : $value;
    }

    public function getContentAttribute($value)
    {
        return is_string($value) 
            ? preg_replace('/src=["\'](?:\.\.\/)+storage\//i', 'src="/storage/', $value) 
            : $value;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
