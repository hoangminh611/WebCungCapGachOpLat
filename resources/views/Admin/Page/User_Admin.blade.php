@if(Auth::User()->group==5)
  @extends('Admin.Master.Admin_Master')
  @section('body')
  <section id="main-content" style="overflow: scroll;">
  	<section class="wrapper">
  		<div class="table-agile-info">
       <div class="panel panel-default">
          <div class="panel-heading">
           Bảng Người DÙng
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

                  <th data-breakpoints="xs"></th>
                  <th>ID</th>
                  <th>Provider_id</th>
                  <th>Provider</th>
                  <th data-breakpoints="xs">Họ Tên</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
                  <th>Địa chỉ</th>
                  <th>Kích họat</th>
                  <th>Phân quyền</th>
                  <th data-breakpoints="xs sm md" data-title="Edit">< /th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                  <tr data-expanded="true">
                    <td></td>
                    <td>{{$user->id}}</td>
                    <td>{{$user->provider_id}}</td>
                    <td>{{$user->provider}}</td>
                    <td>{{$user->full_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->active}}</td>
                    @if($user->group==0)
                      <td>Khách Hàng</td>
                    @elseif($user->group==1)
                      <td>Nhân viên</td>
                    @elseif($user->group==2)
                      <td>Quản Lý Kho</td>
                    @elseif($user->group==5)
                      <td>Admin</td>
                    @endif
                    <td>
                      <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $user->id }})"></button>
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
              function editRow($id){
                  var  route="{{route('ViewPage_Update_User','idtype')}}";
                  route=route.replace('idtype',$id);
                  
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
@else
  <script type="text/javascript">
            alert('Bạn không có quyền truy cập');
            window.location.href = "{{route('Content_Admin')}}";
  </script>
@endif