<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name'];
    protected $guarded = [];
    protected $with = ['products'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
