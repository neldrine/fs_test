<?php

use Illuminate\Support\Facades\Route;

Route::get('/api', function () {
    return response()->json([
        'message' => 'test'
    ]);
});

Route::get('/rover', [\App\Http\Controllers\RoverPhotoController::class, 'index']);

