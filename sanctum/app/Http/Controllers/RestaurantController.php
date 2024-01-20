<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Resources\RestaurantResource;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\RestaurantResourcemenu;

class RestaurantController extends Controller
{   
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $restaurants = RestaurantResource::collection(Restaurant::all()->keyBy->id);
        return $this->apiResponse( $restaurants, true, null, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = new RestaurantResourcemenu (Restaurant::findOrFail($id));
        return $this->apiResponse( $restaurant, true, null, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(restaurant $restaurant)
    {
        //
    }
    public function search_restaurant($type, $address) {
        if(Restaurant::Where('cuisine_type', $type) && Restaurant::Where('address', $address)) {
            //echo 'po';
            return RestaurantResourcemenu::collection(Restaurant::Where('cuisine_type', $type)
            ->where('address', $address)->get());
        }
        
    }
}
