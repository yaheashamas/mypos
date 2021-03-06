<?php

namespace App\models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(client::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'product_order');
    }
}
