<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetColorController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetTypeController;
use App\Http\Controllers\UnsplashApiController;
use App\Http\Controllers\UserController;
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

Route::middleware(ForceJsonResponse::class)->group(function () {
    Route::prefix('/unsplash')->group(function () {
        Route::get('/search', [UnsplashApiController::class, 'search'])
            ->name('api.unsplash.search');
    });

    Route::middleware('guest:sanctum')->group(function () {
        Route::prefix('/user')->group(function () {
            Route::post('/register', [AuthController::class, 'register'])
                ->name('api.users.register');
            Route::post('/login', [AuthController::class, 'login'])
                ->name('api.users.login');
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('api.users.logout');

        Route::prefix('/user')->group(function () {
            Route::get('/get-profile-by-username', [UserController::class, 'getProfileByUsername'])
                ->name('api.users.get-profile-by-username');
            Route::put('/update', [UserController::class, 'update'])
                ->name('api.users.update');
            Route::get('/get-auth', [UserController::class, 'getAuth'])
                ->name('api.users.get-auth');
            Route::delete('/delete', [UserController::class, 'delete'])
                ->name('api.users.delete');
        });

        Route::prefix('/pet-types')->group(function () {
            Route::get('/all', [PetTypeController::class, 'all'])
                ->name('api.pet-types.all');
        });

        Route::prefix('/pet-colors')->group(function () {
            Route::get('/all', [PetColorController::class, 'all'])
                ->name('api.pet-colors.all');
        });

        Route::prefix('/pets')->group(function () {
            Route::get('/latest-pets', [PetController::class, 'latestPets'])
                ->name('api.pets.latest-pets');
            Route::get('/my-pets', [PetController::class, 'myPets'])
                ->name('api.pets.my-pets');
            Route::post('/create', [PetController::class, 'create'])
                ->name('api.pets.create');
            Route::put('/update', [PetController::class, 'update'])
                ->name('api.pets.update');
            Route::delete('/delete', [PetController::class, 'delete'])
                ->name('api.pets.delete');
        });
    });
});
