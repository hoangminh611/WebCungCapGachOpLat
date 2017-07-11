<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
class LoginRegister_Controller extends Controller
{
   public function Login()
   {
   	return view("Page.Login");
   }
   public function Register()
   {
   	return view("Page.Register");
   }
}
