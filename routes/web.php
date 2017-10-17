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
Route::get('News',[
	'as'=>'News',
	'uses'=>'Home_Controller@getNews']);
Route::get('News_By_Type/{id}',[
	'as'=>'News_By_Type',
	'uses'=>'Home_Controller@getNews_By_Type']);
Route::get('New_Detail/{id_new}',[
		'as'=>'New_Detail',
	'uses'=>'Home_Controller@getNew_Detail']);

// ------------------------------ADMIN------------------------------------
Route::group(['prefix'=>'admin'],function()
{

Route::get('Content_Admin',[
	'as'=>'Content_Admin',
	'uses'=>'Admin_Controller@getContentAdmin']);
Route::get('Login_Admin',[
	'as'=>'Login_Admin',
	'uses'=>'Admin_Login_Controller@Login_Admin']);
Route::post('Login',[
	'as'=>'Login',
	'uses'=>'Admin_Login_Controller@postLogin_Admin']);
Route::get('Logout',[
	'as'=>'Logout',
	'uses'=>'Admin_Login_Controller@getLogout']);
Route::get('GetMonthlyFund',[
	'as'=>'GetMonthlyFund',
	'uses'=>'Admin_Controller@getMonthlyFund']);
Route::get('GetPDF',[
	'as'=>'GetPDF',
	'uses'=>'Admin_Controller@GetPDF']);
//-------------------------------User,Customer Admin------------------------------
Route::get('ViewPage_User_Admin',[
	'as'=>'ViewPage_User_Admin',
	'uses'=>'Admin_Controller@ViewPage_User_Admin']);
Route::get('ViewPage_ImportProduct_Admin',[
	'as'=>'ViewPage_ImportProduct_Admin',
	'uses'=>'Admin_Controller@ViewPage_ImportProduct_Admin']);

Route::get('ViewPage_Update_User/{id}',[
	'as'=>'ViewPage_Update_User',
	'uses'=>'Admin_Controller@ViewPage_Update_User']);
Route::post('Update_User',[
	'as'=>'Update_User',
	'uses'=>'Admin_Controller@Update_User']);
//-------------------------------Sản phẩm Admin--------------------------
Route::get('Admin_All_Product',[
	'as'=>'Admin_All_Product',
	'uses'=>'Admin_Product_Controller@Admin_All_Product']);
Route::get('Admin_All_Product_By_Type/{id}',[
	'as'=>'Admin_All_Product_By_Type',
	'uses'=>'Admin_Product_Controller@Admin_All_Product_By_Type']);

Route::post('ViewPage_ImportProduct',[
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
Route::post('Delete_Product',
	['as'=>'Delete_Product',
	 'uses'=>'Admin_Product_Controller@Delete_Product']);
Route::post('Insert_Import_Product',
	['as'=>'Insert_Import_Product',
	 'uses'=>'Admin_Product_Controller@Insert_Import_product']);

Route::get('ViewPageError_Product',
	['as'=>'ViewPageError_Product',
	 'uses'=>'Admin_Product_Controller@ViewPageError_Product']);
Route::get('ViewPageError_Product_Update/{idsize}',
	['as'=>'ViewPageError_Product_Update',
	 'uses'=>'Admin_Product_Controller@ViewPageError_Product_Update']);
Route::post('Update_Error_Product',
	['as'=>'Update_Error_Product',
	 'uses'=>'Admin_Product_Controller@Update_Error_Product']);

//-------------------------------Sản phẩm Admin--------------------------

//-------------------------------Giảm Giá Admin--------------------------
Route::get('Discount_Admin',
	['as'=>'Discount_Admin',
	 'uses'=>'Admin_Discount_Controller@View_Page_Discount']);
Route::get('Discount_Insert_Admin',
	['as'=>'Discount_Insert_Admin',
	 'uses'=>'Admin_Discount_Controller@View_Page_Insert_Discount']);
Route::post('Insert_Discount',
	['as'=>'Insert_Discount',
	 'uses'=>'Admin_Discount_Controller@Insert_Discount']);
Route::post('Update_Discount',
	['as'=>'Update_Discount',
	 'uses'=>'Admin_Discount_Controller@Update_Discount']);
Route::post('Delete_Discount',
	['as'=>'Delete_Discount',
	 'uses'=>'Admin_Discount_Controller@Delete_Discount']);
//-------------------------------Giảm Giá Admin--------------------------
//-------------------------------Quản Lý quà tăng Admin------------------
Route::get('Gift_Admin',
	['as'=>'Gift_Admin',
	 'uses'=>'Admin_Gift_Controller@viewPageGift']);
Route::get('Gift_Insert_Admin',
	['as'=>'Gift_Insert_Admin',
	 'uses'=>'Admin_Gift_Controller@viewPageInsertGift']);
Route::post('Insert_Gift',
	['as'=>'Insert_Gift',
	 'uses'=>'Admin_Gift_Controller@insertGift']);
Route::post('Update_Gift',
	['as'=>'Update_Gift',
	 'uses'=>'Admin_Gift_Controller@updateGift']);
Route::post('Delete_Gift',
	['as'=>'Delete_Gift',
	 'uses'=>'Admin_Gift_Controller@deleteGift']);
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
Route::post('Delete_Category_Parent',
	['as'=>'Delete_Category_Parent',
	'uses'=>'Admin_Product_Controller@DeleteCategory_Parent']);

Route::post('Delete_Category_Child',
	['as'=>'Delete_Category_Child',
	'uses'=>'Admin_Product_Controller@DeleteCategory_Child']);

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
Route::post('DeleteNews',
	['as'=>'DeleteNews',
	'uses'=>'Admin_News_Controller@DeleteNews']);

//--------------------Loại News---------------------------------
Route::get('TypeNews',
	['as'=>'TypeNews',
	'uses'=>'Admin_News_Controller@AllTypeNews']);
Route::get('Insert_Type_News',
	['as'=>'Insert_Type_News',
	'uses'=>'Admin_News_Controller@View_Insert_Type_News']);

Route::post('DeleteTypeNews',
	['as'=>'DeleteTypeNews',
	'uses'=>'Admin_News_Controller@Delete_Type_News']);
Route::post('Insert_Type_News',
	['as'=>'Insert_Type_News',
	'uses'=>'Admin_News_Controller@Insert_Type_News']);
Route::post('Update_Type_News',
	['as'=>'Update_Type_News',
	'uses'=>'Admin_News_Controller@Update_Type_News']);
//-------------------------------News Admin---------------------
//-------------------------------Bill Admin---------------------
Route::get('ViewPageBill_Admin',
	['as'=>'ViewPageBill_Admin',
	'uses'=>'Admin_Bill_Controller@ViewPageBill_Admin']);

Route::get('ViewPageBill_Detail_Admin/{id}/{idcustomer}/{method}',
	['as'=>'ViewPageBill_Detail_Admin',
	'uses'=>'Admin_Bill_Controller@ViewPageBill_Detail_Admin']);
Route::get('ViewPageBill_Detail_Admin_Insert/{id}/{quantity}/{name_product}',
	['as'=>'ViewPageBill_Detail_Admin_Insert',
	'uses'=>'Admin_Bill_Controller@ViewPageBill_Detail_Admin_Insert']);
Route::post('Update_Bill_Detail',
	['as'=>'Update_Bill_Detail',
	'uses'=>'Admin_Bill_Controller@Update_Bill_Detail']);
Route::get('ViewPageBill_Admin_Insert/{id}/{customer}/',
	['as'=>'ViewPageBill_Admin_Insert',
	'uses'=>'Admin_Bill_Controller@ViewPageBill_Admin_Insert']);
Route::post('Update_Bill',
	['as'=>'Update_Bill',
	'uses'=>'Admin_Bill_Controller@Update_Bill']);

Route::post('Delete_Bill_Detail',
	['as'=>'Delete_Bill_Detail',
	'uses'=>'Admin_Bill_Controller@Delete_Bill_Detail']);
Route::get('Count_Bill',
	['as'=>'Count_Bill',
	'uses'=>'Admin_Bill_Controller@Count_Bill']);
Route::get('downloadPDF/{idcustomer}/{idbill}',
	['as'=>'downloadPDF',
	'uses'=>'Admin_Bill_Controller@downloadPDF']);
// ------------------------------ADMIN------------------------------------
});
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
Route::get('autosearch',[
	'as'=>'autosearch',
	'uses'=>'Product_Controller@autocomplete']);

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
Route::get('checkEmail/{email}',[
		'as'=>'checkEmail',
	'uses'=>'LoginRegister_Controller@CheckEmail']);
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
Route::get('Forget_Password',[
	'as'=>'Forget_Password',
	'uses'=>'LoginRegister_Controller@Forget_Password'
]);
Route::get('getlogin/{password}/{email}',[
	'as'=>'getlogin',
	'uses'=>'LoginRegister_Controller@getLogin']);
Route::post('PostForgetPassword',[
	'as'=>'PostForgetPassword',
	'uses'=>'LoginRegister_Controller@PostForgetPassword'
]);
Route::get('ViewPage_User_Edit',
	['as'=>'ViewPage_User_Edit',
	'uses'=>'LoginRegister_Controller@ViewPage_User_Edit']);
Route::get('ViewPage_User_Bill',
	['as'=>'ViewPage_User_Bill',
	'uses'=>'LoginRegister_Controller@ViewPage_User_Bill']);
Route::get('ViewPage_User_Bill_Detail/{id}&dis={percent_discount}',
	['as'=>'ViewPage_User_Bill_Detail',
	'uses'=>'LoginRegister_Controller@ViewPage_User_Bill_Detail']);
Route::post('User_Edit',
	['as'=>'User_Edit',
	'uses'=>'LoginRegister_Controller@User_Edit']);
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

Route::get('rise-to-qty/{id}',
	['as'=>'rise-to-qty',
	 'uses'=>'Home_Controller@riseByOne']); 
Route::get('reduce-to-qty/{id}',
	['as'=>'reduce-to-qty',
	 'uses'=>'Home_Controller@reduceByOne']);
Route::get('Update_Cart',[
	'as'=>'Update_Cart',
	'uses'=>'Home_Controller@Update_Cart']);

Route::get('Payment',[
	'as'=>'Payment',
	'uses'=>'Home_Controller@Payment']);

Route::post('Customer_Edit',[
	'as'=>'Customer_Edit',
	'uses'=>'Home_Controller@Customer_Edit']);
//------------------------------Giỏ Hàng------------------------------------

//------------------------------Trang Giao Diện------------------------------------

