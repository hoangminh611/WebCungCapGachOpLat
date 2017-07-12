<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use App\Slide;
use App\Product;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer(['Master.Menu','page.typeproduct','page.sanpham','section.sanphamnoibat','Admin.Product_Admin'],function($view){
              $type =  TypeProduct::all()->where('type',1);
              $view->with('type',$type);
          });
          view()->composer('Master.Banner',function($view){
              $Slide =Slide::Top5Slide()->get();
              $hotPro=Product::Top3Product()->get();
              $view->with(['Slide'=>$Slide,'hotPro'=>$hotPro]);
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
