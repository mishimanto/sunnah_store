<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Media
{
    public static function url(?string $path): string
    {
        if (! $path) {
            return asset('images/logo.jpg');
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        if (Str::startsWith($path, ['images/', 'videos/'])) {
            return asset($path);
        }

        return Storage::disk('public')->url($path);
    }
}
