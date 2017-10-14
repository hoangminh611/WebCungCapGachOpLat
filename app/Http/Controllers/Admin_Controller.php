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
class Admin_Controller extends Controller
{
   //lấy lãi lỗ
   public function getContentAdmin(Request $req) {
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
      $All_View=Product::All_ViewProduct();
      $Count_User=User::Count_All_User();
      $Count_Bill=Bill::Count_All_Bill();
      $All_Export_Quantity=Export_product:: ALl_Sale_Quantity();

      $month_end = new DateTime(Carbon::now()->format('Y-m-01'));
      $month_end->add(new DateInterval('P1M'));
      $date = new DateTime(Carbon::now()->format('Y-m-01'));
      $getMonth=$date->format('m');

      $Total_By_Month=Bill_Detail::getTotalByMonth($date->format('Y-m-d'), $month_end->format('Y-m-d'));

      return view('Admin.Master.Admin_Content',compact('tongtiennhap','tongtienxuat','a','All_View','Count_User','Count_Bill','All_Export_Quantity','Total_By_Month','getMonth'));
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
      return view('Admin.Page.User_Admin_Edit',compact('user'));
   }

   //updte lai user admin
   public function Update_User(Request $req) {
      $id=$req->id;
      $group=$req->group;
      $user=User::Update_User($id,$group);
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
      $pdf =PDF::loadView('Admin.Master.Admin_GetReport_PDF',compact('a','tongtiennhap','tongtienxuat'))->setPaper('a4', 'landscape');//Load view
        //Tạo file xem trước pdf
         // return view('Admin.Page.Bill_Detail_Admin_PDF',compact('customer','Bill_Detail'));
      return $pdf->stream();
   }
}
