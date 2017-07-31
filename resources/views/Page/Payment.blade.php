@extends('Master.master')
@section('body')
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
	<script type="text/javascript">
	</script>
@endsection