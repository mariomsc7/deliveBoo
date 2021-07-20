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
        // dd($setType);
        // $arr = [];
        $risto = Restaurant::select('restaurants.*')->join('restaurant_type', 'restaurants.id', '=', 'restaurant_type.restaurant_id')->join('types', 'restaurant_type.type_id' ,'=', 'types.id')
        ->whereIn('types.name', $setType)
        // ->orWhere('types.name', '=', 'pizza')
        ->groupBy('restaurants.id')->paginate(3);
        // dd($risto);

        foreach ($risto as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
        }








        // $typology = $request->input('types');
        // $setType = json_decode($typology, true);
        // // dd($setType);
        // $restaurantsColl = [];
        // $tipi = [];
        // foreach($setType as $type){
        //     $tipo = Type::where('name', $type)->first();
        //     if($tipo){
        //         $tipi[] = $tipo;
        //     }
        // }
        // // dd($tipi);
        // foreach($tipi as $type){
        //         $restaurantsColl[]=$type->restaurants;
        // }
        // $restaurants = [];
        // foreach($restaurantsColl as $rests){
        //     foreach($rests as $res){
        //         if(!in_array($res, $restaurants)){
        //             $restaurants[] = $res;
        //         }
        //     }
        // }
        // foreach ($restaurants as $res){
        //     $temp = [];
        //     foreach($res->types as $type){
        //         $temp[] = $type->name;
        //     }
        //     $res['type'] = $temp;
        // }
        // foreach($restaurants as $restaurant) {
        //     if($restaurant->image) {
        //         $restaurant->image = url('storage/' . $restaurant->image);
        //     }
        // }
        // dd($restaurants);
        // $restaurants = Restaurant::all();
        // $types=[];
        // foreach ($restaurants as $res){
        //     foreach($res->types as $type){
        //         if(!in_array($type->name, $types)){
        //             $types[] = $type->name;
        //         }
        //     }
        // }
        foreach($risto as $restaurant) {
            if($restaurant->image) {
                $restaurant->image = url('storage/' . $restaurant->image);
            }
        }
        return response()->json($risto);
    }

    public function list(Request $request) {
        $typology = $request->input('types');
        // dd($typology);
        // $ciao = ['ciao', 'bau', 'miao'];
        // $jj =json_encode($ciao);
        // dd($jj);
        // Get all Restaurants
        $restaurants = Restaurant::with('types')->paginate(3);
        // dd($restaurants);
        $setType = json_decode($typology, true);
        // dd($setType);
        // Set type attribute
        foreach ($restaurants as $res){
            $temp = [];
            foreach($res->types as $type){
                $temp[] = $type->name;
            }
            $res['type'] = $temp;
        }
        // // Filter by type
        // if(!in_array('all', $setType)){
        //     $temp = [];
        //     foreach($setType as $item){
        //         foreach($restaurants as $restaurant){
        //             foreach($restaurant->type as $type){
        //                 if($type == $item){
        //                     if(!in_array($restaurant, $temp)){
        //                         $temp[] = $restaurant;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        //     $restaurants = $temp;
        // }
        
        // Set image path
        foreach($restaurants as $restaurant) {
            if($restaurant->image) {
                $restaurant->image = url('storage/' . $restaurant->image);
            }
        }
        
        if($setType){

            $temp = [];
            foreach($restaurants as $restaurant){
            // dd($setType);
    
                // dd($restaurant->type);
                foreach($restaurant->type as $types){
                    // dd(strtolower($types));
                    if(in_array(strtolower($types), $setType)){
                        if(!in_array($restaurant, $temp)){
                            $temp[] = $restaurant;
                        }
                     }
                }
            }
                // dd($temp);
                $restaurants = $temp;
        }
            // dd($restaurants);
        return response()->json($restaurants);
    }
}
