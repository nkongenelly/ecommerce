<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\User;

class Category extends Model
{
    //
    protected $guarded = [];
    public function products(){
        return $this->hasMany(Product::class);
    }

    public function cuser(){
        return $this->belongs(User::class);
    }
}
