<?php

use App\Http\Controllers\GenresController;
use Illuminate\Support\Facades\Route;

Route::prefix('genres')->group(function () {
    Route::controller(GenresController::class)->group(function () {
        Route::get('/', 'getListGenres')->name('genres.list');
        // Route::post('/verify/password', 'verifyPasswordgenres')->name('genres.verifyPassword');
    });
    
});;