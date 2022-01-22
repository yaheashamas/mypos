<?php

namespace App\Models;

use App\models\Order;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    //relation ship
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function getNameAttribute($value){
        return ucfirst($value);
    }
}
