<?php

use Illuminate\Support\Facades\Route;
use Modules\SupplierManagement\Http\Controllers\SupplierManagementController;

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

Route::prefix('suppliers')->controller(SupplierManagementController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::put('/{supplier_id}', 'update');
    Route::delete('/{supplier_id}', 'destroy');
});
