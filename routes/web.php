<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',[
	'as'=>'home',
	'uses'=>'Home_Controller@getindex']);
Route::get('home',[
	'as'=>'home',
	'uses'=>'Home_Controller@getindex']);
Route::get('Contact',[
	'as'=>'Contact',
	'uses'=>'Home_Controller@getContact']);
// ------------------------------ADMIN------------------------------------
Route::get('Content_Admin',[
	'as'=>'Content_Admin',
	'uses'=>'Admin_Controller@Content_Admin']);
// ------------------------------ADMIN------------------------------------
//------------------------------Trang Giao Diện------------------------------------
//------------------------------Sản Phẩm------------------------------------
Route::get('ViewAll_Product/{id}',[
	'as'=>'ViewAll_Product',
	'uses'=>'Product_Controller@All_Product']);
Route::get('Detail/{id}',[
	'as'=>'Detail',
	'uses'=>'Product_Controller@getDetail']);
Route::get('Type/{id}',[
	'as'=>'ViewAll_Product_By_Type',
	'uses'=>'Product_Controller@All_Product_By_Type']);
//search theo loại và kích thước
Route::get('Search',[
	'as'=>'Search',
	'uses'=>'Product_Controller@Search_Product']);
//search chi tiết sản phẩm
Route::get('Detail_Search',[
	'as'=>'Detail_Search',
	'uses'=>'Product_Controller@Search_Detail']);

//------------------------------Sản Phẩm------------------------------------

//------------------------------Đăng Nhập------------------------------------
Route::post('login',[
	'as'=>'login',
	'uses'=>'LoginRegister_Controller@postLogin']);
Route::get('logout',[
	'as'=>'logout',
	'uses'=>'LoginRegister_Controller@getLogout']);
Route::post('register',[
	'as'=>'register',
	'uses'=>'LoginRegister_Controller@postregister']);
Route::get('getregister',[
	'as'=>'getregister',
	'uses'=>'LoginRegister_Controller@Register']);
Route::get('active-user',[
	'as'=>'active-user',
	'uses'=>'LoginRegister_Controller@activeUser']
);

//------------------------------Đăng Nhập------------------------------------
//------------------------------Trang Giao Diện------------------------------------

