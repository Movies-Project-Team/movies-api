<?php

use App\Http\Controllers\Client\MovieController;
use Illuminate\Support\Facades\Route;

Route::prefix('movies')->group(function () {
    Route::controller(MovieController::class)->group(function () {
        Route::get('/', 'getList')->name('movie.list');
    });
});;