<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Import_product extends Model
{
    protected $table='import_product';
    public $timestamps = true;

    public static function All_Import_Product()
    {
         $pro=DB::table('import_product')->join('products','import_product.id_product','=','products.id')
         ->select('import_product.id as idsize','products.name','import_product.size','import_product.import_price','import_product.import_quantity','import_product.created_at');
         return $pro;
    }
    //xòa sản phẩm theo id product va size doi voi xoa từng sản phẩm,kiểm tra coi san pham do con size nao k
    public static function Delete_Import_Product($id,$size){
        $pro=DB::table('import_product')
        			->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->delete();
        $pro=DB::table('import_product')
        		->where('id_product','=',$id)->select()->first();
        return $pro;
    }
     public static function FindOneImportProduct($id,$size)
    {
        $pro=DB::table('import_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->select();
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
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->update(['size'=>$size,'import_price'=>$import_price,'import_quantity'=>$import_quantity]);
    }

     public static function Select_Import_Product()
    {
        $a=array();
        $bills=DB::table('import_product')->select()->orderBy('id')->get() ;
        foreach ($bills as $bill) {
            if(isset($a[$bill->id_product][$bill->size]))
             $a[$bill->id_product][$bill->size]+=$bill->import_price*$bill->import_quantity;
            else
            {
                $a[$bill->id_product][$bill->size]=$bill->import_price*$bill->import_quantity;
                $a[$bill->id_product][$bill->id_product]=$bill->id_product;
            }
            


        }
       return $a;
    }
}