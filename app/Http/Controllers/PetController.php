<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetSearchRequest;
use App\Http\Requests\PetStoreRequest;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PetController extends Controller
{
    /**
     * @param Request $request
     * @param PetService $petService
     * @return AnonymousResourceCollection
     */
    public function all(Request $request, PetService $petService): AnonymousResourceCollection
    {
        $pets = $petService->getAll();
        return PetResource::collection($pets);
    }

    public function search(PetSearchRequest $request, PetService $petService): JsonResponse
    {
        $pets = $petService->search($request->toSearchData());
    }

    public function create(PetStoreRequest $request, PetService $petService): JsonResponse
    {
        $pet = $petService->save($request->toPetData());
    }

    public function update(PetStoreRequest $request, Pet $pet, PetService $petService): JsonResponse
    {
        $pet = $petService->setPet($pet)->save($request->toPetData());
    }

    public function delete(Request $request, Pet $pet, PetService $petService): JsonResponse
    {
        $petService->setPet($pet)->delete();
    }
}
