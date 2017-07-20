<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Hash;
use Auth;
use Socialite;
use App\User;
use Mail;

class LoginRegister_Controller extends Controller
{
   public function postLogin(Request $req)
   {
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
                return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('thatbai','Sai thông tin đăng nhập');
        }
    }
       public function Register()
   {
   		return view('Master.Register');
   }

    public function postregister(Request $req){
        $this->validate($req,['email'=>'required|email', 'full_name'=>'required', 'password'=>'required|min:6|max:10', 'phone'=>'required|min:10|max:11', 're_password'=>'required|same:password'
            ],['email.required'=>'Vui lòng nhập Email',
                'email.email'=>'Email không đúng định dạng',
                'phone.numeric'=>'Điện thoại phải thuộc kiểu số',
                'password.redirect'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu tối đa 10 ký tự',
                're_password.same'=>'Mật khẩu không khớp'
            ]);
        // DB::table('users')->insert([
        // 		'full_name'=>'lam'
        // 	]);
        $user=User::where('email',$req->email)->first();
        if($user)
        	return redirect()->back()->with('thatbai','Email đã tồn tại');
        else
        {
            
	        $user=new User();
	        $user->full_name = $req->full_name;
	        $user->email =$req->email;
	        $user->password = Hash::make($req->password);
	        $user->phone = $req->phone;
	        $user->address = $req->address;
	        $user->remember_token=$req->_token;
	        $user->save();
    	}
        
       Mail::send('Page.Mail',['nguoidung'=>$user], function ($message) use ($user)
    	{
        $message->from('manhhoangminh1010@gmail.com', "Cung Cấp Gạch Ốp Lát");
        
        $message->to($user->email,$user->full_name);
        $message->subject('xác nhận tài khoản');
    	});

      return redirect()->back()->with('thanhcong','Đăng ký thành công, Vui lòng kiểm tra Email');
    }

    public function activeUser(Request $req){
         $user=User::where([
                ['id','=',$req->id],
                ['remember_token','=',$req->remember_token]
            ])->first();
        if($user){
            $user->active=1;
            $user->save();
            return redirect()->route('getregister')->with('thanhcong','Đã kích hoạt tài khoản');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }


}
