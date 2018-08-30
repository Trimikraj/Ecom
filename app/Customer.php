<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='tbl_customers';

    public function customerGroup(){
    	return $this->belongsTo('App\CustomerGroup','customer_group_id');
    }

}
