<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Customer extends Model
{
    protected $table='customer';
    public $timestamps = true;
    //lấy customer theo id
    public static function Customer_ByID($idcustomer)
    {
        $user=DB::table('customer')->where('id',$idcustomer)->select();
        return $user;
    }
    //lấy tất cả customer
      public static function Customer_All()
    {
        $user=DB::table('customer')->select();
        return $user;
    }
    //insert vào bang customer
    public static function Insert_Customer($id_user,$full_name,$email,$address,$phone)
    {
    	 $user=DB::table('customer')->insertGetId(['full_name'=>$full_name,'email'=>$email,'address'=>$address,'phone'=>$phone,'id_user'=>$id_user]);
        return $user;	
    }

    public static function Delete_Customer($id){
        $customer=DB::table('customer')->where('id',$id)->delete();
        return $customer;
    }
}
