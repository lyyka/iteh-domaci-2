<?php

namespace App\Services\Unsplash\Resources;

class UnsplashSearchResultResource
{
    public function __construct(
        private array $data
    )
    {
    }

    public function photoId(): string
    {
        return $this->data['id'];
    }

    public function downloadLink(): string
    {
        return $this->data['links']['download'];
    }
}
