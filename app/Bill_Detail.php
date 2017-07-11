<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Bill_Detail extends Model
{
	protected $table='bill_detail';
      public function products(){
    	return $this->belongsTo('App\Product','id_product','id');
    }
    public function bills(){
    	return $this->belongsTo('App\Bill','id_bill','id');
    }
    //Tìm tổng số lượng bản của tất cả các sản phẩm
    public static function FindSum_Quantity(){
        $product=DB::table('bill_detail')
        		->leftjoin('products','products.id','=','bill_detail.id_product')
       			->Select('products.name as products_name','bill_detail.id_product',DB::raw('sum(quantity) as Soluong'))->groupBy('products_name','bill_detail.id_product')->get();
        return $product;
    }
    //tìm số lượng bán từ ngày nào tới ngày nào 
    public static function FindSum_QuantityById($id,$created_at_from,$created_at_to){
        $product=DB::table('bill_detail')
        		->leftjoin('products','products.id','=','bill_detail.id_product')
       			->Select(DB::raw('DATE(bill_detail.created_at) as Ngay'),'products.name as products_name','bill_detail.id_product',DB::raw('sum(quantity) as Soluong'))
       			->where('bill_detail.id_product','=',$id)
            ->whereRaw("DATE(bill_detail.created_at)>='$created_at_from' AND DATE(bill_detail.created_at)<='$created_at_to'")
       			->groupBy('products_name','bill_detail.id_product','Ngay')
       			->get();
        return $product;   
        }

}
