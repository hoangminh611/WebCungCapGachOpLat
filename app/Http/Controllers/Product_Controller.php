<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
class Product_Controller extends Controller
{
   public function getIndex()
   {
   	return view('Master.home');
   }
}
