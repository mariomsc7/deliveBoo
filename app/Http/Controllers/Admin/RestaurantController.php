<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:restaurants|max:30',
            'vat_number' => 'required|unique:restaurants|size:11',
            'address' => 'required|unique:restaurants|max:50',
            'types' => 'required|exists:types,id'
        ], [
            'required' => 'The :attribute is required!!!',
            'unique' => 'The :attribute is already used',
            'max' => 'Max :max characters allowed for the :attribute',
        ]);

        $user = Auth::id();
        $data = $request->all();
        $data['user_id'] = $user;


        $new_restaurant = new Restaurant();
        $new_restaurant->fill($data);

        $new_restaurant->save();
        // dd($new_restaurant);

        if (array_key_exists('types', $data)) {
            $new_restaurant->types()->attach($data['types']);
        }


        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
