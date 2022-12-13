<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnsplashApiSearchRequest;
use App\Services\Unsplash\UnsplashService;
use Exception;
use Illuminate\Http\JsonResponse;

class UnsplashApiController extends Controller
{
    /**
     * @param UnsplashApiSearchRequest $request
     * @param UnsplashService $unsplashService
     * @return JsonResponse
     * @throws Exception
     */
    public function search(UnsplashApiSearchRequest $request, UnsplashService $unsplashService): JsonResponse
    {
        return response()->json(
            $unsplashService
                ->searchPhotos(
                    $request->input('search'),
                    $request->input('page'),
                    $request->input('per_page'),
                )
                ->get()
                ->raw()
        );
    }
}
