<?php

namespace App\Services\Unsplash;

use App\Services\Unsplash\Resources\UnsplashSearchResource;
use Exception;
use Illuminate\Support\Facades\Http;

class UnsplashService
{
    private string $baseUrl;
    private string $apiKey;
    private ?string $targetUrl = null;
    private array $query = [];

    public function __construct()
    {
        $this->baseUrl = 'https://api.unsplash.com';
        $this->apiKey = config('app.unsplashApiKey');
    }

    /**
     * @return $this
     */
    public function searchPhotos(string $query, int $page, int $perPage): UnsplashService
    {
        $this->targetUrl = "$this->baseUrl/search/photos";
        $this->query = ['query' => $query, 'page' => $page, 'per_page' => $perPage];
        return $this;
    }

    /**
     * @return UnsplashSearchResource
     * @throws Exception
     */
    public function get(): UnsplashSearchResource
    {
        if (!$this->targetUrl)
            throw new Exception("No target url set.");

        $response = Http::get($this->targetUrl, array_merge($this->query, [
            'client_id' => $this->apiKey
        ]))->json();

        return new UnsplashSearchResource($response);
    }
}
