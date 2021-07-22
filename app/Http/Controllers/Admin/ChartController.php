<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Chart;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Order;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::user();
        // dd($user);
        // $restaurant = Restaurant::find($user->restaurant->id)->first();
        // // $charts = Order::selectRaw('MONTH(created_at) as month')->where('restaurant_id', $restaurant->id)->get();
        // // dd($charts);
        // // Get users grouped by age
        // $groups = Order::where('restaurant_id', $restaurant->id)
        //           ->selectRaw('MONTH(created_at) as month, count(*) as total')
        //           ->groupBy('month')
        //           ->pluck('total', 'month')->all();
        // // dd($groups);

        // // Prepare the data for returning with the view
        // $chart = new Chart;
        //     $chart->labels = (array_keys($groups));
        //     $chart->dataset = (array_values($groups));
        //     // dd($chart);
        //     return view('admin.charts.index', compact('chart'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $user = Auth::user();
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            abort(404);
        } elseif (Auth::user()->restaurant->id != $restaurant->id) {
            abort(403);
        }
        // dd($restaurant);
        // $charts = Order::selectRaw('MONTH(created_at) as month')->where('restaurant_id', $restaurant->id)->get();
        // dd($charts);
        // Get users grouped by age
        $groups = Order::where('restaurant_id', $restaurant->id)
                  ->selectRaw('MONTH(created_at) as month, count(*) as total')
                  ->groupBy('month')
                  ->pluck('total', 'month')->all();
        // dd($groups);

        // Prepare the data for returning with the view
        $chart = new Chart;
            $chart->labels = (array_keys($groups));
            $chart->dataset = (array_values($groups));
            // dd($chart);
            return view('admin.charts.index', compact('chart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
