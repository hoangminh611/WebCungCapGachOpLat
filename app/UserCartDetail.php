<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class UserCartDetail extends Model
{
    protected $table='user_cart_detail';
    public $timestamps = true;
   	public static function getCartDetailByUserId($userID) {
   		$userCart = DB::table('user_cart_detail')
   						->join('export_product', 'user_cart_detail.id_export_product', '=', 'export_product.id')
   						->join('products', 'export_product.id_product', '=', 'products.id')
   						->where('user_cart_id', $userID)
   						->select('export_product.id as idsize','user_cart_detail.quantity as quantity'
   							, 'export_product.size', 'export_product.export_price','export_product.error_quantity'
   							, 'products.id', 'products.name', 'products.image');
   		return $userCart;
   	}

   	public static function addProductToCartUserByID($idExportProduct, $userID, $quantity) {
   		$userCart = DB::table('user_cart_detail')
   						->where([['user_cart_id', $userID], ['id_export_product', $idExportProduct]])
   						->select('id','quantity')->first();
   		if(isset($userCart->id)) {
   			$userCart = DB::table('user_cart_detail')
   						->where([['user_cart_id', $userID], ['id_export_product', $idExportProduct]])
   						->update(['quantity' => ($userCart->quantity + $quantity)]);
   		}
   		else {
   			$userCart = DB::table('user_cart_detail')
   						->insert(['user_cart_id' => $userID, 'id_export_product' => $idExportProduct, 'quantity' =>$quantity]);
   		}

   	}

   	public static function deleteAllProductFromCartByID($userID) {
   		$userCart = DB::table('user_cart_detail')
   						->where([['user_cart_id', $userID]])
   						->delete();
   	}
    
    public static function deleteOneProductFromCartByID($idExportProduct, $userID) {
    	$userCart = DB::table('user_cart_detail')
   						->where([['user_cart_id', $userID], ['id_export_product', $idExportProduct]])
   						->delete();
    }

    public static function reduceByOne($idExportProduct, $userID) {
    	$userCart = DB::table('user_cart_detail')
   						->where([['user_cart_id', $userID], ['id_export_product', $idExportProduct]])
   						->select('id','quantity')->first();
   		if(isset($userCart->id)) {
   			$userCart = DB::table('user_cart_detail')
   						->where([['user_cart_id', $userID], ['id_export_product', $idExportProduct]])
   						->update(['quantity' => ($userCart->quantity -1)]);
   		}
   	}

}
