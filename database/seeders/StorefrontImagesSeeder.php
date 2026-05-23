<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class StorefrontImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Home Page
        $home = Page::where('slug', 'home')->first();
        if ($home) {
            $sections = $home->sections ?? [];
            $sections['seo_image_1'] = $sections['seo_image_1'] ?? 'images/product_shot_new.png';
            $sections['seo_image_2'] = $sections['seo_image_2'] ?? 'images/story_farmer.png';
            $sections['seo_image_3'] = $sections['seo_image_3'] ?? 'images/ingredient_macro.png';
            $sections['story_farmer_image'] = $sections['story_farmer_image'] ?? 'images/story_farmer.png';
            $sections['brand_intro_image'] = $sections['brand_intro_image'] ?? 'images/hero_bg.png';
            $home->sections = $sections;
            $home->save();
        }

        // 2. Peri Peri Makhana
        $peri = Page::where('slug', 'peri-peri-makhana')->first();
        if ($peri) {
            $sections = $peri->sections ?? [];
            $sections['hero_image'] = $sections['hero_image'] ?? 'images/peri_peri_hero.png';
            $sections['quality_image'] = $sections['quality_image'] ?? 'images/peri_peri_quality.png';
            $sections['snack_image'] = $sections['snack_image'] ?? 'images/peri_peri_snack.jpeg';
            $peri->sections = $sections;
            $peri->save();
        }

        // 3. Cream and Onion
        $cream = Page::where('slug', 'cream-and-onion')->first();
        if ($cream) {
            $sections = $cream->sections ?? [];
            $sections['hero_image'] = $sections['hero_image'] ?? 'images/cream_onion_hero.png';
            $sections['quality_image'] = $sections['quality_image'] ?? 'images/cream_onion_quality.png';
            $sections['snack_image'] = $sections['snack_image'] ?? 'images/cream_onion_snack.png';
            $cream->sections = $sections;
            $cream->save();
        }
    }
}
