<?php

namespace App\Services\Unsplash\Resources;

use Illuminate\Support\Arr;
use InvalidArgumentException;

class UnsplashSearchResource
{
    public function __construct(
        private array $data
    )
    {
    }

    public function random(): ?UnsplashSearchResultResource
    {
        try {
            $data = Arr::random($this->data['results']);
        } catch (InvalidArgumentException $exception) {
            $data = null;
        }

        return $data ? new UnsplashSearchResultResource($data) : null;
    }

    public function raw(): array
    {
        return $this->data;
    }
}
