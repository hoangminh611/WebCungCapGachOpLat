<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
use Auth;
class Admin_News_Controller extends Controller
{

      public function ViewAllNews(){
         $news=News::Load_ALL_News()->get();
         return view('Admin.Page.News_Admin',compact('news'));
      }
      public function ViewAllNewsBy_id($id){
         $news=News::Load_ALL_News_By_Id($id)->get();
         return view('Admin.Page.News_Admin',compact('news'));
      }
      //---------------------------------News-------------------------
       //neu co id nghia la update con khong co la insert 
      public function ViewPageInsertNews(Request $req){
         $id=$req->id;
         if($id!=null){
            $news=News::UpdateNewById($req->id)->get();
            return view('Admin.Page.News_Admin_Insert',compact('id','news'));
         }
         else{
            $id=0;
            return view('Admin.Page.News_Admin_Insert',compact('id'));
         }
         
      }
      
      public function UpdateNews(Request $req){
         $id=$req->id;
         $id_user=Auth::User()->id;
         $title=$req->title;
         $description=($req->description);
         $content=($req->content);
         $category_id_news=$req->category_id_news;
         if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images/news',$image);
            $suaanh=1;
            $news=News::UpdateNews($suaanh,$id,$id_user,$title,$image,$description,$content,$category_id_news);
         }
         else
         {
            $image=null;
            $suaanh=0;
            $news=News::UpdateNews($suaanh,$id,$id_user,$title,$image,$description,$content,$category_id_news);
         }
         
          return redirect()->route('ViewNews');
      }
    
      //insert news
      public function InsertNews(Request $req){
         //Chưa kiểm tra đươc image và description
         $id_user=Auth::User()->id;
         $title=$req->title;
         if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images/news',$image);
         }
         else
         {
            $image=null;
         }
         $description=($req->description);
         $content=($req->content);
         $category_id_news=$req->category_id_news;
          $news=News::InsertNews($id_user,$title,$image,$description,$content,$category_id_news);
         return redirect()->route('ViewNews');
      }
      //xoa tin tuc
      public function DeleteNews(Request $req){
         $id=$req->id;
         $news=News::DeleteNews($id);
         return $news;
      }
      //----------------------------News------------------------
      //----------------------------Loại News-------------------
      public function AllTypeNews()
      {
         $Type_Product=News::Show_All_Type_News()->get();
         $type=2;
         return view ('Admin.Page.Category_Parent_Admin',compact('Type_Product','type'));
      }

      public function View_Insert_Type_News(Request $req)
      {
           $id=$req->id;
           $type=2;
           $khongcocha=0;
         if($id!=null){
            $news=News::Update_Type_News_By_Id($req->id)->get();
            return view('Admin.Page.News_Admin_Category_Insert',compact('id','news','type','khongcocha'));
         }
         else{
            $id=0;
            return view('Admin.Page.News_Admin_Category_Insert',compact('id','type','khongcocha'));
         }
      }

      public function Insert_Type_News(Request $req)
      {
         $name=$req->name;
         if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images/news',$image);
         }
         else
         {
            $image=null;
         }
         $description=($req->description);
         $type_cha=($req->type_cha);
         $type=$req->type;
         $type_news=News::InsertTypeNews($name,$description,$image,$type_cha,$type);
          return redirect()->route('TypeNews');
      }

      public function Update_Type_News(Request $req)
      {
         $id=$req->id;
         $name=$req->name;
         $description=$req->description;
         $type_cha=$req->type_cha;
         $type=$req->type;
         if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images/news',$image);
            $suaanh=1;
            $news=News::Update_Type_News($suaanh,$id,$name,$description,$type_cha,$type,$image);
         }
         else
         {
            $image=null;
            $suaanh=0;
            $news=News::Update_Type_News($suaanh,$id,$name,$description,$type_cha,$type,$image);
         }
         
          return redirect()->route('TypeNews');
      }
     
      public function Delete_Type_News(Request $req)
      {
         $id=$req->id;
         $type=News::Detele_Type_News_By_Id($id);
      }
}
