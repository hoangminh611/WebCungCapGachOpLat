<!DOCTYPE html>
<html>
<head>
<title>Luxury Watches A Ecommerce Category Flat Bootstrap Resposive Website Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="{{asset('')}}">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
<script src="js/jquery-1.11.0.min.js"></script>
<!--Custom-Theme-files-->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
<!--//theme-style-->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />	
<meta name="keywords" content="Luxury Watches Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--start-menu-->
<script src="js/simpleCart.min.js"> </script>
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/memenu.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>$(document).ready(function(){$(".memenu").memenu();});</script>	
<!--dropdown-->
<script src="js/jquery.easydropdown.js"></script>	
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu_drop > li > ul'),
	           menu_a  = $('.menu_drop > li > a');
	    
	    menu_ul.hide();
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>				
</head>
<body> 
	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=2033544113598636";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		@include('Master.Top_header')
		@include('Master.Login')
		@include('Master.Menu')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">

				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Checkout</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--start-ckeckout-->
<div id="update">
	<div class="ckeckout">
		<div class="container">
			<div class="ckeck-top heading">
				<h2>CHECKOUT</h2>
			</div>
			<div class="ckeckout-top">
				@if(Session::has('hangkhongdu'))
					<div class="alert alert-danger them " id="alert">
					@for($i=0;$i<count(Session::get('hangkhongdu'));$i++)
					{{Session::get('hangkhongdu')[$i]}}
					<br>
					@endfor
					</div>
				@endif
			<div class="cart-items">
			 <h3>My Shopping Bag</h3>
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
								//phần này của cart tong phía dưới
								$('.totalPrice').html(totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+ " Đồng");
								$('.totalQty').html(totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+ " Sản Phẩm");
								$('.totalPrice').attr('value',totalPrice);
								$('.totalQty').attr('value',totalQty);
								//cai này của header
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
				<ul class="unit" style="border:solid 1px black;">
					<li><span>Item</span></li>
					<li><span>Product Name</span></li>
					<li><span>Quantity/Size</span></li>
					<li><span>Price/Unit_Price</span></li>
					<div class="clearfix"> </div>
				</ul>
				@if(Session::has('cart'))
					@foreach($product_cart as $product)
						<ul class="cart-header product{{$product['item'][0]->idsize}}">
							<div class="close1 {{$product['item'][0]->idsize}}" value="{{$product['item'][0]->idsize}}"> </div>
								<li class="ring-in">
									<a href="{{route('Detail',$product['item'][0]->id)}}">
										<img src="images/{{$product['item'][0]->image}} " class="img-responsive" alt="" style="width: 100px; height: 100px;">
									</a>
								</li>
								<li>
									<span class="name">{{$product['item'][0]->name}}</span>
								</li>
								<li>
									
									<span class="quantity soluong{{$product['item'][0]->idsize}}" value="{{$product['qty']}}" >
									<a href='javascript:void(0)' class='subtruct_itm_qty quantity_change' item_id="{{$product['item'][0]->idsize}}"><button style="border-radius: 6px;">-</button></a>
										Số Lượng:{{$product['qty']}}
									<a href='javascript:void(0)' class='add_itm_qty quantity_change' item_id="{{$product['item'][0]->idsize}}"><button style="border-radius: 6px;">+</button></a>
									</span>
									    
									{{$product['item'][0]->size}}
								</li>
								<li>
									<span class="cost price gia{{$product['item'][0]->idsize}}" value="{{$product['price']}}">{{number_format($product['price'])}}</span>
									{{number_format($product['item'][0]->export_price)}}
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
	        var route = "{{route('reduce-to-qty','id_sp')}}";
	        route=route.replace("id_sp",item_id);
	        $.getJSON( route, function(data){ 
	           	$(".cart_price").html(data.totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" Đồng"); 
	           	$(".cart_qty").html(data.totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" Sản Phẩm"); 
	           	 $("#update").load("{{route('Update_Cart')}}");
	        });
	       	if(soluong==1)
		        {
		        	route="{{route('cart-detail')}}";
		        	window.location.replace(route);
		        }

		});
	</script>
</div>
	<!--end-ckeckout-->
@include('Master.Footer')
</body>
</html>
