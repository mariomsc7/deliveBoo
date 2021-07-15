<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{
     public function index() {
        $restaurants = Restaurant::with('types')->get();
        $types = Type::all();
        $marta = [
            'restaurants' => $restaurants, 
            'types' => $types
                ];


        foreach($restaurants as $restaurant) {
        if($restaurant->image) {
            $restaurant->image = url('storage/' . $restaurant->image);
        }
    }
        return response()->json($marta);
    }
}
