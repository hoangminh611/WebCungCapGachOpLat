<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use App\Slide;
use App\Product;
use DB;
use Session;
use Cookie;
use App\Cart;
use App\Staff_permission;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer(['Master.Menu', 'Master.home', 'Page.Product', 'Page.Detail_Product'
              , 'Page.Search_Product', 'Admin.Master.Admin_Master', 'Admin.Page.Product_Admin_Insert'
              ,'Admin.Page.Product_Admin_Import', 'Admin.Page.Category_Admin_Insert'],function($view)
            {
              $type =  DB::table('category')->select()->where([
                                    ['type', '=', '1'],
                                    ['type_cha', '=', '0'],
                                    ['status', '=', 0],
                                    ])->get();
              $loaicon=array();
              foreach ($type as $type_cha) {
              $type_children =   DB::table('category')->select()
                                    ->where([
                                    ['type','=','1'],
                                    ['type_cha','=',$type_cha->id],
                                    ['status', '=', 0],
                                    ])->get();
              $loaicon[$type_cha->id]=$type_children;
              }
             
              $view->with(['type'=>$type,'loaicon'=>$loaicon]);
            });

            view()->composer(['Admin.Master.Admin_Master','Admin.Page.News_Admin_Insert'],function($view)
            {
              $typenews =  DB::table('category')->select()->where([
                                    ['type', '=', '2'],
                                    ['type_cha', '=', '0'],
                                    ['status', '=', 0],
                                    ])->get();
              $view->with('typenews',$typenews);
            });

            view()->composer('Master.Banner',function($view)
            {
              $Slide =Slide::Top5Slide()->get();
              $hotPro=Product::Top4Product();
              $view->with(['Slide'=>$Slide,'hotPro'=>$hotPro]);
            });

            view()->composer(['Page.Product', 'Page.Detail_Product', 'Page.Search_Product', 'Master.home'],function($view)
            {
               $size=DB::table('export_product')->where('status',0)->select()->get();
               $size_gach=array();
               $size_gach[0]=$size[0]->size;
                for($i=0;$i<count($size);$i++){
                    for($j=0;$j<=count($size_gach);$j++)
                    {
                        if($j==count($size_gach))
                        {
                          $size_gach[$j]=$size[$i]->size;
                        }
                        if($size_gach[$j]==$size[$i]->size)
                        {
                           break;
                        }  
                    }
                }
                $view->with('size_gach',$size_gach);
            });

            view()->composer(['Master.Top_header', 'Master.CheckCart', 'Page.Cart_Detail','Page.Cart_Detail_Update','Page.Payment', 'Master.home'],function($view) {
              if(Cookie('cart')) {
                // $oldcart=Session::get('cart');
                $oldcart = Cookie::get('cart');
                $cart=new Cart($oldcart);
              $view->with(['cart'=>Cookie::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
              }
            });

            view()->composer('Admin.Master.Admin_Header',function($view) {
              $count_bill=DB::table('bills')->where('bills.method','LIKE','%Chưa Xác Nhận%')->count();
              $view->with('count_bill',$count_bill);
            });

             view()->composer([ 'Admin.Master.Admin_Master', 'Admin.Page.Bill_Admin', 'Admin.Page.Bill_Admin_Insert'
                              , 'Admin.Page.Bill_Detail_Admin', 'Admin.Page.Bill_Detail_Admin_Insert', 'Admin.Page.Bill_Detail_Admin_PDF'
                              , 'Admin.Page.Category_Admin', 'Admin.Page.Category_Admin_Insert', 'Admin.Page.Category_Parent_Admin'
                              , 'Admin.Page.Discount_Admin', 'Admin.Page.Discount_Admin_Insert', 'Admin.Page.Error_Product_Admin'
                              , 'Admin.Page.Error_Product_Update_Admin', 'Admin.Page.Gift_Admin', 'Admin.Page.Gift_Admin_Insert'
                              , 'Admin.Page.Import_Product_Admin', 'Admin.Page.News_Admin', 'Admin.Page.News_Admin_Category_Insert'
                              , 'Admin.Page.News_Admin_Insert', 'Admin.Page.Product_Admin', 'Admin.Page.Product_Admin_Import'
                              , 'Admin.Page.Product_Admin_Insert', 'Admin.Page.Slide_Admin', 'Admin.Page.Slide_Admin_Insert'
                              , 'Admin.Page.User_Admin', 'Admin.Page.User_Admin_Edit'
                              ],function($view) {
              if(Auth::check()) {
                if(Auth::User()->group >=1 && Auth::User()->active ==1) {
                  $staff=Staff_permission::getPermissionById(Auth::User()->id)->first();
                  $view->with('staff',$staff);
                }
                else {
                return redirect()->route('Login');
                }
              }
              else {
                return redirect()->route('Login');
              }
              
            });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
