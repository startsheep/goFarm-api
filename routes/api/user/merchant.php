<?php

use App\Http\Controllers\MerchantController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user/merchant')->group(function () {
    Route::get('/', [MerchantController::class, 'index'])->name('api.user.merchant.index');
    Route::post('/', [MerchantController::class, 'store'])->name('api.user.merchant.store');
    Route::get('/{id}', [MerchantController::class, 'show'])->name('api.user.merchant.show');
    Route::put('/{id}', [MerchantController::class, 'update'])->name('api.user.merchant.update');
    Route::delete('/{id}', [MerchantController::class, 'delete'])->name('api.user.merchant.delete');
});
