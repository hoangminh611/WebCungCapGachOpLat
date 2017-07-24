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
            <button id="addRow" onclick="addRow()"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
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
                <th data-breakpoints="xs">ID</th>
                <th>USER</th>
                <th data-breakpoints="xs">IMAGE</th>
                <th>TITLE</th>
                <th>DESCRIPTION</th>
                <th>CONTENT</th>
                <th>CATEGORY ID NEWS</th>
                <th data-breakpoints="xs sm md" data-title="DOB">Edit/Delete</th>
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
                                <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $new->id  }}" onclick="delete_row('{{ $new->id  }}');"></button>
                            </td>
                        </div>
                    </tr>     
                @endforeach
            </tbody>
          </table>
           <div>{{  $news->links() }}</div>
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
            
            function editRow($id){
                var  route="{{route('InsertNews','id=idnews')}}";
                route=route.replace('idnews',$id)
              window.location.replace(route);
            }
            function addRow(){
                var  route="{{route('InsertNews')}}";
              window.location.replace(route);
        
            }

            function delete_row(id)
            {
                ssi_modal.confirm({
                content: 'Are you sure you want to exit?',
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