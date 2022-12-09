<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function delete(Request $request, UserService $userService): JsonResponse
    {
        $userService->setUser(Auth::guard('web')->user())
            ->delete();
        $userService->logout($request);
        return response()->json(['success' => true]);
    }
}
