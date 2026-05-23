<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\VariantOption;
    use App\Models\VariantType;

    class VariantOptionSeeder extends Seeder
    {
        public function run(): void
        {
            $flavourId = VariantType::where('slug', 'flavour')->first()->id;
            $weightId = VariantType::where('slug', 'weight')->first()->id;
            $packId = VariantType::where('slug', 'pack-size')->first()->id;

            VariantOption::create(['variant_type_id' => $flavourId, 'value' => 'Peri Peri', 'display_value' => 'Peri Peri', 'color_hex' => '#E07B2A']);
            VariantOption::create(['variant_type_id' => $flavourId, 'value' => 'Cream & Onion', 'display_value' => 'Cream & Onion', 'color_hex' => '#2D6A4F']);

            VariantOption::create(['variant_type_id' => $weightId, 'value' => '50g', 'display_value' => '50g']);
            VariantOption::create(['variant_type_id' => $weightId, 'value' => '100g', 'display_value' => '100g']);

            VariantOption::create(['variant_type_id' => $packId, 'value' => 'Single', 'display_value' => 'Single Pack']);
            VariantOption::create(['variant_type_id' => $packId, 'value' => '3-Pack', 'display_value' => '3-Pack (Save 10%)']);
        }
    }