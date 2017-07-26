<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Bill_Detail extends Model
{
	protected $table='bill_detail';
    public $timestamps = true;
      public function products(){
    	return $this->belongsTo('App\Product','id_product','id');
    }
    public function bills(){
    	return $this->belongsTo('App\Bill','id_bill','id');
    }
    //Lấy tất cả bill_detail của 1 bill nhất định
    public static function View_All($id)
    {
        $bill_detail=DB::table('bill_detail')
        ->where('id_bill',$id)->join('products','bill_detail.id_product','=','products.id')
        ->select('products.name','bill_detail.id','bill_detail.id_bill','bill_detail.size','bill_detail.quantity','bill_detail.sales_price','bill_detail.created_at','bill_detail.updated_at');
        return $bill_detail;
    }

    public static function Update_Bill_Detail($id,$first_quantity,$quantity,$id_product,$size)
    {
        if($first_quantity>$quantity)
        {
            $new_quantity=$first_quantity-$quantity;
            $export_quantity=DB::table('export_product')->whereRaw("id_product ='$id_product' and size REGEXP'$size' ")->select('export_quantity')->get();
            $export_quantity=$export_quantity[0]->export_quantity-$new_quantity;
            $export=DB::table('export_product')->whereRaw("id_product ='$id_product' and size REGEXP'$size' ")->update(['export_quantity'=>$export_quantity]);
        }

        else
        {
            $new_quantity=$quantity-$first_quantity;
            $export_quantity=DB::table('export_product')->whereRaw("id_product ='$id_product' and size REGEXP'$size' ")->select('export_quantity')->get();;
            $export_quantity=$export_quantity[0]->export_quantity+$new_quantity;
            $export=DB::table('export_product')->whereRaw("id_product ='$id_product' and size REGEXP'$size' ")->update(['export_quantity'=>$export_quantity]);
        }
        $bill_detail=DB::table('bill_detail')->where('id',$id)->update(['quantity'=>$quantity]);

    }
    // //Tìm tổng số lượng bản của tất cả các sản phẩm
    // public static function FindSum_Quantity(){
    //     $product=DB::table('bill_detail')
    //     		->leftjoin('products','products.id','=','bill_detail.id_product')
    //    			->Select('products.name as products_name','bill_detail.id_product',DB::raw('sum(quantity) as Soluong'))->groupBy('products_name','bill_detail.id_product')->get();
    //     return $product;
    // }
    // //tìm số lượng bán từ ngày nào tới ngày nào 
    // public static function FindSum_QuantityById($id,$created_at_from,$created_at_to){
    //     $product=DB::table('bill_detail')
    //     		->leftjoin('products','products.id','=','bill_detail.id_product')
    //    			->Select(DB::raw('DATE(bill_detail.created_at) as Ngay'),'products.name as products_name','bill_detail.id_product',DB::raw('sum(quantity) as Soluong'))
    //    			->where('bill_detail.id_product','=',$id)
    //         ->whereRaw("DATE(bill_detail.created_at)>='$created_at_from' AND DATE(bill_detail.created_at)<='$created_at_to'")
    //    			->groupBy('products_name','bill_detail.id_product','Ngay')
    //    			->get();
    //     return $product;   
    //     }
    //khi xóa theo từng sản phẩm và kiểm tra coi sản phẩm đó còn size nào k
    public static function Delete_Bill_Detail($id,$size){
        $pro=DB::table('bill_detail')
            ->whereRaw("id_product ='$id' and size REGEXP'$size' ")->delete();
        $pro=DB::table('bill_detail')
            ->where('id_product','=',$id)->select()->first();
    }
    // khi xóa loại sản phẩm 
    public static function Delete_Bill_Detail_By_Id($id)
    {
         $pro=DB::table('bill_detail')
            ->where('id_product','=',$id)->delete();
    }



}
