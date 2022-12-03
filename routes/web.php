<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest:sanctum', ForceJsonResponse::class])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])
            ->name('api.users.register');
    });

    Route::prefix('/user')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])
            ->name('api.users.login');
    });
});
