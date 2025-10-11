<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    /**
     * Display the specified category.
     */
    public function show(string $slug): Response
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $tools = $category->activeTools()
            ->ordered()
            ->get();

        return Inertia::render('Categories/Show', [
            'category' => $category,
            'tools' => $tools,
            'seo' => [
                'title' => $category->meta_title ?? $category->name,
                'description' => $category->meta_description ?? $category->description,
                'keywords' => $category->meta_keywords,
            ],
        ]);
    }
}
