<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Discount extends Model
{
    protected $table='discount';
    public $timestamps = true;
    //Lấy tất cả discount
    public static function Get_All(){
    	$discount=DB::table('discount')->where('discount_method',0)->select();
    	return $discount;
    }

    public static function Get_Discount_By_Id($cId){
    	$discount=DB::table('discount')->where('id',$cId)->select();
    	return $discount;
    }

    public static function Discount_Insert($price_discount,$gift,$percent_discount,$ship_price){

    	$discount=DB::table('discount')->insert(['price_discount'=>$price_discount,'gift'=>$gift,'percent_discount'=>$percent_discount,'ship_price'=>$ship_price]);
    }

    public static function Discount_Update($id,$price_discount,$gift,$percent_discount,$ship_price){
  
    	$discount=DB::table('discount')->where('id',$id)->update(['price_discount'=>$price_discount,'gift'=>$gift,'percent_discount'=>$percent_discount,'ship_price'=>$ship_price]);
    }

    public static function Delete_Discount($id){
    	$discount=DB::table('discount')->where('id',$id)->update(['discount_method'=>1]);
    }

}

