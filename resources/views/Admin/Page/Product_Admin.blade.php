@if(isset($staff) && $staff->product_permission === 1)
  @extends('Admin.Master.Admin_Master')
  @section('body')
    <section id="main-content" style="overflow: scroll;">
    	<section class="wrapper">
    		<div class="table-agile-info">
          <div class="panel panel-default">
              <div class="panel-heading">
               SẢN PHẨM ĐANG ĐƯỢC BÁN
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
                      <th>Kích thước</th>
                      <th>Số Lượng Bán</th>
                      <th>Hình ảnh</th>
                      <th data-breakpoints="xs sm md" data-title="Nhập Hàng/Sửa/Xóa">Nhập hàng,thêm kích thước/Sửa/Xóa</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach($product as $pro)
                      <tr data-expanded="true" id="row{{$pro->id}}{{$pro->size}}">
                        <td>{{$pro->id}}</td>
                        <td>{{$pro->name}}</td>
                        <td>{{$pro->type_name}}</td>
                        <td>{!!$pro->description!!}</td>
                        <td>{{number_format($pro->export_price)}}</td>
                        <td><span id="size{{$pro->id}}" value="{{$pro->size}}">{{$pro->size}}</span></td>
                        <td>{{$pro->export_quantity}}</td>
                        <td><img id="img{{ $pro->id }}" src="images/{{$pro->image}}" style="width: 50px; height: 50px;"></td>
                        <td>

                          <form method="post"  id="form{{$pro->id}}{{$pro->size}}" action="{{route('ViewPage_ImportProduct')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="nhaphang" value="1">
                            <input type="hidden" name="id" value="{{$pro->id}}">
                            <input type="hidden" name="name" value="{{$pro->name}}">
                            <input type="hidden" name="type_name" value="{{$pro->type_name}}">
                            <input type="hidden" name="size" value="{{$pro->size}}">
                            <button style="border-radius: 10px;"  class="import_edit_button" id="edit_button{{ $pro->id  }}" type="submit">Nhập Hàng hoặc thêm kích thước</button>
                          </form>

                            <button  class="btn btn-info btn-lg glyphicon glyphicon-hand-right edit_button" style="border-radius: 10px;" id="edit_button{{ $pro->id  }}" onclick="editRow({{ $pro->id}},'{{$pro->size}}')"></button>

                            <button  type="button" class="btn btn-warning btn-lg glyphicon glyphicon-trash delete_button" style="border-radius: 10px" id="delete_button{{ $pro->id  }}" onclick="delete_row({{ $pro->id}},'{{$pro->size}}');"></button>
                        </td>

                          @if(Auth::User()->group != 5)
                                 <script type="text/javascript">
                                   $('#addRow').attr('disabled','true');
                                   $('.delete_button').attr('disabled','true');
                                   $('.edit_button').attr('disabled','true');
                                   $('.import_edit_button').attr('disabled','true');
                                 </script>
                          @endif
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
                    
          function editRow(id,size){
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
          function delete_row(id,size){
            var form=$('#form'+id+size).serialize();

            ssi_modal.confirm({
            content: 'Bạn có muốn xóa? Nếu xóa hàng sẽ mất luôn nếu muốn khôi phục phãi vào database để sửa',
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
                        var route="{{route('Delete_Product')}}";
                        $.ajax({
                        url:route,
                        type:'post',
                        data: form,
                        success:function(result) {  
                             $('#row'+id+size).hide();
                            alert("Xóa thành công");
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