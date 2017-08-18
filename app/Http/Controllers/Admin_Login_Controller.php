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
session_start();
class Admin_Login_Controller extends Controller
{
  //view trang login admin
   public function Login_Admin()
   {
      // dd(Session::has('group'));
   	return view('Admin.Page.Login_Admin');
   }
   //ĐĂNG NHẬP ADMIN
   public function postLogin_Admin(Request $req)
   {    
        
      if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
            if(Auth::User()->group>=1){
               $_SESSION['group']=true;
               return redirect()->route('Content_Admin');}
             else
               return redirect()->back()->with('thatbai','Bạn không có quyền truy cập vào trang này');
        }
        else{
            return redirect()->back()->with('thatbai','Sai thông tin đăng nhập');
        }
    }
    //log out admin
     public function getLogout()
    {
        Auth::logout();
        session_unset();
        return redirect()->route('Login_Admin');
    }
}
