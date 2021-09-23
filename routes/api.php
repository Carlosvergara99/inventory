<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([ 'prefix' => 'products'], function () {
    Route::get('get', 'InventoryController@GetProducts');
    Route::post('stock', 'InventoryController@StockProduct');
});
Route::group([ 'prefix' => 'inventory'], function () {
    Route::post('get', 'InventoryController@GetInventory');
    Route::post('create', 'InventoryController@Createinventory');
});