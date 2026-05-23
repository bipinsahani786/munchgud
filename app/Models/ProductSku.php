<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku_code',
        'name',
        'mrp',
        'sale_price',
        'cost_price',
        'stock_qty',
        'low_stock_threshold',
        'is_active',
        'is_default'
    ];

    protected $casts = [
        'mrp' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variantOptions()
    {
        return $this->belongsToMany(VariantOption::class, 'product_sku_options');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'sku_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getIsLowStockAttribute()
    {
        return $this->stock_qty <= $this->low_stock_threshold && $this->stock_qty > 0;
    }

    public function getIsOutOfStockAttribute()
    {
        return $this->stock_qty <= 0;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_qty', '>', 0);
    }
}
