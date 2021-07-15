<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
     public function index() {
        $restaurants = Restaurant::all(); 
        foreach($restaurants as $restaurant) {
        if($restaurant->image) {
            $restaurant->image = url('storage/' . $restaurant->image);
        }
    }
        return response()->json($restaurants);
    }
}
