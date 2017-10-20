<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Slide extends Model
{
    protected $table='banner';
    public $timestamps = true;
    public static function Top5Slide() {
    	$slide=DB::table('banner')->where('show',1)->select()->orderBy('id','DESC')->limit(5);
    	return $slide;
    }

    public static function getAll() {
    	$slide=DB::table('banner')->select();
    	return $slide;
    }

    public static function getSlideByID($id) {
    	$slide=DB::table('banner')->where('id',$id)->select();
    	return $slide;
    }

    public static function insertSlide($hinh,$url,$show,$idUser){
    	$slide=DB::table('banner')->insert(['hinh' => $hinh,'url' => $url, 'show' => $show, 'id_user' => $idUser]);
    	return $slide;
    }

    public static function updateSlide($suaanh,$hinh,$url,$show,$idUser,$id) {
    	if($suaanh==1) {
    		$slide=DB::table('banner')->where('id',$id)->update(['hinh' => $hinh,'url' => $url, 'show' => $show, 'id_user' => $idUser]);
    	return $slide;
    	}
    	elseif ($suaanh==0) {
    		$slide=DB::table('banner')->where('id',$id)->update(['url' => $url, 'show' => $show, 'id_user' => $idUser]);
    	return $slide;
    	}
    }

    public static function deleteSlide($id) {
    	$slide=DB::table('banner')->where('id',$id)->delete();
    }
}
