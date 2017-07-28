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
          @if(isset($typepro))
            <button id="addRow" onclick="addRow_Id({{$typepro}})"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
          @else
             <button id="addRow" onclick="addRow()"  class=" btn btn-info btn-lg glyphicon glyphicon-plus-sign" style=" border-radius: 10px;"></button>
          @endif
        </div> 
        <div>
          <table id="product_table" class="table" ui-jq="footable" ui-options='{
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
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th data-breakpoints="xs">Mô Tả</th>
                <th>Giá theo kích thước</th>
                <th>Size</th>
                <th>Số Lượng Bán</th>
                <th>Giá Nhập</th>
                <th>Số Lượng Nhập</th>
                <th>Image</th>
                <th>Ngày tạo</th>
                <th data-breakpoints="xs sm md" data-title="DOB">Nhập hàng,thêm kích thước/Edit/Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($product as $pro)
                <tr data-expanded="true" id="row{{$pro->id}}">
                  <td>{{$pro->id}}</td>
                  <td>{{$pro->name}}</td>
                  <td>{{$pro->type_name}}</td>
                  <td>{{$pro->description}}</td>
                  <td>{{number_format($pro->export_price)}}</td>
                  <td><span id="size{{$pro->id}}" value="{{$pro->size}}">{{$pro->size}}</span></td>
                  <td>{{$pro->export_quantity}}</td>
                  <td>{{number_format($pro->import_price)}}</td>
                  <td>{{$pro->import_quantity}}</td>
                  <td><img id="img{{ $pro->id }}" src="images/{{$pro->image}}" style="width: 50px; height: 50px;"></td>
                  <td>{{$pro->created_at}}</td>
                  <td>
                    <button style="border-radius: 10px;" id="edit_button{{ $pro->id  }}" onclick="importRow({{ $pro->id }},'{{$pro->name}}','{{$pro->type_name}}','{{$pro->size}}')">Nhập Hàng hoặc thêm kích thước</button>
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $pro->id  }}" onclick="editRow({{ $pro->id }},'{{$pro->size}}')"></button>
                    <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $pro->id  }}" onclick="delete_row({{ $pro->id}},'{{$pro->size}}');"></button>
                   
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('#product_table').DataTable();
});
            
    function editRow(id,size)
            {
              var  route="{!!route('ViewPage_InsertProduct','id=idloai&size=kichthuoc')!!}";
                route=route.replace('idloai',id);
                route=route.replace('kichthuoc',size);;
              window.location.replace(route);
            }
    function addRow_Id(typepro){
              var  route="{{route('ViewPage_InsertProduct','type=loai')}}";
              route=route.replace('loai',typepro);
              window.location.replace(route);
        
            }
    function addRow(){
              var  route="{{route('ViewPage_InsertProduct')}}";
              window.location.replace(route);
        
            }
    function importRow(id,name,type_name,size)
            {
             var  route="{!!route('ViewPage_ImportProduct','nhaphang=1&id=idname&name=ten&type_name=loai&size=kichthuoc')!!}";
             route=route.replace('idname',id);
              route=route.replace('ten',name);
             route=route.replace('loai',type_name);
             route=route.replace('kichthuoc',size);
              window.location.replace(route);
            }
    function delete_row(id,size)
            {
                ssi_modal.confirm({
                content: 'Bạn có muốn xóa? Nếu xóa sẽ ảnh hưởng tới các bảng sau :import_product,export_product,bill_detail??',
                okBtn: {
                className:'btn btn-primary'
                },
                cancelBtn:{
                className:'btn btn-danger'
                }
                },function (result) 
                    {
                        if(result)
                        {
                            var image = $('#img'+id).attr("src");
                            var route="{{ route('Delete_Product') }}";

                            $.ajax({
                            url:route,
                            type:'get',
                            data:{
                                id:id,
                                size:size,
                                imageFile:image,
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