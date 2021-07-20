<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function() {
    // Get Types
    Route::get('/types', 'RestaurantController@resType');

    // Get restaurants
    // All
    Route::get('/restaurants', 'RestaurantController@list');
    // Filter
    Route::get('/filter', 'RestaurantController@filter');

    // Get Dishes
    Route::get('/restaurant/{id}', 'DishController@index');
});
