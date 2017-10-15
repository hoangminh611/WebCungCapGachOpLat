<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class View_product extends Model
{
    protected $table='view_product';
    public $timestamps = true;
   
   public static function InsertVIewOnProductByPeople($idProduct,$idPeopleView,$typePeople) {
   	$getPeople=DB::table('view_product')
                  ->where([['id_people_view',$idPeopleView],['id_product',$idProduct]])->select()->first();
    if (isset($getPeople)) {
      $view=DB::table('view_product')
                  ->where([['id_people_view',$idPeopleView],['id_product',$idProduct]])->select('number_view')->first();
      $view=($view->number_view)+1;
      //phaỉ thêm  "" vào "$idPeopleView" là do lúc thêm vào là int lú là string 2 cái nó kiểu dữ liệu khác nhau nên gây lỗi 
      $updateview=DB::table('view_product')
                   ->where([['id_people_view','=', "$idPeopleView"],['id_product','=',$idProduct]])->update(['number_view'=>$view]);
    }
    else {
       DB::table('view_product')->insert(['id_people_view'=>$idPeopleView,'id_product'=>$idProduct,'type_people'=>$typePeople,'number_view'=> 1]);
    }
   	return 1;
   }


   public static function getProduct(){
    $arrayPro=DB::table('view_product')
                ->join('export_product','view_product.id_product','=','export_product.id_product')
                  ->where([['status',0]])->select('view_product.id_product','id_people_view','number_view')->distinct();
    return $arrayPro;
   }

   public static function checkUserExist($userID){
   		$arrayPro=DB::table('view_product')->where('id_people_view',$userID)->select('id');
   	return $arrayPro;
   }

  public static function updateWhenUserLogin($cookieID,$userID){
    $arrayPro=DB::table('view_product')->where('id_people_view',$cookieID)->select('id_product','number_view')->get();
    if(isset($arrayPro[0]->id_product)) {
      foreach ($arrayPro as $key => $value) {
        $existUser=DB::table('view_product')->where([['id_people_view',$userID],['id_product',$value->id_product]])->select()->first();
        if(isset($existUser)) {
          $view=$existUser->number_view+$value->number_view;
          DB::table('view_product')->where([['id_people_view',"$userID"],['id_product',$value->id_product]])->update(['number_view'=>$view]);
        }
        else {
          DB::table('view_product')->insert(['id_people_view'=>$userID,'id_product'=>$value->id_product,'type_people'=>"User",'number_view'=> $value->number_view]);
        }
      }
      DB::table('view_product')->where('id_people_view',$cookieID)->delete();
    }

  }
    

}
