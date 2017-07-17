<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
use App\Product;
class Product_Controller extends Controller
{
   public function getIndex()
   {
   	return view('Master.home');
   }
   //Lấy tất cả sản phẩm của loại cha
   public function All_Product($id)
   {
   	$All_Product=Product::All_Product_ById($id);
      $typepro=0;
   	return view('Page.Product',compact('All_Product','typepro'));
   }
   //Lấy sản phẩm của 1 loại nhất định
   public function All_Product_By_Type(Request $req)
   {
      $product=Product::Find_Product_By_Id_Type($req->id)->paginate(6);
      $typepro=$req->id;

      return view('Page.Product',compact('product','typepro'));
   }
   //Lây chi tiết sản phẩm đó vả đưa ra 1 số sản phẩm gợi ý cùng loại
   public function getDetail(Request $req)
   {
   	$product=Product::Find_Product_By_Id($req->id)->get();
      $product_same_type=Product::Find_Product_By_Same_Type($product[0]->id_type,$product[0]->id)->limit(3)->get();
      
   	return view('Page.Detail_Product',compact('product','product_same_type'));
   }

   public function Search_Product(Request $req)
   {
      $type=$req->type;
      $size=$req->size;
      if($type=="khong"&&$size=='khong')
         $product=DB::table('products')->select()->paginate(6);
      else if($type!="khong"&&$size=='khong')
         $product=DB::table('products')->where('id_type',$type)->select()->paginate(6);
      else if($type=="khong"&&$size!='khong')
         $product=Product::Search_Product_By_Size($size)->get();
      else
         $product=Product::Search_Product_By_Type_Size($type,$size)->paginate(6);
      return view('Page.Search_Product',compact('product'));
   }

   public function Search_Detail(Request $req)
   {
      $product=DB::table('products')->whereRaw("match(name) against('$req->search')")->get();
      if(!isset($product[0]))
          $product=DB::table('products')->whereRaw("name REGEXP '$req->search'")->get();
     return view('Page.Search_Product',compact('product'));
   }

}
