<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductManagement\Http\Controllers\ProductController;

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

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::post('/',  'store');
    Route::put('/{product_id}',  'update');
    Route::delete('/{product_id}', 'destroy');
    Route::get('/', 'index');
});
