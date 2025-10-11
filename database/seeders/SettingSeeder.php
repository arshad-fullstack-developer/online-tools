<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Online Tools', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Free Online Tools & Calculators', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Collection of free online tools including calculators, converters, and formatters.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => 'contact@example.com', 'type' => 'text', 'group' => 'general'],
            
            // SEO Settings
            ['key' => 'default_meta_title', 'value' => 'Online Tools - Free Calculators & Converters', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'default_meta_description', 'value' => 'Free online tools including calculators, text tools, date calculators, and developer utilities.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'default_meta_keywords', 'value' => 'online tools, calculators, converters, free tools, utilities', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'seo'],
            
            // Monetization Settings
            ['key' => 'adsense_enabled', 'value' => '0', 'type' => 'boolean', 'group' => 'monetization'],
            ['key' => 'adsense_client_id', 'value' => '', 'type' => 'text', 'group' => 'monetization'],
            ['key' => 'adsense_slot_id', 'value' => '', 'type' => 'text', 'group' => 'monetization'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
