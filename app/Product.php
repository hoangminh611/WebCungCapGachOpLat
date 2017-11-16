<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table='products';
    public $timestamps = true;
    public function type_products(){
    	return $this->belongsTo('App\TypeProduct','id_type','id');
    }
    public function bill(){
    	return $this->hasManyThrough('App\Bill','App\BillDetail','id_product','id');
    }
    public static function Top4Product()// tim san pham NHIỀU VIEW NHẤT
    {
      $a=array();
      $i=0;
    	$newPro = DB::table('products')             
              ->join('export_product','products.id','=','export_product.id_product')
              ->where([
                    ['status',0],
                    ])
    				       ->orderBy('view','DESC')->select('products.id','products.id_type','products.view','products.name','products.image','products.description')->get();
      foreach($newPro as $newpro)
      {
        $Pro=DB::table('products')->where('id',$newpro->id)->select()->first();
                if(!isset($a[$newpro->id]))
                {
                      $a[$newpro->id]=$Pro;
                      $i++;
                      if($i==4)
                        break;
                }

      }
            return $a;

    }
    //8 sản phẩm mới
    public static function Top8NewsProduct()
    {
      $a=array();
      $i=0;
      $newPro = DB::table('products')
              ->join('export_product','products.id','=','export_product.id_product')
              ->where([
                    ['status',0],
                    ])
            ->orderBy('id','DESC')->select('products.id','products.id_type','products.view','products.name','products.image','products.description')->get();
      foreach($newPro as $newpro)
      {
        $Pro=DB::table('products')->where('id',$newpro->id)->select()->first();
                if(!isset($a[$newpro->id]))
                {
                      $a[$newpro->id]=$Pro;
                      $i++;
                      if($i==8)
                        break;
                }

      }
            return $a;
    }
    //Tất cả sản phẩm cùng loại cha
    public static function All_Product_ById($id)
    {
      $type=DB::table('category')
                  ->where('category.id',$id)
                  ->join('category as bang','category.id','=','bang.type_cha')
                  ->select()->get();
      $newPro= array();
      foreach ($type as $loaicha)
      {
        $newpro = DB::table('products')->select()->where('id_type',$loaicha->id)->get();
        $newPro[$loaicha->id]=$newpro;
      }
            return $newPro;
    }

     //Tìm sản phẩm theo loại và kích thước
    public static function Search_Product_By_Type_Size($id,$size)
    {
      $product=DB::table('products')
                  ->join('export_product','products.id','=','export_product.id_product')
                  ->where([
                    ['id_type','=',$id],
                    ['size','=',$size],
                    ['status',0],
                    ])
                  ->select('export_product.id as idsize','products.id','products.id_type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price');
            return $product;
    }

    //tìm sản phầm theo size
     public static function Search_Product_By_Size($size)
    {
      $product=DB::table('products')
                  ->join('export_product','products.id','=','export_product.id_product')
                  ->where([['size',$size],['status',0],])
                  ->select('export_product.id as idsize','products.id','products.id_type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price');
            return $product;
    }

    //Tìm sản phẩm theo  loai
    public static function Find_Product_By_Id_Type($id){

        $product=DB::table('products')->where('id_type',$id);

        return $product;
    }
    //Tìm sản phẩm chi tiết
    public static function Find_Product_By_Id($id)
    {
        $view=DB::table('products')->where('products.id','=',$id)->select('view')->get();
        $view=($view[0]->view)+1;
        DB::table('products')->where('products.id','=',$id)->update(['view'=>$view]);
        $product=DB::table('products')
                    ->where('products.id','=',$id)
                    ->join('export_product','products.id','=','export_product.id_product')
                    ->where('status',0)
                    ->select('export_product.id as idsize','products.id','products.id_type','products.view','products.name','products.image','products.description','export_product.size as size','export_product.export_price','export_product.export_quantity');
          
        return $product;
    }

    public static function FindSimilarProduct($id){
      $product=DB::table('products')
                    ->where('products.id','=',$id)
                    ->join('export_product','products.id','=','export_product.id_product')
                    ->where('status',0)
                    ->select('export_product.id as idsize','products.id','products.name','products.image');
          
        return $product;
    }
    // Gợi Ý Tim sàn phẩm theo cùng loại
    public static function Find_Product_By_Same_Type($id,$idpro){
        $product=DB::table('products')->where([
          ['id_type','=',$id],
          ['id','!=',$idpro],
          ]);

        return $product;
    }
    
   //-------Admin-----------
     //hiện tất cả các sản phẩm
    public static function Show_Product_All(){
            $product=DB::table('products')
                        ->join('category','products.id_type','=','category.id')
                        ->join('export_product','products.id','=','export_product.id_product')
                        ->where('export_product.status',0)
                        ->select('category.name as type_name','products.id','products.name', 
                                'products.image','products.description','export_product.size as size','export_product.export_price','export_product.export_quantity')
                        ->orderBy('id','DESC');

        return $product;
  }
  //Hiện tất cả sản phẩm theo loại cha 
  public static function Show_Product_All_By_Type($id){
            $product=DB::table('products')
                        ->where('id_type',$id)
                        ->join('category','products.id_type','=','category.id')
                        ->join('export_product','products.id','=','export_product.id_product')
                        ->where('export_product.status',0)
                        ->select('category.name as type_name','products.id','products.name',
                                'products.image','products.description','export_product.size as size','export_product.export_price','export_product.export_quantity')
                        ->orderBy('id','DESC');
        return $product;
  }
  //xóa sản phẩm theo id sản phẩm
  public static function Delete_Product($id){
        $pro=DB::table('products')->where('id','=',$id)->delete();
        return $pro;
  }


  //Insert san phẩm mới
  public static function Insert_Product($name, $type, $desc,$image){
            $id=DB::table('products')->insertGetId(['name'=>$name,'id_type'=>$type,'description'=>$desc,'image'=>$image]);
            return $id;
  }

  //Tìm 1 sản phẩm chi tiết
  public static function findOneProduct($id)
    {
        $product = DB::table('products')
                    ->where('id','=',$id);
        return $product;

    }

  public static function getImageProduct($id) {
    $pro=DB::table('products')->where('id','=',$id)->select('image');
    return $pro;
  }
  //Update sản phẩm
  public static function Update_Product($anhthemmoi_suaAnh,$id,$name, $type,$desc,$image){
      if($anhthemmoi_suaAnh==1)
        {
            $pro=DB::table('products')->where('id','=',$id)->update(['name'=>$name,'id_type'=>$type,'description'=>$desc,'image'=>$image]);
            return $pro; 
        }
      else
        {
             $pro=DB::table('products')->where('id','=',$id)->update(['name'=>$name,'id_type'=>$type,'description'=>$desc]);
        }
  }
    //All view nhiều nhất
    public static function All_ViewProduct(){
        $total_view=DB::table('products')->sum('view');
        return $total_view;
    }





  
}
