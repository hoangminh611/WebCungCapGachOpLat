<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Discount extends Model
{
    //Khi mà sửa giá tới mức để giảm trong discount do chưa bấm update tình trạng hóa đơn nên hóa đơn đó nó mặc định là giảm theo cái phần trăm lúc trước khi sửa
    protected $table='discount';
    public $timestamps = true;
    //Lấy tất cả discount
    public static function Get_All(){
    	$discount=DB::table('discount')->where('discount_method',0)
                        ->join('gift','discount.id_gift','gift.id')->select('discount.id','discount.price_discount','discount.percent_discount','discount.ship_price','discount.updated_at','gift.id as idgift','gift.name_gift');
    	return $discount;
    }

    public static function Get_Discount_By_Id($cId){
    	$discount=DB::table('discount')
                    ->join('gift','discount.id_gift','gift.id')
                    ->where('discount.id',$cId)->select('discount.id','discount.price_discount','discount.percent_discount','discount.ship_price','discount.updated_at','gift.id as idgift','gift.name_gift','gift.price_gift');;
    	return $discount;
    }

    public static function Discount_Insert($price_discount,$gift,$percent_discount,$ship_price){

    	$discount=DB::table('discount')->insert(['price_discount'=>$price_discount,'id_gift'=>$gift,'percent_discount'=>$percent_discount,'ship_price'=>$ship_price]);
    }

    public static function Discount_Update($id,$price_discount,$gift,$percent_discount,$ship_price){
  
    	$discount=DB::table('discount')->where('id',$id)->update(['price_discount'=>$price_discount,'id_gift'=>$gift,'percent_discount'=>$percent_discount,'ship_price'=>$ship_price]);
    }

    public static function Delete_Discount($id){
    	$discount=DB::table('discount')->where('id',$id)->update(['discount_method'=>1]);
    }

}

