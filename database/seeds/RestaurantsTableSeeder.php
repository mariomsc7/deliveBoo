<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_restaurants = new Restaurant();

        $new_restaurants->name = 'cinese';
        $new_restaurants->address = 'via roma';
        $new_restaurants->vat_number = '12345678900';
        $new_restaurants->user_id = 1;

        $new_restaurants->save();
    }
}
