<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Api\SitemapCrawlerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ToolController as AdminToolController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Blog Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Specific page routes (before dynamic route)
Route::get('/about', [PageController::class, 'show'])->defaults('slug', 'about');
Route::get('/tools', [PageController::class, 'show'])->defaults('slug', 'tools');
Route::get('/contact', [PageController::class, 'show'])->defaults('slug', 'contact');

// Tool routes (must come after /tools page route)
Route::get('/tools/{slug}', [ToolController::class, 'show'])->name('tools.show');
Route::post('/tools/{slug}/log-usage', [ToolController::class, 'logUsage'])->name('tools.log-usage');

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// API Routes
Route::post('/api/crawl-sitemap', [SitemapCrawlerController::class, 'crawl']);
Route::post('/api/detect-ai-content', [\App\Http\Controllers\Api\AIDetectionController::class, 'detectAIContent']);
Route::post('/api/contact', [\App\Http\Controllers\ContactController::class, 'submit']);

// Debug route - Remove after testing
Route::get('/debug-settings', function() {
    try {
        $settings = \App\Models\Setting::all();
        $logo = \App\Models\Setting::where('key', 'logo')->first();
        $footerLogo = \App\Models\Setting::where('key', 'footer_logo')->first();
        
        return '<h1>Settings Debug</h1>' .
               '<h2>Logo:</h2>' .
               '<p>Exists: ' . ($logo ? 'Yes' : 'No') . '</p>' .
               '<p>Value: ' . ($logo ? $logo->value : 'NULL') . '</p>' .
               '<h2>Footer Logo:</h2>' .
               '<p>Exists: ' . ($footerLogo ? 'Yes' : 'No') . '</p>' .
               '<p>Value: ' . ($footerLogo ? $footerLogo->value : 'NULL') . '</p>' .
               '<h2>All Settings:</h2>' .
               '<pre>' . print_r($settings->pluck('value', 'key')->toArray(), true) . '</pre>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Auth routes (must be before dynamic pages)
require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tools Management
    Route::resource('tools', AdminToolController::class);
    Route::post('/tools/{tool}/toggle-active', [AdminToolController::class, 'toggleActive'])->name('tools.toggle-active');

    // Categories Management
    Route::resource('categories', AdminCategoryController::class);

    // Pages Management
    Route::resource('pages', AdminPageController::class);
    Route::post('/pages/{page}/toggle-active', [AdminPageController::class, 'toggleActive'])->name('pages.toggle-active');

    // Blog Management
    Route::resource('blogs', AdminBlogController::class);
    Route::post('/blogs/{blog}/toggle-publish', [AdminBlogController::class, 'togglePublish'])->name('blogs.toggle-publish');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Contact Submissions
    Route::get('/contact-submissions', [ContactSubmissionController::class, 'index'])->name('contact-submissions.index');
    Route::get('/contact-submissions/{id}', [ContactSubmissionController::class, 'show'])->name('contact-submissions.show');
    Route::delete('/contact-submissions/{id}', [ContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');
    Route::post('/contact-submissions/{id}/mark-read', [ContactSubmissionController::class, 'markAsRead'])->name('contact-submissions.mark-read');
    Route::post('/contact-submissions/{id}/mark-unread', [ContactSubmissionController::class, 'markAsUnread'])->name('contact-submissions.mark-unread');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dynamic Pages (must be last to avoid conflicts with all other routes)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show')->where('slug', '[a-z0-9\-]+');
