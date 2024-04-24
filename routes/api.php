<?php

use Illuminate\Support\Facades\Route;

Route::get('/rover', [\App\Http\Controllers\RoverPhotoController::class, 'index'])
    ->middleware(\App\Http\Middleware\IsUserAuthenticated::class);

