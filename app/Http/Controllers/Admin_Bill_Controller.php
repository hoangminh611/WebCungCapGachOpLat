<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth; 
use Illuminate\Support\Facades\Input;
use App\Bill;
use App\Bill_Detail;
use Session;
use App\Import_product;
class Admin_Bill_Controller extends Controller
{
   public function ViewPageBill_Admin()
   {
   	$Bill=Bill::All_Bill()->get();
   	return view('Admin.Page.Bill_Admin',compact('Bill'));
   }

   public function ViewPageBill_Detail_Admin($id)
   {
   	$Bill_Detail=Bill_Detail::View_All($id)->get();
   	return view('Admin.Page.Bill_Detail_Admin',compact('Bill_Detail'));
   }

   public function ViewPageBill_Admin_Insert(Request $req)
   {
      $id=$req->id;
      $user=$req->user;
      $customer=$req->customer;
      $bill=Bill::View_bill_byId($id)->get();
      return view('Admin.Page.Bill_Admin_Insert',compact('bill','user','customer','id'));
   }
   public function ViewPageBill_Detail_Admin_Insert(Request $req)
   {
   	$id_bill_detail=$req->id;
   	$quantity=$req->quantity;
   	$name_pro=$req->name_product;
   	$Bill_Detail=DB::table('bill_detail')->where('id',$id_bill_detail)->select()->get();
   	return view('Admin.Page.Bill_Detail_Admin_Insert',compact('Bill_Detail','quantity','name_pro'));
   }

   public function Update_Bill_Detail(Request $req)
   {
   	$id=$req->id;
   	$first_quantity=$req->first_quantity;
   	$quantity=$req->quantity;
   	$id_product=$req->id_product;
   	$size=$req->size;
   	$id_bill=$req->id_bill;
   	$bill_detail=Bill_Detail::Update_Bill_Detail($id,$first_quantity,$quantity,$id_product,$size);
   	return redirect()->route('ViewPageBill_Detail_Admin',$id_bill);
   }

   public function Update_Bill(Request $req)
   {
      $id=$req->id;
      $method=$req->method;
      $bill=Bill::Update_Bill($id,$method);
      return redirect()->route('ViewPageBill_Admin');
   }

}
