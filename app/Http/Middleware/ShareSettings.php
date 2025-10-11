<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class ShareSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            $allSettings = Setting::all()->keyBy('key');
            
            return [
                'site_name' => $allSettings->get('site_name')?->value ?? 'Online Tools',
                'site_tagline' => $allSettings->get('site_tagline')?->value ?? 'Your All-in-One Tool Collection',
                'site_description' => $allSettings->get('site_description')?->value ?? '',
                'logo' => $allSettings->get('logo')?->value ?? '',
                'favicon' => $allSettings->get('favicon')?->value ?? '',
                'contact_email' => $allSettings->get('contact_email')?->value ?? '',
                'contact_phone' => $allSettings->get('contact_phone')?->value ?? '',
                'address' => $allSettings->get('address')?->value ?? '',
                'facebook' => $allSettings->get('facebook')?->value ?? '',
                'twitter' => $allSettings->get('twitter')?->value ?? '',
                'instagram' => $allSettings->get('instagram')?->value ?? '',
                'linkedin' => $allSettings->get('linkedin')?->value ?? '',
            ];
        });

        Inertia::share('settings', $settings);

        return $next($request);
    }
}
