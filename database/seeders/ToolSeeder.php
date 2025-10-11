<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $textCategory = Category::where('slug', 'text-tools')->first();
        $dateCategory = Category::where('slug', 'date-time-tools')->first();
        $financeCategory = Category::where('slug', 'finance-tools')->first();
        $devCategory = Category::where('slug', 'developer-tools')->first();

        $tools = [
            // Text & String Tools
            [
                'category_id' => $textCategory->id,
                'name' => 'Word Counter',
                'slug' => 'word-counter',
                'description' => 'Count words, characters, sentences, and paragraphs in your text instantly.',
                'content' => '<h2>How to Use Word Counter</h2><p>Simply paste or type your text into the input box, and the tool will automatically count words, characters, sentences, and paragraphs in real-time.</p><h3>Features</h3><ul><li>Real-time counting</li><li>Character count with and without spaces</li><li>Sentence and paragraph count</li><li>Reading time estimation</li></ul>',
                'icon' => 'type',
                'component_name' => 'WordCounter',
                'order' => 1,
                'is_featured' => true,
                'meta_title' => 'Word Counter - Free Online Word & Character Counter',
                'meta_description' => 'Free online word counter tool. Count words, characters, sentences, and paragraphs instantly. Perfect for writers, students, and content creators.',
                'meta_keywords' => 'word counter, character counter, text counter, word count tool',
                'schema_markup' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebApplication',
                    'name' => 'Word Counter',
                    'description' => 'Count words, characters, sentences, and paragraphs in your text instantly.',
                    'applicationCategory' => 'UtilitiesApplication',
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                    ],
                ],
            ],
            [
                'category_id' => $textCategory->id,
                'name' => 'Text Case Converter',
                'slug' => 'text-case-converter',
                'description' => 'Convert text to uppercase, lowercase, title case, sentence case, and more.',
                'content' => '<h2>How to Use Text Case Converter</h2><p>Enter your text and choose from various case conversion options including uppercase, lowercase, title case, sentence case, and alternating case.</p>',
                'icon' => 'text',
                'component_name' => 'TextCaseConverter',
                'order' => 2,
                'meta_title' => 'Text Case Converter - Convert Text to Upper, Lower, Title Case',
                'meta_description' => 'Free online text case converter. Convert text to uppercase, lowercase, title case, sentence case instantly.',
                'meta_keywords' => 'text case converter, uppercase, lowercase, title case, sentence case',
            ],
            [
                'category_id' => $textCategory->id,
                'name' => 'JSON Formatter',
                'slug' => 'json-formatter',
                'description' => 'Format and validate JSON data with syntax highlighting.',
                'content' => '<h2>How to Use JSON Formatter</h2><p>Paste your JSON data into the input box. The tool will automatically format, validate, and highlight the syntax.</p>',
                'icon' => 'braces',
                'component_name' => 'JsonFormatter',
                'order' => 3,
                'meta_title' => 'JSON Formatter - Format & Validate JSON Online',
                'meta_description' => 'Free online JSON formatter and validator. Format, beautify, and validate JSON data with syntax highlighting.',
                'meta_keywords' => 'json formatter, json validator, json beautifier, format json',
            ],
            [
                'category_id' => $textCategory->id,
                'name' => 'Slug Generator',
                'slug' => 'slug-generator',
                'description' => 'Generate SEO-friendly URL slugs from any text.',
                'content' => '<h2>How to Use Slug Generator</h2><p>Enter your text or title, and the tool will automatically generate a clean, SEO-friendly URL slug.</p>',
                'icon' => 'link',
                'component_name' => 'SlugGenerator',
                'order' => 4,
                'meta_title' => 'Slug Generator - Create SEO-Friendly URL Slugs',
                'meta_description' => 'Free online slug generator. Create clean, SEO-friendly URL slugs from any text instantly.',
                'meta_keywords' => 'slug generator, url slug, seo slug, permalink generator',
            ],

            // Date & Time Tools
            [
                'category_id' => $dateCategory->id,
                'name' => 'Age Calculator',
                'slug' => 'age-calculator',
                'description' => 'Calculate your exact age in years, months, days, hours, and minutes.',
                'content' => '<h2>How to Use Age Calculator</h2><p>Enter your date of birth and optionally a target date. The calculator will show your exact age in years, months, days, hours, minutes, and seconds.</p>',
                'icon' => 'cake',
                'component_name' => 'AgeCalculator',
                'order' => 1,
                'is_featured' => true,
                'meta_title' => 'Age Calculator - Calculate Your Exact Age Online',
                'meta_description' => 'Free online age calculator. Calculate your exact age in years, months, days, hours, and minutes from your date of birth.',
                'meta_keywords' => 'age calculator, calculate age, age in days, age in months, date of birth calculator',
            ],
            [
                'category_id' => $dateCategory->id,
                'name' => 'Date Difference Calculator',
                'slug' => 'date-difference-calculator',
                'description' => 'Calculate the difference between two dates in various units.',
                'content' => '<h2>How to Use Date Difference Calculator</h2><p>Select two dates and the tool will calculate the exact difference in years, months, weeks, days, hours, and minutes.</p>',
                'icon' => 'calendar-range',
                'component_name' => 'DateDifferenceCalculator',
                'order' => 2,
                'meta_title' => 'Date Difference Calculator - Calculate Days Between Dates',
                'meta_description' => 'Free online date difference calculator. Calculate the exact difference between two dates in years, months, weeks, and days.',
                'meta_keywords' => 'date difference calculator, days between dates, date calculator, time difference',
            ],

            // Finance Tools
            [
                'category_id' => $financeCategory->id,
                'name' => 'Discount Calculator',
                'slug' => 'discount-calculator',
                'description' => 'Calculate discounts, final prices, and savings instantly.',
                'content' => '<h2>How to Use Discount Calculator</h2><p>Enter the original price and discount percentage to calculate the final price and amount saved.</p>',
                'icon' => 'percent',
                'component_name' => 'DiscountCalculator',
                'order' => 1,
                'is_featured' => true,
                'meta_title' => 'Discount Calculator - Calculate Sale Price & Savings',
                'meta_description' => 'Free online discount calculator. Calculate final price, discount amount, and savings percentage instantly.',
                'meta_keywords' => 'discount calculator, sale price calculator, percentage off calculator, savings calculator',
            ],
            [
                'category_id' => $financeCategory->id,
                'name' => 'Loan EMI Calculator',
                'slug' => 'loan-emi-calculator',
                'description' => 'Calculate monthly EMI, total interest, and loan repayment schedule.',
                'content' => '<h2>How to Use Loan EMI Calculator</h2><p>Enter loan amount, interest rate, and tenure to calculate your monthly EMI and total interest payable.</p>',
                'icon' => 'calculator',
                'component_name' => 'LoanEmiCalculator',
                'order' => 2,
                'meta_title' => 'Loan EMI Calculator - Calculate Monthly EMI Online',
                'meta_description' => 'Free online loan EMI calculator. Calculate monthly installments, total interest, and repayment schedule for home, car, and personal loans.',
                'meta_keywords' => 'emi calculator, loan calculator, home loan emi, car loan calculator, personal loan emi',
            ],

            // Developer Tools
            [
                'category_id' => $devCategory->id,
                'name' => 'Base64 Encoder/Decoder',
                'slug' => 'base64-encoder-decoder',
                'description' => 'Encode and decode Base64 strings instantly.',
                'content' => '<h2>How to Use Base64 Encoder/Decoder</h2><p>Enter your text to encode it to Base64, or paste Base64 string to decode it back to plain text.</p>',
                'icon' => 'binary',
                'component_name' => 'Base64Tool',
                'order' => 1,
                'meta_title' => 'Base64 Encoder/Decoder - Encode & Decode Base64 Online',
                'meta_description' => 'Free online Base64 encoder and decoder. Convert text to Base64 and decode Base64 strings instantly.',
                'meta_keywords' => 'base64 encoder, base64 decoder, encode base64, decode base64',
            ],
            [
                'category_id' => $devCategory->id,
                'name' => 'Password Generator',
                'slug' => 'password-generator',
                'description' => 'Generate strong, secure random passwords.',
                'content' => '<h2>How to Use Password Generator</h2><p>Customize password length and character types (uppercase, lowercase, numbers, symbols) to generate secure random passwords.</p>',
                'icon' => 'key',
                'component_name' => 'PasswordGenerator',
                'order' => 2,
                'is_featured' => true,
                'meta_title' => 'Password Generator - Create Strong Random Passwords',
                'meta_description' => 'Free online password generator. Create strong, secure random passwords with customizable length and character types.',
                'meta_keywords' => 'password generator, random password, strong password, secure password generator',
            ],
            [
                'category_id' => $textCategory->id,
                'name' => 'AI Content Detector',
                'slug' => 'ai-content-detector',
                'description' => 'Detect if text is written by AI or human with advanced analysis. Professional accuracy like ZeroGPT.',
                'content' => '<h2>How to Use AI Content Detector</h2><p>Paste your text (minimum 100 characters) into the input box and click "Detect AI Content". Our advanced algorithm analyzes multiple metrics to determine if the content was written by AI or human.</p><h3>Features</h3><ul><li>Advanced multi-metric analysis</li><li>Perplexity and burstiness detection</li><li>Vocabulary diversity analysis</li><li>Sentence complexity evaluation</li><li>Pattern consistency checking</li><li>Detailed breakdown of indicators</li><li>Professional accuracy</li></ul><h3>What We Analyze</h3><ul><li><strong>Perplexity:</strong> Measures text predictability</li><li><strong>Burstiness:</strong> Evaluates sentence variation</li><li><strong>Vocabulary Diversity:</strong> Checks word usage patterns</li><li><strong>Sentence Complexity:</strong> Analyzes structure consistency</li><li><strong>Pattern Consistency:</strong> Detects automated patterns</li><li><strong>Repetition Index:</strong> Identifies repeated phrases</li></ul>',
                'icon' => 'cpu',
                'component_name' => 'AIContentDetector',
                'order' => 20,
                'is_featured' => true,
                'meta_title' => 'AI Content Detector - Detect AI Generated Text | Free Tool',
                'meta_description' => 'Free AI content detector tool. Detect if text is written by AI (ChatGPT, GPT-4, etc.) or human with professional accuracy. Advanced analysis like ZeroGPT.',
                'meta_keywords' => 'ai content detector, ai text detector, chatgpt detector, gpt detector, ai checker, zerogpt alternative',
                'schema_markup' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebApplication',
                    'name' => 'AI Content Detector',
                    'description' => 'Detect if text is written by AI or human with advanced analysis.',
                    'applicationCategory' => 'UtilitiesApplication',
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                    ],
                ],
            ],
        ];

        foreach ($tools as $tool) {
            Tool::create($tool);
        }
    }
}
