<?php

use App\Http\Controllers\Pages\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', DashboardController::class)->name('web.dashboard.index');
});
