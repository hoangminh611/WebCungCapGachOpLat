@extends('Admin.Master.Admin_Master')
@section('body')
<section id="main-content" style="overflow: scroll;">
	<section class="wrapper">
		<div class="table-agile-info">
     <div class="panel panel-default">
        <div class="panel-heading">
         Basic table
        </div>
          <div>
          {{--   <button id="addRow" onclick="addRow({{$name_parent[0]->id}})"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button> --}}
        </div> 
        <div>
          <table class="table" ui-jq="footable" ui-options='{
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
                <th>Product</th>
                <th>Size</th>
                <th data-breakpoints="xs">Quantity</th>
                <th>Giá Bán</th>
                <th>Giá Tổng</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
                <th data-breakpoints="xs sm md" data-title="DOB">Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($Bill_Detail as $bill_detail)
                <tr data-expanded="true">
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
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill_detail->id }},{{$bill_detail->quantity}},'{{$bill_detail->name}}')"></button>
                     {{-- <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row('{{ $type_pro->id}}');"></button> --}}
                  </td>
                </tr> 
              @endforeach
            </tbody>
          </table>
 			<div>{{$Bill_Detail->links()}}</div>
      </div>
  </div>
</div>
 <script type="text/javascript">
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            
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

            // function delete_row(id)
            // {
            //     ssi_modal.confirm({
            //     content: 'Xóa sẽ ảnh hưởng tới bảng product ,bill_detail,export,import product?',
            //     okBtn: {
            //     className:'btn btn-primary'
            //     },
            //     cancelBtn:{
            //     className:'btn btn-danger'
            //     }
            //     },function (result) {
            //         if(result)
            //         {
            //             var route="{{route('Delete_Category_Child')}}";
            //             $.ajax({
            //                 url:route,
            //                 type:'get',
            //                 data:{
            //                     id:id,
            //                 },
            //                 success:function() {  
            //                      $('#row'+id).hide();
            //                     alert('Xóa thành công');
            //                 }
            //             });
            //         }
            //         else
            //             ssi_modal.notify('error', {content: 'Result: ' + result});
            //     }
            // );
            // }

    </script>
</section>
@endsection