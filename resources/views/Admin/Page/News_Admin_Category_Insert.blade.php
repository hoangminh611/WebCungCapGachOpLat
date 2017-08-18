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
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Insert_Type_News')}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên loại*</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name="name" id="name" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập tên </span>
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Hình ảnh*</label>
                                    <div class="col-sm-6">
                                         <input type="file" value="" name="image" id="f" accept="image/*" class="form-control" style="border-top: 1px solid black;" required="" onchange=" file_change(this) ">
                                          <img style="width: 100px;height: 100px" id="img"  style="display: none;">
                                        <span class="help-block">Chọn Ảnh </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Mô tả</label>
                                    <div class="col-sm-6">
                                         <textarea name="description" class="form-control" id="ckeditor" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại cha*</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="type_cha" name ="type_cha">
                                            @if(isset($khongcocha))
                                                <option value="0">Không có loại cha</option>
                                            @endif
                                            </select>
                                    </div>
                                </div>
                                <button type="button" onclick="submit_insert_form()" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                        </div>
                    @else
                         <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Type_News',"id=$id")}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Tên Loại*</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$news[0]->name}}" name= "name" id="name" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập tên </span>
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Hình ảnh*</label>
                                    <div class="col-sm-6">
                                           <input type="file" value="" name="image" id="f" accept="image/*" class="form-control" style="border-top: 1px solid black;"  onchange=" file_change(this) ">
                                          <img style="width: 100px;height: 100px" id="img" src="images/news/{{$news[0]->image}}">
                                        <span class="help-block">Chọn Ảnh </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Mô tả</label>
                                    <div class="col-sm-6">
                                         <textarea name="description" id="ckeditor" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="" title="Hãy nhập mô tả">{{$news[0]->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại cha*</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="type_cha" name ="type_cha">
                                            @if(isset($khongcocha))
                                                <option value="0">Không có loại cha</option>
                                            @endif
                                            </select>
                                    </div>
                                </div>
                                <button type="button" onclick="submit_form()" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                        </div>
                    @endif
                    <script>
                     CKEDITOR.replace( 'ckeditor',{
                        filebrowserBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html',
                        filebrowserImageBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html',
                        filebrowserFlashBrowseUrl : '../public/ckeditor/ckfinder/ckfinder.html?type=Flash',
                        filebrowserUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                        filebrowserImageUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                        filebrowserFlashUploadUrl : '../public/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
                    });
                </script>
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
       function submit_insert_form()
        {
             var frm=$('#add-form')[0];//cái này tương đương với document.getelementbyid
                ssi_modal.confirm({
                content: 'Xin Hãy Kiểm tra kỹ càng trước khi save nếu bi sai sót có thể sẽ gây ra lỗi đáng tiếc',
                okBtn: {
                className:'btn btn-primary'
                },
                cancelBtn:{
                className:'btn btn-danger'
                }
                },function (result) 
                    {
                        if(result)
                        {
                                 var noidung=CKEDITOR.instances.ckeditor.getData();
                          if($('#name').val()&&noidung&&$.trim($('#f').val()))
                          {
                            frm.submit();
                          }
                          else 
                            alert('Bạn chưa nhập đủ nội dung');
                         }
                        else
                            ssi_modal.notify('error', {content: 'Result: ' + result});
                    }
                );
        }
      function submit_form()
            {
                var frm=$('#edit-form')[0];//cái này tương đương với document.getelementbyid
                ssi_modal.confirm({
                content: 'Xin Hãy Kiểm tra kỹ càng trước khi save nếu bi sai sót có thể sẽ gây ra lỗi đáng tiếc',
                okBtn: {
                className:'btn btn-primary'
                },
                cancelBtn:{
                className:'btn btn-danger'
                }
                },function (result) 
                    {
                        if(result)
                        {
                                 var noidung=CKEDITOR.instances.ckeditor.getData();
                          if($('#name').val()&&noidung)
                          {
                            frm.submit();
                          }
                          else 
                            alert('Bạn chưa nhập đủ nội dung');
                         }
                        else
                            ssi_modal.notify('error', {content: 'Result: ' + result});
                    }
                );
            }   
</script>
</section>
@endsection             
