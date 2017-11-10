<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Staff_permission extends Model
{
    public static function updateStaffPermission($idUser,$bannerPermission, $productPermission
        , $categoryPermission, $userPermission, $billPermission, $historyPermission
        , $errorProductPermission, $discountPermission, $giftPermission,$newsPermission) {

        $staff = DB::table('staff_permission')->where('id_staff', $idUser)->select('id_staff')->first();
        if(isset($staff->id_staff)) {

            $staff = DB::table('staff_permission')->where('id_staff', $idUser)->update([
                 'banner_permission' => $bannerPermission
                , 'product_permission' => $productPermission
                , 'category_permission' => $categoryPermission
                , 'news_permission' => $newsPermission
                , 'bill_permission' => $billPermission
                , 'user_permission' => $userPermission
                , 'import_product_permission' => $historyPermission
                , 'error_product_permission' => $errorProductPermission
                , 'discount_permission' => $discountPermission
                , 'gift_permission' => $giftPermission
                ]);
        }else {
            $staff = DB::table('staff_permission')->insert([
                 'id_staff' => $idUser
                ,'banner_permission' => $bannerPermission
                , 'product_permission' => $productPermission
                , 'category_permission' => $categoryPermission
                , 'news_permission' => $newsPermission
                , 'bill_permission' => $billPermission
                , 'user_permission' => $userPermission
                , 'import_product_permission' => $historyPermission
                , 'error_product_permission' => $errorProductPermission
                , 'discount_permission' => $discountPermission
                , 'gift_permission' => $giftPermission
                ]);
        }
    }

    public static function getPermissionById($idUser) {
         $staff = DB::table('staff_permission')->where('id_staff', $idUser)->select();
         return $staff;
    }

    public static function deleteUser($idUser) {
         $staff = DB::table('staff_permission')->where('id_staff', $idUser)->delete();
         return $staff;
    }
}

