@extends('Master.master')
@section('body')
	<!--start-breadcrumbs-->
@if(Auth::check())
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
				<h2>User</h2>
			</div>
				<div class="contact-text">
					<div class="col-md-3 contact-left">
						<div >
							<button class="btn btn-success" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); width: 100%; height:150px; "  onclick="VIewPageEditUser()">Sửa thông tin User</button>
							<button class="btn btn-info" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); width: 100%;height:150px;" onclick="ViewPageBill()">Hiện h
							óa đơn đã mua</button>
						</div>
					</div>
					<div class="col-md-9 contact-right">
								@if(count($errors)>0)
									<div class="alert alert-danger">
										<ul>
											@foreach($errors->all() as $error)
											<li>{{$error}}</li>
											@endforeach
										</ul>
									</div>
								@endif
								@if(Session::has('thanhcong'))
									<div class="alert alert-success" id="alert">{{Session::get('thanhcong')}}</div>
								@endif
						<form method="post" action="{{route('User_Edit')}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<span>Họ Tên:<a id='name' href="javascript:void(0)">Sửa</a></span>
							<span id="name_edit"><input type="text" placeholder="Họ Tên" value="{{Auth::User()->full_name}}" disabled="" style="width: 100%; margin-left: 0px;"></span>
							<span>Số Điện Thoại:<a id='phone' href="javascript:void(0)">Sửa</a></span>
							<span id="phone_edit">
								<input type="text" placeholder="Số điện thoại" value="{{Auth::User()->phone}}" disabled="" style="width: 100%;margin-left: 0px;">
							</span>
							<span>Email:</span>
							<input type="text" placeholder="Email" value="{{Auth::User()->email}}" disabled="" style="width: 100%;margin-left: 0px;">
							<span>Địa Chỉ:<a id='address' href="javascript:void(0)">Sửa</a></span>
							<span id="address_edit">
								<input type="text" placeholder="Địa Chỉ" value="{{Auth::User()->address}}" disabled="" style="width: 100%;margin-left: 0px;">
							</span>
							<span>Mật Khẩu:<a id='password' href="javascript:void(0)">Sửa</a></span>
							<span id="password_edit">
								<input type="password"  value="{{Auth::User()->password}}" disabled="" style="width: 100%;margin-left: 0px;">
							</span>
								<div class="submit-btn">
									<input type="submit" style="float:right;" value="Lưu">
								</div>

						</form>
					</div>	
					<div class="clearfix"></div>
				</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#name').click(function(){
			$('#name_edit').html('<input type="text" name="name" placeholder="Họ Tên"  required value="" style="width: 100%; margin-left: 0px;">');
		})
		$('#address').click(function(){
			$('#address_edit').html('<input type="text" name="address" placeholder="Địa Chỉ"  required value="" style="width: 100%; margin-left: 0px;">');
		})
		$('#phone').click(function(){
			$('#phone_edit').html('<input type="text" name="phone" pattern="[0-9]{10,11}" minlength="10" maxlength="11" placeholder="Số điện thoại" value="" style="width: 100%;margin-left: 0px;" required title=" nhâp số điện thoại 10 hoặc 11 chữ số">');
		})
		$('#password').click(function(){
			$('#password_edit').html('<input type="password" name="password" minlength="6" maxlength="10" placeholder="Mật khẩu" value="" style="width: 100%;margin-left: 0px;"><br>																						<input placeholder="Nhập Lại mật khẩu " type="password" name="re_password"  minlength="6" maxlength="10" id="re_password" tabindex="4" required style="width: 100%;margin-left: 0px;">');
		})
		function VIewPageEditUser()
		{
			var route="{{route('ViewPage_User_Edit')}}";
			window.location.replace(route);
		}
		function ViewPageBill()
		{
			var route="{{route('ViewPage_User_Bill')}}";
			window.location.replace(route);
		}
	</script>
@else
	<script type="text/javascript">
		var route="{{route('index')}}"
		window.location.replace(route);
	</script>
@endif
@endsection