<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name('api.auth.login');

    Route::post('registration', RegistrationController::class)->name('api.auth.registration');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('authenticated', AuthenticatedController::class)->name('api.auth.authenticated');

        Route::post('logout', LogoutController::class)->name('api.auth.logout');
    });
});
