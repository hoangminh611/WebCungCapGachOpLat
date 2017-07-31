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
                // ->join('users','bills.id_user','=','users.id')
                // ->select('users.full_name','bills.id','bills.id_user','bills.id_customer','bills.method','bills.note','bills.created_at','bills.updated_at');
                ->select();
    	return $Bill;
    }
    //lay bill theo di
    public static function View_bill_byId($id)
    {
        $Bill=DB::table('bills')->where('id',$id)->select();
        return $Bill;
    }
    //update bill update lai cai phuong thuc
    public static function Update_Bill($id,$method)
    {
        $Bill=DB::table('bills')->where('id',$id)->update(['method'=>$method]);
    }
    //Insert customer vào bill
    public static function Insert_Bill($idcustomer,$note)
    {
         $Bill=DB::table('bills')->insertGetId(['id_customer'=>$idcustomer,'method'=>'chua xac nhan','note'=>$note]);
         return $Bill;
    }

    //count bill
    public static function Count_All_Bill()
    {
         $Bill=DB::table('bills')->count('id');
         return $Bill;
    }
}
