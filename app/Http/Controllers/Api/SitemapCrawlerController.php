<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class SitemapCrawlerController extends Controller
{
    public function crawl(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'url' => 'required|url',
            'max_pages' => 'required|integer|min:1|max:1000',
            'include_images' => 'boolean',
        ]);

        $baseUrl = rtrim($validated['url'], '/');
        $maxPages = $validated['max_pages'];
        $includeImages = $validated['include_images'] ?? false;

        $discoveredUrls = [];
        $visitedUrls = [];
        $urlsToVisit = [$baseUrl];

        try {
            while (count($discoveredUrls) < $maxPages && count($urlsToVisit) > 0) {
                $currentUrl = array_shift($urlsToVisit);

                // Skip if already visited
                if (in_array($currentUrl, $visitedUrls)) {
                    continue;
                }

                $visitedUrls[] = $currentUrl;

                try {
                    // Fetch the page with timeout
                    $response = Http::timeout(10)->get($currentUrl);

                    if ($response->successful()) {
                        $html = $response->body();
                        
                        // Extract links from HTML
                        $newUrls = $this->extractLinks($html, $baseUrl);
                        
                        // Add current URL to discovered
                        $urlData = ['url' => $currentUrl];
                        
                        // Extract images if requested
                        if ($includeImages) {
                            $urlData['images'] = $this->extractImages($html, $baseUrl);
                        }
                        
                        $discoveredUrls[] = $urlData;

                        // Add new URLs to visit queue
                        foreach ($newUrls as $newUrl) {
                            if (!in_array($newUrl, $visitedUrls) && !in_array($newUrl, $urlsToVisit)) {
                                $urlsToVisit[] = $newUrl;
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Skip this URL if there's an error
                    continue;
                }

                // Prevent infinite loops
                if (count($visitedUrls) > $maxPages * 2) {
                    break;
                }
            }

            return response()->json([
                'success' => true,
                'urls' => array_slice($discoveredUrls, 0, $maxPages),
                'total_found' => count($discoveredUrls),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to crawl website: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function extractLinks(string $html, string $baseUrl): array
    {
        $links = [];
        $baseDomain = parse_url($baseUrl, PHP_URL_HOST);

        // Match all href attributes
        preg_match_all('/<a[^>]+href=["\'](.*?)["\']/', $html, $matches);

        foreach ($matches[1] as $link) {
            // Skip anchors, javascript, mailto, tel, etc.
            if (empty($link) || $link === '#' || 
                str_starts_with($link, 'javascript:') || 
                str_starts_with($link, 'mailto:') || 
                str_starts_with($link, 'tel:')) {
                continue;
            }

            // Convert relative URLs to absolute
            if (str_starts_with($link, '/')) {
                $link = $baseUrl . $link;
            } elseif (!str_starts_with($link, 'http://') && !str_starts_with($link, 'https://')) {
                $link = $baseUrl . '/' . $link;
            }

            // Only include URLs from the same domain
            $linkDomain = parse_url($link, PHP_URL_HOST);
            if ($linkDomain === $baseDomain) {
                // Remove query strings and fragments
                $link = strtok($link, '?');
                $link = strtok($link, '#');
                $links[] = $link;
            }
        }

        return array_unique($links);
    }

    private function extractImages(string $html, string $baseUrl): array
    {
        $images = [];

        // Match all img src attributes
        preg_match_all('/<img[^>]+src=["\'](.*?)["\']/', $html, $matches);

        foreach ($matches[1] as $img) {
            if (empty($img)) {
                continue;
            }

            // Convert relative URLs to absolute
            if (str_starts_with($img, '/')) {
                $img = $baseUrl . $img;
            } elseif (!str_starts_with($img, 'http://') && !str_starts_with($img, 'https://')) {
                $img = $baseUrl . '/' . $img;
            }

            // Only include images from the same domain
            $imgDomain = parse_url($img, PHP_URL_HOST);
            $baseDomain = parse_url($baseUrl, PHP_URL_HOST);
            
            if ($imgDomain === $baseDomain) {
                $images[] = $img;
            }
        }

        return array_unique(array_slice($images, 0, 10)); // Limit to 10 images per page
    }
}
