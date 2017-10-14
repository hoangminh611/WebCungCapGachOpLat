<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Bill;
use App\Customer;
use App\Discount;
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
        ->where('id_bill',$id)
        ->join('export_product','bill_detail.id_export_product','=','export_product.id')
        ->join('products','export_product.id_product','=','products.id')
        ->select('products.name','bill_detail.id','bill_detail.id_bill','bill_detail.id_export_product','export_product.size','bill_detail.quantity','bill_detail.sales_price','bill_detail.created_at','bill_detail.updated_at','export_product.id_product');
        return $bill_detail;
    }
    //update lai số lượng mua của khách hàng
    public static function Update_Bill_Detail($id,$first_quantity,$quantity,$idExportProduct)
    {
        if($first_quantity>$quantity)
        {
            $new_quantity=$first_quantity-$quantity;
            $export_quantity=DB::table('export_product')->where([
                    ['id','=',$idExportProduct],
                    ])->select('export_quantity')->get();
            $export_quantity=$export_quantity[0]->export_quantity-$new_quantity;
            $export=DB::table('export_product')->where([
                    ['id','=',$idExportProduct],
                    ])->update(['export_quantity'=>$export_quantity]);
        }

        else
        {
            $new_quantity=$quantity-$first_quantity;
            $export_quantity=DB::table('export_product')->where([
                    ['id','=',$idExportProduct],
                    ])->select('export_quantity')->get();
            $export_quantity=$export_quantity[0]->export_quantity+$new_quantity;
            $export=DB::table('export_product')->where([
                    ['id','=',$idExportProduct],
                    ])->update(['export_quantity'=>$export_quantity]);
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
    // //khi xóa theo từng sản phẩm và kiểm tra coi sản phẩm đó còn size nào k(không cần nữa)
    // public static function Delete_Bill_Detail($id,$size){
    //     $pro=DB::table('bill_detail')
    //         ->where([
    //                 ['id_product','=',$id],
    //                 ['size','LIKE','%'.$size.'%'],])->delete();
    //     $pro=DB::table('bill_detail')
    //         ->where('id_product','=',$id)->select()->first();
    // }
    // khi xóa loại sản phẩm (không càn nữa)
    // public static function Delete_Bill_Detail_By_Id($id_product)
    // {
    //      $pro=DB::table('bill_detail')
    //         ->where('id_product','=',$id)->delete();
    // }
    //Khi xóa 1 bill_Detail
    public static function Delete_One_Bill_Detail($id)
    {
        $id_bill_detail=DB::table('bill_detail')
            ->where('id','=',$id)->select('id_bill')->get();

        $Delete_Bill_Detail=DB::table('bill_detail')
            ->where('id','=',$id)->delete();
        $bill=DB::table('bill_detail')
            ->where('id_bill','=',$id_bill_detail[0]->id_bill)->select()->first();
        if(!isset($bill))
        {
            $Id_Customer=Bill::View_bill_byId($id_bill_detail[0]->id_bill)->select()->get();
             $Delete_Bill=Bill::Delete_Bill($id_bill_detail[0]->id_bill);
             $Delete_Customer=Customer::Delete_Customer($Id_Customer[0]->id_customer);
        }
        

    }
    //Insert vào bill detail(xong)
    public static function Insert_Bill_Detail($id_bill,$idExportProduct,$sales_price,$Qty)
    {
         $pro=DB::table('bill_detail')->insert(['id_bill'=>$id_bill,'id_export_product'=>$idExportProduct,'sales_price'=>$sales_price,'quantity'=>$Qty]);
         return $pro;
    }
    //lấy giá ra để tính lời lãi lỗ
    public static function Select_Bill_Detail()
    {
        $a=array();
        $a['tongtienxuat']=0;
        $bill=DB::table('bill_detail')->join('bills','bill_detail.id_bill','=','bills.id')
        ->join('export_product','bill_detail.id_export_product','=','export_product.id')
        ->join('products','export_product.id_product','=','products.id')
        ->where('bills.method','LIKE','%Đã Thanh Toán%')->select()->get();
        // dd($bill);
        foreach ($bill as $bill_detail) {

            $discount=Discount::Get_Discount_By_Id($bill_detail->discount)->first();

            if(isset($a[$bill_detail->id_product][$bill_detail->size]))
            {
             $a[$bill_detail->id_product][$bill_detail->size]['price']+=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;
             $a[$bill_detail->id_product][$bill_detail->size]['quantity']+=$bill_detail->quantity;
             $a['tongtienxuat']+=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;;
            }
            else
            {
            $a[$bill_detail->id_product][$bill_detail->size]['price']=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;
             $a[$bill_detail->id_product][$bill_detail->id_product]=$bill_detail->id_product;
             $a[$bill_detail->id_product][$bill_detail->size]['quantity']=$bill_detail->quantity;
            $a['tongtienxuat']+=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;;
            }

        }
       return $a;
    }

    public static function getTotalByMonth($month_start,$month_end){
            // public static function FindSum_QuantityById($id,$created_at_from,$created_at_to){
        $a=array();
        //$a['tongtienxuat']=0;
        $bill=DB::table('bill_detail')
                ->join('export_product','bill_detail.id_export_product','=','export_product.id')
                ->join('products','export_product.id_product','=','products.id')
                ->join('bills','bill_detail.id_bill','=','bills.id')
                ->Select()
                ->where('bills.method','LIKE','%Đã Thanh Toán%')
                ->whereRaw("DATE(bill_detail.updated_at)>='$month_start' AND DATE(bill_detail.updated_at)<'$month_end'")
                ->get();
        foreach ($bill as $bill_detail) {

            $discount=Discount::Get_Discount_By_Id($bill_detail->discount)->first();

            if(isset($a[$bill_detail->id_product][$bill_detail->size]))
            {
             $a[$bill_detail->id_product][$bill_detail->size]['price']+=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;
             $a[$bill_detail->id_product][$bill_detail->size]['quantity']+=$bill_detail->quantity;
             $a[$bill_detail->id_product][$bill_detail->size]['size']=$bill_detail->size;
            // $a['tongtienxuat']+=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;
             $a[$bill_detail->id_product][$bill_detail->size]['name']=$bill_detail->name;
            }
            else
            {
            $a[$bill_detail->id_product][$bill_detail->size]['price']=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;
             $a[$bill_detail->id_product][$bill_detail->size]['quantity']=$bill_detail->quantity;
             $a[$bill_detail->id_product][$bill_detail->size]['size']=$bill_detail->size;
            //$a['tongtienxuat']+=($bill_detail->sales_price*$bill_detail->quantity)*(100-$discount->percent_discount)/100;
             $a[$bill_detail->id_product][$bill_detail->size]['name']=$bill_detail->name;
            }

        }
        return $a;   
        // }
    }
}
