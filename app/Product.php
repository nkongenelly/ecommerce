<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Product;
use App\Feature;


class Product extends Model
{
    protected $guarded = [];
    public function features(){
        return $this->belongsToMany(Feature::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(Product::class);
    }
}
