@extends("Master.master")
@section('body')
	<!--start-breadcrumbs-->
	<a href="#" class="close"><img src="images/close.png" class="btn_close" title="Close Window" alt="Close" /></a>
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Đăng Ký	</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--register-starts-->

	<div class="register" style="max-height: 550px;">
		<div class="container">
			<div class="register-top heading"  >
				<h2>TÀI KHOẢN</h2>
			</div>
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
			@if(Session::has('thatbai'))
				<div class="alert alert-danger" id="alert">{{Session::get('thatbai')}}</div>
			@endif
			@if(!isset($laylaimatkhau))
			<form accept-charset="UTF-8" action="{{route('register')}}" method="post">
				<div class="register-main">
					<div class="col-md-6 account-left">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						HỌ TÊN:
						<input placeholder="Full name" type="text" name="full_name" id="full_name" tabindex="1" required>
						<BR>
						EMAIL:
						<BR>
						<input placeholder="Email" type="text"  name="email" id="email" tabindex="3" required  pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email">
						<div  class=" thongbao" style="display: none;"></div>
						<BR>
						SỐ ĐIỆN THOẠI
						<BR>
						<input placeholder="số điện thoại" type="text"  name="phone" id="phone" pattern="[0-9]*" minlength="10" maxlength="11" tabindex="3" required required title=" nhâp số điện thoại 10 hoặc 11 chữ số">
						<br>
						ĐỊA CHỈ
						<br>
						<input placeholder="Địa chỉ" type="text" name="address" id="address" tabindex="2" required>
					</div>
					<div class="col-md-6 account-right account-left">
						MẬT KHẨU:
						<input placeholder="mât khẩu" type="password" minlength="6" maxlength="10" name="password" id="password" tabindex="4" required>
						<br>
						NHẬP LẠI MẬT KHẨU:
						<br>
						<input placeholder="Nhập lại mật khẩu " type="password" name="re_password" id="re_password" tabindex="4" minlength="6" maxlength="10" required>
					</div>
					<div class="col-md-6 account-right account-left">
						Captcha:
						<br>
						<input  style="width:50%" placeholder="Captcha" type="text" minlength="6" maxlength="6" name="captcha" id="captcha" tabindex="2" required> 
						<span style="width: 25%;font-size: 25px; background-color: red; text-align: center">{{$randomString}}</span>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class=" address submit">
					<input type="submit" value="Đăng Ký">
				</div>
			</form>
			@else
				<form accept-charset="UTF-8" action="{{route('PostForgetPassword')}}" method="post">
					<div class="register-main">
						<div class="col-md-12 account-left">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							EMAIL:	
							<input placeholder="Email" type="text"  name="get_mail" id="email" tabindex="3" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email">
						<div class="clearfix"></div>
					</div>
					<div class="address submit" >
						<input type="submit" value="Lấy lại mật khẩu">
					</div>
				</form>
			@endif
		</div>
	</div>
	<script type="text/javascript">
		$('#email').blur(function(){
			var email=$(this).val();
			var route="{{route('checkEmail','email')}}";
			var route=route.replace('email',email);
			$.ajax ({
							url: route,
							type:'get',
							data: null,
							success:function(data)
							{
								$('.thongbao').show();
								$('.thongbao').html(data);
							}

			});
		});
	</script>
@endsection