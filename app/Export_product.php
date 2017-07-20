<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Export_product extends Model
{
    protected $table='export_product';
    public static function FindProductByIdPro_Size($idsize)
    {
    	$product=DB::table('export_product')
    				->where('export_product.id',$idsize)
    				->join('products','export_product.id_product','=','products.id')
    				->select('export_product.id as idsize','products.id','products.name','products.image','export_product.size','export_product.export_price');
    	return $product;
    }

}