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
use Session;
use Auth;
use App\Product;
use App\Rating_Product;
use App\View_product;
class Product_Controller extends Controller
{
   //Lấy tất cả sản phẩm của loại cha
  public function All_Product($id)
   {
    $countTypeNotNull = 0;
   	$All_Product=Product::All_Product_ById($id);
    $typepro=0;
    $countAllType =count($All_Product);

    foreach ($All_Product as $key => $value) {
      if(!isset($value[0])) {
        $countTypeNotNull++;
      }
    }

    if($countTypeNotNull == $countAllType) {
      $haveProduct = 0;
    }
    else {
      $haveProduct = 1;
    }
   	return view('Page.Product',compact('All_Product','typepro','haveProduct'));
   }
   //Lấy sản phẩm của 1 loại nhất định
   public function All_Product_By_Type(Request $req)
   {
      $sort = $req->sort;
      if(isset($req->sort)) {
        if($sort === "No Sort") {
            $product=Product::Find_Product_By_Id_Type($req->id)->paginate(6,['products.id']);
        }
        elseif($sort === "ASC") {
          $product=Product::Find_Product_By_Id_Type($req->id)->orderBy('name','ASC')->paginate(6,['products.id']);
        }
        elseif ($sort === "DESC") {
           $product=Product::Find_Product_By_Id_Type($req->id)->orderBy("name",'DESC')->paginate(6,['products.id']);
        }
      }
      else {
        $product=Product::Find_Product_By_Id_Type($req->id)->paginate(6,['products.id']);
      }
      $typepro=$req->id;

      return view('Page.Product',compact('product','typepro','sort'));
   }
   //Lây chi tiết sản phẩm đó vả đưa ra 1 số sản phẩm gợi ý cùng loại
   public function getDetail(Request $req)
   {
    Session::put('checkcart',false);
   	$product=Product::Find_Product_By_Id($req->id)->get();

    if(Cookie::has('cookieIdWebGach')){
      $user=Cookie::get('cookieIdWebGach');
      $typePeople='CookieID';
    }

    if(Auth::check()){
      $user=Auth::User()->id;
      $typePeople='User';
    }

    $updateViewSimilarProduct=View_product::InsertVIewOnProductByPeople($req->id,$user,$typePeople);
    $product_recommend=Product_Controller::getSimilarProduct($req);
      if ( $product_recommend != 0  ) {
         foreach ($product_recommend as $key => $value) {
            $product_same_type[]=Product::FindSimilarProduct($key)->first();
            if(isset($product_same_type[2]))
              break;
         }
      }
      else {
          $product_same_type=Product::Find_Product_By_Same_Type($product[0]->id_type,$product[0]->id)->limit(3)->get();
      }
   	return view('Page.Detail_Product',compact('product','product_same_type'));
   }
   //search product theo loại sản phẩm hoặc kích thước
   public function Search_Product(Request $req)
   {
      $typeSearch=$req->typeSearch;
      $sizeSearch=$req->sizeSearch;
      $sort =$req->sort;
      if($typeSearch == "khong" &&  $sizeSearch == 'khong') {
         $product=DB::table('products')->join('export_product','products.id','=','export_product.id_product')
                                      ->where([
                                          ['status',0],
                                          ])
                                      ->select('products.id','products.id_type','products.view','products.name','products.image','products.description')->orderBy('name',$sort)->distinct()->paginate(6,['products.id']);
                              }
      else if($typeSearch!="khong"&&$sizeSearch=='khong')
         $product=DB::table('products')->join('export_product','products.id','=','export_product.id_product')
                                      ->where([
                                          ['status',0],['id_type',$typeSearch]
                                          ])
                                      ->select('products.id','products.id_type','products.view','products.name','products.image','products.description')->distinct()->orderBy('name',$sort)->paginate(6,['products.id']);
      else if($typeSearch=="khong"&&$sizeSearch!='khong')
         $product=Product::Search_Product_By_Size($sizeSearch)->orderBy('name',$sort)->paginate(6,['products.id']);
      else
         $product=Product::Search_Product_By_Type_Size($typeSearch,$sizeSearch)->orderBy('name',$sort)->paginate(6,['products.id']);
      return view('Page.Search_Product',compact('product','typeSearch','sizeSearch','sort'));
   }
   //search theo tên sản phẩm
   public function Search_Detail(Request $req) {
      $product=DB::table('products')->join('export_product','products.id','=','export_product.id_product')
                                      ->select('products.id','products.id_type','products.view','products.name','products.image','products.description')->whereRaw("match(name) against('$req->search') and status = 0")->orWhere([['name','Like','%'.$req->search.'%'],['status',0]])->distinct()->paginate(6);
      $typeSearch = 'khong';
      $sizeSearch = 'khong';
      $searchNamePro = 1;
      $search = $req->search;
     return view('Page.Search_Product',compact('product','typeSearch','sizeSearch','searchNamePro','search'));
   }
   //cái này dùng để hiện ajax các gợi ý
   public function autocomplete(Request $req) {
      $term = $req->term;
      $results = array();
      
      $queries =DB::table('products')->join('export_product','products.id','=','export_product.id_product')
                                      ->where([
                                          ['status',0]
                                          ])
                                      ->select('products.id','products.id_type','products.view','products.name','products.image','products.description')->whereRaw("match(name) against('$term') and status = 0")->orWhere([['name','Like','%'.$term.'%'],['status',0]])->distinct()
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
    $exitUser=View_product::checkUserExist($user)->first();
    if(isset($exitUser->id)){

       $products=array();
       $product=View_product::getProduct()->get();
       foreach($product as $key){
          $products[$key->id_people_view][$key->id_product]=$key->number_view;
       }
       // dd($products);
       //ý tưởng là nếu như không có sản phẩm nào được gợi ý thì ẽ lấy những thằng sản phẩm cùng loại 
       $pro=Product_Controller::getRecommendations_Cosine($products,$user);
       if(!$pro){
        return 0;
       }
       else {
        return $pro;
       } 
    }
    else{
       return 0;
    }
 }


    public function matchItems_Cosine($preferences, $person){
        $score = array();
        
            foreach($preferences as $otherPerson=>$values){

                if($otherPerson != $person) {

                    $sim = $this->similarityDistance_Cosine($preferences, $person, $otherPerson);
                    if($sim > 0){
                        $score[$otherPerson] = $sim;
                    }
                }
            }
            //sort theo value giảm dần
        arsort($score);
        return $score;
    
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
        //sigma của a nhân b và tổng của tất cả sản phẩm person đã view
        foreach($preferences[$person1] as $key=>$value){

            if(array_key_exists($key, $preferences[$person2])){
                $multi=$multi + ($value * $preferences[$person2][$key]);
            }

            $s1=$s1+pow($value,2);
        }
        //tính sqrt của tất cả các sản phẩm mà person2 đã view
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
        
        foreach($preferences as $otherPerson => $values)
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
                    //Tìm ra những sách mà user cần  không có view
                    if(!array_key_exists($key, $preferences[$person]))
                    {
                        if(!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        //Tìm tổng của user có key không trùng với user đưa vào ti lệ thuận với độ tương tự của nó(tổng só lượng view trung bình  của 1 sản phẩm  của tất cả các user ứng với độ tương tự của từng user)
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;
                        if(!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        //Tổng các độ tương tự của người dùng với sản phẩm ấy
                        // $simSums[$key] += $sim;


                    }
                }
                
            }
        }
        //bỏ đi do chia ra hay không chia thì tỷ lệ vẫn vậy
        // foreach($total as $key=>$value)
        // {
        //   $ranks[$key] = 0;
        //   // $ranks[$key] = $value / $simSums[$key];

        //   $ranks[$key]=$value;
        // }
        //sort theo value giảm dần
        arsort($total);
       return $total;    
    }

}
