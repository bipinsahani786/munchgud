<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\VariantType;

    class VariantTypeSeeder extends Seeder
    {
        public function run(): void
        {
            VariantType::updateOrCreate(['slug' => 'flavour'], ['name' => 'Flavour']);
            VariantType::updateOrCreate(['slug' => 'weight'], ['name' => 'Weight']);
            VariantType::updateOrCreate(['slug' => 'pack-size'], ['name' => 'Pack Size']);
        }
    }