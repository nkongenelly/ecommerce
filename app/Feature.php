<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductFeature;

class Feature extends Model
{
    protected $guarded = [];
    public function productfeatures(){
        return $this->hasMany(ProductFeature::class);
    }
}
