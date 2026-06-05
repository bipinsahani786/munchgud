<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Page;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $pagesData = [
            'home' => [
                'hero_image' => 'images/hero_bg.png',
                'seo_image_1' => 'images/product_shot_new.png',
                'seo_image_2' => 'images/story_farmer.png',
                'seo_image_3' => 'images/ingredient_macro.png',
                'bestseller_image' => 'images/ingredient_macro.png',
                'process_image' => 'images/story_farmer.png',
                'ingredients_image' => 'images/ingredient_macro.png',
                'story_farmer_image' => 'images/story_farmer.png',
                'brand_intro_image' => 'images/hero_bg.png',
            ],
            'story' => [
                'roots_image_main' => 'images/story_farmer.png',
                'heritage_image' => 'images/story_farmer.png',
                'philosophy_image' => 'images/story_farmer.png',
            ],
            'cream-and-onion' => [
                'hero_image' => 'images/cream_onion_hero.png',
                'quality_image' => 'images/cream_onion_quality.png',
                'snack_image' => 'images/cream_onion_snack.png',
            ],
            'peri-peri-makhana' => [
                'hero_image' => 'images/peri_peri_hero.png',
                'quality_image' => 'images/peri_peri_quality.png',
            ],
            'health-benefits' => [
                'hero_image' => 'images/ingredient_macro.png',
                'nutrition_image' => 'images/ingredient_macro.png',
            ]
        ];

        foreach ($pagesData as $slug => $newSections) {
            $page = Page::where('slug', $slug)->first();
            if ($page) {
                $sections = is_array($page->sections) ? $page->sections : [];
                $changed = false;
                foreach ($newSections as $key => $defaultImage) {
                    if (!isset($sections[$key])) {
                        $sections[$key] = $defaultImage;
                        $changed = true;
                    }
                }
                if ($changed) {
                    $page->sections = $sections;
                    $page->save();
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // For a data seeding migration, the down method is typically left empty 
        // as reverting it might remove images the user has legitimately set.
    }
};
