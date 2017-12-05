
<!--dropdown-->
	<div id="cart-box" class="login-popup">
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=2033544113598636";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

					<div class="in-check" >
					<ul class="unit" style="border:solid 1px black;">
						<li><span>Hình Ảnh</span></li>
						<li><span>Tên Sản Phẩm</span></li>
						<li><span>Số Lượng/Kích thước</span></li>
						<li><span>Giá/Đơn Giá</span></li>
						<div class="clearfix"> </div>
					</ul>
					@if(Cookie::has('cart'))
						@foreach($product_cart as $product)
							<ul class="cart-header product{{$product['item']->idsize}}">
								<div class="close1 {{$product['item']->idsize}}" value="{{$product['item']->idsize}}"> </div>
									<li class="ring-in">
										<a href="{{route('Detail',$product['item']->id)}}">
											<img src="images/{{$product['item']->image}} " class="img-responsive" alt="" style="width: 100px; height: 100px;">
										</a>
									</li>
									<li>
										<span class="name">{{$product['item']->name}}</span>
									</li>
									<li>
										
										<span class="quantity soluong{{$product['item']->idsize}}" value="{{$product['qty']}}" >
											Số Lượng:{{$product['qty']}}
										</span>
										    
										{{$product['item']->size}}
									</li>
									<li>
										<span class="cost price gia{{$product['item']->idsize}}" value="{{$product['price']}}">{{number_format($product['price'])}}</span>
										{{number_format($product['item']->export_price)}}
									</li>
								<div class="clearfix"> </div>
							</ul>
						@endforeach
						<ul class="cart-header">
									<li style="float: right;">
										<span>Tổng Tiền:</span>
										<span class="cost totalPrice" value="{{$totalPrice}}">{{number_format($totalPrice)}} Đồng</span>
									</li>
									<li style="float: right;">
										<span>Tổng Số Lượng:</span>
										<span class="cost totalQty" value="{{$totalQty}}">{{number_format($totalQty)}} Sản Phẩm</span>
									</li>
								<div class="clearfix"> </div>
							</ul>
						<ul>
									<li style="float: right"><a href="javavoid:(0)"  id="isMyCart" class="add-cart btn btn-success">TÔi dang mua hàng</a></li>
									<li  style="float:left;"><a href="javavoid:(0)" id="notMyCart" class=" add-cart btn btn-warning">Giỏ Hàng Không phải của tôi</a></li>
									<div class="clearfix"> </div>
						</ul>
					@endif				
		</div>
		<script type="text/javascript">
			$('#notMyCart').click(function() {
				$('#mask , .login-popup').fadeOut(300 , function() 
				  	{
				    	$('#mask').remove();  
					}); 
						var route="{{route('delete-cart')}}";
						$.ajax ({
							url: route,
							type:'get',
							data: null,
							success:function(data){
								window.location.replace("{{route('checkcart')}}");
							}
						});
						return false;
					});	  
			$(document).on('click','#isMyCart','#mask', function(){
					$('#mask , .login-popup').fadeOut(300 , function() 
				  	{
				    	$('#mask').remove();  
					}); 
					window.location.replace("{{route('checkcart')}}");
					return false;
			})
		</script>
	</div>