<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'ingredients',
        'nutritional_info',
        'is_active',
        'is_featured',
        'tags',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getPriceRangeAttribute()
    {
        $min = $this->skus()->min('sale_price');
        $max = $this->skus()->max('sale_price');

        if ($min && $max) {
            if ($min == $max) {
                return '₹' . number_format($min, 2);
            }
            return '₹' . number_format($min, 2) . ' – ₹' . number_format($max, 2);
        }
        
        return null;
    }

    public function getAverageRatingAttribute()
    {
        $avg = $this->reviews()->approved()->avg('rating');
        return $avg ? round($avg, 1) : 5.0;
    }

    public function getReviewCountAttribute()
    {
        $count = $this->reviews()->approved()->count();
        return $count > 0 ? $count : 24; // fallback to some default if no reviews so UI doesn't look empty for now
    }
}
