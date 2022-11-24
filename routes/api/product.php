<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('api.product.index');
    Route::post('/', [ProductController::class, 'store'])->name('api.product.store');
    Route::get('/{id}', [ProductController::class, 'show'])->name('api.product.show');
    Route::put('/{id}', [ProductController::class, 'update'])->name('api.product.update');
    Route::put('/update-status/{id}', [ProductController::class, 'updateStatus'])->name('api.product.update.status');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('api.product.delete');
});
