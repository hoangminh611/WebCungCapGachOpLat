<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth; 
use Illuminate\Support\Facades\Input;
use App\Slide;
class Admin_Slide_Controller extends Controller
{
  //view trang login admin
   public function viewPageSlide()
   {
     $slides=Slide::getAll()->orderBy('id','DESC')->get();
   	 return view('Admin.Page.Slide_Admin',compact('slides'));
   }

   public function  viewPageInsertSlide(Request $req){
   		$id=$req->id;
   		if($id==null)
   			$id=0;
   		$slide=Slide::getSlideByID($id)->get();

   	return view('Admin.Page.Slide_Admin_Insert',compact('slide','id'));
   }

   public function insertSlide(Request $req){

      if ($req->hasFile('image')) 
      {
         $filename= $req->file('image')->getClientOriginalName();
         $req->file('image')->move('images/Banner',$filename);
      }
      else
      {
         $filename=null;
      }
      $url=$req->URL;
      $show=$req->show;
      if(Auth::check()) {
      	$idUser=Auth::User()->id;
      }
   	  $insertSlide=Slide::insertSlide($filename,$url,$show,$idUser);

   	  return redirect()->route('Slide_Admin');
   }

   public function updateSlide(Request $req){
   		if ($req->hasFile('image')) 
         {
            $image= $req->file('image')->getClientOriginalName();
            $req->file('image')->move('images',$image);
            $suaanh=1;         
         }
         else
         {
            $image=null;
            $suaanh=0;
            
         }
        $url=$req->URL;
        $show=$req->show;
        $id=$req->id;
        if(Auth::check()) {
      		$idUser=Auth::User()->id;
      	}

        $updateSlideide=SLide::updateSlide($suaanh,$image,$url,$show,$idUser,$id);
   	 	
   	 	return redirect()->route('Slide_Admin');
   }

   public function deleteSlide(Request $req){
   		$deleteSlide=Slide::deleteSlide($req->id);
   }
}
