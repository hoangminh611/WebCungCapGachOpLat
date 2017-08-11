@extends('Master.master')
@section('body')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Contact</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--contact-start-->
	<div class="contact">
		<div class="container">
			<div class="contact-top heading">
				<h2>CONTACT</h2>
			</div>
				<div class="contact-text">
				<div class="col-md-3 contact-left">
					<div class="address">
						<h5>Address</h5>
						<p style="color: black;">Hùng Minh, 
							<span>22 Lê Trung Nghĩa Phường 12 Quận Tân Bình</span>
							{{-- <span>Tel:1115550001</span>
							<span>Fax:190-4509-494</span> --}}
							<span>Email:<a href="mailto:example@email.com">manhhoangminh611@gmail.com</a></span>
						</p>
					</div>
				</div>
					<div class="col-md-9 contact-right">
						{{-- <form>
							<input type="text" placeholder="Name">
							<input type="text" placeholder="Phone" style="margin-left: 5px;">
							<input type="text" placeholder="Email">
							<textarea placeholder="Message" required=""></textarea>
							<div class="submit-btn">
								<input type="submit" value="SUBMIT">
							</div>
						</form> --}}
					<iframe
					  width="100%"
					  height="450"
					  frameborder="1" style="border:0"
					  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyApiFmiXRLtPQSZWp1G9A41mOfbunjNToM
					    &q=22+Lê+Trung+Nghĩa,+Phường+12,+Tân+Bình,+Hồ+Chí+Minh,+Việt+Nam" allowfullscreen>
					</iframe>
					
					</div>	
					<div class="clearfix"></div>
				</div>
		</div>
	</div>
	<!--contact-end-->
@endsection