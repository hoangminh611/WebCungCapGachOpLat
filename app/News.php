<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class News extends Model
{
    protected $table='news';
    public $timestamps = true;
    //lấy 5 bài mới nhất
    public  static function ShowNewPost(){
        $news=DB::table('news')->limit(5)->where('show',1)->orderBy('id','DESC')->select();
        return $news;
    }
    public static function ShowAllPost(){
         $news=DB::table('news')->where('show',1)
                                ->join('category','news.Category_ID_News','=','category.id')
                                ->select('news.id','news.title','news.image','news.description','news.content','category.name','news.created_at','news.Category_ID_News','news.show')->orderBy('news.id','DESC');
        return $news;
    }

     public static function ShowAllPost_ByType($id){
         $news=DB::table('news')->where([['Category_ID_News',$id],['show',1],])->orderBy('id','DESC')->select();
        return $news;
    }
    public static function  CategoryNews(){
        $news=DB::table('category')
                    ->where([
                            ['type', '=', '2'],
                            ['type_cha', '=', '0'],
                            ])->select();
        return $news;
    }
    public static function New_Detail($id)
    {
        $news=DB::table('news')->where('news.id',$id)
                ->join('users','news.id_user','=','users.id')
                ->join('category','news.Category_ID_News','=','category.id')
                ->select('news.title','news.image','news.description','news.content','users.full_name','news.created_at','news.Category_ID_News','news.show','category.name','category.id as type_new');
        return $news;
    }

    //--------------------------------------------ADMIN-------------------------------------
    public static function Load_ALL_News(){
        $news=DB::table('news')
                ->where([
                        ['type', '=', '2'],
                        ['type_cha', '=', '0'],
                        ])
                ->join('category','news.Category_ID_News','=','category.id')
                ->join('users','news.id_user','=','users.id')
                ->select('category.name as type_name','news.id','news.id_user','news.title','news.image','news.description','news.content','users.full_name','news.show')
                ->orderBy('id','DESC');
        return $news;
    }
    public static function Load_ALL_News_By_Id($id){
         $news=DB::table('news')
                ->where([
                        ['type', '=', '2'],
                        ['Category_ID_News', '=', $id],
                        ['type_cha', '=', '0'],
                        ])
                ->join('category','news.Category_ID_News','=','category.id')
                ->join('users','news.id_user','=','users.id')
                ->select('category.name as type_name','news.id','news.id_user','news.title','news.image','news.description','news.content','users.full_name','news.show')
                ->orderBy('id','DESC');
        return $news;
    }
    public static function UpdateNewById($id) {
        $news=DB::table('news')
                ->where('news.id',$id)
                ->select();
        return $news;
    }
    public static function NewById($id) {
        $news=DB::table('news')
                ->where('news.id',$id)
                ->join('users','news.id_user','=','users.id')->select();
        return $news;
    }

    public static function InsertNews($id_user,$title,$image,$description,$content,$category_id_news) {
        $id=DB::table('news')
                ->insertGetId(['id_user' => $id_user,'title' => $title, 'image' => $image, 'description' => $description, 'content' => $content, 'Category_ID_News' => $category_id_news]);
        return $id;
    }

    public static function getImageNameFromNews($id) {
         $News=DB::table('news')
                    ->where('id',$id)->select('image');
        return $News;       
    }
    public static function UpdateNews($themSuaAnh, $id, $id_user, $title, $image, $description, $content, $category_id_news, $show_new) {
        if($themSuaAnh == 1) {
            $News=DB::table('news')
                    ->where('id',$id)
                    ->update(['id_user' => $id_user, 'title' => $title, 'image' => $image , 'description' => $description, 'content' => $content, 'Category_ID_News' => $category_id_news, 'show' => $show_new]);
        }
        else {
            $News=DB::table('news')
                    ->where('id',$id)
                    ->update(['id_user' => $id_user, 'title' => $title, 'description' => $description, 'content' => $content, 'Category_ID_News' => $category_id_news, 'show' => $show_new]);
        }
                return $News;

    }
    public static function DeleteNews($id){
           $News=DB::table('news')
                    ->where('id',$id)
                   ->delete();
            return $News;
    }
    //------------------------ loại new
    public static function  Show_All_Type_News()
    {
        $typenews =  DB::table('category')->select()->where([
                                    ['type', '=', '2'],
                                    ['type_cha', '=', '0'],
                                    ])->orderBy('id','DESC');
        return $typenews;
    }

    public static function InsertTypeNews($name,$description,$type_cha,$type)
    {
        $type_news=DB::table('category')
                        ->insert(['name'=>$name,'description'=>$description,'type_cha'=>$type_cha,'type'=>$type]);
        return $type_news;
    }
    //lấy ra loại de bo vào trang update loai
    public static function Update_Type_News_By_Id($id)
    {
        $typenews =  DB::table('category')->select()->where([
                                    ['type', '=', '2'],
                                    ['type_cha', '=', '0'],
                                    ['id','=',$id]
                                    ]);
        return $typenews;
    }

    public static function Detele_Type_News_By_Id($id)
    {
        $News=DB::table('news')
                    ->where('Category_ID_News',$id)
                   ->delete();
        $type=DB::table('category')
                    ->where('id',$id)
                   ->delete();
            return $type;
    }

     public static function Update_Type_News($id,$name,$description,$type_cha,$type){
               $News=DB::table('category')
                        ->where('id',$id)
                        ->update(['name'=>$name,'description'=>$description,'type_cha'=>$type_cha,'type'=>$type]);
                return $News;
    }
}

