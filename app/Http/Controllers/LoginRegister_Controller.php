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
  //Login
   public function postLogin(Request $req)
   {    
        
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
                return redirect()->route('home');
        }
        else
        {  
            $active=DB::table('users')->where('email',$req->email)->select('active')->get();
                if($active[0]->active==0)
                {
                    $thatbai="Email chưa kích hoạt";
                }
                else
                {
                    $thatbai="Sai thông tn đăng nhập";
                }
            return redirect()->back()->with('thatbai',$thatbai);
        }
    }
    //Gọi trang register
       public function Register()
   {
   		return view('Master.Register');
   }

      public function CheckEmail($email)
      {
          $user=User::where('email',$email)->first();
          if($user)
            return 'Email đã tồn tại vui lòng chọn email khác';
          else
            return 'Email hợp lệ';
      }
   //Đăng kí
    public function postregister(Request $req){
        $this->validate($req,['email'=>'required|email', 'full_name'=>'required', 'password'=>'required|min:6|max:10', 'phone'=>'numeric|min:10|max:11', 're_password'=>'required|same:password'
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
    //ACTIVE TÀI KHOẢN thường
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
    //logout
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
//khúc này để gọi facebook và google
    public function redirectToProvider($providers){
        return Socialite::driver($providers)->redirect();
    }
    public function handleProviderCallback($providers){
      try{
          $socialUser = Socialite::driver($providers)->user();
          //return $user->getEmail();
      }
      catch(\Exception $e){
          return redirect()->route('home')->with(['flash_level'=>'danger','thatbai'=>"Đăng nhập không thành công"]);
      }
       $socialProvider = User::where('provider_id',$socialUser->getId())->first();
       if(!$socialProvider){
          //tạo mới
          $user = User::where('email',$socialUser->getEmail())->first();
          if($user){
            return redirect()->route('home')->with(['flash_level'=>'danger','thatbai'=>"Email đã có người sử dụng"]);
          }
          else{
            $user = new User();
            $user->provider_id=$socialUser->getId();
            $user->provider=$providers;
            $user->email = $socialUser->getEmail();
            $user->full_name = $socialUser->getName();
            //if($providers == 'google'){
              // $image = explode('?',$socialUser->getAvatar());
              // $user->avatar = $image[0];
           // }
           // $user->avatar = $socialUser->getAvatar();
            $user->save();
          }
      }
      else{
          $user = User::where('email',$socialUser->getEmail())->first();
      }
      Auth()->login($user);
      return redirect()->route('home')->with(['flash_level'=>'success','thanhcong'=>"Đăng nhập thành công"]);
    }

    public function ViewPage_User_Edit()
    {
      return view('Master.User_Edit');
    }
    public function User_Edit(Request $req)
    {
      $name=$req->name;
      $phone=$req->phone;
      $password=$req->password;
      if($name==null)
        $name=Auth::User()->full_name;
      if($phone==null)
        $phone=Auth::User()->phone;
      if($password==null)
        $password=Auth::User()->password;
      else
        $password=Hash::make($password);
      $user = User::where('email',Auth::User()->email)->update(['full_name'=>$name,'phone'=>$phone,'password'=>$password]);
      return redirect()->back();

    }
}
