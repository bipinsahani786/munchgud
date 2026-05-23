<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{
    use HasFactory;

    protected $fillable = ['variant_type_id', 'value'];

    public function variantType()
    {
        return $this->belongsTo(VariantType::class);
    }

    public function skus()
    {
        return $this->belongsToMany(ProductSku::class, 'product_sku_options');
    }
}
