
<!--dropdown-->
@if(Cookie::has('cart'))
	<div id="cart-box" class="login-popup">
					<div class="in-check" >
					<table>
					<tr class="unit" style="border:1px solid black;">
						<th style=" text-align: center;border:1px solid black">Hình Ảnh</th>
						<th style=" text-align: center;border:1px solid black">Tên Sản Phẩm </th>
						<th style=" text-align: center ;border:1px solid black">Số Lượng/Kích thước</th>
						<th style=" text-align: center;border:1px solid black">Giá/Đơn Giá</th>
						<div class="clearfix"> </div>
					</tr>
						@foreach($product_cart as $product)
							<tr class="cart-header product{{$product['item']->idsize}}">
									<td class="ring-in"
										<a href="{{route('Detail',$product['item']->id)}}">
											<img src="images/{{$product['item']->image}} " class="img-responsive" alt="" style="width: 100px; height: 100px;">
										</a>
									</td> 
									<td>
										<span class="name">{{$product['item']->name}}</span>
									</td> 
									<td>
										<span class="quantity soluong{{$product['item']->idsize}}" value="{{$product['qty']}}" >
											Số Lượng:{{$product['qty']}}
										</span>
										    <br>
										{{$product['item']->size}}
									</td> 
									<td>
										<span class="cost price gia{{$product['item']->idsize}}" value="{{$product['price']}}">{{number_format($product['price'])}}</span>
										<br>
										{{number_format($product['item']->export_price)}}
									</td> 
							</tr>
									<div class="clearfix"> </div>
						@endforeach

						<tr class="cart-header">
									<td style="float: right;">
										<span>Tổng Tiền:</span>
										<span class="cost totalPrice" value="{{$totalPrice}}">{{number_format($totalPrice)}} Đồng</span>
									</td>
									<td></td>
									<td></td>
									<td style="float: right;">
										<span>Tổng Số Lượng:</span>
										<span class="cost totalQty" value="{{$totalQty}}">{{number_format($totalQty)}} Sản Phẩm</span>
									</td>
								<div class="clearfix"> </div>
						</tr>
						<tr>
									<td style="float: right"><a href="javavoid:(0)"  id="isMyCart" class="add-cart btn btn-success">TÔi dang mua hàng</a></td>
									<td></td>
									<td></td>
									<td  style="float:left;"><a href="javavoid:(0)" id="notMyCart" class=" add-cart btn btn-warning">Giỏ Hàng Không phải của tôi</a></td>
									<div class="clearfix"> </div>
						</tr>

					</table>			
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
@endif	