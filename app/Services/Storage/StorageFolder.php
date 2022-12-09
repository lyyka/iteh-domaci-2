<?php

namespace App\Services\Storage;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class StorageFolder
{
    public function __construct(
        private string $path,
        private string $disk = 'public'
    )
    {
    }

    public function path(?string $fileName = null): string
    {
        return "$this->path/$fileName";
    }

    public function disk(): string
    {
        return $this->disk;
    }

    public function diskAdapter(): Filesystem
    {
        return Storage::disk($this->disk());
    }
}
