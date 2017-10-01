@extends('Admin.Master.Admin_Master')
@section('body')
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Tổng Số Lượt Xem</h4>
					<h3>{{number_format($All_View)}}</h3>
					<p>Other hand, we denounce</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Tổng số Tài Khoản</h4>
						<h3>{{number_format($Count_User)}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng lượng bán</h4>
						<h3>{{number_format($All_Export_Quantity)}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<a href="{{route('ViewPageBill_Admin')}}">
						<div class="col-md-8 market-update-left">
							
							<h4>Tổng số đơn hàng</h4>
							<h3>{{number_format($Count_Bill)}}</h3>
							<p>Other hand, we denounce</p>
							
						</div>
					</a>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
					<!-- tasks -->
{{-- 			<div class="agile-last-grids">
				<div class="col-md-4 agile-last-left">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Monthly</h3>
						</div>
						<div id="graph7"></div>
						<script>
						// This crosses a DST boundary in the UK.
						Morris.Area({
						  element: 'graph7',
						  data: [
							{x: '2013-03-30 22:00:00', y: 3, z: 3},
							{x: '2013-03-31 00:00:00', y: 2, z: 0},
							{x: '2013-03-31 02:00:00', y: 0, z: 2},
							{x: '2013-03-31 04:00:00', y: 4, z: 4}
						  ],
						  xkey: 'x',
						  ykeys: ['y', 'z'],
						  labels: ['Y', 'Z']
						});
						</script>

					</div>
				</div> --}}
				<div class="col-md-12 agile-last-left agile-last-middle">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
						
							<h3>Tổng doanh thu bán hàng qua từng tháng trong 1 năm</h3>
							<form  method="get" id="dateForm">
								<select name="date" id="date">
									@for($i=1;$i<=12;$i++)
										<option id="{{$i}}" value="{{$i}}">Tháng {{$i}}</option>
									@endfor
								</select>
								<button type="button" id="search">Tìm Kiếm</button>
							
							</form>
						</div>
						<div id="graph8"></div>
						<script type="text/javascript">
						/* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
						$('#'+{{$getMonth}}).attr('selected','selected');
						var day_data = [
						@foreach($Total_By_Month as $total)
						  @foreach($total as $total_product)
						  {"product": "{{$total_product['name']}}({{$total_product['size']}})", "Tổng hàng bán": {{$total_product['quantity']}}, "Tổng Tiền": {{$total_product['price']}}},
						  @endforeach
						@endforeach
						  
						];
						if(day_data.length > 0){
							Morris.Bar({
								element: 'graph8',
								data: day_data,
								xkey: 'product',
								ykeys: ['Tổng hàng bán','Tổng Tiền'],
								labels: ['Tổng hàng bán', 'Tổng Tiền'],
								xLabelAngle: 60,
							});
						}
						$("#search").click(function () {
							var route="{{route('GetMonthlyFund')}}";
	                        $.ajax({
	                            url:route,
	                            type:'get',
	                            data:$('#dateForm').serialize(),
	                            dataType:'json',
	                            success:function(result) {
	                            	// console.log(result);
	                            	$('#graph8').html('');
	                            	var day_data = [];
	                            	for(var i = 0; i < result.length; i++)
	                            	{
                            			day_data.push({'product': result[i].name
                            									,'Tổng hàng bán':result[i].quantity 
                            									,'Tổng Tiền': result[i].price
                            						 });          		
	                            	}
	                            	
	                            	if(day_data.length > 0){

	                            		Morris.Bar({
											element: 'graph8',
											data: day_data,
											xkey: 'product',
											ykeys: ['Tổng hàng bán','Tổng Tiền'],
											labels: ['Tổng hàng bán(Sản Phẩm)', 'Tổng Tiền(VNĐ)'],
											xLabelAngle: 60,
	                            		})
									
									}
	                            }
	                        });
	    
						});
						
						
						</script>
					</div>
				</div>
{{-- 				<div class="col-md-4 agile-last-left agile-last-right">
					<div class="agile-last-grid">
						<div class="area-grids-heading">
							<h3>Yearly</h3>
						</div>
						<div id="graph9"></div>
						<script>
						var day_data = [
						  {"elapsed": "I", "value": 34},
						  {"elapsed": "II", "value": 24},
						  {"elapsed": "III", "value": 3},
						  {"elapsed": "IV", "value": 12},
						  {"elapsed": "V", "value": 13},
						  {"elapsed": "VI", "value": 22},
						  {"elapsed": "VII", "value": 5},
						  {"elapsed": "VIII", "value": 26},
						  {"elapsed": "IX", "value": 12},
						  {"elapsed": "X", "value": 19}
						];
						Morris.Line({
						  element: 'graph9',
						  data: day_data,
						  xkey: 'elapsed',
						  ykeys: ['value'],
						  labels: ['value'],
						  parseTime: false
						});
						</script>

					</div>
				</div> --}}
				<div class="clearfix"> </div>
			</div>
		<!-- //tasks -->
{{-- 		<div class="agileits-w3layouts-stats">
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">Browser Stats</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled">
									<li>GoogleChrome <span class="pull-right">85%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:85%;"></div> 
										</div>
									</li>
									<li>Firefox <span class="pull-right">35%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:35%;"></div>
										</div>
									</li>
									<li>Internet Explorer <span class="pull-right">78%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:78%;"></div>
										</div>
									</li>
									<li>Safari <span class="pull-right">50%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:50%;"></div>
										</div>
									</li>
									<li>Opera <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									<li class="last">Others <span class="pull-right">60%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar orange" style="width:60%;"></div>
										</div>
									</li> 
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<div class="stats-last-agile">
							<table class="table stats-table ">
								<thead>
									<tr>
										<th>S.NO</th>
										<th>PRODUCT</th>
										<th>STATUS</th>
										<th>PROGRESS</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Lorem ipsum</td>
										<td><span class="label label-success">In progress</span></td>
										<td><h5>85% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Aliquam</td>
										<td><span class="label label-warning">New</span></td>
										<td><h5>35% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Lorem ipsum</td>
										<td><span class="label label-danger">Overdue</span></td>
										<td><h5 class="down">40% <i class="fa fa-level-down"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">4</th>
										<td>Aliquam</td>
										<td><span class="label label-info">Out of stock</span></td>
										<td><h5>100% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">5</th>
										<td>Lorem ipsum</td>
										<td><span class="label label-success">In progress</span></td>
										<td><h5 class="down">10% <i class="fa fa-level-down"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">6</th>
										<td>Aliquam</td>
										<td><span class="label label-warning">New</span></td>
										<td><h5>38% <i class="fa fa-level-up"></i></h5></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div> --}}
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								{{-- <header class="agileits-box-header clearfix">
									<h3>Visitor Statistics</h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div> --}}
								<table id="bill_table" class="table" ui-jq="footable" ui-options='{
						            "paging": {
						              "enabled": true
						            },
						            "filtering": {
						              "enabled": true
						            },
						            "sorting": {
						              "enabled": true
						            }}'>
						            <thead>
						              <tr>
						                <th>Tên sản phẩm</th>
						                <th data-breakpoints="xs">Kích thước</th>
						                <th>Tổng lượng nhập</th>
						                <th>Tổng tiền nhập</th>
						                <th>Tổng lượng xuất</th>
						                <th>Tổng tiền xuất</th>
						                <th>Tiền Lãi/Lỗ</th>
						              </tr>
						            </thead>
						            <tbody>
						              @foreach($a as $key)
						              	@foreach($key as $value)
							    
						                <tr data-expanded="true">
						                  <td>{{$value['name']}}</td>
						                  <td>{{$value['size']}}</td>
						                  <td>{{number_format($value['import_quantity'])}}</td>

						                    <td>{{number_format($value['import_price'])}}</td>
						                  @if(isset($value['export_quantity']))
						                  	<td>{{number_format($value['export_quantity'])}}</td>
						                  	<td>{{number_format($value['export_price'])}}</td>

						                  @else
						                  	<td>0</td>
						                  	<td>0</td>
						                  @endif
						                  <td>{{number_format($value['price'])}}</td>
						                </tr> 
						                @endforeach
						              @endforeach
						               
						            </tbody>
						        </table>
						         <div style="float: left">TỔNG TIỀN NHẬP: {{number_format($tongtiennhap)}} VNĐ</div>
						         <div style="float: right;">TỔNG TIỀN BÁN RA(đơn đã thanh toán): {{number_format($tongtienxuat)}}VNĐ</div>
						{{--         <div>Tông Tiền Nhập:{{number_format($tongtiennhap)}}</div>
						         <div>Tông Tiền Xuất:{{number_format($tongtienxuat)}}</div> --}}
						          <script type="text/javascript">
						          	 $(document).ready(function(){
						              $('#bill_table').DataTable();
						            });
						          </script>
							</div>
						</div>
	<!--//agileinfo-grap-->

				</div>
			</div>
		</div>
{{-- 		<div class="agil-info-calendar">
		<!-- calendar -->
		<div class="col-md-6 agile-calendar">
			<div class="calendar-widget">
                <div class="panel-heading ui-sortable-handle">
					<span class="panel-icon">
                      <i class="fa fa-calendar-o"></i>
                    </span>
                    <span class="panel-title"> Calendar Widget</span>
                </div>
				<!-- grids -->
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">
									
								</div>
								<div class="monthly" id="mycalendar"></div>
							</div>
							
							<div class="clearfix"> </div>
						</div>
					</div>
			</div>
		</div>
		<!-- //calendar -->
		<div class="col-md-6 w3agile-notifications">
			<div class="notifications">
				<!--notification start-->
				
					<header class="panel-heading">
						Notification 
					</header>
					<div class="notify-w3ls">
						<div class="alert alert-info clearfix">
							<span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send you a mail </li>
									<li class="pull-right notification-time">1 min ago</li>
								</ul>
								<p>
									Urgent meeting for next proposal
								</p>
							</div>
						</div>
						<div class="alert alert-danger">
							<span class="alert-icon"><i class="fa fa-facebook"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> mentioned you in a post </li>
									<li class="pull-right notification-time">7 Hours Ago</li>
								</ul>
								<p>
									Very cool photo jack
								</p>
							</div>
						</div>
						<div class="alert alert-success ">
							<span class="alert-icon"><i class="fa fa-comments-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender">You have 5 message unread</li>
									<li class="pull-right notification-time">1 min ago</li>
								</ul>
								<p>
									<a href="#">Anjelina Mewlo, Jack Flip</a> and <a href="#">3 others</a>
								</p>
							</div>
						</div>
						<div class="alert alert-warning ">
							<span class="alert-icon"><i class="fa fa-bell-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender">Domain Renew Deadline 7 days ahead</li>
									<li class="pull-right notification-time">5 Days Ago</li>
								</ul>
								<p>
									Next 5 July Thursday is the last day
								</p>
							</div>
						</div>
						<div class="alert alert-info clearfix">
							<span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
							<div class="notification-info">
								<ul class="clearfix notification-meta">
									<li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span> send you a mail </li>
									<li class="pull-right notification-time">1 min ago</li>
								</ul>
								<p>
									Urgent meeting for next proposal
								</p>
							</div>
						</div>
						
					</div>
				
				<!--notification end-->
				</div>
			</div>
			<div class="clearfix"> </div>
		</div> --}}

</section>
@endsection