<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tool;
use App\Models\Setting;
use App\Models\Page;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): Response
    {
        $categories = Category::active()
            ->ordered()
            ->withCount('activeTools')
            ->get();

        $featuredTools = Tool::active()
            ->featured()
            ->with('category')
            ->ordered()
            ->limit(6)
            ->get();

        $popularTools = Tool::active()
            ->popular()
            ->with('category')
            ->limit(6)
            ->get();

        // Get total tools count
        $totalTools = Tool::active()->count();

        // Get home page for SEO and content settings
        $homePage = Page::where('slug', 'home')->first();

        // Default content structure if no page exists
        $homeContent = [
            'hero_badge' => $homePage->hero_badge ?? '✨ 100% Free • No Registration Required',
            'hero_title' => $homePage->hero_title ?? 'Free Online Tools',
            'hero_subtitle' => $homePage->hero_subtitle ?? '& Calculators',
            'hero_description' => $homePage->hero_description ?? 'Powerful, easy-to-use tools for everyday tasks. From text manipulation to financial calculations - all in one place.',
            'categories_title' => $homePage->categories_title ?? 'Browse by Category',
            'categories_description' => $homePage->categories_description ?? 'Choose from our organized collection of tools designed for different needs',
            'featured_title' => $homePage->featured_title ?? 'Most Popular Tools',
            'featured_description' => $homePage->featured_description ?? 'Start with our most-used and highly-rated tools',
            'trending_title' => $homePage->trending_title ?? 'Trending Now',
            'trending_description' => $homePage->trending_description ?? 'See what others are using right now',
            'bottom_content' => $homePage->content ?? null,
        ];

        return Inertia::render('Home', [
            'categories' => $categories,
            'featuredTools' => $featuredTools,
            'popularTools' => $popularTools,
            'page' => $homePage,
            'homeContent' => $homeContent,
            'totalTools' => $totalTools,
        ]);
    }
}
