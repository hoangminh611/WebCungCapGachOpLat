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
        @if(isset($idloainew))
            <button id="addRow" onclick="addRow_ID({{$idloainew}})"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
        @else
            <button id="addRow" onclick="addRow()"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
        @endif
        </div> 
        <div>
          <table id="new_table" class="table" ui-jq="footable" ui-options='{
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
                <th>Người đăng tin</th>
                <th data-breakpoints="xs">Hình ãnh</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Nội dung</th>
                <th>Loại tin tức</th>
                <th data-breakpoints="xs sm md" data-title="Sửa/Xóa">Sửa/Xóa</th>
              </tr>
            </thead>
           <tbody>
                @foreach($news as $new)
                    <tr id="row{{$new->id }}">
                        <div id="row1{{$new->id }}">
                            <td id="id{{$new->id }}">{{$new->id }}</td>
                            <td id="id_user{{$new->id }}">{{$new->full_name }}</td>
                            <td id="image{{$new->id}}"><img id="img{{$new->id}}" src="images/news/{{$new->image}}" style="width: 100px; height: 100px"></td>
                            <td id="title{{ $new->id }}">{{ $new->title }}</td>
                            <td id="description{{ $new->id }}"><div>{{$new->description}}</div></td>
                       	    <td id="content{{ $new->id }}">{!!html_entity_decode($new->content)!!}</td>
                            <td id="category_id{{ $new->id }}">{{$new->type_name}}</td>
                            <td>
                                <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $new->id  }}" onclick="editRow({{ $new->id }})"></button>
                                <button class="btn btn-warning btn-lg glyphicon glyphicon-trash delete_button" style="border-radius: 10px" id="delete_button{{ $new->id  }}" onclick="delete_row('{{ $new->id  }}');"></button>
                            </td>
                            @if(Auth::User()->group<2)
                               <script type="text/javascript">
                                 $('.delete_button').attr('disabled','true');
                               </script>
                             @endif
                        </div>
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
                $('#new_table').DataTable();
            });
            function editRow($id){
                var  route="{{route('InsertNews','id=idnews')}}";
                route=route.replace('idnews',$id)
              window.location.replace(route);
            }
            function addRow(){
                var  route="{{route('InsertNews')}}";
              window.location.replace(route);
        
            }
            function addRow_ID(idloainew)
            {
                var  route="{{route('InsertNews','idTypenew=idloai')}}";
                route=route.replace('idloai',idloainew);
              window.location.replace(route);
            }
            function delete_row(id)
            {
                ssi_modal.confirm({
                content: 'Bạn có chắc chắn xóa tin.Hãy kiểm tra kỹ để tránh sai sót?',
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
                        var route="{{ route('DeleteNews') }}";
                        $.ajax({
                            url:route,
                            type:'get',
                            data:{
                                id:id,
                                // imageFile:image,
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
@endsection