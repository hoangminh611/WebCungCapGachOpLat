@extends('Master.master')
@section('body')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
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
							<span>22 Lê Trung Nghĩa</span>
							<span>Tel:1115550001</span>
							<span>Fax:190-4509-494</span>
							Email: <a href="mailto:example@email.com">contact@example.com</a></p>
						</p>
					</div>
				</div>
					<div class="col-md-9 contact-right">
						<form>
							<input type="text" placeholder="Name">
							<input type="text" placeholder="Phone">
							<input type="text"  placeholder="Email">
							<textarea placeholder="Message" required=""></textarea>
							<div class="submit-btn">
								<input type="submit" value="SUBMIT">
							</div>
						</form>
					</div>	
					<div class="clearfix"></div>
				</div>
		</div>
	</div>
	<!--contact-end-->
@endsection