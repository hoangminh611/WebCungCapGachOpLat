<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Rating_Product extends Model
{
    protected $table='rating_product';
    public $timestamps = true;
   
   public static function getProduct(){
   	$arrayPro=DB::table('rating_product')
                ->join('export_product','rating_product.id_product','=','export_product.id_product')
                  ->where([['status',0]])->distinct();
   	return $arrayPro;
   }
   public static function checkUserExist($userID){
   		$arrayPro=DB::table('rating_product')->where('id_people_rating',$userID)->select('id');
   	return $arrayPro;
   }
}
