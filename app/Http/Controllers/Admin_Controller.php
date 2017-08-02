<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
use App\User;
use App\Customer;
use App\Bill_Detail;
use App\Import_product;
use App\Export_product;
use App\Product;
use App\Bill;
class Admin_Controller extends Controller
{
   //lấy lãi lỗ
   public function Content_Admin()
   {
   	$a=array();
      $bill_detail=Bill_Detail::Select_Bill_Detail();
      $import=Import_product::Select_Import_Product();
      $Import_product=DB::table('export_product')
      ->join('products','export_product.id_product','=','products.id')->select()->get();
      foreach ( $Import_product as $key) {

         if(!isset($bill_detail[$key->id_product][$key->size]))
         {
            $a[$key->id_product][$key->size]['price']=-$import[$key->id_product][$key->size];
             $a[$key->id_product][$key->size]['size']=$key->size;
             $a[$key->id_product][$key->id_product]=$key->name;
         }
         else
         {
            $a[$key->id_product][$key->size]['price']=$bill_detail[$key->id_product][$key->size]-$import[$key->id_product][$key->size];
            $a[$key->id_product][$key->size]['size']=$key->size;
            $a[$key->id_product][$key->id_product]=$key->name;
         }
      }

      $All_View=Product::All_ViewProduct();
      $Count_User=User::Count_All_User();
      $Count_Bill=Bill::Count_All_Bill();
      $All_Export_Quantity=Export_product:: ALl_Sale_Quantity();
     return view('Admin.Master.Admin_Content',compact('Import_product','a','All_View','Count_User','Count_Bill','All_Export_Quantity'));
   }

   public function ViewPage_User_Admin()
   {
   		$users=User::User_All()->get();
   		return view('Admin.Page.User_Admin',compact('users'));
   }
   public function ViewPage_ImportProduct_Admin()
   {
   		$product=Import_product::All_Import_Product()->orderBy('created_at','DESC')->get();
   		return view('Admin.Page.Import_Product_Admin',compact('product'));
   }

   public function ViewPage_Update_User($id)
   {
      $user=User::Select_User_By_Id($id)->get();
      return view('Admin.Page.User_Admin_Edit',compact('user'));
   }

   public function Update_User(Request $req)
   {
      $id=$req->id;
      $group=$req->group;
      $user=User::Update_User($id,$group);
      return redirect()->route('ViewPage_User_Admin');
   }
}
