<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/client')->middleware(['middleware' => 'cors'])->group(function () {
    foreach(glob(__DIR__ . '/client/*.php') as $file) {
        require_once $file;
    }
});

Route::prefix('v1/admin')->middleware(['middleware' => 'cors'])->group(function () {
    foreach(glob(__DIR__ . '/admin/*.php') as $file) {
        require_once $file;
    }
});