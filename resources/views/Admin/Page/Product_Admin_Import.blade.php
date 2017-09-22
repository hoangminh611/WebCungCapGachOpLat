@if(Auth::User()->group==5||Auth::User()->group==2)
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
                          IMPORT Product
                      </header>
                              <div class="panel-body">
                                  <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Insert_Import_Product')}}">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="hidden" name="id" value="{{$id}}">
                                      <div class="form-group">
                                          <label class="col-sm-3 control-label">Tên sản phẩm</label>
                                          <div class="col-sm-6">
                                              <input type="text" value="{{$name}}"  class="form-control" style="border-top: 1px solid black;" disabled="true">
                                              <span class="help-block">Nhập tên sản phẩm </span>
                                          </div>

                                      </div>
                                        <div class="form-group">
                                          <label class="col-sm-3 control-label">Loại Sản phẩm</label>
                                          <div class="col-sm-6">
  												<input type="text"  value="{{$type_name}}"  class="form-control" style="border-top: 1px solid black;" disabled="true">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-3 control-label">Kích thước:</label>
                                          <div class="col-sm-6">
  													<input type="text" name="size" value="{{$size}}"  maxlength="7" class="form-control" style="border-top: 1px solid black;"  pattern="[0-9x]*" title="Nhập dung quy cách ví dụ 60x30" >
                                                        <span class="help-block">Nhập kích thước ví dụ 60x30,30x30... </span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-3 control-label">Giá Bán(VNĐ):</label>
                                          <div class="col-sm-6">
                                               <input type="text" value="" name="export_price" class="form-control" style="border-top: 1px solid black;"    pattern="[0-9]*" maxlength='10' required="" title=" nhập từ 0 tới 10 chữ số" >
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-3 control-label">Giá Nhập Hàng(VNĐ):</label>
                                          <div class="col-sm-6">
                                               <input type="text" value="" name="import_price" class="form-control" style="border-top: 1px solid black;"    pattern="[0-9]*" maxlength='10' required="" title=" nhập từ 0 tới 10 chữ số">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-3 control-label">Số lượng Nhập:</label>
                                          <div class="col-sm-6">
                                               <input type="text" value="" name="import_quantity" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='10' required="" title=" nhập từ 0 tới 10 chữ số">
                                          </div>
                                      </div>
                                    
                                      <button type="submit"  class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Save</button>           
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
@else
  <script type="text/javascript">
            alert("Bạn không có quyền truy cập")
            window.location.href = "{{route('Content_Admin')}}";
            </script>
@endif