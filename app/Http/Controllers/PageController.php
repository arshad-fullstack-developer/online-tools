<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Tool;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    /**
     * Show dynamic page by slug
     */
    public function show(string $slug): Response
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Increment view count
        $page->incrementViews();

        // Special handling for tools page
        if ($slug === 'tools') {
            $categories = Category::with(['tools' => function ($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            return Inertia::render('Pages/DynamicPage', [
                'page' => $page,
                'categories' => $categories,
                'seo' => $page->getSeoData(),
                'isToolsPage' => true,
            ]);
        }

        return Inertia::render('Pages/DynamicPage', [
            'page' => $page,
            'seo' => $page->getSeoData(),
            'isToolsPage' => false,
        ]);
    }

    /**
     * Legacy routes - redirect to dynamic pages
     */
    public function about(): Response
    {
        return $this->show('about');
    }

    public function tools(): Response
    {
        return $this->show('tools');
    }

    public function blog(): Response
    {
        return $this->show('blog');
    }

    public function contact(): Response
    {
        return $this->show('contact');
    }
}
