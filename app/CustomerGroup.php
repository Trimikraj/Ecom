<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table='tbl_customer_groups';

    public function customer(){
    	return $this->hasMany('App\Customer');
    }
}
