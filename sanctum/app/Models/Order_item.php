<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'price',
        'order_id',
        'uuid'
    ];

    protected $appends = ['invoice'];

    public function getInvoiceAttribute() {
        
        $order_items = Order_item::where('order_id',$this->order_id)->get();
        $subset = $order_items->map->only(['price']);
        $total =0;
        for( $i=0; $i<count($subset); $i++) {
            $total = $total + $subset[$i]['price'];
            
        }
        return $total;
        
        
    }


    public function order() {
        return $this->belongsTo(Order::class);
    }
}
