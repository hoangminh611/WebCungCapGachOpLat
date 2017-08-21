@extends('Admin.Master.Admin_Master')
@section('body')
<section id="main-content" style="overflow: scroll;">
	<section class="wrapper">
		<div class="table-agile-info">
     <div class="panel panel-default">
        <div class="panel-heading">
         Bill_Detail
         <br>
        </div>
            Họ Tên:<b>{{$customer[0]->full_name}}</b>
            <br> Địa Chỉ:<b>{{$customer[0]->address}}</b>
            <br> Điện thoại:<b>{{$customer[0]->phone}}</b> 
            <br>Email:<b>{{$customer[0]->email}}</b>
          <div>
          {{--   <button id="addRow" onclick="addRow({{$name_parent[0]->id}})"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button> --}}
        </div> 
        <div>
          <table id="bill_detail_table" class="table" ui-jq="footable" ui-options='{
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
                <th data-breakpoints="xs">ID_bill</th>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Kích thước</th>
                <th data-breakpoints="xs">Số Lượng</th>
                <th>Giá Bán</th>
                <th>Giá Tổng</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
                <th data-breakpoints="xs sm md" data-title="Sửa/Xóa">Sửa/Xóa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($Bill_Detail as $bill_detail)
                <tr data-expanded="true" id="row{{$bill_detail->id}}">
                	<td>{{$bill_detail->id_bill}}</td>
                  <td>{{$bill_detail->id}}</td>
                  <td>{{$bill_detail->name}}</td>
                  <td>{{$bill_detail->size}}</td>
                  <td>{{number_format($bill_detail->quantity)}}</td>
                  <td>{{number_format($bill_detail->sales_price)}}</td>
                  <td>{{number_format($bill_detail->quantity*$bill_detail->sales_price)}}</td>
                  <td>{{$bill_detail->created_at}}</td>
                  <td>{{$bill_detail->updated_at}}</td>
                  <td>
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right edit_button" style="border-radius: 10px;" onclick="editRow({{ $bill_detail->id }},{{$bill_detail->quantity}},'{{$bill_detail->name}}')"></button>
                     <button class="btn btn-warning btn-lg glyphicon glyphicon-trash delete_button" style="border-radius: 10px" id="delete_button{{ $bill_detail->id  }}" onclick="delete_row({{$bill_detail->id}},{{ $bill_detail->id_product}},'{{$bill_detail->size}}',{{$bill_detail->quantity}});"></button>
                      @if(Auth::User()->group<2)
                           <script type="text/javascript">
                             $(document).ready(function(){
                                $('#bill_detail_table').DataTable();
                                var method="{{$method}}";
                                if(method=="Đã Xác Nhận Chưa Thanh Toán"||method=="Đã Thanh Toán")
                                {
                                  $('.delete_button').attr('disabled','');
                                  $('.edit_button').attr('disabled','');
                                }

                              });
                           </script>
                      @endif
                  </td>
                </tr> 
              @endforeach
            </tbody>
          </table>
          <a href="{{route('downloadPDF',[$customer[0]->id,$idhoadon])}}">Xuất file PDF</a>
      </div>
  </div>
</div>
 <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            function editRow(id,quantity,name_product){
                var  route="{{route('ViewPageBill_Detail_Admin_Insert',['idbill_detail','soluong','name'])}}";
                route=route.replace('idbill_detail',id);
                route=route.replace('soluong',quantity);
                route=route.replace('name',name_product);
              	window.location.replace(route);
            }
            // function addRow($idtype){
            //       var  route="";
            //      route=route.replace('idcha',$idtype);
            //       window.location.replace(route);
        
            // }

            function delete_row(id,id_product,size,quantity)
            {
                ssi_modal.confirm({
                content: 'Xóa sẽ ảnh hưởng tới bảng export_product,bill_detail,bill?',
                okBtn: {
                className:'btn btn-primary'
                },
                cancelBtn:{
                className:'btn btn-danger'
                }
                },function (result) {
                    if(result)
                    {
                        var route="{{route('Delete_Bill_Detail')}}";
                        $.ajax({
                            url:route,
                            type:'get',
                            data:{
                                id:id,
                                id_product:id_product,
                                size:size,
                                quantity:quantity,
                            },
                            success:function() {  
                                 $('#row'+id).hide();
                                alert('Xóa thành công');
                            }
                        });
                    }
                    else
                        ssi_modal.notify('error', {content: 'Result: ' + result});
                }
            );
            }

    </script>
</section>
@endsection