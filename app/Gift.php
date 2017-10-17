<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Gift extends Model
{
    protected $table='discount';
    public $timestamps = true;
    //Lấy tất cả discount
    public static function getGift() {
    	$gift=DB::table('gift')->where('gift_status',0)
                   ->select();
    	return $gift;
    }

    public static function getDiscountById($id) {
    	$gift=DB::table('gift')->where('id',$id)->select();
    	return $gift;
    }

   public static function insertGift($nameGift,$priceGift) {
   	$discount=DB::table('gift')->insert(['name_gift'=>$nameGift,'price_gift'=>$priceGift]);
   }

   public static function updateGift($id,$nameGift,$priceGift){
  
    	$discount=DB::table('gift')->where('id',$id)->update(['name_gift'=>$nameGift,'price_gift'=>$priceGift]);
    }


    public static function deleteGift($id){
    	$discount=DB::table('gift')->where('id',$id)->update(['gift_status'=>1]);
    }
}

