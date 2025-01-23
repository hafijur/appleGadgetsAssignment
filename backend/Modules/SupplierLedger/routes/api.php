<?php

use Illuminate\Support\Facades\Route;
use Modules\SupplierLedger\Http\Controllers\SupplierLedgerController;

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

Route::prefix('supplier-ledgers')->controller(SupplierLedgerController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/',  'index');
    Route::post('/',  'store');
});
