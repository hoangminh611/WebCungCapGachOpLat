@if(isset($staff) && $staff->discount_permission === 1)
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
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Insert_Discount')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mức Để Giảm Giá </label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name= "price_discount" pattern="[0-9]*" title="Nhập số" class="form-control" style="border-top: 1px solid black;" required="">
                                        
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Quà Tặng</label>
                                    <div class="col-sm-6">
                                     <select name="gift">
                                        @foreach($gifts as $gift)
                                          <option id="{{$gift->id}}" value="{{$gift->id}}">{{$gift->name_gift}}</option>
                                        @endforeach
                                      </select>
                                       <span class="help-block">Chọn gift </span>
                                    </div>

                                </div>
  							                <div class="form-group">
                                    <label class="col-sm-3 control-label">Phần Trăm Giảm Giá</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name= "percent_discount" id="percent_discount" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='3' required="" title=" nhập từ 0 tới 3 chữ số và max là 100">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Giá Vận Chuyển</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name= "ship_price" id="ship_price" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='6' required="" title=" nhập từ 0 tới 6 chữ số">
                                    </div>

                                </div>
                                <button type="submit" id="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Thêm</button>           
                            </form>
                          </div>
                        @else
                          <div class="panel-body">
                              <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Discount')}}">
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="id" value="{{$discount[0]->id}}">
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Mức Để Giảm Giá </label>
                                      <div class="col-sm-6">
                                          <input type="text" value="{{$discount[0]->price_discount}}" name= "price_discount" pattern="[0-9]*" title="Nhập số" class="form-control" style="border-top: 1px solid black;" required="" id="price_discount">
                                      </div>
                                      @if($id == 1)
                                        <script type="text/javascript">
                                          $('#price_discount').attr('disabled','true');
                                        </script>
                                      @endif
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Quà Tặng</label>
                                      <div class="col-sm-6">
                                        <select name="gift">

                                          @foreach($gifts as $gift)
                                            <option id="{{$gift->id}}" value="{{$gift->id}}">{{$gift->name_gift}}</option>
                                          @endforeach
                                        </select>
                                       <script type="text/javascript">
                                                $('#'+{{$discount[0]->idgift}}).attr('selected','selected')
                                        </script>
                                           <span class="help-block">Chọn gift </span>
                                      </div>

                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Phần Trăm Giảm Giá</label>
                                      <div class="col-sm-6">
                                          <input type="text" value="{{$discount[0]->percent_discount}}" name= "percent_discount" id="percent_discount" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='3' required="" title=" nhập từ 0 tới 3 chữ số và max là 100">
                                      </div>

                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-3 control-label">Giá Vận Chuyển</label>
                                      <div class="col-sm-6">
                                          <input type="text" value="{{$discount[0]->ship_price}}" name= "ship_price" id="ship_price" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='6' required="" title=" nhập từ 0 tới 6 chữ số">
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

          $('#submit').click(function(event){
            if($('#percent_discount').val() > 100){
              alert('giá phải <=100');
              event.preventDefault();
            }

          });
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