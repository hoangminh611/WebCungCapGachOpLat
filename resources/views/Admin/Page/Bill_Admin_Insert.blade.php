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
                        Cập Nhật Hóa Đơn
                    </header>
                    <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Bill')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="id" value="{{ $id }}">
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên Khách Hàng*</label>
                                    <div class="col-sm-6">
                                         <input type="text" value="{{$customer}}" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Tinh Trạng*</label>
                                    <div class="col-sm-6">
                                          <select class="form-control m-bot15" id="method" name ="method">
                                            <option id="1" value="{{$bill[0]->method}}" checked>{{$bill[0]->method}}</option>
                                            <option id="2" value="Chưa Xác Nhận">Chưa Xác Nhận</option>
                                            <option id="3" value="Đã Xác Nhận Chưa Thanh Toán">Đã Xác Nhận Chưa Thanh Toán</option>
                                            <option id="4" value="Đã Thanh Toán" >Đã Thanh Toán</option>
                                        </select>
                                        <script type="text/javascript">
                                            var val= $('#1').val();
                                            if(val=="Chưa Xác Nhận")
                                                $('#2').hide();
                                            if(val=="Đã Xác Nhận Chưa Thanh Toán")
                                            {
                                                var group={{Auth::User()->group}};
                                                if(group<2)
                                                    $('#2').hide();
                                                $('#3').hide();
                                            }
                                            if(val=="Đã Thanh Toán")
                                                $('#4').hide();
                                        </script>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Ghi Chú</label>
                                    <div class="col-sm-6">
                                        <textarea   disabled=""  style="resize: none; width:30em; height: 12.7em;outline: none;border-top: 1px solid black;" >{{$bill[0]->note}}</textarea> 
                                    </div>
                                </div>
                                <button type="submit"  class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Lưu</button>           
                            </form>
                    </div>
            

                </section>

            </div>
        </div>


        <!-- page end-->
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
</section>
@endsection             