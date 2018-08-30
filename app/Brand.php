<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table='tbl_brands';

    public function products(){
    	return $this->hasMany('App\Product');
    }
}
