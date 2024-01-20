<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MenuResource;
use App\Models\Menu;

class RestaurantResourcemenu extends JsonResource
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
            'cuisine_type' => $this->cuisine_type,
            'address' => $this->address,
            'average_ratings' => $this->average_ratings,
            'menu' => MenuResource::make(Menu::findOrFail($this->id)),
            
        ];
    }
}
