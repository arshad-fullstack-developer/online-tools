<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Get a setting value by key.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            
            if (!$setting) {
                return $default;
            }

            return match ($setting->type) {
                'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                'json' => json_decode($setting->value, true),
                default => $setting->value,
            };
        });
    }

    /**
     * Set a setting value.
     */
    public static function set(string $key, mixed $value, string $type = 'text', string $group = 'general'): void
    {
        $valueToStore = match ($type) {
            'boolean' => $value ? '1' : '0',
            'json' => json_encode($value),
            default => $value,
        };

        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $valueToStore,
                'type' => $type,
                'group' => $group,
            ]
        );

        Cache::forget("setting.{$key}");
    }

    /**
     * Get all settings by group.
     */
    public static function getByGroup(string $group): array
    {
        return Cache::rememberForever("settings.group.{$group}", function () use ($group) {
            return static::where('group', $group)
                ->get()
                ->mapWithKeys(function ($setting) {
                    $value = match ($setting->type) {
                        'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                        'json' => json_decode($setting->value, true),
                        default => $setting->value,
                    };
                    
                    return [$setting->key => $value];
                })
                ->toArray();
        });
    }
}
