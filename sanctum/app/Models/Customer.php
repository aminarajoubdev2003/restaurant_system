<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fname',
        'Lname',
        'mobile',
        'uuid',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
