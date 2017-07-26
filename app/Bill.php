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
                ->join('users','bills.id_user','=','users.id')
                ->select('users.full_name','bills.id','bills.id_user','bills.id_customer','bills.method','bills.note','bills.created_at','bills.updated_at');
    	return $Bill;
    }
    //lay bill theo di
    public static function View_bill_byId($id)
    {
        $Bill=DB::table('bills')->where('id',$id)->select();
        return $Bill;
    }

    public static function Update_Bill($id,$method)
    {
        $Bill=DB::table('bills')->where('id',$id)->update(['method'=>$method]);
    }
}
