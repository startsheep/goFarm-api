<?php

use App\Http\Controllers\Pages\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('web.auth.login.index');
    Route::post('login', [LoginController::class, 'process'])->name('web.auth.login.process');
});
