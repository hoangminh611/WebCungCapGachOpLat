@extends("Master.master")
@section('body')
	<!--start-breadcrumbs-->
	<a href="#" class="close"><img src="images/close.png" class="btn_close" title="Close Window" alt="Close" /></a>
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Register</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--register-starts-->

	<div class="register" style="max-height: 550px;">
		<div class="container">
			<div class="register-top heading"  >
				<h2>REGISTER</h2>
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
			<form accept-charset="UTF-8" action="{{route('register')}}" method="post">
				<div class="register-main">
					<div class="col-md-6 account-left">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input placeholder="Full name" type="text" name="full_name" id="full_name" tabindex="1" required>
						<input placeholder="Email address" type="text"  name="email" id="email" tabindex="3" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email">
						<input placeholder="Mobile" type="text"  name="phone" id="phone" pattern="[0-9]{10,11}"  tabindex="3" required required title=" nhâp số điện thoại 10 hoặc 11 chữ số">
						<input placeholder="Address" type="text" name="address" id="address" tabindex="2" required>
					</div>
					<div class="col-md-6 account-right account-left">
						<input placeholder="Password" type="password"  name="password" id="password" tabindex="4" required>
						<input placeholder="Retype password " type="password" name="re_password" id="re_password" tabindex="4" required>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="address submit">
					<input type="submit" value="Submit">
				</div>
			</form>
		</div>
	</div>
@endsection