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
                        Product
                    </header>
                    @if(Session::has('thatbai'))
                        <div class="alert alert-danger" id="alert">{{Session::get('thatbai')}}</div>
                    @endif
                        @if($id==0)
                            <div class="panel-body">
                                <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Insert_Product')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tên sản phẩm*</label>
                                        <div class="col-sm-6">
                                            <input type="text" value="" name="name" class="form-control" style="border-top: 1px solid black;" required="">
                                            <span class="help-block">Nhập tên sản phẩm </span>
                                        </div>

                                    </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label">Loại Sản phẩm*</label>
                                        <div class="col-sm-6">
                                                <select class="form-control m-bot15" id="category_id" name ="category_id">
                                                    @foreach($type as $type_parent)
                                                        @foreach( $loaicon[$type_parent->id] as $type_child )
                                                            <option  id="{{$type_child->id}}" value="{{$type_child->id}}">{{$type_child->name}}</option>
                                                        @endforeach
                                                    @endforeach

                                                    @if(isset($typepro))
                                                        <script type="text/javascript">
                                                         var id={{$typepro}};
                                                        $('#'+id).attr('selected','selected');
                                                        </script>
                                                    @endif
                                                </select>
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
                                    <textarea name="description"  class="form-control" id="ckeditor" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kích thước*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="size" pattern="[0-9x]*" placeholder="Ví dụ 60x30..." maxlength="7" class="form-control" style="border-top: 1px solid black;" required="" title="Nhập dung quy cách ví dụ 60x30">
                                              <span class="help-block">Nhập kích thước ví dụ 60x30,30x30... </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Bán(VNĐ)*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="export_price" pattern="[0-9]*" maxlength='10' class="form-control" style="border-top: 1px solid black;" required="" title=" nhập từ 0 tới 10 chữ số">
                                             <span class="help-block">Nhập Giá Bán </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Nhập Hàng(VNĐ)*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="import_price" class="form-control" style="border-top: 1px solid black;"  pattern="[0-9]*" maxlength='10' required title=" nhập từ 0 tới 10 chữ số" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Số lượng Nhập*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="import_quantity" class="form-control" style="border-top: 1px solid black;" pattern="[0-9]*" maxlength='10'  required title=" nhập từ 0 tới 10 chữ số" >
                                        </div>
                                    </div>
                                  
                                    <button type="submit"  class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Save</button>           
                                </form>
                            </div>
                           
                    @else
                         <div class="panel-body">
                                <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="edit-form" method="post" action="{{route('Update_Product')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="first_size" value="{{ $size}}">
                                    <input type="hidden" name="id" value="{{ $product[0]->id}}">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tên sản phẩm*</label>
                                        <div class="col-sm-6">
                                            <input type="text" value="{{$product[0]->name}}" name="name" class="form-control" style="border-top: 1px solid black;" required="">
                                            <span class="help-block">Nhập tên sản phẩm </span>
                                        </div>

                                    </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label">Loại Sản phẩm*</label>
                                        <div class="col-sm-6">
                                                <select class="form-control m-bot15" id="category_id" name ="category_id">

                                                    @foreach($type as $type_parent)
                                                        @foreach( $loaicon[$type_parent->id] as $type_child )
                                                            <option  id="{{$type_child->id}}" value="{{$type_child->id}}">{{$type_child->name}}</option>
                                                        @endforeach
                                                        <script type="text/javascript">
                                                         var id={{$product[0]->id_type}};
                                                        $('#'+id).attr('selected','selected');
                                                        </script>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Hình ảnh*</label>
                                        <div class="col-sm-6">
                                             <input type="file" value="" name="image" id="f" accept="image/*" class="form-control" style="border-top: 1px solid black;"  onchange=" file_change(this) ">
                                          <img style="width: 100px;height: 100px" id="img" src="images/{{$product[0]->image}}">
                                            <span class="help-block">Chọn Ảnh </span>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class=" col-sm-3 control-label ">Mô tả</label>
                                        <div class="col-sm-6">
                                             <textarea name="description" id="ckeditor" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="">{{$product[0]->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Kích thước*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$size}}" name="size" pattern="[0-9x]*" title="Nhập dung quy cách ví dụ 60x30" class="form-control"  maxlength="7" style="border-top: 1px solid black;" required=""   >
                                              <span class="help-block">Nhập kích thước ví dụ 60x30,30x30... </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Bán(VNĐ)*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$export_product->export_price}}" name="export_price" pattern="[0-9]*" maxlength='10' class="form-control" style="border-top: 1px solid black;" required="" title=" nhập từ 0 tới 10 chữ số">
                                             <span class="help-block">Nhập giá bán </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Nhập Hàng(VNĐ)*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$import_product->import_price}}" pattern="[0-9]*" maxlength='10' name="import_price" class="form-control" style="border-top: 1px solid black;" required="" title=" nhập từ 0 tới 10 chữ số" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Số lượng Nhập*:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$import_product->import_quantity}}" pattern="[0-9]*" maxlength='10' required="" title=" nhập từ 0 tới 10 chữ số" name="import_quantity" class="form-control" style="border-top: 1px solid black;" >
                                        </div>
                                    </div>
                                  
                                    <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Save</button>           
                                </form>
                            </div>
                        @endif
                </section>
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

     //    $("#edit-form").validate(
     //        {
     //            ignore: [],
     //            debug: false,
     //            rules: { 

     //                description:{
     //                    required: function() 
     //                        {
     //                            CKEDITOR.instances.ckeditor.updateElement();
     //                        },
     //                    }
     //                },
     //            messages:
     //                {
     //                    description:{
     //                            required:"Hãy Nhập vào mô tả",
                                                         
     //                        }
     //                    }
     //                });
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
                            frm.submit();
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
                            frm.submit();
                         }
                        else
                            ssi_modal.notify('error', {content: 'Result: ' + result});
                    }
                );
            }   
</script>
</section>
@endsection             
@else
  <script type="text/javascript">
            alert("Bạn không có quyền truy cập")
            window.location.href = "{{route('Content_Admin')}}";
            </script>
@endif