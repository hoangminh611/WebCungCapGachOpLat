<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use App\Slide;
use App\Product;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer(['Master.Menu','Page.Product','Page.Detail_Product','Page.Search_Product','Admin.Product_Admin'],function($view){
              $type =  DB::table('category')->select()->where([
                                    ['type', '=', '1'],
                                    ['type_cha', '=', '0'],
                                    ])->get();
              $loaicon=array();
              foreach ($type as $type_cha) {
              $type_children =   DB::table('category')->select()
                                    ->where([
                                    ['type','=','1'],
                                    ['type_cha','=',$type_cha->id],
                                    ])->get();
              $loaicon[$type_cha->id]=$type_children;
              }
             
              $view->with(['type'=>$type,'loaicon'=>$loaicon]);
          });
          view()->composer('Master.Banner',function($view){
              $Slide =Slide::Top5Slide()->get();
              $hotPro=Product::Top4Product()->get();
              $view->with(['Slide'=>$Slide,'hotPro'=>$hotPro]);
          });
           view()->composer(['Page.Product','Page.Detail_Product','Page.Search_Product'],function($view){
               $size=DB::table('export_product')->select()->get();
               $size_gach=array();
               $sizedaco="0";
                for($i=0;$i<count($size);$i++){
                  if($sizedaco!=$size[$i]->size)
                  {
                      $sizedaco=$size[$i]->size;
                      $size_gach[$i]=$sizedaco; 
                  }
                }
                $view->with('size_gach',$size_gach);
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
