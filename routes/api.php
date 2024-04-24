<?php

use Illuminate\Support\Facades\Route;

Route::get('/rover', [\App\Http\Controllers\RoverPhotoController::class, 'index'])
    ->middleware(\App\Http\Middleware\IsUserAuthenticated::class);

// pass email + password to get a token
Route::get('/authenticate', [\App\Http\Controllers\AuthController::class, 'createToken']);

//use this endpoint to retrieve user details
Route::get('/token', [\App\Http\Controllers\AuthController::class, 'readToken']);

//use this endpoint to refresh the token
Route::post('/token', [\App\Http\Controllers\AuthController::class, 'updateToken']);

// use this endpoint to destroy/log out
Route::delete('/token', [\App\Http\Controllers\AuthController::class, 'deleteToken']);
