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
	'as'=>'index',
	'uses'=>'Home_Controller@getindex']);
Route::get('Contact',[
	'as'=>'Contact',
	'uses'=>'Home_Controller@getContact']);
// ------------------------------ADMIN------------------------------------
Route::get('Content_Admin',[
	'as'=>'Content_Admin',
	'uses'=>'Admin_Controller@Content_Admin']);
Route::get('Login_Admin',[
	'as'=>'Login_Admin',
	'uses'=>'Admin_Login_Controller@Login_Admin']);
//-------------------------------Sản phẩm Admin--------------------------
Route::get('Admin_All_Product',[
	'as'=>'Admin_All_Product',
	'uses'=>'Admin_Product_Controller@Admin_All_Product']);
Route::get('Admin_All_Product_By_Type/{id}',[
	'as'=>'Admin_All_Product_By_Type',
	'uses'=>'Admin_Product_Controller@Admin_All_Product_By_Type']);




//-------------------------------Sản phẩm Admin--------------------------
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
	'uses'=>'LoginRegister_Controller@activeUser']);

//------------------------------Đăng Nhập------------------------------------
//------------------------------Giỏ Hàng------------------------------------
Route::get('add-to-cart/',[
	'as'=>'add-cart',
	'uses'=>'Home_Controller@AddCart']);
Route::get('cart-detail',[
	'as'=>'cart-detail',
	'uses'=>'Home_Controller@DetailCart']);
Route::get('delete-cart',[
	'as'=>'delete-cart',
	'uses'=>'Home_Controller@DeleteCart']);
Route::get('delete-item-cart/{id}',[
	'as'=>'delete-item-cart',
	'uses'=>'Home_Controller@getDelItemCart']);
Route::get('update-cart',[
	'as'=>'update-cart',
	'uses'=>'Home_Controller@Update_Cart']);
//------------------------------Giỏ Hàng------------------------------------

//------------------------------Trang Giao Diện------------------------------------

