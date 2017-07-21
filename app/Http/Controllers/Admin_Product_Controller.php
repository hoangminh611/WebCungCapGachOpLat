<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\Product;
class Admin_Product_Controller extends Controller
{
   public function Admin_All_Product()
   {
   	$product=Product::Show_Product_All()->paginate(8);
   	return view('Admin.Page.Product_Admin',compact('product'));
   }

   public function Admin_All_Product_By_Type(Request $req)
   {
   	$product=Product::Show_Product_All_By_Type($req->id)->paginate(8);
   	$typepro=$req->id;
   	return view('Admin.Page.Product_Admin',compact('product'));
   }

    public function Admin_All_Type()
   {
      $Type_Product=TypeProduct::Show_All_Type_Product_Parent()->paginate(8);
      return view('Admin.Page.Category_Admin',compact('Type_Product'));
   }
      public function Admin_All_Type_By_Type(Request $req)
   {
      $Type_Product=TypeProduct::Show_All_Type_Product_By_Id_Parent($req->id)->paginate(8);
      $name_parent=DB::table('category')->where('id',$req->id)->select('name')->get();
      return view('Admin.Page.Category_Admin',compact('Type_Product','name_parent'));
   }
}
