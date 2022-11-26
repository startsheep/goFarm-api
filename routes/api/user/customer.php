<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user/customer')->group(function () {
    Route::put('/update-status/{id}', [CustomerController::class, 'updateStatus'])->name('api.user.customer.update.status');
});
