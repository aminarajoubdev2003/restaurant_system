<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
       'restaurant_id',
       'customer_id',
       'uuid'
    ];

    protected $appends = ['invoice'];

    public function getInvoiceAttribute() {
        
        $order_items = Order_item::where('order_id',$this->id)->get();
        $subset = $order_items->map->only(['price']);
        $total =0;
        for( $i=0; $i<count($subset); $i++) {
            $total = $total + $subset[$i]['price'];
            
        }
        return $total;
        
        
    }
    
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }

    public function order_items() {
        return $this->hasMany(Order_item::class);
    }
}
