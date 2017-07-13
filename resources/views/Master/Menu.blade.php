	<div class="header-bottom">
		<div class="container">
			<div class="header">
				<div class="col-md-9 header-left" style="font-family: Time New Roman; ">
				<div class="top-nav">
					<ul class="memenu skyblue"><li class="active"><a href="{{route('home')}}">Home</a></li>
						<li class="grid"><a href="#">Sản Phẩm</a>
							<div class="mepanel">
								<div class="row">
									<div class="col1 me-one" >
										{{-- <h4>Shop</h4> --}}
										<ul>
											@foreach($type as $typepro)
												<li ><a href="products.html" style="font-size: 15px;">{{$typepro->name}}</a></li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li class="grid"><a href="typo.html">Blog</a>
						</li>
						<li class="grid"><a href="{{route('Contact')}}">Contact</a>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-3 header-right"> 
				<div class="search-bar">
					<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					<input type="submit" value="">
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>
		</div>
	</div>