@extends('Master.master')
@section('body')
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">Single</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--start-single-->
	<div class="single contact">
		<div class="container">
			<div class="single-main">
				<div class="col-md-9 single-main-left">
				<div class="sngl-top">
					<div class="col-md-5 single-top-left">	
						<div class="flexslider">
							  <ul class="slides">
								<li data-thumb="images/s-1.jpg">
									<div class="thumb-image"> <img src="images/{{$product[0]->image}}" data-imagezoom="true" class="img-responsive" alt=""/> 
									</div>
								</li>
								{{-- //khúc này mốt cho nhiều ảnh vô
								<li data-thumb="images/s-2.jpg">
									 <div class="thumb-image"> <img src="images/s-2.jpg" data-imagezoom="true" class="img-responsive" alt=""/> </div>
								</li> --}}
							  </ul>
						</div>
						<!-- FlexSlider -->
						<script src="js/imagezoom.js"></script>
						<script defer src="js/jquery.flexslider.js"></script>
						<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

						<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
						</script>
					</div>	
					<div class="col-md-7 single-top-right">
						<div class="single-para simpleCart_shelfItem">
						<h2>{{$product[0]->name}}</h2>
						{{-- vote sao --}}
							<div class="star-on">
								<ul class="star-footer">
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
									</ul>
								<div class="review">
									<a href="javascript:void(0)">{{$product[0]->view}}View </a>
									
								</div>
							<div class="clearfix"> </div>
							</div>
							
							<h5 class="item_price">
								@foreach($product as $pro)
									{{$pro->size}}:{{number_format($pro->export_price)}}VNĐ
								@endforeach
							</h5>

							{{-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p> --}}
							<form method="get" action="{{route('add-cart')}}">
							<div class="available">
								<ul>
									<li>
										<span>Size</span>
										<select name="idsize">
											@foreach($product as $pro)
												<option value="{{$pro->idsize}}">{{$pro->size}}</option>
											@endforeach
										</select>
									</li>
									<li>
										<span>Số Lượng:</span>
											<button  type="button" id="minus" style="margin-left: 3%;"><i class="fa fa-minus" aria-hidden="true"></i></button>
											<input type="text" name="quantity" id="quantity"  value="1" pattern="[0-9]{1,4}" required title=" nhâp 1 to 4 chữ số">
											<button   type="button" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
									</li>
									
									<div class="clearfix"> </div>
								</ul>
							</div>
							<button type="submit" name="" class="add-cart item_add">ADD TO CART</button>
							</form>
							{{-- <ul class="tag-men">
								<li><span>TAG</span>
								<span class="women1">: Women,</span></li>
								<li><span>SKU</span>
								<span class="women1">: CK09</span></li>
							</ul> --}}
								
							
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="tabs">
					<ul class="menu_drop">
				<li class="item1"><a href="javascript:void(0)"><img src="images/arrow.png" alt="">Description</a>
					<ul>
						<li class="subitem2"><a href="javascript:void(0)">{{$product[0]->description}}</a></li>
					</ul>
				</li>
				<li class="item2"><a href="#"><img src="images/arrow.png" alt="">Additional information</a>
					<ul>
					    <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
						<li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
					</ul>
				</li>
				<li class="item3"><a href="#"><img src="images/arrow.png" alt="">Comment</a>
					<ul>
						<li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
						<li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
						<li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
					</ul>
				</li>
				<li class="item4"><a href="#"><img src="images/arrow.png" alt="">Helpful Links</a>
					<ul>
					    <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
						<li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
					</ul>
				</li>
				<li class="item5"><a href="#"><img src="images/arrow.png" alt="">Make A Gift</a>
					<ul>
						<li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
						<li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore</a></li>
						<li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes </a></li>
					</ul>
				</li>
	 		</ul>
				</div>
				<div class="latestproducts">
					<div class="product-one">	
						<div style="text-align: center"><h2>SẢN PHẨM GỢI Ý</h2></div>
						@foreach($product_same_type as $samePro)
							@if($samePro->id!=$product[0]->id)
								<div class="col-md-4 product-left p-left"> 
									<div class="product-main simpleCart_shelfItem">
										<a href="{{route('Detail',$samePro->id)}}" class="mask">
											<img class="img-responsive zoom-img" src="images/{{$samePro->image}}" alt="" style=" width:200px;height: 200px;" />
											<div class="product-bottom">
												<h3>{{$samePro->name}}</h3>
												<p>Tìm Hiểu Thêm</p>
										</a>
										<h4>
														<a class="item_add" href="#"><i></i>
															<em><span class=" item_price">{{number_format($samePro->unit_price)}}VNĐ</span></em>
														</a>
												</h4>
											</div>
									</div>
								</div>
							@endif
						@endforeach
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
				<form action="{{route('Search')}}" method="get">
					<div class="col-md-3 prdt-right">
							<div class="w_sidebar">
								<section  class="sky-form">
								
									<h4>Catogories</h4>
									<div class="row1 scroll-pane">
										<div class="col col-4">
											<label><input type="radio" name="type" checked="" value="khong"><i></i>Tất Cả Sản Phẩm</a></label>
										</div>
										<div class="col col-4">
											@foreach($type as $typePro)								
													@foreach($loaicon[$typePro->id] as $typebrand)	
													<label><input type="radio" name="type" value="{{$typebrand->id}}"><i></i>{{$typebrand->name}}</label>
													<br>
												@endforeach
											@endforeach
										</div>
									</div>
								</section>
								<section class="sky-form">
									<h4>Size</h4>
										<div class="col col-4">
											<label><input type="radio" name="size" checked="" value="khong"><i></i>Tất Cả Kích Thước</label>
										</div>
										<div class="col col-4">
											@foreach($size_gach as $sizePro)
												<label><input type="radio" name="size" value="{{$sizePro}}"><i></i>{{$sizePro}}</label>
												<br>
											@endforeach
										</div>
								</section>
							</div>

							<button type="submit" name="" style="width:100%">search<i class="fa fa-search" aria-hidden="true" style="float: right"></i></button>
					</div>
					
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('#minus').click(function()
		{
			var quantity=parseInt($("#quantity").val())-1;
			if(quantity<=1)
				$("#quantity").val(1);
			else
				$("#quantity").val(quantity);

		});
		$('#plus').click(function()
		{
			var quantity=parseInt($("#quantity").val())+1;

				$("#quantity").val(quantity);

		});
		
	</script>
	<!--end-single-->
@endsection