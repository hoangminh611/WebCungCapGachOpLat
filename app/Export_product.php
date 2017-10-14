<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Export_product extends Model
{
    protected $table='export_product';
    public $timestamps = true;

    //Tìm sản phẩm theo id của bàng export để bỏ vào cart
    public static function FindProductByIdPro_Size($idsize)
    {
    	$product=DB::table('export_product')
    				->where('export_product.id',$idsize)
    				->join('products','export_product.id_product','=','products.id')
    				->select('export_product.id as idsize','products.id','products.name','products.image','export_product.size','export_product.export_price','export_product.export_quantity','export_product.error_quantity');
    	return $product;
    }
     //xòa sản phẩm theo id product va size doi voi xoa từng sản phẩm,kiểm tra coi san pham do con size nao k
    public static function Delete_Export_Product($id,$size)
    {
        $pro=DB::table('export_product')
        		->where([
                    ['id_product','=',$id],
                    ['size',$size],])->delete();
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
                    ['size',$size],])->update(['status'=>1]);
    }
    //tìm sản phẩm 
    public static function FindOneExportProduct($id,$size)
    {
        $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size',$size],])->select();
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
                    ['size',$size],
                    ['status',0]])->first();
        if(!isset($pro))
            $pro=DB::table('export_product')->insert(['id_product'=>$id,'size'=>$size,'export_price'=>$export_price]);
        else
            $pro=DB::table('export_product')
                ->where([
                    ['id_product','=',$id],
                    ['size',$size],])->update(['export_price'=>$export_price]);

    }
    //lúc sửa lại mọi thứ trong sản phẩm
    public static function Update_Export_Product($id,$first_size,$size,$export_price)
    {
        
            //kiểm tra xem kích thước mới nhập có bằng kích thước ban đầu hay không nếu bằng update lai giá không bằng thì kiểm tra xem trong bang export co cai kích thước đó chưa nếu có thì trả về là đã có
            if($first_size!=$size)
            {
             $pro=DB::table('export_product')
                    ->where([
                        ['id_product','=',$id],
                        ['size',$size],
                        ['status',0]])->select()->first();
                if(!isset($pro))
                {
                //kiểm tra xem trong bảng import product có hơn 2 lần nhập hàng hay không nếu hơn 2 lần thì thêm kích thước vô bảng export do nếu thay đổi size sẽ gây ra mất hàng bán ra

                    $import=DB::table('import_product')
                                    ->where([
                                    ['id_product','=',$id],
                                    ['size',$first_size],])->select()->get();
                    if(isset($import[1]))
                    {

                        $pro=DB::table('export_product')->insert(['id_product'=>$id,'size'=>$size,'export_price'=>$export_price]);
                    }
                    elseif(isset($import[0]))
                    {
                                $pro=DB::table('export_product')
                                ->where([
                                    ['id_product','=',$id],
                                    ['size',$first_size],])->update(['size'=>$size,'export_price'=>$export_price]);
                            }
                }
                else
                   {
                    //nếu như size bị  nhập kho sai mà trước khi size bị size đó đã có rồi thỉ chỉ update lại giá size mới còn nếu như size bị sai đó lúc trước mà chưa có thì phãi liên hệ thằng admin để xóa size đó đi
                    $pro=DB::table('export_product')
                            ->where([
                                ['id_product','=',$id],
                                ['size',$size],])->update(['export_price'=>$export_price]);
                    $import=DB::table('import_product')
                                    ->where([
                                    ['id_product','=',$id],
                                    ['size',$first_size],])->select()->get();
                     if(isset($import[1]))
                    {
                    }
                    //nếu như trong bảng import chỉ có 1 lần nhập hàng thì sau khi sửa giá cho price mới thì sau đó sẽ xóa product cũ đi
                    elseif(isset($import[0]))
                    {
                                $pro=DB::table('export_product')
                                ->where([
                                    ['id_product','=',$id],
                                    ['size',$first_size],])->update(['status'=>1]);
                    }
                   }
            }
            else
            {
                                $pro=DB::table('export_product')
                                ->where([
                                    ['id_product','=',$id],
                                    ['size',$first_size],])->update(['size'=>$size,'export_price'=>$export_price]);
            }
        
    }
    //insert vào bảng export
    public static function Insert_Export_Product($idExportProduct,$quantity)
    {
        $pro=DB::table('export_product')
                ->where([
                    ['id','=',$idExportProduct],])
                ->select('export_quantity')->get();
        $export_quantity=$pro[0]->export_quantity + $quantity;
         $pro=DB::table('export_product')
                ->where([
                    ['id','=',$idExportProduct],])
                ->update(['export_quantity'=>$export_quantity]);
        return $pro;
    }
    //tìm tổng lượng đã bán
    public static function ALl_Sale_Quantity()
    {
          $pro=DB::table('export_product')->sum('export_quantity');
          return $pro;
    }
    //update lai quantity khi xoa 1 bill detail
    public static function Update_quantity_By_Idproduct($idExportProduct,$quantity)
    {
        $quantity_pro=DB::table('export_product')->where([['id',$idExportProduct],])->select('export_quantity')->get();
        $quantity=$quantity_pro[0]->export_quantity-$quantity;
        $quantity_pro=DB::table('export_product')->where([['id',$idExportProduct],])->update(['export_quantity'=>$quantity]);
    }


    //---------------------------------ADMIN---------------------------------------------------------
    //lấy tất cả của bảng export product ra
    public static function All_export_product()
    {
        $product=DB::table('export_product')
                    ->join('products','export_product.id_product','=','products.id')
                    ->select('export_product.id as idsize','products.name','export_product.size','export_product.error_quantity','export_product.export_quantity','export_product.export_price');
        return $product;
    }
    //update lại sản phẩm lỗi
    public static function Update_ErrorProduct($idsize,$error_quantity)
    {
         $product=DB::table('export_product')->where('id',$idsize)->update(['error_quantity'=>$error_quantity]);
    }
}