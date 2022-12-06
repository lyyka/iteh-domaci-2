<?php

namespace App\Http\Controllers;

use App\Enums\PetColor;
use Illuminate\Http\JsonResponse;

class PetColorController extends Controller
{
    public function all(): JsonResponse
    {
        return response()->json(PetColor::all());
    }
}
