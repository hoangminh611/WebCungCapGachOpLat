@if(isset($staff) && $staff->user_permission === 1)
  @extends('Admin.Master.Admin_Master')
  @section('body')
    <section id="main-content">
      <section class="wrapper">
      <div class="form-w3layouts">
          <!-- page start-->
          <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Update User
                    </header>
                    <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_User')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ $user[0]->id }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Họ Tên</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$user[0]->full_name}}" name="user" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-6">
                                         <input type="text" value="{{$user[0]->email}}" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Điện thoại</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" value="{{$user[0]->phone}}" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Địa Chỉ</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="address" value="{{$user[0]->address}}" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Kích hoạt</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="active" value="{{$user[0]->active}}" disabled="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Phân quyền</label>
                                    <div class="col-sm-6">
                                        <select id="group" name="group">
                                            <option id="0" value="0">Khách Hàng</option>
                                            <option id="1" value="1">Nhân Viên</option>
                                            <option id="2" value="2">Quản Lý Kho</option>
                                            <option id="5" value="5">Admin</option>
                                        </select>
                                        <script type="text/javascript">
                                            var group={{$user[0]->group}};
                                            $('#'+group).attr('selected','selected');
                                        </script>                                      
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Quyền Hạn</label>
                                    <div class="col-sm-6">
                                      <table id="permission" hidden="">
                                        <tr>
                                          <td><label>
                                          <input type="checkbox" id="banner" name="banner" value="1">Quản Lý slide
                                          </label></td>       
                                          <td><label >
                                          <input type="checkbox" id="product" name="product" value="1">Quản Lý sản phẩm
                                          </label></td>
                                          <td><label >
                                          <input type="checkbox" id="category" name="category" value="1">Quản Lý loại
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td><label >
                                          <input type="checkbox" id="user" name="user" value="1">Quản Lý user
                                          </label></td>  
                                          <td><label >
                                          <input type="checkbox" id="bill" name="bill" value="1">Quản Lý hóa đơn
                                          </label></td>
                                          <td><label >
                                          <input type="checkbox" id="history" name="history" value="1">Xem lịch sử nhập hàng
                                          </label></td>
                                        </tr> 
                                        <tr>
                                          <td><label >
                                          <input type="checkbox" id="errorProduct" name="errorProduct" value="1">Quản Lý hàng lỗi
                                          </label></td>  
                                          <td><label >
                                          <input type="checkbox" id="discount" name="discount" value="1">Quản Lý giảm giá
                                          </label></td>
                                          <td><label >
                                          <input type="checkbox" id="gift" name="gift" value="1">Quản lý quá tặng kèm
                                          </label></td>
                                        </tr>
                                        <tr>
                                          <td><label >
                                          <input type="checkbox" id="news" name="news" value="1">Quản lý tin tức
                                          </label></td>
                                        </tr> 
                                      </table>                            
                                    </div>
                                </div>
                                <button type="submit"  class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                    </div>
                </section>

            </div>
        </div>
          <!-- page end-->
      </div>
      <script type="text/javascript">
        @if($user[0]->group != 0){
           $('#permission').show();
        }
        @endif
        $('#group').change(function(){
          $('#banner').attr('checked',false);
          $('#product').attr('checked',false);
          $('#category').attr('checked',false);
          $('#bill').attr('checked',false);
          $('#user').attr('checked',false);
          $('#history').attr('checked',false);
          $('#errorProduct').attr('checked',false);
          $('#discount').attr('checked',false);
          $('#gift').attr('checked',false);
          $('#news').attr('checked',false);

          if($('#group option:selected').val()!= 0 ) {
            $('#permission').show();
          }
          else {
            $('#permission').hide();
          }
        });


        @if(isset($staffPermission[0]->banner_permission) && $staffPermission[0]->banner_permission === 1) {
          $('#banner').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->product_permission) && $staffPermission[0]->product_permission === 1) {
          $('#product').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->category_permission) && $staffPermission[0]->category_permission === 1) {
          $('#category').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->bill_permission) && $staffPermission[0]->bill_permission === 1) {
          $('#bill').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->user_permission) && $staffPermission[0]->user_permission === 1) {
          $('#user').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->import_product_permission) && $staffPermission[0]->import_product_permission === 1) {
          $('#history').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->error_product_permission) && $staffPermission[0]->error_product_permission === 1) {
          $('#errorProduct').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->discount_permission) && $staffPermission[0]->discount_permission === 1) {
          $('#discount').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->gift_permission) && $staffPermission[0]->gift_permission === 1) {
          $('#gift').attr('checked','checked');
        }
        @endif

        @if(isset($staffPermission[0]->news_permission) && $staffPermission[0]->news_permission === 1) {
          $('#news').attr('checked','checked');
        }
        @endif

          // function submit_form()
          //       {
          //           var frm=$('#edit-form')[0];//cái này tương đương với document.getelementbyid
          //           ssi_modal.confirm({
          //           content: 'Xin Hãy Kiểm tra kỹ càng trước khi save nếu bi sai sót có thể sẽ gây ra lỗi đáng tiếc',
          //           okBtn: {
          //           className:'btn btn-primary'
          //           },
          //           cancelBtn:{
          //           className:'btn btn-danger'
          //           }
          //           },function (result) 
          //               {
          //                   if(result)
          //                   {
          //                       frm.submit();
          //                    }
          //                   else
          //                       ssi_modal.notify('error', {content: 'Result: ' + result});
          //               }
          //           );
          //       }   
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