<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\ToolAnalytic;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ToolController extends Controller
{
    /**
     * Display the specified tool.
     */
    public function show(string $slug): Response
    {
        $tool = Tool::where('slug', $slug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        // Increment view count
        $tool->incrementViews();

        // Log analytics
        ToolAnalytic::log($tool->id, 'view');

        // Get related tools
        $relatedTools = $tool->relatedTools(6);

        $data = [
            'tool' => $tool,
            'relatedTools' => $relatedTools,
            'seo' => [
                'title' => $tool->meta_title ?? $tool->name,
                'description' => $tool->meta_description ?? $tool->description,
                'keywords' => $tool->meta_keywords,
                'schema' => $tool->schema_markup,
            ],
        ];

        // Add timezones data for TimeZoneConverter
        if ($slug === 'timezone-converter') {
            $data['timezones'] = \App\Models\Timezone::active()->ordered()->get();
            $data['popularTimezones'] = \App\Models\Timezone::active()->popular()->ordered()->get();
        }

        return Inertia::render('Tools/Show', $data);
    }

    /**
     * Log tool usage.
     */
    public function logUsage(Request $request, string $slug)
    {
        $tool = Tool::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $tool->incrementUsage();

        ToolAnalytic::log($tool->id, 'use', [
            'input' => $request->input('input'),
        ]);

        return response()->json(['success' => true]);
    }
}
