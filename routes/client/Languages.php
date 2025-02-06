<?php

use App\Http\Controllers\LanguagesController;
use Illuminate\Support\Facades\Route;

Route::prefix('languages')->group(function () {
    Route::controller(LanguagesController::class)->group(function () {
        Route::get('/', 'getListLanguages')->name('languages.list');
        // Route::post('/verify/password', 'verifyPasswordProfile')->name('profile.verifyPassword');
    });
    
});;