<?php

namespace App\Filament\Helpers;

use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ImageHelper
{
    /**
     * Resolve an image path to a full URL.
     * Handles both legacy paths (frontend/images/...) and storage paths (hero-slides/...).
     */
    public static function resolveUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        // Already a full URL
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Legacy paths in public/ directory (seeded data)
        if (str_starts_with($path, 'frontend/') || str_starts_with($path, '/frontend/')) {
            return asset(ltrim($path, '/'));
        }

        // Storage disk paths (new uploads via Filament)
        return asset('storage/' . $path);
    }

    /**
     * Create a Placeholder component that shows a preview of the current image.
     */
    public static function preview(string $field, string $label = 'Imagen actual'): Placeholder
    {
        return Placeholder::make($field . '_preview')
            ->label($label)
            ->content(function ($record) use ($field) {
                $path = $record?->{$field};
                $url = self::resolveUrl($path);
                if (!$url) {
                    return new HtmlString('<span class="text-sm text-gray-400">Sin imagen</span>');
                }

                return new HtmlString(
                    '<img src="' . e($url) . '" class="max-h-48 rounded-lg border border-gray-200 object-contain" alt="' . e($field) . '">'
                );
            })
            ->visible(fn ($record) => $record !== null);
    }
}
