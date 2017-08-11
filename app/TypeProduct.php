<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;
use App\Import_product;
use App\Export_product;
class TypeProduct extends Model
{
    protected $table ='category';
    public $timestamps = true;
    public function products(){
    	return $this->hasMany('App\Product','id_type','id');
    }
    //hiện loại cha
    public static function Show_All_Type_Product_Parent(){
		$Type_product=DB::table('category')->where([
                                    ['type', '=', '1'],
                                    ['type_cha', '=', '0'],
                                    ['status', '=', 0],
                                    ])->select();
		return $Type_product;
	}
  //hiện loại con của cha
	public static function Show_All_Type_Product_By_Id_Parent($id){
		$Type_product=DB::table('category')
						->where([
                        ['type', '=', '1'],
                        ['type_cha', '=', $id],
                        ['status', '=',0],
                        ])->select();
		return $Type_product;
	}	
	//Lấy cac thuộc tính của loại sản phẩm
	public static function Get_Category($id){
		$Type_product=DB::table('category')
						->where([
                        ['type', '=', '1'],
                        ['id','=',$id],
                        ['status', '=', 0],
                        ])->select();
        return $Type_product;               
	}
	 public static function Insert_Category($name, $desc, $image,$type_cha,$type){
            $id=DB::table('category')->insertGetId(['name'=>$name,'description'=>$desc,'image'=>$image,'type_cha'=>$type_cha,'type'=>$type]);
            return $id;
  	}
	public static function Update_Category($anhthemmoi_suaAnh,$id,$name,$description,$type_cha,$type,$image){
       if($anhthemmoi_suaAnh==1)
            {
               $News=DB::table('category')
                        ->where('id',$id)
                        ->update(['name'=>$name,'image'=>$image,'description'=>$description,'type_cha'=>$type_cha,'type'=>$type]);
                return $News;
            }
            else
            {
                 $News=DB::table('category')
                        ->where('id',$id)
                        ->update(['name'=>$name,'description'=>$description,'type_cha'=>$type_cha,'type'=>$type]);
                return $News;
            }
  	}
  	//xóa loại sãn phẩm cha
	public static function Delete_Category_Parent($id){
		// $pro=DB::table('products')->where('id_type',$id)->delete();
		$type=DB::table('category')
                  ->where('category.id',$id)
                  ->join('category as bang','category.id','=','bang.type_cha')
                  ->select('bang.id')->get();
        foreach ($type as $type_parent) 
        {
        	$product=DB::table('products')->where('id_type',$type_parent->id)->select('id')->get();
        	foreach ($product as $pro) {
        		//$import_product=Import_product::Delete_Import_Product_By_Id($pro->id);
        		$export_product=Export_product::Delete_Export_Product_By_Id($pro->id);
        		// $bill_detail=Bill_Detail::Delete_Bill_Detail_By_Id($pro->id);
        	}
        	//$product=DB::table('products')->where('id_type',$type_parent->id)->delete();
        	// $type=DB::table('category')
         //          ->where('category.id',$type_parent->id)->delete();
          $type=DB::table('category')
                  ->where('category.id',$type_parent->id)->update(['status'=>1]);
        }
       	 // $type=DB::table('category')
         //          ->where('category.id',$id)->delete();
        $type=DB::table('category')
                   ->where('category.id',$id)->update(['status'=>1]);

	}
	//xóa loại sản phẩm con
	public static function Delete_Category_Child($id){
		$product=DB::table('products')->where('id_type',$id)->select('id')->get();
		foreach ($product as $pro) {
        		// $import_product=Import_product::Delete_Import_Product_By_Id($pro->id);
        		$export_product=Export_product::Delete_Export_Product_By_Id($pro->id);
        		//$bill_detail=Bill_Detail::Delete_Bill_Detail_By_Id($pro->id);
        	}
		//$product=DB::table('products')->where('id_type',$id)->delete();
       // $type=DB::table('category')->where('category.id',$id)->delete();
          $type=DB::table('category')->where('category.id',$id)->update(['status'=>1]);
	}
	// public static function ALL_Type_product(){
	// 	$Type_product=DB::table('category')->select();
	// 	return $Type_product;
	// }
	// public static function vi_to_en($str){
	// 	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	// 	  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	// 	  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	// 	  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	// 	  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	// 	  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	// 	  $str = preg_replace("/(đ)/", 'd', $str);
	// 	  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	// 	  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	// 	  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	// 	  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	// 	  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	// 	  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	// 	  $str = preg_replace("/(Đ)/", 'D', $str);
	// 	  $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
	// 	  return $str;
	// }
}
