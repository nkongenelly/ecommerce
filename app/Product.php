<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductFeature;
use App\Category;
use App\Product;


class Product extends Model
{
    protected $guarded = [];
    public function productfeatures(){
        return $this->hasMany(ProductFeature::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(Product::class);
    }
}
