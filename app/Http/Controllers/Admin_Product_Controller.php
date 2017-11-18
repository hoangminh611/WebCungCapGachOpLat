<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\Product;
use App\Export_product;
use App\Import_product;
use App\Bill_Detail;
class Admin_Product_Controller extends Controller
{
   //Lấy hết tất cả các sản phẩm
   public function Admin_All_Product()
   {
   	$product=Product::Show_Product_All()->get();
   	return view('Admin.Page.Product_Admin',compact('product'));
   }
   //lấy tất cả các sản phẩm theo loại
   public function Admin_All_Product_By_Type(Request $req)
   {
   	$product=Product::Show_Product_All_By_Type($req->id)->get();
      //loại này dùng để hiện vào tronng combox nhất định khi gọi trang insert
   	$typepro=$req->id;
   	return view('Admin.Page.Product_Admin',compact('product','typepro'));
   }
   //Neu co id nghia la update con khong co la insert
   public function ViewPageInsertProduct(Request $req){
       $id=$req->id;
       $typepro=$req->type;
         if($id!=null){
            $product=Product::findOneProduct($req->id)->get();
            $size=$req->size;
            $export_product=Export_product::FindOneExportProduct($id,$size)->first();
            $import_product=Import_product::FindOneImportProduct($id,$size)->orderBy('id','DESC')->first();
            return view('Admin.Page.Product_Admin_Insert',compact('id','product','typepro','export_product','import_product','size'));
         }
         else{
            $id=0;
            return view('Admin.Page.Product_Admin_Insert',compact('id','typepro'));
         }
   }
   //vào trang import
   public function ViewPageImportProduct(Request $req)
   {
      $nhaphang=$req->nhaphang;
      $name=$req->name;
      $size=$req->size;
      $type_name=$req->type_name;
      $id=$req->id;

      return view('Admin.Page.Product_Admin_Import',compact('id','name','type_name','size','nhaphang'));
   }
   //nhập hàng
   public function Insert_Import_product (Request $req)
   {
      $id=$req->id;
      $size=$req->size;
      $export_price=$req->export_price;
      $import_price=$req->import_price;
      $import_quantity=$req->import_quantity;
      $export_product=Export_product::Update_Insert_Export_Product($id,$size,$export_price);
      $import_product=Import_product::Insert_Import_Product($id,$size,$import_price,$import_quantity);
      return redirect()->route('Admin_All_Product');
   }
   //update sản phẩm
   public function Update_Product(Request $req){
         $id=$req->id;
         $first_size=$req->first_size;
         $name = $req->name;
         $type = $req->category_id;
         $desc = $req->description;
         $size = $req->size;
         $export_price = $req->export_price;
         $import_price=$req->import_price;
         $import_quantity=$req->import_quantity;
         $export_product=Export_product::Update_Export_Product($id,$first_size,$size,$export_price);
         $import_product=Import_product::Update_Import_Product($id,$first_size,$size,$import_price,$import_quantity);
         if ($req->hasFile('image')) {

            $imageProduct = Product::getImageProduct($id)->first();   
            File::delete('images/'.$imageProduct->image);
            
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images',$image);
            $suaanh=1;         
            $pro=Product::Update_Product($suaanh,$id,$name, $type,$desc,$image);
         }
         else
         {
            $image=null;
            $suaanh=0;
            $pro=Product::Update_Product($suaanh,$id,$name, $type,$desc,$image);
         }
         return redirect()->route('Admin_All_Product_By_Type',$type);
   }
   //them sản phẩm
   public function Insert_Product(Request $req){
      $filename="";
      $name = $req->name;
      $type = $req->category_id;
      $desc = $req->description;
      $size = $req->size;
      $export_price = $req->export_price;
      $import_price=$req->import_price;
      $import_quantity=$req->import_quantity;

      if ($req->hasFile('image')) 
      {
         $filename= $req->file('image')->getClientOriginalName();
         $req->file('image')->move('images',$filename);
      }
      else
      {
         $filename=null;
      }

      $getId=Product::Insert_Product($name, $type, $desc,$filename);
      $export_product=Export_product::Update_Insert_Export_Product($getId,$size,$export_price);
      $import_product=Import_product::Insert_Import_Product($getId,$size,$import_price,$import_quantity);
      return redirect()->route('Admin_All_Product');
   }

   //xóa sản phẩm
   public function Delete_Product(Request $req){
      $id = $req->id;

      $size=$req->size;
      // $image = $req->imageFile;
      //chua xoa dc cai hinh nay
      // File::delete('images/'.$image);
      // $import_product=Import_product::Delete_Import_Product($id,$size);
      $export_product=Export_product::Update_Delete_Export_Product($id,$size);
      // $bill_detail=Bill_Detail::Delete_Bill_Detail($id,$size);
      // if(!isset($import_product)&&!isset($export_product)&&!isset($bill_detail))
      //    $pro=Product::Delete_Product($id);
   }

   //xem trang sản phẩm bị lỗi
   public function ViewPageError_Product(){
      $export_products=Export_product::All_export_product()->get();
      return view('Admin.Page.Error_Product_Admin',compact('export_products'));
   }
   //xem trang update số lượng lỗi
   public function ViewPageError_Product_Update($idsize)
   {

      $export_product=Export_product::FindProductByIdPro_Size($idsize)->get();
      return view('Admin.Page.Error_Product_Update_Admin',compact('export_product'));
   }

   //update so luong san pham loi
   public function Update_Error_Product(Request $req)
   {
      $idsize=$req->idsize;
      $error_quantity=$req->error_quantity;
      $export_product=Export_product::Update_ErrorProduct($idsize,$error_quantity);
      return redirect()->route('ViewPageError_Product');
   }
   //--------------------------------Loại sản phẩm ----------------------------------------------------------------------------------------------
   //xem trang loại type = 1 là loại sản phẩm với tất cả loại cha
   public function Admin_All_Type()
   {
      $Type_Product=TypeProduct::Show_All_Type_Product_Parent()->orderBy('id','DESC')->get();
      $type=1;
      return view('Admin.Page.Category_Parent_Admin',compact('Type_Product','type'));
   }
   //gọi trang loại sản phẩm với loại con
   public function Admin_All_Type_By_Type(Request $req)
   {
      $Type_Product=TypeProduct::Show_All_Type_Product_By_Id_Parent($req->id)->get();
      $name_parent=DB::table('category')->where('id',$req->id)->select('name','id')->get();
      return view('Admin.Page.Category_Admin',compact('Type_Product','name_parent'));
   }
   //vào trang insert category
   public function ViewPage_InsertCategory(Request $req)
   {
           $id=$req->id;
           $loai=1;
           $khongcocha=$req->khongcocha;
           if($khongcocha==null)
           {
            $khongcocha=0;
           }
         if($id!=null){
            $type_detail=TypeProduct::Get_Category($id)->get();
            return view('Admin.Page.Category_Admin_Insert',compact('id','type_detail','loai','khongcocha'));
         }
         else{
            $id=0;
            return view('Admin.Page.Category_Admin_Insert',compact('id','loai','khongcocha'));
         }
   }
   //insert category
   public function InsertCategory(Request $req)
   {  
        $name=$req->name;
         // if ($req->hasFile('image')) 
         // {
         //    $image= $req->file('image')->getClientOriginalName();
         //    $req->file('image')->move('images/category',$image);
         // }
         // else
         // {
         //    $image=null;
         // }
         $description=$req->description;
         $type_cha=$req->type_cha;
         $type=$req->type;
         $khongcocha=$req->khongcocha;
         $category=TypeProduct::Insert_Category($name, $description,$type_cha,$type);
         if($khongcocha==0)
          return redirect()->route('Admin_All_Type');
         else
         return redirect()->route('Admin_All_Type_By_Type',$khongcocha);
      
   }
   //update category
   public function UpdateCategory(Request $req)
   {
         $id=$req->id;
         $name=$req->name;
         // $id_user=Auth::User()->id;
         $description=$req->description;
         $type_cha=$req->type_cha;
         $type=$req->type;
         $khongcocha=$req->khongcocha;
         $type=TypeProduct::Update_Category($id,$name,$description,$type_cha,$type);

         if($khongcocha==0)
            return redirect()->route('Admin_All_Type');
         else
            return redirect()->route('Admin_All_Type_By_Type',$khongcocha);
      
   }
   //xóa loại sản phẩm cha
   public function DeleteCategory_Parent(Request $req)
   {
      $id=$req->id;
      $type=TypeProduct::Delete_Category_Parent($id);
   }
   //xóa loại sản phẩm con
   public function DeleteCategory_Child(Request $req)
   {
       $id=$req->id;
      $type=TypeProduct::Delete_Category_Child($id);
   }
        
}
