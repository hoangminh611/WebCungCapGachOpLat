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
Route::get('Content_Admin',[
	'as'=>'Content_Admin',
	'uses'=>'Admin_Controller@Content_Admin']);
Route::get('Login',[
	'as'=>'Login',
	'uses'=>'LoginRegister_Controller@Login']);
Route::get('Register',[
	'as'=>'Register',
	'uses'=>'LoginRegister_Controller@Register']);

