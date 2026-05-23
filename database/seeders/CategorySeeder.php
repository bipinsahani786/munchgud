<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Category;

    class CategorySeeder extends Seeder
    {
        public function run(): void
        {
            Category::create(['name' => 'Makhana Snacks', 'slug' => 'makhana-snacks', 'sort_order' => 1]);
            Category::create(['name' => 'Combo Packs', 'slug' => 'combo-packs', 'sort_order' => 2]);
            Category::create(['name' => 'Gift Boxes', 'slug' => 'gift-boxes', 'sort_order' => 3]);
        }
    }