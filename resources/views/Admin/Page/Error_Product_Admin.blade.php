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
                <th></th>
                <th>ID_export_product</th>
                <th>Sản Phẩm</th>          
                <th>Size</th>
                <th>Giá Bán</th>
                <th>Số Lượng Bán</th>
                <th>Số Lượng Lỗi</th>
                <th data-breakpoints="xs sm md" data-title="Edit">Edit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($export_products as $export_product)
                <tr data-expanded="true">
                  <th></th>
                  <td>{{$export_product->idsize}}</td>
                  <td>{{$export_product->name}}</td>
                   
                  <td>{{$export_product->size}}</td>
                  <td>{{number_format($export_product->export_price)}}</td>
                  <td>{{number_format($export_product->export_quantity)}}</td>
                  <td>{{number_format($export_product->error_quantity)}}</td>
                  <td>
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{ $export_product->idsize }})"></button>
                    {{--  <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row('{{ $type_pro->id}}');"></button> --}}
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
                var  route="{{route('ViewPageError_Product_Update','idsize')}}";
                route=route.replace('idsize',$id);
              window.location.replace(route);
            }

    </script>
</section>
@endsection