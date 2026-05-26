<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Category;

    class CategorySeeder extends Seeder
    {
        public function run(): void
        {
            Category::updateOrCreate(['slug' => 'makhana-snacks'], ['name' => 'Makhana Snacks', 'sort_order' => 1]);
            Category::updateOrCreate(['slug' => 'combo-packs'], ['name' => 'Combo Packs', 'sort_order' => 2]);
            Category::updateOrCreate(['slug' => 'gift-boxes'], ['name' => 'Gift Boxes', 'sort_order' => 3]);
        }
    }