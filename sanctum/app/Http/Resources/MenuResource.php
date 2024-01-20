<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Restaurant;
use App\Models\Menu_item;



class MenuResource extends JsonResource
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
            'name' => $this->name,
            'kinds of food' => Menu_itemResource::collection(Menu_item::Where('menu_id', $this->id)->get()),
            
        ];
    }
}
