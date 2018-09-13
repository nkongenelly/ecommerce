<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Product;
use App\Feature;
use App\Order;
use App\OrderItems;
use App\FeatureProduct;


class Product extends Model
{
    protected $touches = array('category','features','user','featureproduct');
    protected $guarded = [];
    public function features(){
        return $this->belongsToMany(Feature::class)->withTimestamps();;
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(Product::class);
    }
    public function order(){
        return $this-hasMany(Order::class);
    }
    public function orderitems(){
        return $this-hasMany(OrderItems::class);
    }
    public function featureproduct(){
        return $this->belongsTo(FeatureProduct::class);
    }
}
