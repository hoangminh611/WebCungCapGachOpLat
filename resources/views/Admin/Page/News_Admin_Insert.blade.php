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
                        News
                    </header>
                    @if($id==0)
                        <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('InsertNews')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="" name="title" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập Title </span>
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
                                    <label class="col-sm-3 control-label">Content:</label>
                                    <div class="col-sm-6">
                                         <textarea name="content"  id="ckeditor" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="" >
                                         </textarea>
                                    </div>
                                    <script>
                                        CKEDITOR.replace( 'ckeditor');
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại Tin</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="category_id_news" name ="category_id_news">
                                                @foreach($typenews as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                                <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                        </div>
                    @else
                        <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('UpdateNews',"id=$id")}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$news[0]->title}}" name="title" class="form-control" style="border-top: 1px solid black;" required="">
                                        <span class="help-block">Nhập Title </span>
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-6">
                                         <input type="file" value="" name="image" id="image" class="form-control" style="border-top: 1px solid black;">
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
                                    <label class="col-sm-3 control-label">Content:</label>
                                    <div class="col-sm-6">
                                         <textarea name="content"  id="ckeditor" class="form-control" style="resize: none; height: 12.7em;outline: none;border-top: 1px solid black;" required="" >
                                            {{$news[0]->content}}
                                         </textarea>
                                    </div>
                                    <script>
                                        CKEDITOR.replace( 'ckeditor');
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Loại Tin</label>
                                    <div class="col-sm-6">
                                            <select class="form-control m-bot15" id="category_id_news" name ="category_id_news">
                                                @foreach($typenews as $type)
                                                    <option  id="{{$type->id}}" value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <script type="text/javascript">
                                             var id={{$news[0]->Category_ID_News}};
                                            $('#'+id).attr('selected','selected');
                                    </script>
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
