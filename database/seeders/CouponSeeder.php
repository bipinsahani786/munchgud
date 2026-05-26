<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Coupon;

    class CouponSeeder extends Seeder
    {
        public function run(): void
        {
            Coupon::updateOrCreate(
                ['code' => 'WELCOME10'],
                [
                    'type' => 'percent',
                    'value' => 10,
                    'min_order_amount' => 500,
                    'is_active' => true,
                ]
            );
        }
    }