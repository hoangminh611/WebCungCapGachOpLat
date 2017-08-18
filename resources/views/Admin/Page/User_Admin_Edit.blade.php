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
                                        <select  name="group">
                                            <option id="0" value="0">Khách Hàng</option>
                                            <option id="1" value="1">Nhân Viên</option>
                                            <option id="2" value="2">Admin</option>
                                        </select>
                                        <script type="text/javascript">
                                            var group={{$user[0]->group}};
                                            $('#'+group).attr('selected','selected');
                                        </script>
                                        
                                    </div>
                                </div>
                                <button type="submit"  class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                    </div>
            

                </section>

            </div>
        </div>

<script type="text/javascript">
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
        <!-- page end-->
        </div>
</section>
@endsection             