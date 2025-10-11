<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class ToolController extends Controller
{
    /**
     * Display a listing of tools.
     */
    public function index(): Response
    {
        $tools = Tool::with('category')
            ->orderByDesc('created_at')
            ->paginate(20);

        return Inertia::render('Admin/Tools/Index', [
            'tools' => $tools,
        ]);
    }

    /**
     * Show the form for creating a new tool.
     */
    public function create(): Response
    {
        $categories = Category::active()->ordered()->get();

        return Inertia::render('Admin/Tools/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created tool.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:tools,slug',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string',
            'component_name' => 'required|string',
            'input_fields' => 'nullable|array',
            'output_fields' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'schema_markup' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Tool::create($validated);

        return redirect()->route('admin.tools.index')
            ->with('success', 'Tool created successfully.');
    }

    /**
     * Show the form for editing the specified tool.
     */
    public function edit(Tool $tool): Response
    {
        $categories = Category::active()->ordered()->get();

        return Inertia::render('Admin/Tools/Edit', [
            'tool' => $tool,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified tool.
     */
    public function update(Request $request, Tool $tool): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:tools,slug,' . $tool->id,
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string',
            'component_name' => 'required|string',
            'input_fields' => 'nullable|array',
            'output_fields' => 'nullable|array',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'schema_markup' => 'nullable|array',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $tool->update($validated);

        return redirect()->route('admin.tools.index')
            ->with('success', 'Tool updated successfully.');
    }

    /**
     * Remove the specified tool.
     */
    public function destroy(Tool $tool): RedirectResponse
    {
        $tool->delete();

        return redirect()->route('admin.tools.index')
            ->with('success', 'Tool deleted successfully.');
    }

    /**
     * Toggle tool active status.
     */
    public function toggleActive(Tool $tool): RedirectResponse
    {
        $tool->update(['is_active' => !$tool->is_active]);

        return back()->with('success', 'Tool status updated successfully.');
    }
}
