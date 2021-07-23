<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\Restaurant;

class DishController extends Controller
{
    // GET DISHES

    public function index($slug)
    {   
        $restaurant = Restaurant::where('slug', $slug)->first();
        // dd($restaurant);
        $dishes = Dish::where('restaurant_id', $restaurant->id)->with('restaurant')->paginate(6);

        foreach ($dishes as $dish) {
            if ($dish->image) {
                $dish->image = url('storage/' . $dish->image);
            }
        }

        return response()->json($dishes);
    }
}
