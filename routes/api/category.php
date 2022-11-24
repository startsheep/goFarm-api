<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('api.category.index');
    Route::post('/', [CategoryController::class, 'store'])->name('api.category.store');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('api.category.show');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('api.category.update');
    Route::delete('/{id}', [CategoryController::class, 'delete'])->name('api.category.delete');
});
