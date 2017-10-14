<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
use Cookie;
use Auth;
use App\Product;
use App\Rating_Product;
class Product_Controller extends Controller
{
   //vào trnag home
   public function getIndex()
   {
   	return view('Master.home');
   }
   //Lấy tất cả sản phẩm của loại cha
   public function All_Product($id)
   {
   	$All_Product=Product::All_Product_ById($id);
      $typepro=0;
   	return view('Page.Product',compact('All_Product','typepro'));
   }
   //Lấy sản phẩm của 1 loại nhất định
   public function All_Product_By_Type(Request $req)
   {
      $product=Product::Find_Product_By_Id_Type($req->id)->paginate(6);
      $typepro=$req->id;

      return view('Page.Product',compact('product','typepro'));
   }
   //Lây chi tiết sản phẩm đó vả đưa ra 1 số sản phẩm gợi ý cùng loại
   public function getDetail(Request $req)
   {
   	$product=Product::Find_Product_By_Id($req->id)->get();
      $product_recommend=Product_Controller::getSimilarProduct($req);
      if($product_recommend!=0){
         foreach ($product_recommend as $key => $value) {
            $product_same_type[]=Product::FindSimilarProduct($value)->get();
         }
      }
      else{
          $product_same_type[]=Product::Find_Product_By_Same_Type($product[0]->id_type,$product[0]->id)->limit(3)->get();
      }
     
      
   	return view('Page.Detail_Product',compact('product','product_same_type'));
   }
   //search product theo loại sản phẩm hoặc kích thước
   public function Search_Product(Request $req)
   {
      $type=$req->type;
      $size=$req->size;
      if($type=="khong"&&$size=='khong')
         $product=DB::table('products')->select()->get();
      else if($type!="khong"&&$size=='khong')
         $product=DB::table('products')->where('id_type',$type)->select()->get();
      else if($type=="khong"&&$size!='khong')
         $product=Product::Search_Product_By_Size($size)->get();
      else
         $product=Product::Search_Product_By_Type_Size($type,$size)->get();
      return view('Page.Search_Product',compact('product'));
   }
   //search theo tên sản phẩm
   public function Search_Detail(Request $req) {
      $product=DB::table('products')->whereRaw("match(name) against('$req->search')")->orWhere('name','Like','%'.$req->search.'%')->get();
     return view('Page.Search_Product',compact('product'));
   }
   //cái này dùng để hiện ajax các gợi ý
   public function autocomplete(Request $req) {
      $term = $req->term;
      $results = array();
      
      $queries =DB::table('products')->whereRaw("match(name) against('$term')")->orWhere('name','Like','%'.$term.'%')
              ->take(5)->get();
      foreach ($queries as $query)
      {
          $results[] = [ 'id' => $query->id, 'value' =>$query->name];
      }
      return response()->json($results);
   }

      public function getSimilarProduct(Request $req){
      
      if(Cookie::has('cookieIdWebGach')){
         $user=Cookie::get('cookieIdWebGach');
      }
      if(Auth::check()){
         $user=Auth::User()->id;
      }
      $exitUser=Rating_Product::checkUserExist($user)->first();

      if(isset($exitUser->id)){

         $products=array();
         $product=Rating_Product::getProduct()->get();
         foreach($product as $key){
            $products[$key->id_people_rating][$key->id_product]=$key->rating;
         }
         // dd($products);
         //ý tưởng là nếu như không có sản phẩm nào được gợi ý thì ẽ lấy những thằng sản phẩm cùng loại 
         
         $pro=Product_Controller::getRecommendations_Cosine($products,$user);
         return $pro;
      }
      else{
         return 0;
      }
   }

   public function similarityDistance_Cosine($preferences, $person1, $person2){
        $similar = array();
        $sum = 0;
        $multi=0;
        $s1=0;
        $s2=0;
        foreach($preferences[$person1] as $key=>$value) {

            if(array_key_exists($key, $preferences[$person2])){
                $similar[$key] = 1;
            }
            
        }

        if(count($similar) == 0){
            return 0;
        }
        
        foreach($preferences[$person1] as $key=>$value){

            if(array_key_exists($key, $preferences[$person2])){
                $multi=$multi + ($value * $preferences[$person2][$key]);
            }

            $s1=$s1+pow($value,2);
        }

        foreach($preferences[$person2] as $key=>$value){
            $s2=$s2+pow($value,2);
        }

        return  $multi/(sqrt($s1)*sqrt($s2));     
    }

   public function getRecommendations_Cosine($preferences, $person){
        $total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;
        
        foreach($preferences as $otherPerson=>$values)
        {
            //Nếu 2 user có trùng nhau 1 sách nào đó 
            if($otherPerson != $person)
            {
                $sim = $this->similarityDistance_Cosine($preferences, $person, $otherPerson);
            }
            //Có trùng 
            if($sim > 0)
            {
                foreach($preferences[$otherPerson] as $key=>$value)
                {
                    //Tìm ra những sách mà user cần  không có đánh giá
                    if(!array_key_exists($key, $preferences[$person]))
                    {
                        if(!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        //Tìm tổng của user có key không trùng với user đưa vào ti lệ thuận với độ tương tự của nó
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;

                        if(!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        //Tổng các độ tương tự của người dùng với sản phẩm ấy
                        $simSums[$key] += $sim;


                    }
                }
                
            }
        }
        
        foreach($total as $key=>$value)
        {
            // $ranks[] = $value / $simSums[$key];

            $ranks[]=$key;
        }
        //sort theo value giảm dần
        arsort($ranks);
       return $ranks;    
    }

}
