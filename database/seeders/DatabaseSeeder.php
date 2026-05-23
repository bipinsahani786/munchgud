<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        public function run(): void
        {
            $this->call([
                AdminSeeder::class,
                CategorySeeder::class,
                VariantTypeSeeder::class,
                VariantOptionSeeder::class,
                ThemeSeeder::class,
                HomepageSectionSeeder::class,
                CouponSeeder::class,
                SettingSeeder::class,
                ProductSeeder::class,
                InitialDataSeeder::class, // Master seeder populating pages, recipes, static text, blogs, and faqs
            ]);
        }
    }