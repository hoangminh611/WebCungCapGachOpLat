@if(isset($staff) && $staff->banner_permission === 1)
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
                      <th>Hình</th>
                      <th>Đường Dẫn</th>
                      <th>Ẩn/Hiện</th>
                      <th data-breakpoints="xs sm md" data-title="Edit/Delete">Edit/Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($slides as $slide)
                      <tr data-expanded="true" id="row{{$slide->id}}">
                        <td></td>
                        <td>{{$slide->id}}</td>
                        <td><img src="images/Banner/{{$slide->hinh}}" width="200px" height="200px"></td>
                        <td>{{$slide->url}}</td>
                        @if($slide->show == 0)
                        	<td>Ẩn</td>
                        @elseif($slide->show == 1)
                        	<td>Hiện</td>
                        @endif
                        <td>
                          <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{$slide->id}})"></button>
                          <form id="form{{$slide->id}}"  method="post" >
                          	  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    	                      <input type="hidden" name="id" value="{{$slide->id}}">
    	                      <button type="button" class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" onclick="delete_row('{{$slide->id}}');"></button>
                           </form>
                        </td>
                      </tr> 
                    @endforeach
                  </tbody>
                </table>
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
                        var  route="{{route('View_PageSlide_Admin_Insert','id=idtype')}}";
                        route=route.replace('idtype',$id);
                        
                      window.location.replace(route);
                    }
                    function addRow(){
                        var  route="{{route('View_PageSlide_Admin_Insert')}}";
                      window.location.replace(route);
                    }
                    // function addRow($idtype){
                    //       var  route="";
                    //      route=route.replace('idcha',$idtype);
                    //       window.location.replace(route);
                
                    // }

                    function delete_row(id)
                    {
                        ssi_modal.confirm({
                        content: 'Bạn Chắc Chắn Muốn Xóa.Nếu Đã Xóa sẽ không thể phục hồi?',
                        okBtn: {
                        className:'btn btn-primary'
                        },
                        cancelBtn:{
                        className:'btn btn-danger'
                        }
                        },function (result) {
                            if(result)
                            {
                                var route="{{route('deleteSlide')}}";
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
    </section>
  @endsection
@else
  <script type="text/javascript">
    alert('Bạn không có quyền truy cập');
    window.location.href = "{{route('Content_Admin')}}";
  </script>
@endif