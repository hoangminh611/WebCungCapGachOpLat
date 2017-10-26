@if(isset($staff) && $staff->gift_permission === 1)
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
                        Quà Tặng
                    </header>
                    @if($id==0)
                         <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Insert_Gift')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên Quà Tặng </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name= "name_gift" class="form-control" style="border-top: 1px solid black;" required="">
                                        
                                    </div>

                                </div>
  							<div class="form-group">
                                    <label class="col-sm-3 control-label">Giá Quá Tặng</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name= "price_gift"  class="form-control" style="border-top: 1px solid black;" >
                                    </div>

                                </div>
                                <button type="submit" id="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Thêm</button>           
                            </form>
                        </div>
                      @else
                        <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Gift')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{$gift[0]->id}}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên Quà Tặng </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$gift[0]->name_gift}}" name= "name_gift" class="form-control" style="border-top: 1px solid black;" required="">
                                        
                                    </div>

                                </div>
  							<div class="form-group">
                                    <label class="col-sm-3 control-label">Giá Quá Tặng</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$gift[0]->price_gift}}" name= "price_gift"  class="form-control" style="border-top: 1px solid black;" >
                                    </div>

                                </div>
                                <button type="submit" id="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Thêm</button>           
                            </form>
                        </div>
                      @endif

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
          //                     if(isNaN($('#hangloi').val()))
          //                       alert('nhập từ 0 tới 10 chữ số');
          //                     else
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