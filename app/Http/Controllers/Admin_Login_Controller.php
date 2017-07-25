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
use Session;
class Admin_Login_Controller extends Controller
{
   public function Login_Admin()
   {
   	return view('Admin.Page.Login_Admin');
   }

   public function postLogin_Admin(Request $req)
   {    
        
      if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
            if(Auth::User()->group>=1){
               Session::put('group',false); 
               return redirect()->route('Content_Admin');}
             else
               return redirect()->back()->with('thatbai','Bạn không có quyền truy cập vào trang này');
        }
        else{
            return redirect()->back()->with('thatbai','Sai thông tin đăng nhập');
        }
    }
     public function getLogout()
    {
        Auth::logout();
        return redirect()->route('Login_Admin');
    }
}
