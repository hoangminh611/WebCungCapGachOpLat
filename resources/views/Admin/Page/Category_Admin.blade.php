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
            <button id="addRow" onclick="addRow({{$name_parent[0]->id}})"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
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
                <th>Loại cha</th>
                <th>Image</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
                <th data-breakpoints="xs sm md" data-title="DOB">Edit/Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($Type_Product as $type_pro)
                <tr data-expanded="true" id="row{{$type_pro->id}}">
                  <td>{{$type_pro->id}}</td>
                  <td>{{$type_pro->name}}</td>
                  <td>{!!$type_pro->description!!}</td>
                  <td>{{$name_parent[0]->name}}</td>
                  <td><img src="images/{{$type_pro->image}}" alt="{{$type_pro->image}}" style="width: 50px; height: 50px;"></td>
                  <td>{{$type_pro->created_at}}</td>
                  <td>{{$type_pro->updated_at}}</td>
                  <td>
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $type_pro->id  }}" onclick="editRow({{ $type_pro->id }},{{$name_parent[0]->id}})"></button>
                    <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row('{{ $type_pro->id}}');"></button>
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
              $('#category_table').DataTable();
});
            function editRow($id,$idtype){
                var  route="{!!route('ViewPage_InsertCategory',['id=idtype','khongcocha=idcha'])!!}";
                route=route.replace('idtype',$id);
                 route=route.replace('idcha',$idtype);
              window.location.replace(route);
            }
            function addRow($idtype){
                  var  route="{!!route('ViewPage_InsertCategory','khongcocha=idcha')!!}";
                 route=route.replace('idcha',$idtype);
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
                        var route="{{route('Delete_Category_Child')}}";
                        $.ajax({
                            url:route,
                            type:'get',
                            data:{
                                id:id,
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