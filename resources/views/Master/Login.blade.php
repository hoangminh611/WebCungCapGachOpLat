
	<!--start-breadcrumbs-->
<div id="login-box" class="login-popup">
	<a href="#" class="close"><img src="../images/close.png" class="btn_close" title="Close Window" alt="Close" /></a>
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Account</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--account-starts-->
	<div class="account">
		<div class="container">
		<div class="account-top heading">
				<h2>ACCOUNT</h2>
			</div>
			<div class="account-main">
				<div class="col-md-6 account-left">
					<h3>Existing User</h3>
					<div class="account-bottom">
						<input placeholder="Email" type="text" tabindex="3" required>
						<input placeholder="Password" type="password" tabindex="4" required>
						<div class="address">
							<a class="forgot" href="#">Forgot Your Password?</a>
							<input type="submit" value="Login">
						</div>
					</div>
				</div>
				<div class="col-md-6 account-right account-left">
					<h3>New User? Create an Account</h3>
					<p>Có tài khoản sẽ có thể cho bạn hưởng thêm nhiều ưu đãi từ dịch vụ của chúng tôi</p>
					<a  href="#register-box" class="register-window">Create an Account</a>
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