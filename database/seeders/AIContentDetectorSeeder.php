<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AIContentDetectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $textCategory = Category::where('slug', 'text-tools')->first();

        // Check if tool already exists
        $existingTool = Tool::where('slug', 'ai-content-detector')->first();
        
        if ($existingTool) {
            echo "AI Content Detector tool already exists!\n";
            return;
        }

        Tool::create([
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
        ]);

        echo "AI Content Detector tool created successfully!\n";
    }
}
