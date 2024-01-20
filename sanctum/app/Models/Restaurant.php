<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function menu() {
        return $this->hasOne(Menu::class);
    }


    
    protected $appends = ['average_ratings'];

    public function getAverageRatingsAttribute() {
        
        $ratings_hotel = Rating::where('restaurant_id',$this->id)->get();
        $subset = $ratings_hotel->map->only(['rate']);
        $rate =0;
        for( $i=0; $i<count($subset); $i++) {
            $rate = $rate + $subset[$i]['rate'];
            $avg = ($rate/count($subset));
           
        }
        return $avg;
        
    }

}
