	<!--top-header-->
		<link rel="stylesheet" type="text/css" href="css/PopUpLogin.css">
	<div class="top-header" style="width: 100%;display: block;;position: fixed;top: 0;left: 0;z-index: 1000; /*Hiển thị lớp trên cùng*/">
		<div class="container">
			<div class="top-header-main">
				<div class="col-md-6 top-header-left"  style="float:left">
					<div class="drop">
						<div class="box">
							<select tabindex="4" class="dropdown drop">
								<option value="" class="label">Dollar :</option>
								<option value="1">Dollar</option>
								<option value="2">Euro</option>
							</select>
						</div>
						<br>
						<div class="box1">
							<select tabindex="4" class="dropdown">
								<option value="" class="label">English :</option>
								<option value="1">English</option>
								<option value="2">French</option>
								<option value="3">German</option>
							</select>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6 top-header-left">
					<div class="cart box_1" style="text-align: center;">
							@if(Auth::check())
								<div>
									<i class="fa fa-user"></i>Chào bạn {{Auth::User()->full_name}}
									|
									<a href="{{route('logout')}}">Đăng xuất</a>
								</div>

							@else
								<div><a  href="#login-box" class="login-window">Đăng Nhập</a></div>
							@endif
						 @if(Session::has('cart'))
							<a href="{{route('cart-detail')}}">
								 <div class="total">
									<span class="cart_price">{{number_format(Session('cart')->totalPrice)}} Đồng</span>
									<img src="images/cart-1.png" alt="" />
								</div>
								<p class="cart_qty" >{{Session('cart')->totalQty}} Product</p>
							</a>
						@else
							<a href="javascript:void(0)">
							 <div class="total">
								<span>0 Đồng</span>
								<img src="images/cart-1.png" alt="" />
							</div>
							</a>
							<p><a href="javascript:void(0)" class="simpleCart_empty">Empty Cart</a></p>
						@endif
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--top-header-->
	{{-- cai nay de tao khoang trong chua header khi load trang --}}
	<div class="top-header">
		<div class="container">
			<div class="top-header-main">
				<div class="col-md-6 top-header-left">
					<div class="drop">
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-6 top-header-left">
					<div class="cart box_1">
						<a href="checkout.html">
							<div><a>Đăng Nhập</a></div>
							 <div class="total">
								<span class="simpleCart_total"></span>
								<img src="images/cart-1.png" alt="" />
								<p><a href="javascript" class="simpleCart_empty">Empty Cart</a></p>
							</div>
						</a>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
		{{-- cai nay de tao khoang trong chua header khi load trang --}}
	<!--start-logo-->
	@if(Session::has('thatbai'))
		<div class="alert alert-danger them " id="alert">{{Session::get('thatbai')}}</div>
		<script type="text/javascript">
			$('.them').hide(3000);							
		</script>
	@endif
	@if(Session::has('thanhcong'))
		<div class="alert alert-danger them " id="alert">{{Session::get('thanhcong')}}</div>
		<script type="text/javascript">
			$('.them').hide(3000);							
		</script>
	@endif
						
	<div class="logo">
		<a href="index.html"><h1>Gạch Ốp Lát Cao Cấp</h1></a>
	</div>
	<!--start-logo-->

	<script type="text/javascript">
		$(document).ready(function() 
		{
				$('a.login-window').click(function() 
				{
				    
				            //Getting the variable's value from a link 
				    var loginBox = $(this).attr('href');

				    //Fade in the Popup
				    $(loginBox).fadeIn(300);
				    // Add the mask to body
				    $('body').append('<div id="mask"></div>');
				    $('#mask').fadeIn(300);
				    
				    return false;
				});

				// When clicking on the button close or the mask layer the popup closed
				$(document).on('click','a.close, #mask', function() 
				{ 
				  	$('#mask , .login-popup').fadeOut(300 , function() 
				  	{
				    	$('#mask').remove();  
					}); 
					return false;
				});

		});
	</script>
