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
    public static function Insert_Customer($full_name,$email,$address,$phone)
    {
    	 $user=DB::table('customer')->insertGetId(['full_name'=>$full_name,'email'=>$email,'address'=>$address,'phone'=>$phone]);
        return $user;	
    }
}
