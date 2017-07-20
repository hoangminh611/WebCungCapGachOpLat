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
   	$typepro=0;
   	return view('Admin.Page.Product_Admin',compact('product','typepro'));
   }

   public function Admin_All_Product_By_Type(Request $req)
   {
   	$product=Product::Show_Product_All_By_Type($req->id)->paginate(8);
   	$typepro=$req->id;
   	return view('Admin.Page.Product_Admin',compact('product','typepro'));
   }
}
