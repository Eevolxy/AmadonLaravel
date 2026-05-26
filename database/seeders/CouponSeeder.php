<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'PROMO10',
            'type' => 'percentage',
            'value' => 10,
            'min_order_amount' => 20,
            'usage_limit' => 100,
            'is_active' => true,
            'expires_at' => now()->addMonths(3),
        ]);

        Coupon::create([
            'code' => 'WELCOME5',
            'type' => 'fixed',
            'value' => 5,
            'min_order_amount' => 15,
            'usage_limit' => 50,
            'is_active' => true,
            'expires_at' => now()->addMonths(6),
        ]);

        Coupon::create([
            'code' => 'SUMMER25',
            'type' => 'percentage',
            'value' => 25,
            'min_order_amount' => 50,
            'usage_limit' => 30,
            'is_active' => true,
            'expires_at' => now()->addMonths(2),
        ]);
    }
}
