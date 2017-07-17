@extends('Master.master')
@section('body')
	<div class="product"> 
		<div class="container">
			<h2 style="text-align: center; ">SẢN PHẨM MỚI</h2>
			<div class="product-top">
				<div class="product-one">
					@foreach($new8Pro as $newPro)
					<div class="col-md-3 product-left" style="margin-top: 5px;">
						<div class="product-main simpleCart_shelfItem">
							<a href="{{route('Detail',"$newPro->id")}}" class="mask"><img class="img-responsive zoom-img" src="images/{{$newPro->image}}" alt="" style="width: 250px; height: 250px;" />
							<div class="product-bottom">
								<h4>{{$newPro->name}}</h4>
								<p>Tìm Hiểu Thêm</p></a>
								<h4>
										<a class="item_add" href="#"><i></i>
											<em><span class=" item_price">{{number_format($newPro->unit_price)}}VNĐ/m<sup>2</sup></span></em>
										</a>
								</h4>
							</div>
						</div>
					</div>
					@endforeach
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
@endsection