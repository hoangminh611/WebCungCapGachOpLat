<!DOCTYPE html>
<html>
<head>
<title>Luxury Watches A Ecommerce Category Flat Bootstrap Resposive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="{{asset('')}}">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
<script src="js/jquery-1.11.0.min.js"></script>
<!--Custom-Theme-files-->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<!--//theme-style-->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />	
<meta name="keywords" content="Luxury Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--start-menu-->
<script src="js/simpleCart.min.js"> </script>
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/memenu.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>$(document).ready(function(){$(".memenu").memenu();});</script>	
<!--dropdown-->
<script src="js/jquery.easydropdown.js"></script>	
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu_drop > li > ul'),
	           menu_a  = $('.menu_drop > li > a');
	    
	    menu_ul.hide();
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>				
</head>
<body> 
	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=2033544113598636";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		@include('Master.Top_header')
		@include('Master.Menu')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">

				<ol class="breadcrumb">
					<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Trang chủ</a></li>
					<li class="active"><a href="{{route('ViewPage_User_Bill')}}">Hóa Đơn</a></li>
					<li class="active">Chi Tiết Hóa Đơn</li>
				</ol>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--start-ckeckout-->
<div id="update">
	<div class="ckeckout">
		<div class="container">
			<div class="ckeck-top heading">
			</div>
			<div class="ckeckout-top" id="printbill">
			{{-- <script>$(document).ready(function(c) {
					$('.close2').on('click', function(c){
						$('.cart-header1').fadeOut('slow', function(c){
							$('.cart-header1').remove();
						});
						});	  
					});
			   </script>
			   <script>$(document).ready(function(c) {
					$('.close3').on('click', function(c){
						$('.cart-header2').fadeOut('slow', function(c){
							$('.cart-header2').remove();
						});
						});	  
					});
			   </script> --}}
				  <table border="1">
            <thead>
              <tr>
                <th >ID_hóa đơn</th>
                <th>ID_chi tiết hóa đơn</th>
                <th>Tên Sản Phẩm</th>
                <th>Kích thước</th>
                <th>Số Lượng</th>
                <th>Giá Bán</th>
                <th>Giá Tổng</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
              </tr>
            </thead>
            <tbody>
            <?php $tong=0;
            		$tongsanpham=0;
            ?>
              @foreach($bill_details as $bill_detail)
                <tr>
                	<td>{{$bill_detail->id_bill}}</td>
					<td>{{$bill_detail->id}}</td>
                  <td>{{$bill_detail->name}}</td>
                  <td>{{$bill_detail->size}}</td>
                  <td>{{number_format($bill_detail->quantity)}}</td>
                  <td>{{number_format($bill_detail->sales_price)}}</td>
                  <td>{{number_format($bill_detail->quantity*$bill_detail->sales_price)}}</td>
                  <td>{{$bill_detail->created_at}}</td>
                  <td>{{$bill_detail->updated_at}}</td>
                  <?php $tong += ($bill_detail->quantity*$bill_detail->sales_price) ;
                  		$tongsanpham += ($bill_detail->quantity);
                  ?>
                </tr> 
              @endforeach
            </tbody>
          </table>
          <br>
          	<h4><b>Tổng Sản Phẩm: {{number_format($tongsanpham)}}</b> Sản Phẩm</h4>
          	<h4><b>Tổng Tiền: {{number_format($tong*(100-$percent_discount)/100)}}</b>(Giảm {{$percent_discount}}%)</h4>
			{{-- <div class="in-check" >
				<ul class="unit" style="border:solid 1px black;">
					<li><span>ID</span></li>
					<li><span>Product</span></li>
					<li><span>Size</span></li>
					<li><span>Quantity</span></li>
					<li><span>Giá Bán</span></li>
					<li><span>Giá Tổng</span></li>
					<li><span>Ngày tạo</span></li>
					<li><span>Ngày update</span></li>
					<div class="clearfix"> </div>
				</ul>
					   @foreach($bill_details as $bill_detail)
                	<ul  class="cart-header product">
		                	<li><span>{{$bill_detail->id_bill}}</span></li>
		                  <li><span>{{$bill_detail->id}}</span></li>
		                  <li><span>{{$bill_detail->name}}</span></li>
		                  <li><span>{{$bill_detail->size}}</span></li>                  
		                  <li><span>{{number_format($bill_detail->quantity)}}</span></li>
		                  <li><span>{{number_format($bill_detail->sales_price)}}</span></li>
		                  <li><span>{{number_format($bill_detail->quantity*$bill_detail->sales_price)}}</span></li>
		                  <li><span>{{$bill_detail->created_at}}</span></li>
		                  <li><span>{{$bill_detail->updated_at}}</span></li>
							<div class="clearfix"> </div>
						</ul>
					@endforeach
		 </div> --}}

		</div>
				 <button id="btn" style="">Print PDF</button>
	</div>
	
</div>
<script src="js/printThis.js"></script>
<script type="text/javascript">
	$('#btn').click(function(){
		$('#printbill').printThis();
	});
</script>
	<!--end-ckeckout-->
@include('Master.Footer')
</body>
</html>
