<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class LegalPagesSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'excerpt' => 'Learn how we collect, use, and protect your personal information.',
                'content' => '<h2>Privacy Policy</h2><p>Your privacy is important to us. This policy outlines how we handle your data.</p>',
                'is_active' => true,
                'show_in_menu' => false,
                'order' => 10,
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'excerpt' => 'Terms and conditions for using our services.',
                'content' => '<h2>Terms of Service</h2><p>By using our services, you agree to these terms and conditions.</p>',
                'is_active' => true,
                'show_in_menu' => false,
                'order' => 11,
            ],
            [
                'title' => 'Cookie Policy',
                'slug' => 'cookie-policy',
                'excerpt' => 'Information about how we use cookies.',
                'content' => '<h2>Cookie Policy</h2><p>We use cookies to improve your experience on our website.</p>',
                'is_active' => true,
                'show_in_menu' => false,
                'order' => 12,
            ],
            [
                'title' => 'Disclaimer',
                'slug' => 'disclaimer',
                'excerpt' => 'Important disclaimers about our services.',
                'content' => '<h2>Disclaimer</h2><p>The information provided on this website is for general informational purposes only.</p>',
                'is_active' => true,
                'show_in_menu' => false,
                'order' => 13,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}
