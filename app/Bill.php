<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table='bills';
    public $timestamps = true;
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }

}
