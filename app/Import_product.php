<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Import_product extends Model
{
    protected $table='import_product';
    public $timestamps = true;
    public static function Delete_Import_Product($id,$size){
        $pro=DB::table('import_product')
        			->whereRaw("id_product ='$id' and size REGEXP '$size'")->delete();
        $pro=DB::table('import_product')
        		->where('id_product','=',$id)->select()->first();
        return $pro;
    }
    
    public static function Insert_Import_Product($id,$size,$import_price,$import_quantity)
    {
            $pro=DB::table('import_product')->insert(['id_product'=>$id,'size'=>$size,'import_price'=>$import_price,'import_quantity'=>$import_quantity]);
    }
}