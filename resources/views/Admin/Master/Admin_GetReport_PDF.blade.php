<!DOCTYPE html>
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>In hóa đơn</title>
    <style>
      body{
        font-family: DejaVu Sans, sans-serif, font-size: 12px;
      }
    </style>
</head>
<body>
<h1>BÁO CÁO THỐNG KÊ LỜI LỖ TẤT CẢ CÁC SẢN PHẨM</h1>
<table id="bill_table" class="table" ui-jq="footable" border="1">
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
</body>