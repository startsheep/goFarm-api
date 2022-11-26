<?php

use App\Http\Controllers\Pages\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('category', CategoryController::class);
});
