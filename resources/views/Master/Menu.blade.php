	<div class="header-bottom">
		<div class="container">
			<div class="header">
				<div class="col-md-9 header-left" style="font-family: Time New Roman; ">
				<div class="top-nav">
					<ul class="memenu skyblue"><li class="active"><a href="{{route('index')}}">Home</a></li>
						<li class="grid"><a href="javascript:void(0)">Sản Phẩm</a>
							<div class="mepanel" >
								<div class="row">
									@foreach($type as $typepro)
									<div class="col1 me-one" style="width: 20% ;margin:0px; float:left; " >
										<h4 style="width: 20%"><a href="{{route('ViewAll_Product',$typepro->id)}}">{{$typepro->name}}</a></h4>
										<ul>
											@foreach($loaicon[$typepro->id] as $type_child)
												<li><a href="{{route('ViewAll_Product_By_Type',$type_child->id)}}">{{$type_child->name}}</a></li>
											@endforeach
										</ul>
									</div>

									@endforeach
								</div>
							</div>
						</li>
						<li class="grid"><a href="{{route('News')}}">News</a>
						</li>
						<li class="grid"><a href="{{route('Contact')}}">Contact</a>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-3 header-right"> 
				<div class="search-bar">
				<form action="{{route('Detail_Search')}}" method="get">
					<input type="text" value="Search"  name="search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					<input type="submit" value="">
				</form>
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>
		</div>
	</div>