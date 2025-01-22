<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// write login route here
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
});
