@extends('Master.master')
@section('body')
	<!--start-breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-main">
				<ol class="breadcrumb">
					<li><a href="index.html">Home</a></li>
					<li class="active">New Products</li>
				</ol>
			</div>
		</div>
	</div>
	<!--end-breadcrumbs-->
	<!--prdt-starts-->
	<div class="prdt"> 
		<div class="container">
			<div class="prdt-top">
				<div class="col-md-9 prdt-left">
					<div class="product-one">

					@if( $typepro == 0)
						@foreach($All_Product as $pro)
							@foreach($pro as $All)
							<div class="col-md-4 product-left p-left">
								<div class="product-main simpleCart_shelfItem">
									<a href="{{route('Detail',"$All->id")}}" class="mask">
										<img class="img-responsive zoom-img" src="images/{{$All->image}}" alt="" style="width: 200px;height:200px;" />
									</a>
										<div class="product-bottom">
										<h3 style="height: 30px;">{{$All->name}}</h3>
										<p>Tìm hiểu thêm</p>									
									</div>
								</div>
							</div>
							@endforeach
						@endforeach
						<div class="clearfix"></div>
						{{-- <div>{{$All_Product->links()}}</div> --}}
					@else
						@foreach($product as $pro)
							<div class="col-md-4 product-left p-left">
								<div class="product-main simpleCart_shelfItem">
									<a href="{{route('Detail',"$pro->id")}}" class="mask">
										<img class="img-responsive zoom-img"  width="200px" height="200px" src="images/{{$pro->image}}" alt="" /></a>
										<div class="product-bottom">
										<h3>{{$pro->name}}</h3>
										<p>Tìm hiểu thêm</p>									
									
										<h4>
												<a class="item_add" href="#"><i></i>
													<em><span class=" item_price">{{number_format($pro->unit_price)}}VNĐ</span></em>
												</a>
										</h4>
									</div>
								</div>
							</div>
						@endforeach
						<div class="clearfix"></div>
						<div>{{$product->links()}}</div>
					@endif
					</div>
				</div>	
					<form action="{{route('Search')}}" method="get">
					<div class="col-md-3 prdt-right">
							<div class="w_sidebar">
								<section  class="sky-form">					
									<h4>Catogories</h4>
									<div class="row1 scroll-pane">
										<div class="col col-4">
											<label><input type="radio" name="type" class="type" checked="" value="khong"><i></i>Tất Cả Sản Phẩm</a></label>
										</div>
										<div class="col col-4">
											@foreach($type as $typePro)								
													@foreach($loaicon[$typePro->id] as $typebrand)	
													<label  id="loai{{$typebrand->id}}"><input type="radio" name="type" value="{{$typebrand->id}}">{{$typebrand->name}}</label>
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
	<!--product-end-->
@endsection