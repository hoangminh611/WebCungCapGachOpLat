<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table='transaction';
    public $timestamps = true;
    public function bill(){
    	return $this->belongsTo('App\Bill','id_bill','id');
    }
}
