<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\Category;
use Illuminate\Database\Seeder;

class HtmlFormatterSeeder extends Seeder
{
    public function run(): void
    {
        $devCategory = Category::where('slug', 'developer-tools')->first();

        // Check if tool already exists
        $existingTool = Tool::where('slug', 'html-formatter')->first();
        
        if ($existingTool) {
            echo "HTML Formatter tool already exists!\n";
            return;
        }

        Tool::create([
            'category_id' => $devCategory->id,
            'name' => 'HTML Formatter',
            'slug' => 'html-formatter',
            'description' => 'Format and beautify messy HTML code into clean, readable structure with proper indentation.',
            'content' => '<h2>How to Use HTML Formatter</h2><p>Paste your messy or minified HTML code into the input box and click "Format HTML". The tool will automatically format it with proper indentation and structure.</p><h3>Features</h3><ul><li>Auto indentation with customizable spacing</li><li>Line wrapping for long lines</li><li>Preserve or normalize newlines</li><li>Handle inline elements properly</li><li>Copy formatted code to clipboard</li><li>Download as HTML file</li><li>Sample HTML for testing</li></ul><h3>Options</h3><ul><li><strong>Indent Size:</strong> Number of spaces for each indentation level (2-8)</li><li><strong>Wrap Line Length:</strong> Maximum line length before wrapping (0 = no wrap)</li><li><strong>Preserve Newlines:</strong> Keep existing line breaks</li><li><strong>Keep Inline Elements:</strong> Don\'t break inline tags like span, a, strong</li></ul>',
            'icon' => 'code',
            'component_name' => 'HtmlFormatter',
            'order' => 30,
            'is_featured' => true,
            'meta_title' => 'HTML Formatter & Beautifier - Format HTML Code Online Free',
            'meta_description' => 'Free online HTML formatter and beautifier. Format messy HTML code into clean, readable structure with proper indentation. Copy or download formatted HTML.',
            'meta_keywords' => 'html formatter, html beautifier, format html, beautify html, html indenter, html pretty print',
            'schema_markup' => [
                '@context' => 'https://schema.org',
                '@type' => 'WebApplication',
                'name' => 'HTML Formatter',
                'description' => 'Format and beautify messy HTML code into clean, readable structure.',
                'applicationCategory' => 'DeveloperApplication',
                'offers' => [
                    '@type' => 'Offer',
                    'price' => '0',
                    'priceCurrency' => 'USD',
                ],
            ],
        ]);

        echo "HTML Formatter tool created successfully!\n";
    }
}
