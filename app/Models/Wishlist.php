<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_sku_id'
    ];

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id')->with(['product', 'product.images']);
    }
}
