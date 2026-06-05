<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type', // fixed or percent
        'value',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'is_active',
        'is_visible',
        'start_at',
        'end_at'
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'is_visible' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isValid(float $orderAmount): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->start_at && $this->start_at->isFuture()) {
            return false;
        }

        if ($this->end_at && $this->end_at->isPast()) {
            return false;
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($this->min_order_amount !== null && $orderAmount < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        $discount = 0;

        if ($this->type === 'fixed' || $this->type === 'flat') {
            $discount = min($this->value, $subtotal);
        } elseif ($this->type === 'percent') {
            $discount = round($subtotal * ($this->value / 100), 2);
        }

        if ($this->max_discount_amount !== null && $discount > $this->max_discount_amount) {
            $discount = $this->max_discount_amount;
        }

        return (float) $discount;
    }
}
