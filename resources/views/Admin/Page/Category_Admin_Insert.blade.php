@if(isset($staff) && $staff->category_permission === 1)
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
                        Insert_Update Loại
                    </header>
                    
                    @if($id==0)
                        <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Insert_Category')}}">
                                <input type="hidden" name="type" value="{{$loai}}">
                                <input type="hidden" name="khongcocha" value="{{$khongcocha}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên Loại*</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name="name" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập tên </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Mô tả</label>
                                    <div class="col-sm-6">
                                         <textarea name="description" id="ckeditor" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại cha*</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="type_cha" name ="type_cha">
                                            @if($khongcocha==0)
                                                <option value="0">Không có loại cha</option>
                                            @else
                                                <option value="0">Không có loại cha</option>
                                                @foreach($type as $type_parent)
                                                    <option  id="{{$type_parent->id}}" value="{{$type_parent->id}}">{{$type_parent->name}}</option>
                                                @endforeach
                                                <script type="text/javascript">
                                                     var id={{$khongcocha}};
                                                    $('#'+id).attr('selected','selected');
                                                    </script>
                                            @endif
                                            </select>
                                    </div>
                                </div>
                                <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Lưu</button>           
                            </form>
                        </div>
                    @else
                         <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Category',"id=$id")}}">
                                <input type="hidden" name="type" value="{{$loai}}">
                                <input type="hidden" name="khongcocha" value="{{$khongcocha}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên Loại*</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$type_detail[0]->name}}" name= "name" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập tên </span>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Mô tả</label>
                                    <div class="col-sm-6">
                                         <textarea name="description"  id="ckeditor" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="">{{$type_detail[0]->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại cha*</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="type_cha" name ="type_cha">
                                             @if($khongcocha==0)
                                                <option value="0">Không có loại cha</option>
                                            @else
                                                <option value="0">Không có loại cha</option>
                                                 @foreach($type as $type_parent)
                                                    <option  id="{{$type_parent->id}}" value="{{$type_parent->id}}">{{$type_parent->name}}</option>
                                                @endforeach
                                            @endif
                                            <script type="text/javascript">
                                             var id={{$type_detail[0]->type_cha}};
                                            $('#'+id).attr('selected','selected');
                                            </script>
                                            </select>
                                    </div>
                                </div>
                                <button type="submit"  class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Lưu</button>           
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
         // $(document).ready(function(){

           //  $("#edit-form").validate(
           //      {
           //          ignore: [],
           //          debug: false,
           //          rules: { 

           //              description:{
           //                  required: function() 
           //                      {
           //                          CKEDITOR.instances.ckeditor.updateElement();
           //                      },
           //                  }
           //              },
           //          messages:
           //              {
           //                  description:{
           //                          required:"Hãy Nhập vào mô tả",
                                                               
           //                      }
           //                  }
           //              });
           //  $("#add-form").validate(
           //      {
           //          ignore: [],
           //          debug: false,
           //          rules: { 

           //              description:{
           //                  required: function() 
           //                      {
           //                          CKEDITOR.instances.ckeditor.updateElement();
           //                      },
           //                  }
           //              },
           //          messages:
           //              {
           //                  description:{
           //                          required:"Hãy Nhập vào mô tả",
                                                               
           //                      }
           //                  }
           //              });
           // });
          //      function submit_insert_form()
          //   {
          //        var frm=$('#add-form')[0];//cái này tương đương với document.getelementbyid
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
          //   }
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
          alert('Bạn không có quyền truy cập');
          window.location.href = "{{route('Content_Admin')}}";
  </script>
@endif