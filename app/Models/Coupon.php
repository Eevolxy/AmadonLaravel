<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'expires_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'min_order_amount' => 'decimal:2',
            'expires_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Check if the coupon is valid for a given order total.
     */
    public function isValid(float $orderTotal = 0): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($orderTotal < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    /**
     * Calculate the discount amount for a given total.
     */
    public function calculateDiscount(float $total): float
    {
        if ($this->type === 'percentage') {
            return round($total * ($this->value / 100), 2);
        }

        return min($this->value, $total);
    }
}
