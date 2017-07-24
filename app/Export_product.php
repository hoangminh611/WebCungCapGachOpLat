<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Export_product extends Model
{
    protected $table='export_product';
    public $timestamps = true;
    public static function FindProductByIdPro_Size($idsize)
    {
    	$product=DB::table('export_product')
    				->where('export_product.id',$idsize)
    				->join('products','export_product.id_product','=','products.id')
    				->select('export_product.id as idsize','products.id','products.name','products.image','export_product.size','export_product.export_price');
    	return $product;
    }
    public static function Delete_Export_Product($id,$size)
    {
        $pro=DB::table('export_product')
        		->whereRaw("id_product ='$id' and size REGEXP'$size' ")->delete();
        $pro=DB::table('export_product')
        		->where('id_product','=',$id)->select()->first();
        return $pro;
    }
    public static function  Update_Insert_Export_Product($id,$size,$export_price)
    {
        $pro=DB::table('export_product')
                ->whereRaw("id_product ='$id' and size REGEXP'$size' ")->first();
        if(!isset($pro))
            $pro=DB::table('export_product')->insert(['id_product'=>$id,'size'=>$size,'export_price'=>$export_price]);
        else
            $pro=DB::table('export_product')
                ->whereRaw("id_product ='$id' and size REGEXP'$size' ")->update(['export_price'=>$export_price]);

    }
}