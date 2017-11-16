<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    protected $table='users';
    public $timestamps = true;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function addNew($input)
    {
    $check = static::where('facebook_id',$input['facebook_id'])->first();

    if(is_null($check)){
        return static::create($input);
    }

    return $check;
    
    }
    
    public static function User_All(){
            $user=DB::table('users')->select();
            return $user;
    }
    // //edit user
    public static function Update_User($id,$group) {
            $user=DB::table('users')->where('id','=',$id)->update(['group'=>$group]);
            return $user;
    }

    //gọi vào trang update user
    public static function Select_User_By_Id($id) {
        $user=DB::table('users')->where('id','=',$id)->select();
        return $user;
    }

    public static function getUserPermission($id) {
          $user=DB::table('staff_permission')->where('id_staff','=',$id)->select();
        return $user;
    }
    // //insert user
    // public static function Insert_User($name, $email, $password, $phone, $address, $group,$remember_token){
    //         $id=DB::table('users')->insertGetId(['full_name'=>$name,'email'=>$email, 'password'=>$password, 'phone'=>$phone, 'address'=>$address,'remember_token'=>$remember_token,'group'=>$group]);
    //         return $id;
    // }
    // //delete user
    // public static function Delete_User($id){
    //     $user=DB::table('users')->where('id','=',$id)->delete();
    //     return $user;
    // }
    //đếm số lượng user
    public static function Count_All_User() {  
         $user=DB::table('users')->count('id');
        return $user; 
    }

    public static function selectAllUserWithNoActiveAndNotProvider($dateToDeleteUser) {
        $user = DB::table('users')->where([['active',0],['provider',null],['updated_at','<',$dateToDeleteUser]])->delete();
        return $user;
    }

}
