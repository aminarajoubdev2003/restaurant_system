<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
}
