<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Tool;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            $settingsData = Setting::all()->keyBy('key');
            return [
                'site_name' => $settingsData->get('site_name')?->value ?? 'Online Tools',
                'site_tagline' => $settingsData->get('site_tagline')?->value ?? 'Your All-in-One Tool Collection',
                'logo' => $settingsData->get('logo')?->value ?? null,
                'footer_logo' => $settingsData->get('footer_logo')?->value ?? null,
                'favicon' => $settingsData->get('favicon')?->value ?? null,
            ];
        });

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'settings' => $settings,
            'categories' => Category::active()->ordered()->get(['id', 'name', 'slug', 'icon']),
            'footerTools' => Tool::active()->ordered()->limit(8)->get(['id', 'name', 'slug']),
        ];
    }
}
