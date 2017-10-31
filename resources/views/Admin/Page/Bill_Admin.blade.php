@if(isset($staff) && $staff->bill_permission === 1)
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
                    <th>Chi Tiết</th>
                    <th data-breakpoints="xs">ID</th>
                    <th>Khách hàng</th>
                    <th data-breakpoints="xs">Tình Trạng</th>
                    <th>Ghi chú</th>
                    <th>Ngày tạo</th>
                    <th>Ngày update</th>
                    <th>Thanh Toán Trực Tuyến</th>
                    <th data-breakpoints="xs sm md" data-title="Sửa">Sửa</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($Bill as $bill)
                    <tr data-expanded="true">
                      <td><a href="{{route('ViewPageBill_Detail_Admin',[$bill->id,$bill->id_customer,$bill->method])}}">Xem Chi Tiết</a></td>
                      <td>{{$bill->id}}</td>
                      <td>{{$bill->full_name}}</td>
                      @if($bill->method=="Chưa Xác Nhận")
                        <td style="color: red">{{$bill->method}}</td>
                      @elseif($bill->method=="Đã Xác Nhận Chưa Thanh Toán")
                        <td style="color: blue">{{$bill->method}}</td>
                      @elseif($bill->method=="Đang Xử Lý")
                         <td style="color: green">{{$bill->method}}</td>
                      @elseif($bill->method=="Đang vận chuyển")
                         <td style="color: yellow">{{$bill->method}}</td>
                      @elseif($bill->method=="Đã Thanh Toán")
                           <td>{{$bill->method}}</td>
                      @endif
                      <td>{{$bill->note}}</td>
                      <td>{{$bill->created_at}}</td>
                      <td>{{$bill->updated_at}}</td>
                      @if($bill->pay_online === 1)
                        <td style="color: red">Đã Thanh Toán Trực Tuyến</td>
                      @elseif($bill->pay_online === 0)
                        <td>Gửi Hàng Thanh Toán </td>
                      @endif
                      <td>
                        <button class="btn btn-info btn-lg glyphicon glyphicon-hand-right edit_button" id="{{$bill->id}}" style="border-radius: 10px;" onclick="editRow({{ $bill->id }},'{{$bill->full_name}}')"></button>
                          @if(Auth::User()->group<2)
                              <script type="text/javascript">
                                $(document).ready(function(){

                                  var method="{{$bill->method}}";
                                  if(method=="Đã Xác Nhận Chưa Thanh Toán")
                                    $('#'+{{$bill->id}}).attr('disabled','');
                                  if(method=="Đang Xử Lý")
                                    $('#'+{{$bill->id}}).attr('disabled','');
                                  if(method=="Đã Thanh Toán")
                                    $('#'+{{$bill->id}}).attr('disabled','');
                                });
                              </script>
                          @endif
                           @if(Auth::User()->group==2)
                              <script type="text/javascript">
                                $(document).ready(function(){

                                  var method="{{$bill->method}}";
                                  if(method=="Đang vận chuyển")
                                    $('#'+{{$bill->id}}).attr('disabled','');
                                  if(method=="Đã Thanh Toán")
                                    $('#'+{{$bill->id}}).attr('disabled','');
                                  if(method=="Chưa Xác Nhận")
                                    $('#'+{{$bill->id}}).attr('disabled','');
                                  
                                });
                              </script>
                          @endif
                         {{-- <button class="btn btn-warning btn-lg glyphicon glyphicon-trash" style="border-radius: 10px" id="delete_button{{ $type_pro->id  }}" onclick="delete_row('{{ $type_pro->id}}');"></button> --}}
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
                function editRow($id,$user){
                    var  route="{{route('ViewPageBill_Admin_Insert',['idtype','nameuser'])}}";
                    route=route.replace('idtype',$id);
                    route=route.replace('nameuser',$user);
                    
                  window.location.replace(route);
                }
                // function addRow($idtype){
                //       var  route="";
                //      route=route.replace('idcha',$idtype);
                //       window.location.replace(route);
            
                // }
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