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
                        Update Bill_Detail
                    </header>
                    <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Bill_Detail')}}">
                                <input type="hidden" name="first_quantity" value="{{$quantity}}">
                                <input type="hidden" name="id" value="{{$Bill_Detail[0]->id}}">
                                <input type="hidden" name="id_product" value="{{$Bill_Detail[0]->id_product}}">
                                <input type="hidden" name="size" value="{{$Bill_Detail[0]->size}}">
                                <input type="hidden" name="id_bill" value="{{$Bill_Detail[0]->id_bill}}">
                                <input type="hidden" name="id_customer" value="{{$customer[0]->id_customer}}">
                                <input type="hidden" name="method" value="{{$customer[0]->method}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên sản phẩm*</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$name_pro}}" name="name" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Kích thước*</label>
                                    <div class="col-sm-6">
                                         <input type="text" value="{{$Bill_Detail[0]->size}}" lass="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Số lượng*</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="quantity" value="{{$Bill_Detail[0]->quantity}}" pattern="[0-9]*" required required title=" nhập từ 0 tới 10 chữ số" maxlength='10'>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Giá bán*</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="quantity" value="{{$Bill_Detail[0]->sales_price}}" disabled="">
                                    </div>
                                </div>
                                <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Lưu</button>           
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