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
		@include('Master.Login')
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
				<br>
				<span>Tỷ giá VNĐ và USD theo ngân Hàng Vietcombank</span>
				<br>
				<span><b>{{$VNĐtoUSD['USD']['id']}} : {{$VNĐtoUSD['USD']['buy']}} VNĐ</b></span>
			</div>
				<div class="contact-text">
					<form method="post" action="{{route('Customer_Edit')}}" id="information">
						@if(Auth::check())
							<div class="col-md-8 contact-right">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<span>Họ Tên:</span>
									<span id="name_edit"><input type="text" id="name" name="name" placeholder="Name" value="{{Auth::User()->full_name}}" style="width: 100%; margin-left: 0px;" required title="Nhập Họ Tên"></span>
									<span>Số Điện Thoại:</span>
									<span>
										<input type="text" id="phone" placeholder="Phone"  name="phone" value="{{Auth::User()->phone}}"  style="width: 100%;margin-left: 0px;" pattern="[0-9]{10,11}" minlength="10" maxlength="11" tabindex="3" required title=" nhâp số điện thoại 10 hoặc 11 chữ số">
									</span>
									<br>
									<span>Email:</span>
									<input type="text" placeholder="Email" id="email" name="email" value="{{Auth::User()->email}}" style="width: 100%;margin-left: 0px;" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email" title="Nhập Email">
									<br>
									<span>Địa Chỉ:</span>
									<span>
										<input type="text" id="address"  value="{{Auth::User()->address}}" name="address" style="width: 100%;margin-left: 0px;" required="" title="Nhập Địa Chỉ Cả tên Thành Phố">
									</span>
									<span class="help-block">Nhập cả tên thành phố </span>
									<span>Ghi Chú:</span>
									<span>
										<input type="text" id="note" value="" name="note" style="width: 100%;margin-left: 0px;">
									</span>
										<div class="submit-btn">
											<input type="submit" value="Thanh Toán">
											<input type="button"  class="btn btn-1 btnPayPal" name="paypal" value="Thanh Toan truc tuyen">
										</div>
							</div>	
						@else
							<div class="col-md-8 contact-right">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<span>Họ Tên:</span>
									<span id="name_edit"><input type="text" id="name" name="name" placeholder="Họ Tên" value="" style="width: 100%; margin-left: 0px;" required  title="Nhập Họ Tên"></span>
									<br>
									<span>Số Điện Thoại:</span>
									<span>
										<input type="text" placeholder="Số điện thoại" id="phone" name="phone" value=""  style="width: 100%;margin-left: 0px;" pattern="[0-9]{10,11}" minlength="10" maxlength="11" tabindex="3" required title=" nhâp số điện thoại 10 hoặc 11 chữ số">
									</span>
									<br>
									<span>Email:</span>
									<input type="text" placeholder="Email" id="email" name="email" value="" style="width: 100%;margin-left: 0px;" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email" title="Nhập Email">
									<br>
									<span>Địa Chỉ:</span>
									<span>
										<input type="text" placeholder="Địa Chỉ" id="address" value="" name="address" style="width: 100%;margin-left: 0px;" required="" title="Nhập Địa Chỉ Cả tên Thành Phố">
									</span>
									 <span class="help-block">Nhập cả tên thành phố </span>
									<span>Ghi Chú:</span>
									<span>
										<input type="text" placeholder="Ghi Chú" id="note" value="" name="note" style="width: 100%;margin-left: 0px;">
									</span>
										<div class="submit-btn">
											<input type="submit" value="Thanh Toán">
											<input type="button"  class="btn btn-1 btnPayPal" name="paypal" value="Thanh Toan truc tuyen">
										</div>
									
							</div>	
						@endif

					</form>
					<div class="col-md-4 contact-left">
						<div>
						@if(Cookie::has('cart'))
							<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_self" id="paypal">
						    	<!-- Nhập địa chỉ email người nhận tiền (người bán) -->
								<input type="hidden" name="business" value="hoangminh@gmail.com">

								<!-- tham số cmd có giá trị _xclick chỉ rõ cho paypal biết là người dùng nhất nút thanh toán -->
								 <!--      <input type="hidden" name="cmd" value="_xclick"> -->
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="upload" value="1">
								<input type="hidden" name="address_override" value="1">
								<input type="hidden" name="return" value="{{route('Customer_Edit')}}">
						        <input type="hidden" name="cancel_return" value="{{route('index')}}">
								<input type="hidden"  id="first_name" name="first_name" value="">
								  <input type="hidden" id="address1" name="address1" value="">
								 {{-- <input type="hidden" name="city" value="Ho Chi Minh">
								  <input type="hidden" name="state" value="VN">
								  <input type="hidden" name="zip" value="70800">
								<input type="hidden" name="country" value="VN"> --}}
								  <input type="hidden" name="city" value="San Jose">
								  <input type="hidden" name="state" value="CA">
								  <input type="hidden" name="zip" value="95121">
								  <input type="hidden" name="country" value="US">
								<?php $i=1;?>	
								@foreach($product_cart as $product)
									<img src="images/{{$product['item']->image}} " class="img-responsive" alt="" style="width: 50px; height: 50px;">
									Số Lượng:{{$product['qty']}}   Giá: {{number_format($product['price'])}}
									     <!-- Thông tin mua hàng. -->
						            <input type="hidden" name="item_name_{{$i}}" value="{{$product['item']->name}}">
						            <input type="hidden" name="amount_{{$i}}" value="{{$product['item']->export_price/22810}}">
						            <input type="hidden" name="quantity_{{$i}}" value="{{$product['qty']}}">
						            <input type="hidden" name="currency_code" value="USD">
						            <?php $i++ ?>

								@endforeach
								<br>

								@if(!Auth::check())
									@if($totalPrice<5000000)
										<input type="hidden" name="shipping_1" value="{{$discount[0]->ship_price/$VNĐtoUSD['USD']['buy']}}">
										<b>Phí vận Chuyển:{{number_format($discount[0]->ship_price)}}VNĐ</b>
										<br>
										<b>Tổng sản phẩm:</b>{{number_format($totalQty)}} Sản Phẩm</b>
										<br>
										<b>Tổng Tiền:</b>{{number_format($totalPrice+$discount[0]->ship_price)}} VNĐ</b>
									@endif
								@elseif(Auth::check())
									      @for($i=0;$i<=count($discount);$i++)
									            @if(!isset($discount[$i]->price_discount))
									                <?php
									                	$percent_discount=$discount[$i-1]->percent_discount;
									                	$ship_price=$discount[$i-1]->ship_price;
									                	$name_gift=$discount[$i-1]->name_gift;
									               		break; 
									               	?>
									            @endif
									            @if($totalPrice < $discount[$i]->price_discount)
									              <?php 
									              		$percent_discount=$discount[$i-1]->percent_discount;
									                	$ship_price=$discount[$i-1]->ship_price;
									                	$name_gift=$discount[$i-1]->name_gift;
									               		break; 
									               ?>
									            @endif
									      @endfor
									<input type="hidden" name="discount_rate_cart" value="{{$percent_discount}}">
									<input type="hidden" name="shipping_1" value="{{$ship_price/$VNĐtoUSD['USD']['buy']}}">
									<b>Phí vận Chuyển:{{number_format($ship_price)}}VNĐ</b>
									<br>
									<b>Tổng sản phẩm:</b>{{number_format($totalQty)}} Sản Phẩm</b>
									<br>
									<b>Tổng Tiền:</b>{{number_format($totalPrice*(100-$percent_discount)/100)}} VNĐ (Giảm {{$percent_discount}}%)</b>
									<br>
									<b>@if($name_gift!=null)
										Tặng {{$name_gift}} (Free)
										@endif
									</b>
								@endif
								<div class="submit-btn">

								</div>
							</form>
						</fieldset>
						@endif
						</div>
					</div>

					<div class="clearfix"></div>
				</div>
		</div>
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script type="text/javascript">
	jQuery.validator.setDefaults({
	  debug: true,
	  success: "valid"
	});
	var address = $('#address').val();
	$('.btnPayPal').click(function(e){
		var form=$('#information').validate({
			rules:{
				email:{
					required:true,
					email:true,
				},
				phone:{
					required:true,
					number:true,
					minlength: 10,
					maxlength:11,
				}
			}
		});
		if(form.form()) {
			var name =$('#name').val();
			var phone = $('#phone').val();
			var address = $('#address').val();
			var email = $('#email').val();
			var note = $('#note').val();
			$('#first_name').val(name);
			$('#address1').val(address);
			var route = "{{route('getCookie')}}";
			$.ajax ({
				url: route,
				type:'get',
				data: {"name":name,'phone':phone,'address':address, 'email':email,'note':note},
				success:function(data){
					$('#paypal').submit();
				}
			})
		}
	});
	
</script>
@include('Master.Footer')
</body>
</html>