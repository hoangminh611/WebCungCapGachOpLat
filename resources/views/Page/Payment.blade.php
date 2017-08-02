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
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">User</li>
				</ol>
			</div>
		</div>
	</div>
	<div class="contact">
		<div class="container">
			<div class="contact-top heading">
				<h2>Khách Hàng</h2>
			</div>
				<div class="contact-text">
					<form method="post" action="{{route('Customer_Edit')}}">
					@if(Auth::check())
						<div class="col-md-8 contact-right">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<span>Name:</span>
								<span id="name_edit"><input type="text" name="name" placeholder="Name" value="{{Auth::User()->full_name}}" style="width: 100%; margin-left: 0px;" required></span>
								<span>Phone:</span>
								<span>
									<input type="text" placeholder="Phone"  name="phone" value="{{Auth::User()->phone}}"  style="width: 100%;margin-left: 0px;" pattern="[0-9]{10,11}"  tabindex="3" required title=" nhâp số điện thoại 10 hoặc 11 chữ số">
								</span>
								<span>Email:</span>
								<input type="text" placeholder="Email" name="email" value="{{Auth::User()->email}}" style="width: 100%;margin-left: 0px;" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email">
								<span>Địa Chỉ:</span>
								<span>
									<input type="text"  value="{{Auth::User()->address}}" name="address" style="width: 100%;margin-left: 0px;" required="" >
								</span>
								<span>Ghi Chú:</span>
								<span>
									<input type="text"  value="" name="note" style="width: 100%;margin-left: 0px;">
								</span>
									<div class="submit-btn">
										<input type="submit" style="float:right;" value="Thanh Toán">
									</div>
						</div>	
					@else
						<div class="col-md-8 contact-right">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<span>Name:</span>
								<span id="name_edit"><input type="text" name="name" placeholder="Name" value="" style="width: 100%; margin-left: 0px;" required></span>
								<span>Phone:</span>
								<span>
									<input type="text" placeholder="Phone"  name="phone" value=""  style="width: 100%;margin-left: 0px;" pattern="[0-9]{10,11}"  tabindex="3" required title=" nhâp số điện thoại 10 hoặc 11 chữ số">
								</span>
								<span>Email:</span>
								<input type="text" placeholder="Email" name="email" value="" style="width: 100%;margin-left: 0px;" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email">
								<span>Địa Chỉ:</span>
								<span>
									<input type="text"  value="" name="address" style="width: 100%;margin-left: 0px;" required="" >
								</span>
								<span>Ghi Chú:</span>
								<span>
									<input type="text"  value="" name="note" style="width: 100%;margin-left: 0px;">
								</span>
									<div class="submit-btn">
										<input type="submit" style="float:right;" value="Thanh Toán">
									</div>
						</div>	
					@endif
					<div class="col-md-4 contact-left">
						<div>
						@if(Session::has('cart'))
							@foreach($product_cart as $product)
								<img src="images/{{$product['item'][0]->image}} " class="img-responsive" alt="" style="width: 50px; height: 50px;">
								Số Lượng:{{$product['qty']}} Giá: {{number_format($product['price'])}}
							@endforeach
							<br>
							Tổng sản phẩm:{{$totalQty}}
							Tổng Tiền:{{$totalPrice}}
						@endif
						</div>
					</div>
					</form>
					<div class="clearfix"></div>
				</div>
		</div>
	</div>
@include('Master.Footer')
</body>
</html>