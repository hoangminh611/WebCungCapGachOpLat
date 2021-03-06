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
use PDF;
use DateTime;
use DateInterval;
use Carbon\Carbon;
use App\Staff_permission;
class Admin_Controller extends Controller
{
   //lấy lãi lỗ
   public function getContentAdmin(Request $req) {
      $outOfDate = new DateTime(Carbon::now()->format('Y-m-01'));
      $outOfDate->sub(new DateInterval('P1M'));
      $user = User::selectAllUserWithNoActiveAndNotProvider($outOfDate);
   	$a=array();
      $bill_detail=Bill_Detail::Select_Bill_Detail();

      $import=Import_product::Select_Import_Product();
      $tongtiennhap= $import['tongtiennhap'];
      $tongtienxuat= $bill_detail['tongtienxuat'];
      // $Import_product=DB::table('import_product')
      //                   ->join('products','import_product.id_product','=','products.id')
      //                   ->select()->get();
       $exportProduct=DB::table('export_product')
                        ->join('products','export_product.id_product','=','products.id')
                        ->select()->get();
      foreach ( $exportProduct as $key) {
         $a[$key->id_product][$key->size]['import_price']=$import[$key->id_product][$key->size]['price'];
         $a[$key->id_product][$key->size]['size']=$key->size;
         $a[$key->id_product][$key->size]['name']=$key->name;
         $a[$key->id_product][$key->size]['import_quantity']=$import[$key->id_product][$key->size]['import_quantity'];
         $a[$key->id][$key->size]['totalSalesQuantity'] = $key->export_quantity;
         if(!isset($bill_detail[$key->id_product][$key->size])) {
            $a[$key->id_product][$key->size]['price']=-$import[$key->id_product][$key->size]['price'];
            // $a[$key->id_product][$key->size]['import_price']=$import[$key->id_product][$key->size]['price'];
            // $a[$key->id_product][$key->size]['size']=$key->size;
            // $a[$key->id_product][$key->size]['name']=$key->name;
            // $a[$key->id_product][$key->size]['import_quantity']=$import[$key->id_product][$key->size]['import_quantity'];
         }
         else{

            $a[$key->id_product][$key->size]['price']=$bill_detail[$key->id_product][$key->size]['price']-$import[$key->id_product][$key->size]['price'];
            // $a[$key->id_product][$key->size]['import_price']=$import[$key->id_product][$key->size]['price'];
            $a[$key->id_product][$key->size]['export_price']=$bill_detail[$key->id_product][$key->size]['price'];
            // $a[$key->id_product][$key->size]['size']=$key->size;
            // $a[$key->id_product][$key->size]['name']=$key->name;
            // $a[$key->id_product][$key->size]['import_quantity']=$import[$key->id_product][$key->size]['import_quantity'];
            $a[$key->id_product][$key->size]['export_quantity']=$bill_detail[$key->id_product][$key->size]['quantity'];

         }
      }

      $All_View = Product::All_ViewProduct();
      $Count_User = User::Count_All_User();
      $Count_Bill = Bill::Count_All_Bill();

      $All_Export_Quantity = Export_product:: ALl_Sale_Quantity();
      $totalPriceGift = Bill::getAllPriceGift();
      $month_end = new DateTime(Carbon::now()->format('Y-m-01'));
      $month_end->add(new DateInterval('P1M'));
      $date = new DateTime(Carbon::now()->format('Y-m-01'));
      $getMonth=$date->format('m');

      $Total_By_Month=Bill_Detail::getTotalByMonth($date->format('Y-m-d'), $month_end->format('Y-m-d'));

      return view('Admin.Master.Admin_Content',compact('tongtiennhap','tongtienxuat','a','All_View','Count_User','Count_Bill','All_Export_Quantity','Total_By_Month','getMonth','totalPriceGift'));
   }

   public function countProductNotEnoughQuantity(){
      $a = array();
      $count = 0;
      $import = Import_product::Select_Import_Product();
      $exportProduct = DB::table('export_product')
                        ->join('products','export_product.id_product','=','products.id')
                        ->select()->get();
      foreach ( $exportProduct as $key) {
         if ( ($import[$key->id_product][$key->size]['import_quantity']-$key->export_quantity ) <= 0)
            $count++;    
      }
      return $count ;
   }

   //lấy tổng số doanh thu bán hàng theo từng tháng khi ajax
   public function getMonthlyFund(Request $req) {
      $results=array();
      $month_end = new DateTime(Carbon::now()->format("Y-$req->date-01"));
      $month_end->add(new DateInterval('P1M'));
      $date  = new DateTime(Carbon::now()->format("Y-$req->date-01"));
      
      $Total_By_Month=Bill_Detail::getTotalByMonth($date->format('Y-m-d'), $month_end->format('Y-m-d'));
      
      foreach ($Total_By_Month as $totals) {
         foreach($totals as $total_product)
         {
            $results[] = $total_product;
         }
      }

      return $results;
   }

   //xem trang user admin
   public function ViewPage_User_Admin() {
   		$users=User::User_All()->orderBy('group','DESC')->get();
   		return view('Admin.Page.User_Admin',compact('users'));
   }

   //xem trang import_product admin
   public function ViewPage_ImportProduct_Admin() {
   		$product=Import_product::All_Import_Product()->orderBy('created_at','DESC')->get();
   		return view('Admin.Page.Import_Product_Admin',compact('product'));
   }

   //xem trang update user admin
   public function ViewPage_Update_User($id) {
      $user=User::Select_User_By_Id($id)->get();
      $staffPermission=User::getUserPermission($id)->get();
      return view('Admin.Page.User_Admin_Edit',compact('user','staffPermission'));
   }

   //updte lai user admin
   public function Update_User(Request $req) {
      $id=$req->id;
      $group=$req->group;
      if (isset($req->banner)) {
         $bannerPermission = 1;
      }else {
         $bannerPermission = 0;
      }

      if (isset($req->product)) {
         $productPermission = 1;
      }else {
         $productPermission = 0;
      }

      if (isset($req->category)) {
         $categoryPermission = 1;
      }else {
         $categoryPermission = 0;
      }
      
      if (isset($req->user)) {
         $userPermission = 1;
      }else {
         $userPermission = 0;
      }

      if (isset($req->bill)) {
         $billPermission = 1;
      }else {
         $billPermission = 0;
      }

      if (isset($req->history)) {
         $historyPermission = 1;
      }else {
         $historyPermission = 0;
      }

      if (isset($req->errorProduct)) {
         $errorProductPermission = 1;
      }else {
         $errorProductPermission = 0;
      }

      if (isset($req->discount)) {
         $discountPermission = 1;
      }else {
         $discountPermission = 0;
      }
      if (isset($req->gift)) {
         $giftPermission = 1;
      }else {
         $giftPermission = 0;
      }
      if (isset($req->news)) {
         $newsPermission = 1;
      }else {
         $newsPermission = 0;
      }
      $user = User::Update_User($id,$group);
      if ($group != 0) {
         $permission = Staff_permission::updateStaffPermission($id,$bannerPermission, $productPermission
           , $categoryPermission, $userPermission, $billPermission, $historyPermission
           , $errorProductPermission, $discountPermission, $giftPermission,$newsPermission);
      }
      elseif ($group == 0) {
          $permission = Staff_permission::deleteUser($id);
      }
      return redirect()->route('ViewPage_User_Admin');
   }
   
   public function GetPDF(Request $req){
      $a=array();
      $bill_detail=Bill_Detail::Select_Bill_Detail();

      $import=Import_product::Select_Import_Product();
      $tongtiennhap= $import['tongtiennhap'];
      $tongtienxuat= $bill_detail['tongtienxuat'];
      $Import_product=DB::table('import_product')
                        ->join('products','import_product.id_product','=','products.id')
                        ->select()->get();
     
      foreach ( $Import_product as $key) {

         if(!isset($bill_detail[$key->id_product][$key->size])) {

            $a[$key->id_product][$key->size]['price']=-$import[$key->id_product][$key->size]['price'];
            $a[$key->id_product][$key->size]['import_price']=$import[$key->id_product][$key->size]['price'];
            $a[$key->id_product][$key->size]['size']=$key->size;
            $a[$key->id_product][$key->size]['name']=$key->name;
            $a[$key->id_product][$key->size]['import_quantity']=$import[$key->id_product][$key->size]['import_quantity'];
         }
         else{

            $a[$key->id_product][$key->size]['price']=$bill_detail[$key->id_product][$key->size]['price']-$import[$key->id_product][$key->size]['price'];
            $a[$key->id_product][$key->size]['import_price']=$import[$key->id_product][$key->size]['price'];
            $a[$key->id_product][$key->size]['export_price']=$bill_detail[$key->id_product][$key->size]['price'];
            $a[$key->id_product][$key->size]['size']=$key->size;
            $a[$key->id_product][$key->size]['name']=$key->name;
            $a[$key->id_product][$key->size]['import_quantity']=$import[$key->id_product][$key->size]['import_quantity'];
            $a[$key->id_product][$key->size]['export_quantity']=$bill_detail[$key->id_product][$key->size]['quantity'];

         }
      }
      $totalPriceGift = Bill::getAllPriceGift();
      $pdf =PDF::loadView('Admin.Master.Admin_GetReport_PDF',compact('a','tongtiennhap','tongtienxuat','totalPriceGift'))->setPaper('a4', 'landscape');//Load view
        //Tạo file xem trước pdf
         // return view('Admin.Page.Bill_Detail_Admin_PDF',compact('customer','Bill_Detail'));
      return $pdf->stream();
   }

   
}
