<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth; 
use Illuminate\Support\Facades\Input;
use App\Discount;
class Admin_Discount_Controller extends Controller
{
  //view trang login admin
   public function View_Page_Discount()
   {
     $discounts=Discount::Get_All()->orderBy('price_discount')->get();
   	 return view('Admin.Page.Discount_Admin',compact('discounts'));
   }

   public function  View_Page_Insert_Discount(Request $req){
   		$id=$req->id;
   		if($id==null)
   			$id=0;
   		$discount=Discount::Get_Discount_By_Id($id)->get();
   	return view('Admin.Page.Discount_Admin_Insert',compact('discount','id'));
   }

   public function Insert_Discount(Request $req){
   		$insert_discount=Discount::Discount_Insert($req->price_discount,$req->gift,$req->percent_discount,$req->ship_price);
   	 	return redirect()->route('Discount_Admin');
   }

   public function Update_Discount(Request $req){
   		$update_discount=Discount::Discount_Update($req->id,$req->price_discount,$req->gift,$req->percent_discount,$req->ship_price);
   	 	return redirect()->route('Discount_Admin');
   }

   public function Delete_Discount(Request $req){
   		$update_discount=Discount::Delete_Discount($req->id);
   }
}
