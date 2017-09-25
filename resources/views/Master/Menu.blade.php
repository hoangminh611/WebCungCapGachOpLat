	<div class="header-bottom">
		<div class="container">
			<div class="header">
				<div class="col-md-9 header-left" style="font-family: Time New Roman; ">
				<div class="top-nav">
					<ul class="memenu skyblue"><li class="active"><a href="{{route('index')}}">Trang chủ</a></li>
						<li class="grid"><a href="javascript:void(0)">Sản Phẩm</a>
							<div class="mepanel" >
								<div class="row">
									@foreach($type as $typepro)
									<div class="col1 me-one" style="width: 20% ;margin:0px; float:left; " >
										<h4 style="width: 20%">
											<a href="{{route('ViewAll_Product',$typepro->id)}}" class="toggle" data-toggle="tooltip"  title="{{$typepro->description}}">{{$typepro->name}}</a></h4>
										<ul>
											@foreach($loaicon[$typepro->id] as $type_child)
												<li>
													<a href="{{route('ViewAll_Product_By_Type',$type_child->id)}}" data-toggle="tooltip" data-placement="top" title="{{$type_child->description}}">
													{{$type_child->name}}
													</a>
												</li>
											@endforeach
										</ul>
									</div>

									@endforeach
								</div>
							</div>
						</li>
						<li class="grid"><a href="{{route('News')}}">Tin tức</a>
						</li>
						<li class="grid"><a href="{{route('Contact')}}">Liên Hệ</a>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-3 header-right"> 
				<div class="search-bar">
				<form action="{{route('Detail_Search')}}" method="get">
					<input type="text" value="Nhập tên sản phẩm" id="search" name="search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					<input type="submit" value="">
				</form>
				</div>
			</div>
			<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<style type="text/css">
        .ui-autocomplete.ui-menu
        {
            position: fixed;
            display: inline-block;
            background-color: white;
            z-index: 9999; /* for mozilla */
        }
    </style>
	<script type="text/javascript">
	  $( function() {
	    $( "#search" ).autocomplete({

	      source: "{{route('autosearch')}}",
	      minLength: 1,
	      autoFocus: true,
		  select: function(event, ui) {
		  		$('#search').val(ui.item.value);
		  		// $('#idSearch').val(ui.item.id);
		  	}
		});
	    });
	  
    	 
  </script>