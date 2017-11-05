@if(isset($staff) && $staff->banner_permission === 1)
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
                          Giảm Giá
                      </header>
                      @if($id==0)
                           <div class="panel-body">
                              <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('insertSlide')}}">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Hình </label>
                                      <div class="col-sm-6">
                                          <input type="file" value="" name="image" id="f" accept="image/*" class="form-control" style="border-top: 1px solid black;" required="" onchange=" file_change(this) ">
                                            <img style="width: 100px;height: 100px" id="img"  style="display: none;">
                                              <span class="help-block">Chọn Ảnh </span>
                                      </div>

                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">URL</label>
                                      <div class="col-sm-6">
                                     		<input type="text" value="" name= "URL" id="URL" class="form-control" style="border-top: 1px solid black;" required="" >
                                         <span class="help-block">Nếu muốn đưa đường dẫn hay đưa cả đầu vào http</span>
                                      </div>

                                  </div>
    							                <div class="form-group">
                                      <label class="col-sm-3 control-label">Show</label>
                                      <div class="col-sm-6">
                                          <select name="show">
                                            <option id="1" value="1">Hiện</option>
    											                  <option id="0" value="0">Ẩn</option>
                                          </select>
                                          <span class="help-block">1 Lần Hiện Slide tối đa chỉ có 5 cái và lấy cái mới nhất</span>
                                      </div>

                                  </div>

                                  <button type="submit" id="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Thêm</button>           
                              </form>
                            </div>
                      @else
                          <div class="panel-body">
                              <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('updateSlide')}}">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="id" value="{{$slide[0]->id}}">
                                   <div class="form-group">
                                      <label class="col-sm-3 control-label">Hình </label>
                                      <div class="col-sm-6">
                                          <input type="file" value="" name="image" id="f" accept="image/*" class="form-control" style="border-top: 1px solid black;" onchange=" file_change(this) ">
                                            <img style="width: 100px;height: 100px" id="img" src="images/Banner/{{$slide[0]->hinh}}" style="display: none;">
                                              <span class="help-block">Chọn Ảnh </span>
                                      </div>

                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">URL</label>
                                      <div class="col-sm-6">
                                     		<input type="text" value="{{$slide[0]->url}}" name= "URL" id="URL" class="form-control" style="border-top: 1px solid black;" required="">
                                         <span class="help-block">Nếu muốn đưa đường dẫn hay đưa cả đầu vào http</span>
                                      </div>

                                  </div>
    							                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Show</label>
                                        <div class="col-sm-6">
                                            <select name="show">
                                            	 <option id="1" value="1">Hiện</option>
    											                     <option id="0" value="0">Ẩn</option>
                                            </select>
                                            <span class="help-block">1 Lần Hiện Slide tối đa chỉ có 5 cái và lấy cái mới nhất</span>
                                            <script type="text/javascript">
                                            	$('#'+{{$slide[0]->show}}).attr('selected','selected');
                                            </script>
                                        </div>
                                      </div>
                                  <button type="submit" id="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Lưu</button>    		       
                              </form>
                          </div>
                      @endif
                  </section>
              </div>
          </div>

          <!-- page end-->
        </div>
        <script type="text/javascript">

          function file_change(f){
            var reader = new FileReader();
            reader.onload = function (e) {
            var img = document.getElementById("img");
            img.src = e.target.result;
            img.style.display = "inline";
            };
            var ftype =f.files[0].type;
            switch(ftype)
            {
                case 'image/png':
                case 'image/gif':
                case 'image/jpeg':
                case 'image/pjpeg':
                    reader.readAsDataURL(f.files[0]);
                    break;
                default:
                    alert(' Bạn chỉ được chọn file ảnh.');
                    $('#f').val(null);
            }
          }
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