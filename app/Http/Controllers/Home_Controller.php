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
use App\Cart;
use Session;
use App\Export_product;
class Home_Controller extends Controller
{
   public function getIndex()
   {
      $new8Pro=Product::Top8NewsProduct()->get();
   	return view('Master.home',compact('new8Pro'));
   }

   public function getNews()
   {
      $new_post=News::ShowNewPost()->get();
      $All_news=News::ShowAllPost()->paginate(3);
      $category=News::CategoryNews()->get();
      return view('Page.News',compact('new_post','All_news','category'));
   }
   public function getNews_By_Type(Request $req)
   {
      $new_post=News::ShowNewPost()->get();
      $All_news=News::ShowAllPost_ByType($req->id)->paginate(3);
      $category=News::CategoryNews()->get();
      return view('Page.News',compact('new_post','All_news','category'));
   }

   public function getNew_Detail($id)
   { 
     $new_post=News::ShowNewPost()->get();
     $new_detail=News::New_Detail($id)->get();
     $category=News::CategoryNews()->get();
     return view('Page.News_Detail',compact('new_post','new_detail','category'));

   }
   public function getContact()
   {
      return view('Page.Contact');
   }

   public function AddCart(Request $req)
   {  

      $product=Export_product::FindProductByIdPro_Size($req->idsize)->get();
      $oldcart=Session('cart')?Session::get('cart'):null;
      $cart=new Cart($oldcart);
      $cart->add($product,$req->idsize,$req->quantity);
      $req->session()->put('cart',$cart);
      return redirect()->back();
   }
   //Hiện ra trang cart-detail
   public function DetailCart()
   {
      return view('Page.Cart_Detail');
   }
   //Dùng ajax cai update cart_detail
   public function Update_Cart()
   {
      return view('Page.Cart_Detail_Update');
   }
   public function DeleteCart(Request $req)
   {
       Session::forget('cart');
       return redirect()->route('index');
   }

   public function getDelItemCart(Request $req)
   {
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($req->id);
        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
    }

    public function reduceByOne($id)
    {
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
        return json_encode($cart);
    }

    public function riseByOne($id)
    {

        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->riseByOne($id);

        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
        return json_encode($cart);
    }




   // public function info(){
   // 	return view('page.gioithieu');
   // }
   // public function news_All(){
   //    $news=News::Load_ALL_News()->orderBy('created_at','DESC')->paginate(5);
   //    $typeidtintuc=0;
   //    return view('page.tintuc',compact('news','newNoiBat','typeidtintuc'));
   // }
   // public function NewsById($id){
   //    $NewsById=News::Load_ALL_News()->where('Category_ID_News',$id)->orderBy('id','DESC')->paginate(5);
   //    $typeidtintuc=$id;
   //    return view('page.tintuc',compact('NewsById','typeidtintuc'));
   // }
   // public function newsdetail($id){
   //    $newDetail=News::NewById($id)->get();
   //    return view('page.ChitietTintuc',compact('newDetail'));
   // }
   //   public function contact(){
   // 	return view('page.lienhe');
   // }

   // public function getGiohang(){
   //    return view('page.giohang');
   // }
}
