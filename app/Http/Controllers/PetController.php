<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetSearchRequest;
use App\Http\Requests\PetStoreRequest;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function all(Request $request, PetService $petService) : JsonResponse
    {
        $pets = $petService->getAll();
    }

    public function search(PetSearchRequest $request, PetService $petService) : JsonResponse
    {
        $pets = $petService->search($request->toSearchData());
    }

    public function create(PetStoreRequest $request, PetService $petService) : JsonResponse
    {
        $pet = $petService->save($request->toPetData());
    }

    public function update(PetStoreRequest $request, Pet $pet, PetService $petService) : JsonResponse
    {
        $pet = $petService->setPet($pet)->save($request->toPetData());
    }

    public function delete(Request $request, Pet $pet, PetService $petService) : JsonResponse
    {
        $petService->setPet($pet)->delete();
    }
}
