<?php

use App\Http\Controllers\Pages\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('product', ProductController::class);
});
