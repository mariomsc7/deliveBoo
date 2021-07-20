<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{

    public function resType() {
        $restaurants = Restaurant::all();
        $types=[];
        foreach ($restaurants as $res){
            foreach($res->types as $type){
                if(!in_array($type->name, $types)){
                    $types[] = $type->name;
                }
            }
        }
        return response()->json($types);
    }

    public function filter(Request $request) {
        $typology = $request->input('types');
        $setType = json_decode($typology, true);

        $risto = Restaurant::select('restaurants.*')
                            ->join('restaurant_type', 'restaurants.id', '=', 'restaurant_type.restaurant_id')
                            ->join('types', 'restaurant_type.type_id' ,'=', 'types.id')
                            ->whereIn('types.name', $setType)
                            ->groupBy('restaurants.id')->paginate(3);


        foreach ($risto as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
        }

        foreach($risto as $restaurant) {
            if($restaurant->image) {
                $restaurant->image = url('storage/' . $restaurant->image);
            }
        }
        
        return response()->json($risto);
    }

    public function list() {
        $restaurants = Restaurant::paginate(3);

        // Set type attribute
        foreach ($restaurants as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
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
