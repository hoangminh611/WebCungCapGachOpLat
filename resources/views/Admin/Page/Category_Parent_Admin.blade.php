@if(isset($staff) && $staff->category_permission === 1)
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
              @if($type==2)
                <button id="addRow" onclick="addRow()"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
              @else
                <button id="addRow" onclick="addRow_Type_Category()"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
              @endif
          </div> 
          <div>
              <table id="category_table" class="table" ui-jq="footable" ui-options='{
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
                    <th data-breakpoints="xs">ID</th>
                    <th>Tên Loại</th>
                    <th data-breakpoints="xs">Mô Tả</th>
                    <th>Type</th>
                    <th>Ngày tạo</th>
                    <th>Ngày update</th>
                    <th data-breakpoints="xs sm md" data-title="Sửa/Xóa">Sửa/Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($Type_Product as $type_pro)
                    <tr data-expanded="true" id="row{{$type_pro->id}}"> 
                      <td>{{$type_pro->id}}</td>
                      <td>{{$type_pro->name}}</td>
                      <td>{!!$type_pro->description!!}</td>
                      <td>{{$type_pro->type}}</td>
                     {{--  <td><img src="images/category/{{$type_pro->image}}" alt="{{$type_pro->image}}" style="width: 50px; height: 50px;"></td> --}}
                      <td>{{$type_pro->created_at}}</td>
                      <td>{{$type_pro->updated_at}}</td>
                      <td>
                       <form action="" method="post" id="form{{$type_pro->id}}">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="id" value="{{$type_pro->id}}"> 
                          @if($type==2)
                            <button type="button" class="btn btn-info btn-lg glyphicon glyphicon-hand-right edit_button" style="border-radius: 10px;" id="edit_button{{ $type_pro->id  }}" onclick="editRow({{ $type_pro->id }})"></button>

                            <button type="button" class="btn btn-warning btn-lg glyphicon glyphicon-trash delete_button" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row('{{ $type_pro->id}}');"></button>
                          @else
                            <button type="button" class="btn btn-info btn-lg glyphicon glyphicon-hand-right edit_button" style="border-radius: 10px;" id="edit_button{{ $type_pro->id  }}" onclick="editRow_category({{ $type_pro->id }})"></button>
                           
                            <button  type="button" class="btn btn-warning btn-lg glyphicon glyphicon-trash delete_button" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row_category('{{ $type_pro->id}}');"></button>
                            
                          @endif
                      </form>
                      </td>
                        
                        @if(Auth::User()->group<2)
                          <script type="text/javascript">
                            $('#addRow').attr('disabled','true');
                            $('.delete_button').attr('disabled','true');
                            $('.edit_button').attr('disabled','true');
                          </script>
                        @elseif(Auth::User()->group==2)
                          <script type="text/javascript">
                            $('#addRow').attr('disabled','true');
                            $('.delete_button').attr('disabled','true');
                          </script>
                        @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </section>
    <script type="text/javascript">
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $(document).ready(function(){
                $('#category_table').DataTable();
              });
              function editRow($id){
                  var  route="{{route('Insert_Type_News','id=idtype')}}";
                  route=route.replace('idtype',$id)
                window.location.replace(route);
              }
              function addRow(){
                  var  route="{{route('Insert_Type_News')}}";
                window.location.replace(route);
          
              }

              function addRow_Type_Category(){
                var route="{{route('ViewPage_InsertCategory')}}";
                window.location.replace(route);
              }
              function editRow_category($id){
                  var  route="{{route('ViewPage_InsertCategory','id=idtype')}}";
                  route=route.replace('idtype',$id)
                window.location.replace(route);
              }
              function delete_row(id)
              {
                  ssi_modal.confirm({
                  content: 'Bạn có muốn xóa loại này nếu xóa loại này sẽ ảnh hưởng tới bảng news?',
                  okBtn: {
                  className:'btn btn-primary'
                  },
                  cancelBtn:{
                  className:'btn btn-danger'
                  }
                  },function (result) {
                      if(result)
                      {
                          // var image = $('#img'+id).attr("src");
                          var route="{{ route('DeleteTypeNews') }}";
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
              function delete_row_category(id)
              {

                  ssi_modal.confirm({
                  content: 'Bạn có muốn xóa loại cha sẽ làm mất tất cả các loại con cùng các product?',
                  okBtn: {
                  className:'btn btn-primary'
                  },
                  cancelBtn:{
                  className:'btn btn-danger'
                  }
                  },function (result) {
                      if(result)
                      {
                          // var image = $('#img'+id).attr("src");
                          var route="{{ route('Delete_Category_Parent') }}";
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