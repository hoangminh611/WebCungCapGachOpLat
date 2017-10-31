<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Bill extends Model
{
    protected $table='bills';
    public $timestamps = true;
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_bill','id');
    }

	//Lấy tất cả bill
    public static function All_Bill()
    {
    	$Bill=DB::table('bills')
                ->join('customer','bills.id_customer','=','customer.id')
                ->select('customer.full_name','customer.phone','customer.address','customer.email','bills.id','bills.id_customer','bills.method','bills.note','bills.created_at','bills.updated_at','bills.pay_online');
    	return $Bill;
    }
    //lay bill theo id
    public static function View_bill_byId($id)
    {
        $Bill=DB::table('bills')->where('id',$id)->select();
        return $Bill;
    }
    //update bill update lai cai phuong thuc
    public static function Update_Bill($id,$method,$discount,$currentPercentDiscount,$currentNameGift,$currentPriceGift)
    {
        $Bill=DB::table('bills')->where('id',$id)->update(['method' => $method,'discount' => $discount,'current_percent_discount'=>$currentPercentDiscount,'current_name_gift'=>$currentNameGift,'current_price_gift' => $currentPriceGift]);
    }
    //Insert customer vào bill
    public static function Insert_Bill($idcustomer,$note,$discount,$currentPriceGift,$currentPercentDiscount,$currentNameGift,$payOnline = '0')
    {
         $Bill=DB::table('bills')->insertGetId(['id_customer'=>$idcustomer,'method'=>'Chưa Xác Nhận','note'=>$note,'discount'=>$discount,'current_price_gift'=>$currentPriceGift,'current_percent_discount'=>$currentPercentDiscount,'current_name_gift'=>$currentNameGift, 'pay_online' => $payOnline]);
         return $Bill;
    }

    //count bill
    public static function Count_All_Bill()
    {
         $Bill=DB::table('bills')->count('id');
         return $Bill;
    }
    //Xóa bill
    public static function Delete_Bill($id){
         $bill=DB::table('bills')->where('id',$id)->delete();
         return $bill;
    }
    //tìm tổng giá để update lại discount
    public static function Sum_Price($id){
        $Bill=DB::table('bill_detail')->where('id_bill',$id)->select(DB::raw('sum(sales_price*quantity)as total'));
        return $Bill;

    }

    public static function View_bill_discountbyId($id){
         $Bill = DB::table('bills')->join('discount','bills.discount','=','discount.id')
                                 ->join('gift','gift.id','=','discount.id_gift')->where('bills.id',$id)->select();
        return $Bill;
    }

    public static function getAllPriceGift(){
        $totalGift = 0;
        $Bill = DB::table('bills')->where('bills.method','LIKE','%Đã Thanh Toán%')->select()->get();
        
        foreach ($Bill as $gift) {
            $totalGift += $gift->current_price_gift;
        }
        return $totalGift;
    }
}
