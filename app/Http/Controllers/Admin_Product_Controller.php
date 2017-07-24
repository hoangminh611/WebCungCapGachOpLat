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
   public function Admin_All_Product()
   {
   	$product=Product::Show_Product_All()->orderBy('id','DES')->paginate(8);
   	return view('Admin.Page.Product_Admin',compact('product'));
   }

   public function Admin_All_Product_By_Type(Request $req)
   {
   	$product=Product::Show_Product_All_By_Type($req->id)->paginate(8);
   	$typepro=$req->id;
   	return view('Admin.Page.Product_Admin',compact('product'));
   }
   //Neu co id nghia la update con khong co la insert
   public function ViewPageInsertProduct(Request $req){
       $id=$req->id;
         if($id!=null){
            // $news=News::UpdateNewById($req->id)->get();
            return view('Admin.Page.Product_Admin_Insert',compact('id','news'));
         }
         else{
            $id=0;
            return view('Admin.Page.Product_Admin_Insert',compact('id'));
         }
   }

   public function ViewPageImportProduct(Request $req)
   {
      $nhaphang=$req->nhaphang;
      
      $name=$req->name;
      $size=$req->size;
      $type_name=$req->type_name;
      $id=$req->id;
      return view('Admin.Page.Product_Admin_Import',compact('id','name','type_name','size','nhaphang'));
   }

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
   public function Update_Product(Request $req){
      $filename="";
      $id = $req->input('id');
      $name = $req->input('edit_name');
      $type = $req->input('edit_type');
      $desc = $req->input('edit_des');
      $unit_price = $req->input('edit_unit_price');
      $pro_price = $req->input('edit_pro_price');
      $unit = $req->input('edit_unit');
      if ($req->hasFile('edit_image')) {
         $filename= $req->file('edit_image')->getClientOriginalName();
      $req->file('edit_image')->move('images/product',$filename);
      }else{
         $filename=null;
      }
      $pro=Product::Edit_Product($id,$name,$type, $desc,$filename);
      return $pro; 
   }

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

   public function Delete_Product(Request $req){
      $id = $req->id;
      $size=$req->size;
      $image = $req->imageFile;
      //chua xoa dc cai hinh nay
      File::delete('images/'.$image);
      $import_product=Import_product::Delete_Import_Product($id,$size);
      $export_product=Export_product::Delete_Export_Product($id,$size);
      $bill_detail=Bill_Detail::Delete_Bill_Detail($id,$size);
      if(!isset($import_product)&&!isset($export_product)&&!isset($bill_detail))
         $pro=Product::Delete_Product($id);
   }
   //--------------------------------Loại sản phẩm -----------------------
   public function Admin_All_Type()
   {
      $Type_Product=TypeProduct::Show_All_Type_Product_Parent()->orderBy('id','DESC')->paginate(8);
      $type=1;
      return view('Admin.Page.Category_Parent_Admin',compact('Type_Product','type'));
   }

   public function Admin_All_Type_By_Type(Request $req)
   {
      $Type_Product=TypeProduct::Show_All_Type_Product_By_Id_Parent($req->id)->paginate(8);
      $name_parent=DB::table('category')->where('id',$req->id)->select('name')->get();
      return view('Admin.Page.Category_Admin',compact('Type_Product','name_parent'));
   }

   public function ViewPage_InsertCategory(Request $req)
   {
           $id=$req->id;
           $type=1;
           $khongcocha=0;
         if($id!=null){
            $news=TypeProduct::Get_Category($id)->get();
            return view('Admin.Page.Category_Admin_Insert',compact('id','news','type','khongcocha'));
         }
         else{
            $id=0;
            return view('Admin.Page.Category_Admin_Insert',compact('id','type','khongcocha'));
         }
   }
   public function InsertCategory(Request $req)
   {  
        $name=$req->name;
         if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images/category',$image);
         }
         else
         {
            $image=null;
         }
         $description=$req->description;
         $type_cha=$req->type_cha;
         $type=$req->type;
         $category=TypeProduct::Insert_Category($name, $description, $image,$type_cha,$type);
          return redirect()->route('Admin_All_Type');
      
   }
   public function UpdateCategory(Request $req)
   {
         $id=$req->id;
         $name=$req->name;
         // $id_user=Auth::User()->id;
         $description=$req->description;
         $type_cha=$req->type_cha;
         $type=$req->type;
         if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images/news',$image);
            $suaanh=1;
            $type=TypeProduct::Update_Category($suaanh,$id,$name,$description,$type_cha,$type,$image);
         }
         else
         {
            $image=null;
            $suaanh=0;
            $type=TypeProduct::Update_Category($suaanh,$id,$name,$description,$type_cha,$type,$image);
         }
         
          return redirect()->route('Admin_All_Type');
      
   }

}
