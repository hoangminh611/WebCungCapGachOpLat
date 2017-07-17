	<!--banner-starts-->
	<div class="bnr" id="home">
		<div  id="top" class="callbacks_container">
			<ul class="rslides" id="slider4">
				@foreach($Slide as $slide)
			    <li>
					<img src="images/Banner/{{$slide->hinh}}" alt="{{$slide->hinh}}"  style="height:400px;"  />
				</li>
				@endforeach
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<!--banner-ends--> 
	<!--Slider-Starts-Here-->
				<script src="js/responsiveslides.min.js"></script>
			 <script>
			    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 4
			      $("#slider4").responsiveSlides({
			        auto: true,
			        pager: true,
			        nav: true,
			        speed: 500,
			        namespace: "callbacks",
			        before: function () {
			          $('.events').append("<li>before event fired.</li>");
			        },
			        after: function () {
			          $('.events').append("<li>after event fired.</li>");
			        }
			      });
			
			    });
			  </script>
			<!--End-slider-script-->
		<div class="about"> 
		<div class="container">
			<div style="text-align: center"><h2>SẢN PHẨM NỔI BẬT</h2></div>
			<div class="about-top grid-1">
				@foreach($hotPro as $hot)
				<div class="col-md-4 about-left" style="width: 282px; height: 282px;padding-left: 15px; padding-right: 5px;" >
					<figure class="effect-bubba" >
						<a href="{{route('Detail',"$hot->id")}}">
							<img class="img-responsive" src="images/{{$hot->image}}" style="width: 282px; height: 282px; " alt="{{$hot->image}}"/>
							<figcaption>
								<h2>{{$hot->name}}</h2>
								<p>{{number_format($hot->unit_price)}}VNĐ</p>	
							</figcaption>		
						</a>	
					</figure>
				</div>
				@endforeach
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--about-end-->