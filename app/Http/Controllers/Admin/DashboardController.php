<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use App\Models\ToolAnalytic;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): Response
    {
        $stats = [
            'total_tools' => Tool::count(),
            'active_tools' => Tool::active()->count(),
            'total_categories' => Category::count(),
            'total_views' => Tool::sum('view_count'),
            'total_usage' => Tool::sum('usage_count'),
        ];

        // Most used tools (last 30 days)
        $popularTools = Tool::active()
            ->with('category')
            ->orderByDesc('usage_count')
            ->limit(10)
            ->get();

        // Recent activity
        $recentActivity = ToolAnalytic::with('tool')
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'popularTools' => $popularTools,
            'recentActivity' => $recentActivity,
        ]);
    }
}
