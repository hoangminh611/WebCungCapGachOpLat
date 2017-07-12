	<!--top-header-->
	<div class="top-header" style="width: 100%;display: block;;position: fixed;top: 0;left: 0;z-index: 100000; /*Hiển thị lớp trên cùng*/">
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
					<div class="cart box_1">
						<a href="checkout.html">
							<div><a href="{{route('Login')}}">Đăng Nhập</a></div>
							 <div class="total">
								<span class="simpleCart_total"></span></div>
								<img src="../images/cart-1.png" alt="" />
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
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
								<span class="simpleCart_total"></span></div>
								<img src="images/cart-1.png" alt="" />
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
		{{-- cai nay de tao khoang trong chua header khi load trang --}}
	<!--start-logo-->
	<div class="logo">
		<a href="index.html"><h1>Gạch Ốp Lát Cao Cấp</h1></a>
	</div>
	<!--start-logo-->