<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        
        return Inertia::render('Admin/Settings/Index', [
            'settings' => [
                'site_name' => $settings->get('site_name')?->value ?? 'Online Tools',
                'site_tagline' => $settings->get('site_tagline')?->value ?? 'Your All-in-One Tool Collection',
                'site_description' => $settings->get('site_description')?->value ?? '',
                'logo' => $settings->get('logo')?->value ?? '',
                'footer_logo' => $settings->get('footer_logo')?->value ?? '',
                'favicon' => $settings->get('favicon')?->value ?? '',
                'contact_email' => $settings->get('contact_email')?->value ?? '',
                'contact_phone' => $settings->get('contact_phone')?->value ?? '',
                'address' => $settings->get('address')?->value ?? '',
                'facebook' => $settings->get('facebook')?->value ?? '',
                'twitter' => $settings->get('twitter')?->value ?? '',
                'instagram' => $settings->get('instagram')?->value ?? '',
                'linkedin' => $settings->get('linkedin')?->value ?? '',
            ],
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'footer_logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        foreach ($validated as $key => $value) {
            if ($request->hasFile($key)) {
                // Handle file upload
                $oldSetting = Setting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    Storage::disk('public')->delete($oldSetting->value);
                }
                $value = $request->file($key)->store('settings', 'public');
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => $request->hasFile($key) ? 'image' : 'text']
            );
        }

        // Clear settings cache
        Cache::forget('site_settings');

        return back()->with('success', 'Settings updated successfully!');
    }
}
