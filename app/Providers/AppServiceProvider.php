<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
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
