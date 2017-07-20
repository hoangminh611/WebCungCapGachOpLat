<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
class Admin_Login_Controller extends Controller
{
   public function Login_Admin()
   {
   	return view('Admin.Page.Login_Admin');
   }
}
