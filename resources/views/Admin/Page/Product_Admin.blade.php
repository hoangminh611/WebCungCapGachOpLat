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
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th data-breakpoints="xs">Mô Tả</th>
                <th>Giá trưng bày</th>
                <th>Giá theo kích thước</th>
                <th>Size</th>
                <th>Image</th>
                <th>Ngày tạo</th>
                <th>Ngày update</th>
                <th data-breakpoints="xs sm md" data-title="DOB">Edit/Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach($product as $pro)
                <tr data-expanded="true">
                  <td>{{$pro->id}}</td>
                  <td>{{$pro->name}}</td>
                  <td>{{$pro->type_name}}</td>
                  <td>{{$pro->description}}</td>
                  <td>{{number_format($pro->unit_price)}}</td>
                  <td>{{number_format($pro->export_price)}}</td>
                  <td>{{$pro->size}}</td>
                  <td><img src="images/{{$pro->image}}" style="width: 50px; height: 50px;"></td>
                  <td>{{$pro->created_at}}</td>
                  <td>{{$pro->updated_at}}</td>
                  <td>
                    <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" id="edit_button{{ $pro->id  }}" onclick="editRow({{ $pro->id }})"></button>
                    <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $pro->id  }}" onclick="delete_row('{{ $pro->id}}');"></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div>{{$product->links()}}</div>
      </div>
  </div>
</div>
</section>
@endsection