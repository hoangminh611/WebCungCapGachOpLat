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
use App\User;
use App\Customer;
class Admin_Controller extends Controller
{
   public function Content_Admin()
   {
   	return view('Admin.Master.Admin_Content');
   }

   public function ViewPage_User_Admin()
   {
   		$users=User::User_All()->get();
   		return view('Admin.Page.User_Admin',compact('users'));
   }
   public function ViewPage_Customer_Admin()
   {
   		$customers=Customer::Customer_All()->get();
   		return view('Admin.Page.Customer_Admin',compact('customers'));
   }
}
