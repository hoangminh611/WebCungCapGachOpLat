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
use App\Customer;
use Session;
use App\Import_product;
use App\Export_Product;
use App\Discount;
use PDF;
class Admin_Bill_Controller extends Controller
{
   //xem trang bill admin
   public function ViewPageBill_Admin()
   {
   	$Bill=Bill::All_Bill()->orderBy('bills.method')->orderBy('bills.id','DESC')->get();
   	return view('Admin.Page.Bill_Admin',compact('Bill'));
   }
   //xem trang bill detail admin
   public function ViewPageBill_Detail_Admin($id,$id_customer,$method)
   {
      $idhoadon=$id;
   	$Bill_Detail=Bill_Detail::View_All($id)->get();
      $bill=Bill::View_bill_discountbyId($idhoadon)->get();
      $customer=Customer::Customer_ByID($id_customer)->get();
   	return view('Admin.Page.Bill_Detail_Admin',compact('Bill_Detail','customer','method','idhoadon','bill'));
   }
   //xem trang bill  insert admin
   public function ViewPageBill_Admin_Insert(Request $req)
   {
      $id=$req->id;
      $customer=$req->customer;
      $bill=Bill::View_bill_byId($id)->get();
      return view('Admin.Page.Bill_Admin_Insert',compact('bill','user','customer','id'));
   }
    //xem trang bill detail  insert admin
   public function ViewPageBill_Detail_Admin_Insert(Request $req)
   {
   	$id_bill_detail=$req->id;
   	$quantity=$req->quantity;
   	$name_pro=$req->name_product;
   	$Bill_Detail=Bill_Detail::GetDetail_Bill_DeTail($id_bill_detail)->get();

      $Bill=DB::table('bill_detail')->where('id',$id_bill_detail)->select('id_bill')->get();
      $customer=DB::table('bills')->where('id',$Bill[0]->id_bill)->select('id_customer','method')->get();
   	return view('Admin.Page.Bill_Detail_Admin_Insert',compact('Bill_Detail','quantity','name_pro','customer'));
   }
   //update bill detail
   public function Update_Bill_Detail(Request $req)
   {
   	$id=$req->id;
   	$first_quantity=$req->first_quantity;
   	$quantity=$req->quantity;
   	$id_export_product=$req->id_export_product;
   	$id_bill=$req->id_bill;
      $id_customer=$req->id_customer;
      $method=$req->method;
   	$bill_detail=Bill_Detail::Update_Bill_Detail($id,$first_quantity,$quantity,$id_export_product);
   	return redirect()->route('ViewPageBill_Detail_Admin',[$id_bill,$id_customer,$method]);
   }
   //update bill
   public function Update_Bill(Request $req)
   {
      $id=$req->id;

      $method=$req->method;
      $price=Bill:: Sum_Price($id)->get();
      $discount=Discount::Get_All()->orderBy('price_discount')->get();
      
      for($i=0;$i<=count($discount);$i++){
            if(!isset($discount[$i]->price_discount)){
                $id_discount=$discount[$i-1]->id;
               break;
            }
            if($price[0]->total < $discount[$i]->price_discount){
               $id_discount=$discount[$i-1]->id;
               break;
         }
      }
      $discount=Discount::Get_Discount_By_Id($id_discount)->get();
      $bill=Bill::Update_Bill($id,$method,$id_discount,$discount[0]->percent_discount);
      return redirect()->route('ViewPageBill_Admin');
   }
   //xóa bill detail theo id,cap nhat lai quantity
   public function Delete_Bill_Detail(Request $req)
   {
      $id=$req->id;
      $id_export_product=$req->id_export_product;
      $quantity=$req->quantity;
      $bill_detail=Bill_Detail::Delete_One_Bill_Detail($id);
      $export_quantity=Export_Product::Update_quantity_By_Idproduct($id_export_product,$quantity);

   }
   //đếm số bill chưa xác nhận
   public function Count_Bill()
   {
      $count_bill=DB::table('bills')->where('bills.method','LIKE','%Chưa Xác Nhận%')->count();

      return  $count_bill;
   }
   //xem file PDF
    public function downloadPDF(Request $req){

     $Bill_Detail=Bill_Detail::View_All($req->idbill)->get();
      $customer=Customer::Customer_ByID($req->idcustomer)->get();
      $bill=Bill::View_bill_discountbyId($req->idbill)->get();
         $pdf =PDF::loadView('Admin.Page.Bill_Detail_Admin_PDF',compact('customer','Bill_Detail','bill'))->setPaper('a4', 'landscape');//Load view
        //Tạo file xem trước pdf
         // return view('Admin.Page.Bill_Detail_Admin_PDF',compact('customer','Bill_Detail'));
        return $pdf->stream();
   }
}
