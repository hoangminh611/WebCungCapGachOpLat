<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Export_product extends Model
{
    protected $table='export_product';
    public $timestamps = true;

    //Tìm sản phẩm theo id của bàng export
    public static function FindProductByIdPro_Size($idsize)
    {
    	$product=DB::table('export_product')
    				->where('export_product.id',$idsize)
    				->join('products','export_product.id_product','=','products.id')
    				->select('export_product.id as idsize','products.id','products.name','products.image','export_product.size','export_product.export_price');
    	return $product;
    }
     //xòa sản phẩm theo id product va size doi voi xoa từng sản phẩm,kiểm tra coi san pham do con size nao k
    public static function Delete_Export_Product($id,$size)
    {
        $pro=DB::table('export_product')
        		->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->delete();
        $pro=DB::table('export_product')
        		->where('id_product','=',$id)->select()->first();
        return $pro;
    }
    //cho status no bang 1
      public static function Update_Delete_Export_Product($id,$size)
    {
        $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->update(['status'=>1]);
    }
    //tìm sản phẩm 
    public static function FindOneExportProduct($id,$size)
    {
        $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->select();
        return $pro;
    }
    //xòa sản phẩm khi loại sản phẩm bị xóa
    public static function Delete_Export_Product_By_Id($id)
    {
         // $pro=DB::table('export_product')
         //        ->where('id_product','=',$id)->delete();
         $pro=DB::table('export_product')
                ->where('id_product','=',$id)->update(['status'=>1]);
    }
    //Lúc nhập hàng hoặc thêm kích thước
    public static function  Update_Insert_Export_Product($id,$size,$export_price)
    {
        $pro=DB::table('export_product')
               ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->first();
        if(!isset($pro))
            $pro=DB::table('export_product')->insert(['id_product'=>$id,'size'=>$size,'export_price'=>$export_price]);
        else
            $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->update(['export_price'=>$export_price]);

    }
    //lúc sửa lại mọi thứ trong sản phẩm
    public static function Update_Export_Product($id,$first_size,$size,$export_price)
    {
        $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->update(['size'=>$size,'export_price'=>$export_price]);
    }

    public static function Insert_Export_Product($id,$size,$quantity)
    {
        $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->select('export_quantity')->get();
        $export_quantity=$pro[0]->export_quantity + $quantity;
         $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size','LIKE','%'.$size.'%'],])->update(['export_quantity'=>$export_quantity]);
        return $pro;
    }
    //tìm tổng lượng đã bán
    public static function ALl_Sale_Quantity()
    {
          $pro=DB::table('export_product')->sum('export_quantity');
          return $pro;
    }
    //update lai quantity khi xoa 1 bill detail
    public static function Update_quantity_By_Idproduct($id,$size,$quantity)
    {
        $quantity_pro=DB::table('export_product')->where([['id_product',$id],['size','LIKE','%'.$size.'%']])->select('export_quantity')->get();
        $quantity=$quantity_pro[0]->export_quantity-$quantity;
        $quantity_pro=DB::table('export_product')->where([['id_product',$id],['size','LIKE','%'.$size.'%']])->update(['export_quantity'=>$quantity]);
    }
}