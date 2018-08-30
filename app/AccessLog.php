<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
	const CREATED_AT='access_date';
    protected $table='tbl_access_logs';
}
