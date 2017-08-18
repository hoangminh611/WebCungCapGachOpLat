
	<!--start-breadcrumbs-->
<div id="login-box" class="login-popup">
	<a href="#" class="close"><img src="images/close.png" class="btn_close" title="Close Window" alt="Close" /></a>
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Trang chủ</a></li>
					<li class="active">Tài Khoản</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--account-starts-->
	<div class="account">
		<div class="container">
		<div class="account-top heading">
				<h2>ĐĂNG NHẬP TÀI KHOẢN</h2>
			</div>
			<div class="account-main">
				<div class="col-md-6 account-left">
					<h3>Đã có tài khoản </h3>
					<div class="account-bottom">
					<form  accept-charset="UTF-8" action="{{route('login')}}"  method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input placeholder="Email" type="text" tabindex="3" title="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-validation="email" required="" value="" name="email">
						<input placeholder="Password" type="password" name="password" tabindex="4" required>
						<div class="address">
							<a class="forgot" href="{{route('Forget_Password')}}">Quên mật khẩu?</a>
							<input type="submit" value="Đăng Nhập">
						</div>
					</form>
					</div>
					<button type="button">
							<a href="{{route('provider_login','facebook')}}">
								<i class="fa fa-facebook-square" aria-hidden="true" style="font-size: 20px;">
								Đăng Nhập Facebook
								</i>
								
							</a>
					</button>
					<button type="button">
							<a href="{{route('provider_login','google')}}">
								<i class="fa fa-google-plus" aria-hidden="true" style="font-size: 20px;">
								Đăng nhập Google
								</i>
								
							</a>
					</button>
				</div>
				<div class="col-md-6 account-right account-left">
					<h3>Chưa có tài khoản? Hãy tao mới</h3>
					<p>Có tài khoản sẽ có thể cho bạn hưởng thêm nhiều ưu đãi từ dịch vụ của chúng tôi</p>
					<a href="{{route('getregister')}}" class="register-window">Tạo tài khoản</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--account-end-->
</div>
	<script type="text/javascript">
		$(document).ready(function() 
		{
				$('a.register-window').click(function() 
				{
				    
				            //Getting the variable's value from a link 
				    var registerBox = $(this).attr('href');

				    //Fade in the Popup
				    $(registerBox).fadeIn(300);
				    // Add the mask to body
				    $('body').append('<div id="mask"></div>');
				    $('#mask').fadeIn(300);
				    $('.login-popup').fadeOut(300);
				    return false;
				});

				// When clicking on the button close or the mask layer the popup closed
				$(document).on('click','a.close, #mask', function() 
				{ 
				  	$('#mask , .register-popup').fadeOut(300 , function() 
				  	{
				    	$('#mask').remove();  
					}); 
					return false;
				});
		});
	</script>