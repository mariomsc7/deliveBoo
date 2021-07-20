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
    
    //Get restaurants
    Route::get('/filter', 'RestaurantController@filter');
    Route::get('/restaurants', 'RestaurantController@list');
    Route::get('/types', 'RestaurantController@resType');
    Route::get('/restaurant/{id}', 'DishController@index');
});
