@if(isset($staff) && $staff->discount_permission === 1)
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
                  <th>Mức Để Giảm Giá</th>
                  <th>Quà Tặng</th>
                  <th data-breakpoints="xs">Phần Trăm Giảm giá</th>
                  <th>Tiền Vận chuyển</th>
                  <th data-breakpoints="xs sm md" data-title="Edit/Delete"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($discounts as $discount)
                  <tr data-expanded="true" id="row{{$discount->id}}">
                    <td></td>
                    <td>{{$discount->id}}</td>
                    <td>{{$discount->price_discount}}</td>
                    <td>{{$discount->name_gift}}</td>
                    <td>{{$discount->percent_discount}}</td>
                    <td>{{$discount->ship_price}}</td>
                    <td>
                      <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right" style="border-radius: 10px;" onclick="editRow({{$discount->id}})"></button>
                      <form id="form{{$discount->id}}"  method="post" >
                      	  	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                      <input type="hidden" name="id" value="{{$discount->id}}">
	                      <button type="button" class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" onclick="delete_row('{{$discount->id}}');"></button>
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
                  var  route="{{route('Discount_Insert_Admin','id=idtype')}}";
                  route=route.replace('idtype',$id);
                  
                window.location.replace(route);
              }
              function addRow(){
                  var  route="{{route('Discount_Insert_Admin')}}";
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
                          var route="{{route('Delete_Discount')}}";
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