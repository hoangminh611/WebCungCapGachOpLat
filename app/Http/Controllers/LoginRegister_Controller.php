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
use App\Bill_Detail;
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
        $this->validate($req,['email'=>'required|email', 'full_name'=>'required', 'password'=>'required|min:6|max:10', 'phone'=>'numeric', 're_password'=>'required|same:password'
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
            Auth()->login($user);
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
            $user->active=1;
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
    //vào trang của user để edit
    public function ViewPage_User_Edit()
    {
      return view('Master.User_Edit');
    }
    //update lại user
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
      {
         $this->validate($req,['password'=>'required|min:6|max:10','re_password'=>'required|same:password'
            ],[
                'password.redirect'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu tối đa 10 ký tự',
                're_password.same'=>'Mật khẩu không khớp'
            ]);
        $password=Hash::make($password);
      }
      $user = User::where('email',Auth::User()->email)->update(['full_name'=>$name,'phone'=>$phone,'password'=>$password]);
      return redirect()->back()->with('thanhcong','Thay đổi thông tin thành công');
    }
    //vài trang bill của user
    public function ViewPage_User_Bill()
    {
      if(Auth::check())
      {
        $bills=array();
        $i=0;
        $id_customer=DB::table('customer')->where('id_user',Auth::User()->id)->select('id')->get();
        if(isset($id_customer[0]))
        {
          foreach($id_customer as $id)
          {

            $bill=DB::table('bills')->where('id_customer',$id->id)->select()->get();
            $bills[$i++]=$bill;
          }
        }
        else
          $bills=null;
        return view('Master.User_Bill',compact('bills'));
      }
      else
        return redirect()->route('index');
    }
    //vào trang bill detail của từng bill của user đó
    public function ViewPage_User_Bill_Detail($id)
    {
      if(Auth::check())
      {
        $bill_details=Bill_Detail::View_All($id)->get();

        return view('Master.User_Bill_Detail',compact('bill_details'));
      }
      else
        return redirect()->route('index');
    }

    public function Forget_Password()
    {
      $laylaimatkhau=0;
      return view('Master.Register',compact('laylaimatkhau'));
    }
    //forget password
    public function PostForgetPassword(Request $req){
      $user=User::User_All()->where('email',$req->get_mail)->get();
      if(isset($user[0])){

            $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i <6 ; $i++) {
                 $randomString .= $characters[rand(0, $charactersLength - 1)];
             }
            Mail::send('Page.Mail_Forget_Pass',['matkhau'=>$randomString,'email'=>$user[0]->email], function ($message)  use ($user)
            {
              $message->from('manhhoangminh1010@gmail.com', "Cung Cấp Gạch Ốp Lát");
              $message->to($user[0]->email,$user[0]->full_name);
              $message->subject('Cấp lại mật khẩu');
            });
             // DB::table('users')->where('email',$req->get_mail)->update(['password'=>Hash::make($randomString)]);
             return redirect()->back()->with('thanhcong','Mật khẩu mới đã được gửi tới email của bạn. Vui lòng kiểm tra email để lấy mật khẩu và đăng nhập.');  
      }
      else
            return redirect()->back()->with('thatbai','Nhập Không Đúng Email hoặc Email Bạn Không Tồn Tại');
    }
    //dang nhap khi lay lai mat khau
     //Login
   public function getLogin(Request $req)
   {    
        $password=Hash::make($req->password);
        $pro=DB::table('users')->where('email',$req->email)->update(['password'=>$password]);
         if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1])){
                return redirect()->route('home')->with('thanhcong','xin hãy đổi lại mật khẩu để tránh sai sót');;
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
                    $thatbai="Mật khẩu đã được thay đổi";
                }
            return redirect()->back()->with('thatbai',$thatbai);
        }
    }
}
