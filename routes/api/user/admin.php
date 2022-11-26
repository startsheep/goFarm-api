<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user/admin')->group(function () {
    Route::put('/update-status/{id}', [AdminController::class, 'updateStatus'])->name('api.user.admin.update.status');
});
