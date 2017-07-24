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
Route::group(['prefix'=>'admin'],function()
{

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
Route::get('ViewPage_ImportProduct',[
	'as'=>'ViewPage_ImportProduct',
	'uses'=>'Admin_Product_Controller@ViewPageImportProduct']);

Route::get('ViewPage_InsertProduct',[
	'as'=>'ViewPage_InsertProduct',
	'uses'=>'Admin_Product_Controller@ViewPageInsertProduct']);
Route::post('Update_Product',
	['as'=>'Update_Product',
	 'uses'=>'Admin_Product_Controller@Update_Product']);
Route::post('Insert_Product',
	['as'=>'Insert_Product',
	 'uses'=>'Admin_Product_Controller@Insert_Product']);
Route::get('Delete_Product',
	['as'=>'Delete_Product',
	 'uses'=>'Admin_Product_Controller@Delete_Product']);

Route::post('Insert_Import_Product',
	['as'=>'Insert_Import_Product',
	 'uses'=>'Admin_Product_Controller@Insert_Import_product']);
//-------------------------------Sản phẩm Admin--------------------------
//-------------------------------Loại Admin--------------------------
Route::get('Admin_All_Type',[
	'as'=>'Admin_All_Type',
	'uses'=>'Admin_Product_Controller@Admin_All_Type']);
Route::get('Admin_All_Type_By_Type/{id}',[
	'as'=>'Admin_All_Type_By_Type',
	'uses'=>'Admin_Product_Controller@Admin_All_Type_By_Type']);
Route::get('ViewPage_InsertCategory',[
	'as'=>'ViewPage_InsertCategory',
	'uses'=>'Admin_Product_Controller@ViewPage_InsertCategory']);
Route::post('Insert_Category',[
	'as'=>'Insert_Category',
	'uses'=>'Admin_Product_Controller@InsertCategory']);
Route::post('Update_Category',[
	'as'=>'Update_Category',
	'uses'=>'Admin_Product_Controller@UpdateCategory']);

//-------------------------------Loại Admin--------------------------
//-------------------------------News Admin--------------------------
Route::get('ViewNews',
	['as'=>'ViewNews',
	'uses'=>'Admin_News_Controller@ViewAllNews']);
Route::get('ViewNewsBy_id/{id}',
	['as'=>'ViewNewsBy_id',
	'uses'=>'Admin_News_Controller@ViewAllNewsBy_id']);

Route::post('UpdateNews',
	['as'=>'UpdateNews',
	'uses'=>'Admin_News_Controller@UpdateNews']);
Route::post('InsertNews',
	['as'=>'InsertNews',
	'uses'=>'Admin_News_Controller@InsertNews']);
Route::get('InsertNews',
	['as'=>'InsertNews',
	'uses'=>'Admin_News_Controller@ViewPageInsertNews']);
Route::get('DeleteNews',
	['as'=>'DeleteNews',
	'uses'=>'Admin_News_Controller@DeleteNews']);


Route::get('TypeNews',
	['as'=>'TypeNews',
	'uses'=>'Admin_News_Controller@AllTypeNews']);
Route::get('Insert_Type_News',
	['as'=>'Insert_Type_News',
	'uses'=>'Admin_News_Controller@View_Insert_Type_News']);

Route::get('DeleteTypeNews',
	['as'=>'DeleteTypeNews',
	'uses'=>'Admin_News_Controller@Delete_Type_News']);
Route::post('Insert_Type_News',
	['as'=>'Insert_Type_News',
	'uses'=>'Admin_News_Controller@Insert_Type_News']);
Route::post('Update_Type_News',
	['as'=>'Update_Type_News',
	'uses'=>'Admin_News_Controller@Update_Type_News']);
//-------------------------------News Admin---------------------
});
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
Route::get('loginfacebook/{provider}', [
	'as'=>'provider_login',
	'uses'=>'LoginRegister_Controller@redirectToProvider'
]);
Route::get('loginfacebook/{provider}/callback', [
	'as'=>'provider_login_callback',
	'uses'=>'LoginRegister_Controller@handleProviderCallback'
]);
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

