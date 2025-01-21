<?php

use Illuminate\Support\Facades\Route;
use Modules\PurchaseManagement\Http\Controllers\PurchaseManagementController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::prefix('purchases')->controller(PurchaseManagementController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
});
