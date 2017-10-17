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
use App\Product;
use App\Cart;
use Session;
use App\Export_product;
use App\Import_product;
use App\Customer;
use App\Bill;
use App\Bill_Detail;
use App\Discount;
use Cookie;
class Home_Controller extends Controller
{
  //Lấy 8 sản phẩm mới
   public function getIndex() {
      $new8Pro=Product::Top8NewsProduct();
      // Cookie::queue(Cookie::forget('cookieIdWebGach'));
      if(!Cookie::has('cookieIdWebGach')){
        Session::regenerate();
        Cookie::queue('cookieIdWebGach', Session::getId(), 800000);
      }
   	return view('Master.home',compact('new8Pro'));
   }
   //lấy trang news
   public function getNews() {
      $new_post=News::ShowNewPost()->get();
      $All_news=News::ShowAllPost()->paginate(3);
      $category=News::CategoryNews()->get();
      return view('Page.News',compact('new_post','All_news','category'));
   }
   //lấy trang news theo loại news
   public function getNews_By_Type(Request $req) {
      $new_post=News::ShowNewPost()->get();
      $All_news=News::ShowAllPost_ByType($req->id)->paginate(3);
      $category=News::CategoryNews()->get();
      return view('Page.News',compact('new_post','All_news','category'));
   }
   //Lấy tin tức
   public function getNew_Detail($id) { 
     $new_post=News::ShowNewPost()->get();
     $new_detail=News::New_Detail($id)->get();
     $category=News::CategoryNews()->get();
     return view('Page.News_Detail',compact('new_post','new_detail','category'));

   }
   //vào trang contact
   public function getContact() {
      return view('Page.Contact');
   }
   //----------------------------------CART--------------------------------
   //thêm san pham vao giỏ
   public function AddCart(Request $req) {  

      $product=Export_product::FindProductByIdPro_Size($req->idsize)->get();

      $oldcart=Session('cart')?Session::get('cart'):null;
      $cart=new Cart($oldcart);
      $cart->add($product,$req->idsize,$req->quantity);
      $req->session()->put('cart',$cart);
      return redirect()->back();
      
   }
   //Hiện ra trang cart-detail
   public function DetailCart() {
      return view('Page.Cart_Detail');
   }
   //Dùng ajax cai update cart_detail
   public function Update_Cart() {
      return view('Page.Cart_Detail_Update');
   }
   public function DeleteCart(Request $req) {
       Session::forget('cart');
       return redirect()->route('index');
   }
   //xóa 1 sản phẩm trong cart
   public function getDelItemCart(Request $req) {
        $oldCart=Session('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($req->id);
        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
    }
    //giảm 1 sản phẩm
    public function reduceByOne($id) {
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if(count($cart->items)<=0)
        {
            Session::forget('cart');
        }
        else
            Session::put('cart',$cart);
        return json_encode($cart);
    }
    //tnag8 1 sản phẩm
    public function riseByOne($id) {

        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->riseByOne($id);

        if(count($cart->items)<=0)
            Session::forget('cart');
        else
            Session::put('cart',$cart);
        return json_encode($cart);
    }



    //gọi trang thanh toán
   public function Payment() {
      $discount=Discount::Get_All()->orderBy('price_discount')->get();
   	return view('Page.Payment',compact('discount'));
   }

   //Insert vào bảng customer khi thanh toán
   public function Customer_Edit(Request $req) {
        $a=array();
        $i=0;
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        foreach ($cart->items as $key) {
          $id=$key['item'][0]->id;
          $size=$key['item'][0]->size;
          $name=$key['item'][0]->name;
          $Qty=$key['qty'];

          $export_quantity=Export_product::FindOneExportProduct($id,$size)->get();
          $import_quantity=Import_product::FindOneImportProduct($id,$size)->sum('import_quantity');
          $quantity=$import_quantity-$export_quantity[0]->export_quantity;

          if($quantity<$Qty)
          $a[$i++]=$name." - ".$size." : hàng không đủ hàng trong kho chỉ còn : ".$quantity;
          # code...
        }

        if($a==null) {
          $full_name=$req->name;
          $phone=$req->phone;
          $email=$req->email;
          $address=$req->address;
          $note=$req->note;

          if(Auth::check()) {
            $id_user=Auth::User()->id;
            $discount=Discount::Get_All()->orderBy('price_discount')->get();

            for($i=0;$i<=count($discount);$i++){

                  if(!isset($discount[$i]->price_discount)){
                      $id_discount=$discount[$i-1]->id;
                     break;
                  }

                  if($cart->totalPrice < $discount[$i]->price_discount){
                     $id_discount=$discount[$i-1]->id;
                     break;
               }
            }
          }
          else {
            $id_user=null;
            $id_discount=1;
          } 

          $id_customer=Customer::Insert_Customer($id_user,$full_name,$email,$address,$phone);
          $discount=Discount::Get_Discount_By_Id( $id_discount)->get();
          $id_bill=Bill::Insert_Bill($id_customer,$note,$id_discount,$discount[0]->price_gift,$discount[0]->percent_discount);

          foreach ($cart->items as $key) {

              $id_export_product=$key['item'][0]->idsize;
              $size=$key['item'][0]->size;
              $sales_price=$key['item'][0]->export_price;
              $quantity=$key['qty'];
              $bill_detail=Bill_Detail::Insert_Bill_Detail($id_bill,$id_export_product,$sales_price,$quantity);
              $export_product=Export_product:: Insert_Export_Product($id_export_product,$quantity);
            }

          Session::forget('cart');
          return redirect()->route('index')->with('thanhcong','mua hàng thành công,chúng tôi sẽ liên hệ bạn sớm nhất');
        }
        else {

        return redirect()->route('cart-detail')->with('hangkhongdu',$a);;
        }
   }
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
