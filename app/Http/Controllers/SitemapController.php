<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate and return the sitemap.
     */
    public function index(): Response
    {
        try {
            $tools = Tool::where('is_active', 1)->get();
            $categories = Category::where('is_active', 1)->get();

            $baseUrl = config('app.url');

            $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

            // Homepage
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($baseUrl . '/') . '</loc>' . "\n";
            $xml .= '    <changefreq>daily</changefreq>' . "\n";
            $xml .= '    <priority>1.0</priority>' . "\n";
            $xml .= '  </url>' . "\n";

            // Categories
            foreach ($categories as $category) {
                $xml .= '  <url>' . "\n";
                $xml .= '    <loc>' . htmlspecialchars($baseUrl . '/categories/' . $category->slug) . '</loc>' . "\n";
                $xml .= '    <changefreq>weekly</changefreq>' . "\n";
                $xml .= '    <priority>0.8</priority>' . "\n";
                $xml .= '  </url>' . "\n";
            }

            // Tools
            foreach ($tools as $tool) {
                $xml .= '  <url>' . "\n";
                $xml .= '    <loc>' . htmlspecialchars($baseUrl . '/tools/' . $tool->slug) . '</loc>' . "\n";
                $xml .= '    <changefreq>monthly</changefreq>' . "\n";
                $xml .= '    <priority>0.9</priority>' . "\n";
                $xml .= '  </url>' . "\n";
            }

            $xml .= '</urlset>';

            return response($xml, 200)
                ->header('Content-Type', 'text/xml; charset=utf-8');
                
        } catch (\Exception $e) {
            return response('Error generating sitemap: ' . $e->getMessage(), 500)
                ->header('Content-Type', 'text/plain');
        }
    }
}
