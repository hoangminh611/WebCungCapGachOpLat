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
                <th>Chi Tiết</th>
                <th data-breakpoints="xs">ID</th>
                <th>Customer</th>
                <th data-breakpoints="xs">Tình Trang</th>
                <th>Ghi chú</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
                <th data-breakpoints="xs sm md" data-title="DOB">Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($Bill as $bill)
                <tr data-expanded="true">
                  <td><a href="{{route('ViewPageBill_Detail_Admin',[$bill->id,$bill->id_customer])}}">Xem Chi Tiết</a></td>
                  <td>{{$bill->id}}</td>
                  <td>{{$bill->full_name}}</td>
                  <td>{{$bill->method}}</td>
                  <td>{{$bill->note}}</td>
                  <td>{{$bill->created_at}}</td>
                  <td>{{$bill->updated_at}}</td>
                  <td>
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $bill->id }},'{{$bill->full_name}}')"></button>
                     {{-- <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row('{{ $type_pro->id}}');"></button> --}}
                  </td>
                </tr> 
              @endforeach
            </tbody>
          </table>
{{--  <div>{{$Type_Product->links()}}</div> --}}
      </div>
  </div>
</div>
 <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function(){
              $('#bill_table').DataTable();
            });
            function editRow($id,$user){
                var  route="{{route('ViewPageBill_Admin_Insert',['idtype','nameuser'])}}";
                route=route.replace('idtype',$id);
                route=route.replace('nameuser',$user);
                
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