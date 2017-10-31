<!DOCTYPE html>
<html>
<head>
<title>Gạch Ốp Lát Cao Cấp</title>
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
					<li><a href="{{route('index')}}">Trang chủ</a></li>
					<li class="active"><a href="{{route('ViewPage_User_Bill')}}">Hóa Đơn</a></li>
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
			<div class="ckeckout-top">
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
				
			<div class="in-check" >
				<ul class="unit" style="border:solid 1px black;">
					<li><span>Xem chi tiết</span></li>
					<li><span>Số hóa đơn đã mua</span></li>
					<li><span>Tình trạng</span></li>
					<li><span>Hình Thức Thanh Toán</span></li>
					<div class="clearfix"> </div>
				</ul>
				@if($bills!=null)
				<?php $i=1?>
					@foreach($bills as $bill)
						<ul  class="cart-header product">
								<li class="ring-in">
									<span><a href="{{route('ViewPage_User_Bill_Detail',[$bill[0]->id,$bill[0]->percent_discount])}}">Xem chi tiết</a></span>
								</li>
								<li>
									<span class="id">{{$i++}}</span>
								</li>
								<li>
									<span>{{$bill[0]->method}}</span>
								</li>
								<li>
									@if($bill[0]->pay_online === 1)
										<span>Đã Thanh Toán Online</span>
									@elseif($bill[0]->pay_online === 0)
										<span>Nhận Hàng Rồi Thanh Toán</span>
									@endif
								</li>
							<div class="clearfix"> </div>
						</ul>
					@endforeach
				@endif
		 </div>
		</div>
	</div>
</div>
	<!--end-ckeckout-->
@include('Master.Footer')
</body>
</html>
