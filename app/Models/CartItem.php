<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'product_sku_id',
        'quantity'
    ];

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id')->with(['product', 'variantOptions']);
    }
}
