<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// just from this line we create all api default routes GET/POST/PUT/DELETE/PATCH
// USE php artisan route:list
Route::apiResource('books', BookController::class);
