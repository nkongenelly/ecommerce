<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductFeature;
use App\Product;

class Feature extends Model
{
    protected $guarded = [];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
