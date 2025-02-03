<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/{id}', 'getListProfile')->name('getListProfile');
        Route::get('/getProfile', 'getProfile')->name('getProfile');
        Route::post('/add', 'changePasswordProfile')->name('changePasswordProfile');
        Route::post('/add', 'verifyPasswordProfile')->name('verifyPasswordProfile');

    });
    
});;