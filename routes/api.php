<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['guest:sanctum', ForceJsonResponse::class])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])
            ->name('api.users.register');
        Route::post('/login', [AuthController::class, 'login'])
            ->name('api.users.login');
    });
});

Route::middleware(['auth:sanctum', ForceJsonResponse::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('api.users.logout');

    Route::prefix('/pets')->group(function () {
        Route::get('/latest-pets', [PetController::class, 'latestPets'])
            ->name('api.pets.latest-pets');
        Route::get('/my-pets', [PetController::class, 'myPets'])
            ->name('api.pets.my-pets');
        Route::get('/search', [PetController::class, 'search'])
            ->name('api.pets.search');
        Route::post('/create', [PetController::class, 'create'])
            ->name('api.pets.create');
        Route::put('/{pet}/update', [PetController::class, 'update'])
            ->name('api.pets.update');
        Route::delete('/{pet}/delete', [PetController::class, 'delete'])
            ->name('api.pets.delete');
    });
});
