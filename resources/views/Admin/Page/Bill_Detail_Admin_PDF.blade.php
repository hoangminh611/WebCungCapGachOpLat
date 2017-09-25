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
         <br>
        </div>
            Họ Tên:<b>{{$customer[0]->full_name}}</b>
            <br> Địa Chỉ:<b>{{$customer[0]->address}}</b>
            <br> Điện thoại:<b>{{$customer[0]->phone}}</b> 
            <br>Email:<b>{{$customer[0]->email}}</b>
        <div>
          <table id="bill_detail_table"  border="1" class="table" ui-jq="footable">
            <thead>
              <tr>
                <th>Tên sản phẩm</th>
                <th>Kích thước</th>
                <th data-breakpoints="xs">Số Lượng</th>
                <th>Giá Bán</th>
                <th>Giá Tổng</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
              </tr>
            </thead>
            <tbody>
            <?php $tong=0;?>
              @foreach($Bill_Detail as $bill_detail)
                <tr data-expanded="true" id="row{{$bill_detail->id}}">
                  <td>{{$bill_detail->name}}</td>
                  <td>{{$bill_detail->size}}</td>
                  <td>{{number_format($bill_detail->quantity)}}</td>
                  <td>{{number_format($bill_detail->sales_price)}}</td>
                  <td>{{number_format($bill_detail->quantity*$bill_detail->sales_price)}}</td>
                  <td>{{$bill_detail->created_at}}</td>
                  <td>{{$bill_detail->updated_at}}</td>

                </tr> 
                <?php $tong+=($bill_detail->quantity*$bill_detail->sales_price) ?>
              @endforeach
            </tbody>
          </table>
  <center>
      <table class="sumary-table" style="padding-left: 380px; float: right" >

      @if(($bill[0]->discount)!=0)
            @if($tong>=5000000)
                <tr>
                   <th style="">=> Tạm Tính:</th>
                    <td width="152px"  style="color: red">{{number_format($tong*(100-$bill[0]->discount)/100)}} VNĐ(Giảm {{$bill[0]->discount}}) %</td>
                </tr>
                <tr>
                   <th style="">=> Phí vận chuyển:</th>
                    <td width="152px"  style="color: red">0  VND</td>
                </tr>
                @if($tong>=8000000)
                  <tr>
                     <th style="">=> 1 Móc Chìa khóa(Free)</th>
                  </tr>
                @endif
                <tr>
                  <td style=""><h1>Tổng cộng:</h1> </td>
                  <td width="152px"  style="color: red;"><h3 style="">{{number_format($tong)}}VND</h3></td>
                </tr>
            @endif
          @else
            <tr>
              <th style="">=> Tạm Tính:</th>
              <td width="152px"  style="color: red">{{number_format($tong)}} VND</td>
            </tr>
            <tr>
              <th style="">=> Phí vận chuyển:</th>
              @if($tong<5000000)
                <td width="152px"  style="color: red">40,000  VNĐ</td>
              @else
                <td width="152px"  style="color: red">0  VNĐ</td>
              @endif
            </tr>
            <tr>
              <td style=""><h1>Tổng cộng:</h1> </td>
              <td width="152px"  style="color: red;"><h3 style="">{{number_format($tong+40000)}}VND</h3></td>
            </tr>
          @endif
        
      
      </table><br>

  <div style="clear: both;"></div>
      <table style="width: 100%; text-align: center" >
        <tr>
          <td width="500px"></td>
          <td> Ngày {{date("d/m/Y")}} </td>
        </tr>
        <tr>
          <td width="500px" class="customer-title"><strong>Khách hàng</strong></td>
          <td class="writer-title"><strong>Người lập phiếu</strong></td>
        </tr>
        <tr>
          <td>(Ký và ghi rõ họ tên)</td>
          <td class="writer-name"><span>(Ký và ghi rõ họ tên)</span></td>
        </tr>
      </table>
  </center>
</body>
</html>
		
