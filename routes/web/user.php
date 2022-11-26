<?php

use App\Http\Controllers\Pages\User\AdminController;
use App\Http\Controllers\Pages\User\CustomerController;
use App\Http\Controllers\Pages\User\DoctorController;
use App\Http\Controllers\Pages\User\MerchantController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::resource('admin', AdminController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('merchant', MerchantController::class);
    Route::resource('customer', CustomerController::class);
});
