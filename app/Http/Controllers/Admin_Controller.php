<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductEditRequest;
use DB;
use File;
use Auth;
use Illuminate\Support\Facades\Input;
use App\TypeProduct;
use App\News;
class Admin_Controller extends Controller
{
   public function Content_Admin()
   {
   	return view('Admin.Master.Admin_Content');
   }
}
