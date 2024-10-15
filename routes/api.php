<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'api'], function() {
    Route::post('/login', [AuthController::class, 'login']);
});

