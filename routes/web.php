<?php

use App\Http\Controllers\AppPageController;
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

Route::get('/', [AppPageController::class, 'show'])->name('web.home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AppPageController::class, 'show'])->name('web.users.login');
    Route::get('/register', [AppPageController::class, 'show'])->name('web.users.register');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [AppPageController::class, 'show'])->name('web.users.dashboard');
    Route::get('/account', [AppPageController::class, 'show'])->name('web.users.account');
    Route::get('/{username}', [AppPageController::class, 'show'])->name('web.users.user-profile');
});
