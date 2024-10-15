<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth', 'middleware' => 'jwt'], function() {
    Route::post('/login', [AuthController::class, 'login']);
});

