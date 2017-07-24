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
                                    <label class="col-sm-3 control-label">name</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name="name" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập name </span>
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
                                    <label class="col-sm-3 control-label">Loại cha</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="type_cha" name ="type_cha">
                                            @if(isset($khongcocha))
                                                <option value="0">Không có loại cha</option>
                                            @else
                                                <option value="0">Không có loại cha</option>
                                                @foreach($typenews as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                    </div>
                                </div>
                                <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                        </div>
                    @else
                         <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Update_Type_News',"id=$id")}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">name</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$news[0]->name}}" name= "name" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập name </span>
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-6">
                                         <input type="file" value="" name="image" id="image" class="form-control" style="border-top: 1px solid black;" >
                                          <img  width="100px" height="100px;" src="images/news/{{$news[0]->image}}">
                                        <span class="help-block">Chọn Ảnh </span>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Description</label>
                                    <div class="col-sm-6">
                                         <textarea name="description" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="">
                                          {{$news[0]->description}}
                                         </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại cha</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="type_cha" name ="type_cha">
                                            @if(isset($khongcocha))
                                                <option value="0">Không có loại cha</option>
                                            @else
                                                <option value="0">Không có loại cha</option>
                                                @foreach($typenews as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                    </div>
                                </div>
                                <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
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
