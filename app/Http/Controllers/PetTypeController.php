<?php

namespace App\Http\Controllers;

use App\Enums\PetType;
use Illuminate\Http\JsonResponse;

class PetTypeController extends Controller
{
    public function all(): JsonResponse
    {
        return response()->json(PetType::all());
    }
}
