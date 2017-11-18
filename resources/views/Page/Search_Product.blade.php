@extends('Master.master')
@section('body')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="active">Sản Phẩm</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
<div class="prdt"> 
		<div class="container">
			<div class="prdt-top">
				<div class="col-md-9 prdt-left">
					<div class="product-one">
					  @if(isset($product[0]))
					  	<div class="col-md-4 p-left" style="float: right;" >
						Sắp Xếp:
						 	<select name="sort" id="sort">
							 	<option  id="No Sort" value="No Sort" selected="">Không Có</option>
							 	<option id="ASC" value="ASC">A-Z</option>
							 	<option id="DESC" value="DESC">Z-A</option>
						 	</select>
					 	<script type="text/javascript">
					 		$('#sort').change(function(){
					 			var sort = $(this).val();
					 			var route = '{{route('Search',["typeSearch=$typeSearch","sizeSearch=$sizeSearch","sort=sortName"])}}' ;
					 			route = route.replace('sortName',sort);
					 			route = route.replace(/&amp;/g,'&')
					 			window.location.replace(route);
					 		});
					 		var sort = "{{$sort}}";
					 		if(sort != null)
					 			$('#'+sort).attr('selected','selected');
					 	</script>
					 	</div><br><br><br><br>
					 	<div class="clearfix"></div>
						@foreach($product as $All)
							<div class="col-md-4 product-left p-left">
								<div class="product-main simpleCart_shelfItem">
									<a href="{{route('Detail',"$All->id")}}" class="mask">
										<img class="img-responsive zoom-img" src="images/{{$All->image}}" alt="" style="width: 200px;height:200px;" />
									</a>
										<div class="product-bottom">
										<h3 style="height: 30px;">{{$All->name}}</h3>
										<p>Tìm hiểu thêm</p>									
{{-- 									
										<h4>
												<a class="item_add" href="#"><i></i>
													<em><span class=" item_price">{{number_format($All->unit_price)}}VNĐ/m<sup>2</sup></span></em>
												</a>
										</h4> --}}
									</div>
								</div>
							</div>
						@endforeach
						<div class="clearfix"></div>
						<div>{{$product->appends(Request::capture()->except('product'))->links()}}</div>
					  @else
					 	<div>
							<h2>Không Có Sản Phẩm</h2>
						</div>
					 @endif
					</div>
				</div>
				<form action="{{route('Search')}}" method="get">
					<div class="col-md-3 prdt-right">
							<div class="w_sidebar">
								<section  class="sky-form">
								
									<h4>Loại Sản Phẩm</h4>
									<div class="row1 scroll-pane">
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
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--product-end-->
@endsection