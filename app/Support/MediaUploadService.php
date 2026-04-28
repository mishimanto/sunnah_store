<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUploadService
{
    public function store(?UploadedFile $file, ?string $currentPath = null, string $directory = 'uploads'): ?string
    {
        if (! $file) {
            return $currentPath;
        }

        if ($currentPath && ! Str::startsWith($currentPath, ['images/', 'videos/', 'http://', 'https://', '/'])) {
            Storage::disk('public')->delete($currentPath);
        }

        return $file->store($directory, 'public');
    }
}
