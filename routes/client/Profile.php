<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/{id}', 'getListProfile')->name('getListProfile');
        Route::get('/info/{id}', 'getProfile')->name('getProfile');
        Route::post('/change/password', 'changePasswordProfile')->name('changePasswordProfile');
        Route::post('/verify/password', 'verifyPasswordProfile')->name('verifyPasswordProfile');
    });
    
});;