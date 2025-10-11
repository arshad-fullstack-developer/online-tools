<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Text & String Tools',
                'slug' => 'text-tools',
                'description' => 'Powerful text manipulation and analysis tools',
                'icon' => 'type',
                'order' => 1,
                'meta_title' => 'Text & String Tools - Free Online Text Utilities',
                'meta_description' => 'Free online text tools including word counter, case converter, JSON formatter, and more.',
                'meta_keywords' => 'text tools, word counter, case converter, text utilities',
            ],
            [
                'name' => 'Date & Time Tools',
                'slug' => 'date-time-tools',
                'description' => 'Calculate dates, times, and durations easily',
                'icon' => 'calendar',
                'order' => 2,
                'meta_title' => 'Date & Time Tools - Free Online Date Calculators',
                'meta_description' => 'Free online date and time calculators including age calculator, date difference calculator, and more.',
                'meta_keywords' => 'date calculator, age calculator, time tools, date difference',
            ],
            [
                'name' => 'Finance Tools',
                'slug' => 'finance-tools',
                'description' => 'Financial calculators for everyday use',
                'icon' => 'dollar-sign',
                'order' => 3,
                'meta_title' => 'Finance Tools - Free Online Financial Calculators',
                'meta_description' => 'Free online financial calculators including discount calculator, loan calculator, EMI calculator, and more.',
                'meta_keywords' => 'finance calculator, loan calculator, EMI calculator, discount calculator',
            ],
            [
                'name' => 'Developer Tools',
                'slug' => 'developer-tools',
                'description' => 'Essential tools for developers',
                'icon' => 'code',
                'order' => 4,
                'meta_title' => 'Developer Tools - Free Online Development Utilities',
                'meta_description' => 'Free online developer tools including Base64 encoder/decoder, password generator, and more.',
                'meta_keywords' => 'developer tools, base64, password generator, encoding tools',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
