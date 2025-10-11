<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of pages.
     */
    public function index(): Response
    {
        $pages = Page::orderBy('order')->paginate(20);

        return Inertia::render('Admin/Pages/Index', [
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for creating a new page.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Pages/Create');
    }

    /**
     * Store a newly created page.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'show_in_menu' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|string',
            'schema_markup' => 'nullable|string',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Show the form for editing the page.
     */
    public function edit(Page $page): Response
    {
        return Inertia::render('Admin/Pages/Edit', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified page.
     */
    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'hero_badge' => 'nullable|string',
            'hero_title' => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_description' => 'nullable|string',
            'categories_title' => 'nullable|string',
            'categories_description' => 'nullable|string',
            'featured_title' => 'nullable|string',
            'featured_description' => 'nullable|string',
            'trending_title' => 'nullable|string',
            'trending_description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'show_in_menu' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|string',
            'schema_markup' => 'nullable|string',
        ]);

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified page.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    /**
     * Toggle page active status
     */
    public function toggleActive(Page $page): RedirectResponse
    {
        $page->update(['is_active' => !$page->is_active]);

        return back()->with('success', 'Page status updated successfully.');
    }
}
