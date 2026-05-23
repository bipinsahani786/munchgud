<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\VariantType;

    class VariantTypeSeeder extends Seeder
    {
        public function run(): void
        {
            VariantType::create(['name' => 'Flavour', 'slug' => 'flavour']);
            VariantType::create(['name' => 'Weight', 'slug' => 'weight']);
            VariantType::create(['name' => 'Pack Size', 'slug' => 'pack-size']);
        }
    }