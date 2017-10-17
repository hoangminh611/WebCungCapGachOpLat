@if(Auth::User()->group==5)
  @extends('Admin.Master.Admin_Master')
  @section('body')
  <section id="main-content" style="overflow: scroll;">
  	<section class="wrapper">
  		<div class="table-agile-info">
       <div class="panel panel-default">
          <div class="panel-heading">
           Bảng Chi tiết giảm gía
          </div>
            <div>
              <button id="addRow" onclick="addRow()"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
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
                  <th>Tên Quà Tặng</th>
                  <th>Giá Tiền Của Quà</th>
                  <th data-breakpoints="xs sm md" data-title="Edit/Delete"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($getGifts as $getGift)
                  <tr data-expanded="true" id="row{{$getGift->id}}">
                    <td></td>
                    <td>{{$getGift->id}}</td>
                    <td>{{$getGift->name_gift}}</td>
                    <td>{{number_format($getGift->price_gift)}}</td>
                    <td>
                      <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{$getGift->id}})"></button>
                      <form id="form{{$getGift->id}}"  method="post" >
                      	  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                      <input type="hidden" name="id" value="{{$getGift->id}}">
	                      <button type="button" class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" onclick="delete_row('{{$getGift->id}}');"></button>
                       </form>
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
                  var  route="{{route('Gift_Insert_Admin','id=idtype')}}";
                  route=route.replace('idtype',$id);
                  
                window.location.replace(route);
              }
              function addRow(){
                  var  route="{{route('Gift_Insert_Admin')}}";
                window.location.replace(route);
              }


              function delete_row(id)
              {
                  ssi_modal.confirm({
                  content: 'Xóa sẽ ảnh hưởng tới bảng product ,bill_detail,export,import product?',
                  okBtn: {
                  className:'btn btn-primary'
                  },
                  cancelBtn:{
                  className:'btn btn-danger'
                  }
                  },function (result) {
                      if(result)
                      {
                          var route="{{route('Delete_Gift')}}";
                          $.ajax({
                              url:route,
                              type:'post',
                              data:$('#form'+id).serialize(),
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
@else
  <script type="text/javascript">
            alert('Bạn không có quyền truy cập');
            window.location.href = "{{route('Content_Admin')}}";
  </script>
@endif