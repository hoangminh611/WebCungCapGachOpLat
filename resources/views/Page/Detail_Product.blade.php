@extends('Master.master')
@section('body')
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Sản Phẩm Chi tiết</li>
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
{{-- 								<ul class="star-footer">
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
										<li><a href="#"><i> </i></a></li>
									</ul> --}}
							@if(Session::has('khongdu'))
								<div class="alert alert-danger">
										{{Session::get('khongdu')}}		
								</div>
							@endif
								<div class="review">
									<a href="javascript:void(0)">View: {{$product[0]->view}} Lượt Xem </a>
									<br>
									<a href="javascript:void(0)">Số Lượng hàng đã bán ra :
									<br>
										@foreach($product as $pro)
												{{$pro->size}}:{{$pro->export_quantity}} Viên
												<br>
										@endforeach
									</a>
								</div>
								<div class="fb-like" data-href="http://localhost/webcungcapgachoplat/public/index.php/Detail/{{$product[0]->id}}" data-width="500" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
								<div class="clearfix"> </div>
							</div>
							
							<h5 class="item_price">
								@foreach($product as $pro)
									{{$pro->size}}:{{number_format($pro->export_price)}}VNĐ
								@endforeach
							</h5>
							<div class="available">
								<h6 style="float: left"><b><i>Gợi ý số lượng gạch : </i></b></h6>
								<input type="text" name="" pattern="[0-9]{1,4}" maxlength='4' required title=" nhâp 1 to 4 chữ số" id="square" placeholder="Nhập diện tích m2">
								<input type="button" name="" id="calculator" value="Tính">
							</div>
							<div style="clear: both"></div>
							{{-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p> --}}
							<form method="get" action="{{route('add-cart')}}">
							<div class="available">
								<ul>
									<li>
										<span>Kích Thước</span>
										<select name="idsize" id="size">
											@foreach($product as $pro)
												<option value="{{$pro->idsize}}" size="{{$pro->size}}">{{$pro->size}}</option>
											@endforeach
										</select>
									</li>
									<li>
										<span>Số Lượng:</span>
											<button  type="button" id="minus" style="margin-left: 3%;"><i class="fa fa-minus" aria-hidden="true"></i></button>
											<input type="text" name="quantity" id="quantity"  value="1" pattern="[0-9]{1,4}" maxlength='4' required title=" nhâp 1 to 4 chữ số">
											<button   type="button" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
										<script type="text/javascript">
											$('#quantity').keyup(function()
											{
												if($('#quantity').val()<1||isNaN($('#quantity').val()))
											{

												$("#quantity").val(1);
											}
											})
											
											

										</script>
									</li>
									
									<div class="clearfix"> </div>
								</ul>
							</div>
							<button type="submit" name="" class="add-cart item_add">Thêm vào giỏ</button>

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
				<li class="item1"><a href="javascript:void(0)"><img src="images/arrow.png" alt="">Mô Tả</a>
					<ul style="background-color: white;">
						<li class="subitem2" ><a href="javascript:void(0)">{!!$product[0]->description!!}</a></li>
					</ul>
				</li>
{{-- 				<li class="item2"><a href="#"><img src="images/arrow.png" alt="">Additional information</a>
				</li> --}}
				<li class="item3"><a href="#"><img src="images/arrow.png" alt="">Bình Luận</a>
					<ul style="background-color: white;">
					    <li class="subitem3">
					    	<div class="fb-comments" data-href="http://localhost/webcungcapgachoplat/public/index.php/Detail//{{$product[0]->id}}" data-width="560" data-numposts="5"></div>
					    </li>

					</ul>
				</li>
				{{-- <li class="item4"><a href="#"><img src="images/arrow.png" alt="">Helpful Links</a>
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
				</li> --}}
	 		</ul>
				</div>
				<div class="latestproducts">
					<div class="product-one">	
						<div style="text-align: center"><h2>CÓ THỂ BẠN SẼ THÍCH</h2></div>
						@foreach($product_same_type as $samePro)
						 {{--  @foreach($same_Pro as $samePro) --}}
							@if($samePro->id!=$product[0]->id)
								<div class="col-md-4 product-left p-left"> 
									<div class="product-main simpleCart_shelfItem">
										<a href="{{route('Detail',$samePro->id)}}" class="mask">
											<img class="img-responsive zoom-img" src="images/{{$samePro->image}}" alt="" style=" width:200px;height: 200px;" />
											<div class="product-bottom">
												<h3 style="height: 30px;">{{$samePro->name}}</h3>
												<p>Tìm Hiểu Thêm</p>
										</a>
											</div>
									</div>
								</div>
							@endif
						 {{--  @endforeach --}}	
						@endforeach
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
				<form action="{{route('Search')}}" method="get">
					<div class="col-md-3 prdt-right">
							<div class="w_sidebar">
								<section  class="sky-form">
								
									<h4>Loại Sản Phẩm</h4>
									<div class="row1 scroll-pane" style="min-height: 300px;">
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
									<h4>Kích Thước</h4>
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

		$('#calculator').click(function(){
			var size=$('#size option:selected').attr('size');
			var str=size.split('x');
			var s=$('#square').val();
			if(isNaN(s)){

				alert('Không thể nhập chữ ')
				$('#square').val(1);
			}

			else if(s<0){
				alert('Không thể nhập số < 0')
				$('#square').val(1);
			}
			else{

				s=s*10000;
				s=Math.ceil(s/(str[0]*str[1]));
				$("#quantity").val(s);
			}
		})
		$('#home').hide();
	</script>
	<!--end-single-->
@endsection