<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Customer extends Model
{
    protected $table='customer';
    public $timestamps = true;
    public static function Customer_All()
    {
        $user=DB::table('customer')->select();
        return $user;
    }
}
