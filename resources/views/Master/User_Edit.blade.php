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
				<h2>User</h2>
			</div>
				<div class="contact-text">
					<div class="col-md-3 contact-left">
						<div class="address">
							<h5>Address</h5>
							<p style="color: black;">Hùng Minh, 
								<span>22 Lê Trung Nghĩa</span>
								<span>Tel:1115550001</span>
								<span>Fax:190-4509-494</span>
								<span>Email:<a href="mailto:example@email.com">manhhoangminh611@gmail.com</a></span>
							</p>
						</div>
					</div>
					<div class="col-md-9 contact-right">
						<form method="post" action="{{route('User_Edit')}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<span>Name:<a id='name' href="javascript:void(0)">Edit</a></span>
							<span id="name_edit"><input type="text" placeholder="Name" value="{{Auth::User()->full_name}}" disabled="" style="width: 100%; margin-left: 0px;"></span>
							<span>Phone:<a id='phone' href="javascript:void(0)">Edit</a></span>
							<span id="phone_edit">
								<input type="text" placeholder="Phone" value="{{Auth::User()->phone}}" disabled="" style="width: 100%;margin-left: 0px;">
							</span>
							<span>Email:</span>
							<input type="text" placeholder="Email" value="{{Auth::User()->email}}" disabled="" style="width: 100%;margin-left: 0px;">
							<span>Password:<a id='password' href="javascript:void(0)">Edit</a></span>
							<span id="password_edit">
								<input type="password"  value="{{Auth::User()->password}}" disabled="" style="width: 100%;margin-left: 0px;">
							</span>
								<div class="submit-btn">
									<input type="submit" style="float:right;" value="SUBMIT">
								</div>

						</form>
					</div>	
					<div class="clearfix"></div>
				</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#name').click(function(){
			$('#name_edit').html('<input type="text" name="name" placeholder="Name"  required value="" style="width: 100%; margin-left: 0px;">');
		})
		$('#phone').click(function(){
			$('#phone_edit').html('<input type="text" name="phone" pattern="[0-9]{10,11}" placeholder="Phone" value="" style="width: 100%;margin-left: 0px;" required title=" nhâp số điện thoại 10 hoặc 11 chữ số">');
		})
		$('#password').click(function(){
			$('#password_edit').html('<input type="password" name="password" minlength="6" maxlength="20" placeholder="password" value="" style="width: 100%;margin-left: 0px;">');
		})
	</script>
@endsection