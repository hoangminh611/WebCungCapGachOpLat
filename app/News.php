<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class News extends Model
{
    protected $table='news';
    public static function Load_ALL_News(){
    	$news=DB::table('news')->select();
    	return $news;
    }
    public static function NewById($id){
    	$news=DB::table('news')
                ->where('news.id',$id)
    			->join('users','news.id_user','=','users.id')->select();
    	return $news;
    }
}
