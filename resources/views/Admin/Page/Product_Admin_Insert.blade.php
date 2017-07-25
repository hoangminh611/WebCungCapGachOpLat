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
                        @if($id==0)
                            <div class="panel-body">
                                <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Insert_Product')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tên sản phẩm</label>
                                        <div class="col-sm-6">
                                            <input type="text" value="" name="name" class="form-control" style="border-top: 1px solid black;" required="">
                                            <span class="help-block">Nhập tên sản phẩm </span>
                                        </div>

                                    </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label">Loại Sản phẩm</label>
                                        <div class="col-sm-6">
                                                <select class="form-control m-bot15" id="category_id" name ="category_id">
                                                    @foreach($type as $type_parent)
                                                        @foreach( $loaicon[$type_parent->id] as $type_child )
                                                            <option  id="{{$type_child->id}}" value="{{$type_child->id}}">{{$type_child->name}}</option>
                                                        @endforeach
                                                        <script type="text/javascript">
                                                         var id={{$typepro}};
                                                        $('#'+id).attr('selected','selected');
                                                        </script>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Image</label>
                                        <div class="col-sm-6">
                                             <input type="file" value="" name="image" id="image" class="form-control" style="border-top: 1px solid black;" required="">
                                            <span class="help-block">Chọn Ảnh </span>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class=" col-sm-3 control-label ">Description</label>
                                        <div class="col-sm-6">
                                             <textarea name="description" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="">
                                             </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Size:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="" name="size" class="form-control" style="border-top: 1px solid black;" required="">
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
                    @else
                         <div class="panel-body">
                                <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Update_Product')}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="first_size" value="{{ $size}}">
                                    <input type="hidden" name="id" value="{{ $product[0]->id}}">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tên sản phẩm</label>
                                        <div class="col-sm-6">
                                            <input type="text" value="{{$product[0]->name}}" name="name" class="form-control" style="border-top: 1px solid black;" required="">
                                            <span class="help-block">Nhập tên sản phẩm </span>
                                        </div>

                                    </div>
                                      <div class="form-group">
                                        <label class="col-sm-3 control-label">Loại Sản phẩm</label>
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
                                        <label class="col-sm-3 control-label">Image</label>
                                        <div class="col-sm-6">
                                             <input type="file" value="" name="image" id="image" class="form-control" style="border-top: 1px solid black;">
                                             <img  width="100px" height="100px;" src="images/{{$product[0]->image}}">
                                            <span class="help-block">Chọn Ảnh </span>

                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class=" col-sm-3 control-label ">Description</label>
                                        <div class="col-sm-6">
                                             <textarea name="description" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="">
                                             {{$product[0]->description}}
                                             </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Size:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$size}}" name="size" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Bán:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$export_product->export_price}}" name="export_price" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Giá Nhập Hàng:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$import_product->import_price}}" name="import_price" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">SỐ lượng Nhập:</label>
                                        <div class="col-sm-6">
                                             <input type="text" value="{{$import_product->import_quantity}}" name="import_quantity" class="form-control" style="border-top: 1px solid black;" required="">
                                        </div>
                                    </div>
                                  
                                    <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">Save</button>           
                                </form>
                            </div>
                        @endif
                </section>

            </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection             
