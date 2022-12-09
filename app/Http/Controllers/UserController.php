<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(UserUpdateRequest $request, UserService $userService): UserResource
    {
        $user = Auth::guard('web')->user();

        $userService->setUser($user)->update($request->toRegisterData());

        return new UserResource($user);
    }

    public function getAuth(): UserResource
    {
        return new UserResource(Auth::guard('web')->user());
    }

    public function delete(Request $request, UserService $userService): JsonResponse
    {
        $userService->setUser(Auth::guard('web')->user())
            ->delete();
        $userService->logout($request);
        return response()->json(['success' => true]);
    }
}
