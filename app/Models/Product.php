<?php

namespace App\Models;

use App\models\Order;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','description'];
    protected $guarded = [];
    protected $appends = ['imagePath'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute(){
        return asset('uploads/imageProduct/'.$this->image);
    }
    public function orders(){
        return $this->belongsToMany(Order::class,'product_order');
    }
}
