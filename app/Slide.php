<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Slide extends Model
{
    protected $table='banner';
    public static function Top5Slide(){
    	$slide=DB::table('banner')->select()->orderBy('id','DESC');
    	return $slide;
    }
}
