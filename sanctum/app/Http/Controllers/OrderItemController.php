<?php

namespace App\Http\Controllers;

use App\Models\order_item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\Order_itemResource;
use App\Http\Resources\OrderResource;


class OrderItemController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
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
        $message = ["item_name" => "this meal not exist in menu",
                  ];
        $validatedData = Validator::make($request->all(), [
            "item_name"=>"required|string|min:3|max:20|regex:/^[A-Za-z]+$/|exists:menu_items,item_name",
            "price"=>"required|string|min:4|max:6|regex:/^[0-9]+$/|exists:menu_items,price",
            "order_id"=>"required|string|exists:orders,id"
        ],$message);
        //$this->test($validate);
        if ($validatedData->fails()) {
            return $this->apiResponse( null, false, $validatedData->messages(), 401);
            
        }else{
        $order_item = Order_item::create([
            "item_name" => $request->item_name,
            "price" => $request->price,
            "order_id"=>$request->order_id,
            "uuid" => Str::uuid() ]);

            $orders = OrderResource::make(Order::findOrFail($order_item->order_id));
            return $this->apiResponse( $orders, true, null, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(order_item $order_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order_item $order_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order_item $order_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order_item $order_item)
    {
        //
    }
}
