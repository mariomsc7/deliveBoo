<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{
    // public function index() {
    //     $restaurants = Restaurant::all();

    //     foreach ($restaurants as $res){
    //         $temp = [];
    //         foreach($res->types as $type){
    //             $temp[] = $type->name;
    //         }
    //         $res['type'] = $temp;
    //     }

    //     foreach($restaurants as $restaurant) {
    //         if($restaurant->image) {
    //             $restaurant->image = url('storage/' . $restaurant->image);
    //         }
    //     }
    
    //     return response()->json($restaurants);
    // }

    public function list($typology) {
        // Get all Restaurants
        $restaurants = Restaurant::all();

        // Set type attribute
        foreach ($restaurants as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
        }
        // Filter by type
        if($typology != 'all'){
            $temp = [];
            foreach($restaurants as $restaurant){
                foreach($restaurant->type as $type){
                    if($type == $typology){
                        $temp[] = $restaurant;
                    }
                }
            }
            $restaurants = $temp;
        }

        // Set image path
        foreach($restaurants as $restaurant) {
            if($restaurant->image) {
                $restaurant->image = url('storage/' . $restaurant->image);
            }
        }
    
        return response()->json($restaurants);
    }
}
