<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\HomepageSection;
    use App\Models\Theme;

    class HomepageSectionSeeder extends Seeder
    {
        public function run(): void
        {
            $themeId = Theme::first()->id;

            HomepageSection::create([
                'theme_id' => $themeId,
                'type' => 'hero',
                'title' => 'Snack Guilt-Free. Feel Gud.',
                'subtitle' => 'Direct from Bihar Farms',
                'content' => ['cta1_text' => 'Shop Now', 'cta2_text' => 'Our Story'],
                'sort_order' => 1
            ]);

            HomepageSection::create([
                'theme_id' => $themeId,
                'type' => 'features',
                'title' => 'Why MunchGud?',
                'content' => ['features' => ['Roasted Not Fried', 'Protein Rich', 'Gluten Free']],
                'sort_order' => 2
            ]);
        }
    }