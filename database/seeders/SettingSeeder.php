<?php

namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\Setting;

    class SettingSeeder extends Seeder
    {
        public function run(): void
        {
            Setting::create(['key' => 'site_name', 'value' => 'MunchGud', 'group' => 'general']);
            Setting::create(['key' => 'contact_email', 'value' => 'hello@munchgud.com', 'group' => 'general']);
            Setting::create(['key' => 'free_shipping_threshold', 'value' => '999', 'group' => 'shipping']);
        }
    }