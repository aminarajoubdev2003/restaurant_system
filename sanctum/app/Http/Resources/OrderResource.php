<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Restaurant;
use App\Models\Order_item;
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'number_of_order' => $this->id,
            'restaurant' => RestaurantResource::make(Restaurant::findOrFail($this->restaurant_id)),
            'items' => Order_itemResource::collection(Order_item::Where('order_id', $this->id)->get()),
            'invoice' => $this->invoice
        ];
    }
}
