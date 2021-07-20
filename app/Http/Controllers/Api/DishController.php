<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;

class DishController extends Controller
{
    // GET DISHES

    public function index($restaurant_id)
    {

        $dishes = Dish::where('restaurant_id', $restaurant_id)->with('restaurant')->paginate(3);

        foreach ($dishes as $dish) {
            if ($dish->image) {
                $dish->image = url('storage/' . $dish->image);
            }
        }

        return response()->json($dishes);
    }
}
