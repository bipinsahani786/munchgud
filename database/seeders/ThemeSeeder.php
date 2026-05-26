<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Theme;

    class ThemeSeeder extends Seeder
    {
        public function run(): void
        {
            Theme::updateOrCreate(
                ['name' => 'Classic Green'],
                [
                    'primary_color' => '#1B4332',
                    'secondary_color' => '#E07B2A',
                    'bg_color' => '#FAF7F0',
                    'text_color' => '#1A1A1A',
                    'heading_font' => 'Playfair Display',
                    'is_active' => true,
                ]
            );
        }
    }