<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
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
        // Debug: Log all incoming data
        Log::info('Settings Update Request', [
            'has_logo' => $request->hasFile('logo'),
            'has_footer_logo' => $request->hasFile('footer_logo'),
            'has_favicon' => $request->hasFile('favicon'),
            'all_files' => $request->allFiles(),
            'all_input' => $request->except(['logo', 'footer_logo', 'favicon']),
        ]);

        try {
            $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string',
            'logo' => 'nullable|image|max:5120',
            'footer_logo' => 'nullable|image|max:5120',
            'favicon' => 'nullable|image|max:2048',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        // File fields that should not be updated if null
        $fileFields = ['logo', 'footer_logo', 'favicon'];
        
        // Process file uploads first (they might not be in $validated if null)
        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                Log::info("Uploading file for: {$fileField}");
                $oldSetting = Setting::where('key', $fileField)->first();
                if ($oldSetting && $oldSetting->value) {
                    Storage::disk('public')->delete($oldSetting->value);
                }
                $filePath = $request->file($fileField)->store('settings', 'public');
                
                Setting::updateOrCreate(
                    ['key' => $fileField],
                    ['value' => $filePath, 'type' => 'file', 'group' => 'general']
                );
                
                Log::info("File uploaded successfully: {$fileField} = {$filePath}");
            }
        }

        // Process other fields (non-file fields only)
        foreach ($validated as $key => $value) {
            if (!in_array($key, $fileFields)) {
                // Only update non-file fields
                if ($value !== null && $value !== '') {
                    Setting::updateOrCreate(
                        ['key' => $key],
                        ['value' => $value, 'type' => 'text', 'group' => 'general']
                    );
                }
            }
        }

        // Clear all caches
        Cache::forget('site_settings');
        Cache::forget('favicon_setting');
        Cache::flush();

        return back()->with('success', 'Settings updated successfully!');
        
        } catch (\Exception $e) {
            Log::error('Settings update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withErrors(['error' => 'Failed to update settings: ' . $e->getMessage()]);
        }
    }
}
