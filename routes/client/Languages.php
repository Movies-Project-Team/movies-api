<?php

use App\Http\Controllers\GenresController;
use App\Http\Controllers\LanguagesController;
use Illuminate\Support\Facades\Route;

Route::prefix('util')->group(function () {
    Route::controller(GenresController::class)->group(function () {
        Route::get('/genres', 'getListGenres')->name('genres.list');
    });
    Route::controller(LanguagesController::class)->group(function () {
        Route::get('/languages', 'getListLanguages')->name('languages.list');
    });
});
