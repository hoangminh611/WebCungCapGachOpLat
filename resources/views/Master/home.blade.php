@extends('Master.master')
@section('body')
	<div class="product"> 
		<div class="container">
			<h2 style="text-align: center; color: blue">SẢN PHẨM MỚI</h2>
			<div class="product-top">
				<div class="col-md-9 prdt-left">
					<div class="product-one">
						@foreach($new9Pro as $newPro)
						<div class="col-md-4 product-left p-left" style="margin-top: 5px;">
							<div class="product-main simpleCart_shelfItem">
								<a href="{{route('Detail',"$newPro->id")}}" class="mask"><img class="img-responsive zoom-img" src="images/{{$newPro->image}}" alt="" style="width: 250px; height: 250px;" />
								<div class="product-bottom">
									<h4 style="height: 30px;">{{$newPro->name}}</h4>
									<p>Tìm Hiểu Thêm</p></a>

								</div>
							</div>
						</div>
						@endforeach
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<form action="{{route('Search')}}" method="get">
					<div class="col-md-3 prdt-right">
							<div class="w_sidebar">
								<section  class="sky-form">
								
									<h4>Loại Sản Phẩm</h4>
									<div class="row1 scroll-pane" style="min-height: 300px;">
										<div class="col col-4">
											<label><input type="radio" name="typeSearch" checked="" class="typekhong" value="khong"><i></i>Tất Cả Sản Phẩm</a></label>
										</div>
										<div class="col col-4">
											@foreach($type as $typePro)								
													@foreach($loaicon[$typePro->id] as $typebrand)	
													<label ><input type="radio" name="typeSearch"  class="type{{$typebrand->id}}" value="{{$typebrand->id}}"><i></i>{{$typebrand->name}}</label>
													<br>
												@endforeach
											@endforeach
										</div>
									</div>
								</section>
								<section class="sky-form">
									<h4>Kích Thước</h4>
										<div class="col col-4">
											<label><input type="radio" name="sizeSearch" checked="" class="sizekhong" value="khong"><i></i>Tất Cả Kích Thước</label>
										</div>
										<div class="col col-4">
											@foreach($size_gach as $sizePro)
												<label><input type="radio" name="sizeSearch" class="size{{$sizePro}}" value="{{$sizePro}}"><i></i>{{$sizePro}}</label>
												<br>
											@endforeach
										</div>
								</section>
								@if(isset($_GET['typeSearch']))
										<script type="text/javascript">
											var a="{{$_GET['typeSearch']}}";
											$(".type"+a).attr('checked','checked');
											var b="{{$_GET['sizeSearch']}}";
											$(".size"+b).attr('checked','checked');
									</script>
								@endif
							</div>

							<button type="submit" name="" style="width:100%">search<i class="fa fa-search" aria-hidden="true" style="float: right"></i></button>
					</div>	
				</form>
		</div>
	</div>
	@if(Session::get('checkcart') == true && Cookie::has('cart')) 
		<script type="text/javascript">
		$(document).ready(function() 
			{
			$("#cart-box").fadeIn(500);
					    // Add the mask to body
			$('body').append('<div id="mask"></div>');
			$('#mask').fadeIn(500);
		});
		</script>
	@endif

@endsection