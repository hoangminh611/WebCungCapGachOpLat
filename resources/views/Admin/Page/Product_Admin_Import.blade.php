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
                            <div class="panel-body">
                                <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Insert_Import_Product')}}">
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
                                        <label class="col-sm-3 control-label">Size:</label>
                                        <div class="col-sm-6">
													<input type="text" name="size" value="{{$size}}"  class="form-control" style="border-top: 1px solid black;" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Bán:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="export_price" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Nhập Hàng:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="import_price" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">SỐ lượng Nhập:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="import_quantity" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                  
                                    <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Save</button>           
                                </form>
                            </div>
                </section>

            </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection             
