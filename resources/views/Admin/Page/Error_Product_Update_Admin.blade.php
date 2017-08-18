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
                        Update Error Product
                    </header>
                         <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Error_Product')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="idsize" value="{{$export_product[0]->idsize}}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên sản phẩm</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$export_product[0]->name}}" name= "name" class="form-control" style="border-top: 1px solid black;" disabled="">
                                        
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kích thước</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$export_product[0]->size}}" name= "name" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
								                <div class="form-group">
                                    <label class="col-sm-3 control-label">Số lượng lỗi</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$export_product[0]->error_quantity}}" name= "error_quantity" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='10' required="" title=" nhập từ 0 tới 10 chữ số">
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
@endsection             
