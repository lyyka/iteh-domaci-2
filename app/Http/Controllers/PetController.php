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
    public function latestPets(Request $request, PetService $petService): AnonymousResourceCollection
    {
        $pets = $petService->getLatestPets(12);
        return PetResource::collection($pets);
    }

    /**
     * @param Request $request
     * @param PetService $petService
     * @return AnonymousResourceCollection
     */
    public function myPets(Request $request, PetService $petService): AnonymousResourceCollection
    {
        $pets = $petService->getAuthUsersPets();
        return PetResource::collection($pets);
    }

    /**
     * @param PetSearchRequest $request
     * @param PetService $petService
     * @return AnonymousResourceCollection
     */
    public function search(PetSearchRequest $request, PetService $petService): AnonymousResourceCollection
    {
        $pets = $petService->search($request->toSearchData());

        return PetResource::collection($pets);
    }

    /**
     * @param PetStoreRequest $request
     * @param PetService $petService
     * @return PetResource
     */
    public function create(PetStoreRequest $request, PetService $petService): PetResource
    {
        $pet = $petService->save($request->toPetData());

        return new PetResource($pet);
    }

    /**
     * @param PetStoreRequest $request
     * @param Pet $pet
     * @param PetService $petService
     * @return PetResource
     */
    public function update(PetStoreRequest $request, Pet $pet, PetService $petService): PetResource
    {
        $pet = $petService->setPet($pet)->save($request->toPetData());

        return new PetResource($pet);
    }

    public function delete(Request $request, Pet $pet, PetService $petService): JsonResponse
    {
        $petService->setPet($pet)->delete();

        return response()->json(['success' => true]);
    }
}
