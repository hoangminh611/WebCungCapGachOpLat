<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth; 
use Illuminate\Support\Facades\Input;
use App\Gift;
class Admin_Gift_Controller extends Controller
{
  //view trang login admin
   public function viewPageGift()
   {
     $getGifts=Gift::getGift()->get();
   	 return view('Admin.Page.Gift_Admin',compact('getGifts'));
   }

   public function  viewPageInsertGift(Request $req){
   		$id=$req->id;
   		if($id==null)
   			$id=0;
   		$gift=Gift::getDiscountById($id)->get();
   	return view('Admin.Page.Gift_Admin_Insert',compact('gift','id'));
   }

   public function insertGift(Request $req){
         
   		$insertGift=Gift::insertGift($req->name_gift,$req->price_gift) ;
   	 	return redirect()->route('Gift_Admin');
   }

   public function updateGift(Request $req){
   		$updateGift=Gift::updateGift($req->id,$req->name_gift,$req->price_gift);
   	 	return redirect()->route('Gift_Admin');
   }

   public function deleteGift(Request $req){
   		$deleteGift=Gift::deleteGift($req->id);
   }
}
