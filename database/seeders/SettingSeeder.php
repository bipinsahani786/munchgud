<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Setting;

    class SettingSeeder extends Seeder
    {
        public function run(): void
        {
            Setting::updateOrCreate(['key' => 'site_name'], ['value' => 'MunchGud', 'group' => 'general']);
            Setting::updateOrCreate(['key' => 'contact_email'], ['value' => 'hello@munchgud.com', 'group' => 'general']);
            Setting::updateOrCreate(['key' => 'free_shipping_threshold'], ['value' => '999', 'group' => 'shipping']);
        }
    }