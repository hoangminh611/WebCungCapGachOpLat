<div id="update">
		<div class="ckeckout">
			<div class="container">
				<div class="ckeck-top heading">
					<h2>Kiểm Tra Giỏ Hàng</h2>
				</div>
				<div class="ckeckout-top">
				<div class="cart-items">
				 <h3>Giỏ Hàng của tôi</h3>
					<script>
					$(document).ready(function(c) {
						$('.close1').on('click', function(c){
							var val= $(this).attr('value');
							var totalPrice=$('.totalPrice').attr('value');
							var totalQty=$('.totalQty').attr('value');
							var soluong=$('.soluong'+val).attr('value');
							var price=$('.gia'+val).attr('value');
							var totalPrice=parseInt(totalPrice-price);
							var totalQty=parseInt(totalQty-soluong);
							var route="{{route('delete-item-cart','id')}}";
							route=route.replace('id',val);
							$.ajax ({
								url: route,
								type:'get',
								data: null,
								success:function(data){
									$('.product'+val).fadeOut('slow', function(c){
										$('.product'+val).remove();
									});
									$('.totalPrice').html(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+ " Đồng");
									$('.totalQty').html(totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+ " Sản Phẩm");
									$('.totalPrice').attr('value',totalPrice);
									$('.totalQty').attr('value',totalQty);
									$('.cart_price').html(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+ " Đồng");
									if(totalQty!=0)
										$('.cart_qty').html(totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+ " Sản Phẩm");
									else
										$('.cart_qty').html('Empty Cart');

								}
							});
							
						});	  
					});
				   </script>
				{{-- <script>$(document).ready(function(c) {
						$('.close2').on('click', function(c){
							$('.cart-header1').fadeOut('slow', function(c){
								$('.cart-header1').remove();
							});
							});	  
						});
				   </script>
				   <script>$(document).ready(function(c) {
						$('.close3').on('click', function(c){
							$('.cart-header2').fadeOut('slow', function(c){
								$('.cart-header2').remove();
							});
							});	  
						});
				   </script> --}}
					
				<div class="in-check" >
					@if(!Auth::check())
						<div class="alert alert-warning"> Hãy Đăng Nhập để nhận ưu đãi từ cửa hàng chúng tôi</div>
					@else
						<div class="alert alert-warning"> 
							@foreach($discounts as $discount)
								<p>VỚI HÓA ĐƠN CÓ GIÁ TRỊ LÀ :{{$discount->price_discount}} VNĐ sẽ được giảm giá {{$discount->percent_discount}} % và tiền ship là :{{$discount->ship_price}} và được bộ quà tặng là :{{$discount->name_gift != null ? $discount->name_gift : 'Không có'}}</p></p>
							@endforeach
						</div>
					@endif
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
										<a href='javascript:void(0)' class='subtruct_itm_qty quantity_change' item_id="{{$product['item']->idsize}}"><button style="border-radius: 6px;">-</button></a>
											Số Lượng:{{$product['qty']}}
										<a href='javascript:void(0)' class='add_itm_qty quantity_change' item_id="{{$product['item']->idsize}}"><button style="border-radius: 6px;">+</button></a>
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
									<li style="float: right"><a href="{{route('Payment')}}" class="add-cart btn btn-success">Thanh Toán</a></li>
									<li  style="float:left;"><a href="{{route('delete-cart')}}" class=" add-cart btn btn-warning">Xóa Cart</a></li>
									
									<div class="clearfix"> </div>
						</ul>
					@endif
							
			 </div>
			</div>
		</div>
		<script type="text/javascript">
			$('a.add_itm_qty').click(function(e){
			 e.preventDefault(); 
	        var item_id = $(this).attr("item_id"); 
	        var route = "{{route('rise-to-qty','id_sp')}}";
	         route=route.replace("id_sp",item_id);   
	           $.getJSON( route, function(data){ 
	          	$(".cart_price").html(data.totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" Đồng"); 
           		$(".cart_qty").html(data.totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" Sản Phẩm"); 

	           	$("#update").load("{{route('Update_Cart')}}");
	           	});

			});
			 $('a.subtruct_itm_qty').click(function(e){
				e.preventDefault(); 
		        var item_id = $(this).attr("item_id"); 
		        var soluong=$('.soluong'+item_id).attr('value');
		        if(soluong==1)
		        {
		        	var route="{{route('delete-item-cart','id')}}";
							route=route.replace('id',item_id); 
		        	$.ajax ({
								url: route,
								type:'get',
								data: null,
								success:function(data){
									window.location.replace('{{route('cart-detail')}}');
									return;
								}
							});
		        }	
		        var route = "{{route('reduce-to-qty','id_sp')}}";
		        route=route.replace("id_sp",item_id);   
		        $.getJSON( route, function(data){ 
		           	$(".cart_price").html(data.totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" Đồng"); 
		           	$(".cart_qty").html(data.totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" Sản Phẩm"); 
		           	$("#update").load("{{route('Update_Cart')}}");
           		});
			 });
		</script>
</div>
