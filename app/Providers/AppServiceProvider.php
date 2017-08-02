<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use App\Slide;
use App\Product;
use DB;
use Session;
use App\Cart;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer(['Master.Menu','Page.Product','Page.Detail_Product','Page.Search_Product','Admin.Master.Admin_Master','Admin.Page.Product_Admin_Insert','Admin.Page.Product_Admin_Import','Admin.Page.Category_Admin_Insert'],function($view)
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
              $hotPro=Product::Top4Product()->get();
              $view->with(['Slide'=>$Slide,'hotPro'=>$hotPro]);
            });

            view()->composer(['Page.Product','Page.Detail_Product','Page.Search_Product'],function($view)
            {
               $size=DB::table('export_product')->select()->get();
               $size_gach=array();
               $size_gach[0]=$size[0]->size;
               $sizedaco="0";
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

            view()->composer(['Master.Top_header','Page.Cart_Detail','Page.Cart_Detail_Update','Page.Payment'],function($view)
            {
              if(Session('cart'))
              {
                $oldcart=Session::get('cart');
                $cart=new Cart($oldcart);
              $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
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
