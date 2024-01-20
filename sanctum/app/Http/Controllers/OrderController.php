<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        if(Order::Where('customer_id', $id)->get()) {
            return OrderResource::collection(Order::Where('customer_id', $id)->get());
        }else{
            return $this->apiResponse(null, 0, 'notfound', 404);
        }
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
        $validatedData = Validator::make($request->all(), [
            "restaurant_id"=>"required|string|exists:restaurants,id",
            "customer_id"=>"required|string|exists:customers,id"
        ]);
        //$this->test($validate);
        if ($validatedData->fails()) {
            return $this->apiResponse( null, false, $validatedData->messages(), 401);
        }else{
        $order = Order::create([
            "restaurant_id" => $request->restaurant_id,
            "customer_id" => $request->customer_id,
            "uuid" => Str::uuid() ]);

            //$order = OrderResource::make(Order::all()->keyBy->id);
            $orders = new OrderResource (Order::findOrFail($order->id));
            return $this->apiResponse( $orders, true, null, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
