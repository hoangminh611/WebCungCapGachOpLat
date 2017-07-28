<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Import_product extends Model
{
    protected $table='import_product';
    public $timestamps = true;
    //xòa sản phẩm theo id product va size doi voi xoa từng sản phẩm,kiểm tra coi san pham do con size nao k
    public static function Delete_Import_Product($id,$size){
        $pro=DB::table('import_product')
        			->whereRaw("id_product ='$id' and size REGEXP '$size'")->delete();
        $pro=DB::table('import_product')
        		->where('id_product','=',$id)->select()->first();
        return $pro;
    }
     public static function FindOneImportProduct($id,$size)
    {
        $pro=DB::table('import_product')
                ->where('id_product','=',$id)->select();
        return $pro;
    }
    //xòa sản phẩm khi loại sản phẩm bị xóa
    public static function Delete_Import_Product_By_Id($id)
    {
         $pro=DB::table('import_product')
                ->where('id_product','=',$id)->delete();
    }
    //insert vào bảng import product
    public static function Insert_Import_Product($id,$size,$import_price,$import_quantity)
    {
            $pro=DB::table('import_product')->insert(['id_product'=>$id,'size'=>$size,'import_price'=>$import_price,'import_quantity'=>$import_quantity]);
    }
    //update lai bang import product khi nó lở nhập sai
    public static function Update_Import_Product($id,$first_size,$size,$import_price,$import_quantity)
    {
        $pro=DB::table('import_product')
                ->whereRaw("id_product ='$id' and size REGEXP'$first_size' ")->update(['size'=>$size,'import_price'=>$import_price,'import_quantity'=>$import_quantity]);
    }
}