<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $guarded = [];

    public static function get(string $key, string $group = 'general', $default = null): mixed
    {
        return Cache::rememberForever("site_setting.{$group}.{$key}", function () use ($key, $group, $default) {
            $setting = static::where('group', $group)->where('key', $key)->first();
            return $setting?->value ?? $default;
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['value' => $value, 'type' => $type]
        );

        Cache::forget("site_setting.{$group}.{$key}");
        Cache::forget("site_settings.group.{$group}");
    }

    public static function getGroup(string $group): array
    {
        return Cache::rememberForever("site_settings.group.{$group}", function () use ($group) {
            return static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }
}
