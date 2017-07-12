	<!--banner-starts-->
	<div class="bnr" id="home">
		<div  id="top" class="callbacks_container">
			<ul class="rslides" id="slider4">
				@foreach($Slide as $slide)
			    <li>
					<img src="../images/Banner/{{$slide->hinh}}" alt="{{$slide->hinh}}"  style="height:400px;"  />
				</li>
				@endforeach
			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<!--banner-ends--> 
	<!--Slider-Starts-Here-->
				<script src="../js/responsiveslides.min.js"></script>
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
			<div class="about-top grid-1">
				@foreach($hotPro as $hot)
				<div class="col-md-4 about-left">
					<figure class="effect-bubba">
						<img class="img-responsive" src="../images/{{$hot->image}}" alt=""/>
						<figcaption>
							<h2>{{$hot->name}}</h2>
							<p>{{number_format($hot->unit_price)}}VNĐ</p>	
						</figcaption>			
					</figure>
				</div>
				@endforeach
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--about-end-->