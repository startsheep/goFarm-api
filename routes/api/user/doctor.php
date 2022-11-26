<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user/doctor')->group(function () {
    Route::put('/update-status/{id}', [DoctorController::class, 'updateStatus'])->name('api.user.doctor.update.status');
});
