<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSku;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if($categories->count() == 0) return;

        $products = [
            ['name' => 'Peri Peri Makhana', 'cat' => 'savory', 'desc' => 'Spicy and tangy African bird\'s eye chili flavor.', 'price' => 149],
            ['name' => 'Cream & Onion Makhana', 'cat' => 'savory', 'desc' => 'Classic sour cream and onion blend.', 'price' => 149],
            ['name' => 'Mint & Lemon Makhana', 'cat' => 'savory', 'desc' => 'Refreshing mint with a twist of lemon.', 'price' => 149],
            ['name' => 'Cheese & Herbs Makhana', 'cat' => 'savory', 'desc' => 'Rich cheddar with italian herbs.', 'price' => 179],
            ['name' => 'Truffle & Parmesan Makhana', 'cat' => 'gourmet', 'desc' => 'Luxurious truffle oil and aged parmesan.', 'price' => 249],
            ['name' => 'Caramel Crunch Makhana', 'cat' => 'sweet', 'desc' => 'Coated in rich buttery caramel.', 'price' => 199],
            ['name' => 'Dark Chocolate Makhana', 'cat' => 'sweet', 'desc' => 'Dipped in 70% dark Belgian chocolate.', 'price' => 229],
            ['name' => 'Himalayan Pink Salt Makhana', 'cat' => 'roasted-makhana', 'desc' => 'Simply roasted with pink salt.', 'price' => 129],
            ['name' => 'Wasabi Makhana', 'cat' => 'gourmet', 'desc' => 'Intense Japanese horseradish kick.', 'price' => 189],
            ['name' => 'Jaggery & Sesame Makhana', 'cat' => 'sweet', 'desc' => 'Traditional Indian sweet flavor.', 'price' => 149],
        ];

        foreach ($products as $p) {
            $cat = Category::firstOrCreate(
                ['slug' => $p['cat']],
                ['name' => ucwords(str_replace('-', ' ', $p['cat'])), 'sort_order' => rand(1,10)]
            );
            
            $product = Product::create([
                'category_id' => $cat->id,
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'short_description' => $p['desc'],
                'description' => 'Experience the perfect crunch with our ' . $p['name'] . '. Made from the finest fox nuts sourced directly from Bihar, slow roasted to perfection and tossed in premium ingredients.',
                'ingredients' => 'Phool Makhana, Olive Oil, Natural Flavors, Spices, Salt.',
                'is_active' => true,
                'is_featured' => true,
            ]);

            // Create SKUs with Weights
            $weights = [
                ['name' => '100g', 'price_multiplier' => 1],
                ['name' => '250g', 'price_multiplier' => 2.2],
                ['name' => '500g', 'price_multiplier' => 4],
            ];
            
            $variantType = \App\Models\VariantType::firstOrCreate(['name' => 'Weight']);

            foreach ($weights as $index => $w) {
                $sku = ProductSku::create([
                    'product_id' => $product->id,
                    'sku_code' => strtoupper(Str::random(5)) . '-' . $w['name'],
                    'name' => $w['name'],
                    'mrp' => round(($p['price'] * $w['price_multiplier']) + 50),
                    'sale_price' => round($p['price'] * $w['price_multiplier']),
                    'stock_qty' => rand(50, 200),
                    'is_active' => true,
                    'is_default' => $index === 0
                ]);
                
                $opt = \App\Models\VariantOption::firstOrCreate([
                    'variant_type_id' => $variantType->id, 
                    'value' => $w['name']
                ]);
                
                \Illuminate\Support\Facades\DB::table('product_sku_options')->insert([
                    'product_sku_id' => $sku->id,
                    'variant_option_id' => $opt->id
                ]);
            }
        }
    }
}
