<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, UserService $userService): JsonResponse
    {
        $user = $userService->register($request->toRegisterData());
        $userService->issueToken();

        if ($userService->login($user)) {
            $request->session()->regenerate();
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param LoginRequest $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function login(LoginRequest $request, UserService $userService): JsonResponse
    {
        $response = ['success' => false];
        $isLoggedIn = $userService->login($request->toCredentials());

        if ($isLoggedIn) {
            $request->session()->regenerate();
            $response = ['success' => true];
        }

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }
}
