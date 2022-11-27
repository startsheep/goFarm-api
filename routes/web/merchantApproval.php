<?php

use App\Http\Controllers\Pages\MerchantApprovalController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::resource('merchant-approval', MerchantApprovalController::class);
});
