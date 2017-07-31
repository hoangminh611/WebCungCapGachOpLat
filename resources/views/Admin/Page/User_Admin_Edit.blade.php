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
                        Update User
                    </header>
                    <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Update_User')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="id" value="{{ $user[0]->id }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$user[0]->full_name}}" name="user" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-6">
                                         <input type="text" value="{{$user[0]->email}}" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Phone</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" value="{{$user[0]->phone}}" disabled="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Địa Chỉ</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="address" value="{{$user[0]->address}}" disabled="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Active</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="active" value="{{$user[0]->active}}" disabled="">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Group</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="group" value="{{$user[0]->group}}" pattern="[0-2]" required=""
                                        title="Nhập quyền hạn 0 1 2 ">
                                    </div>
                                </div>
                                <button type="submit" class="button submit-button btn btn-info btn-lg glyphicon glyphicon-floppy-save saveEdit" style="border-radius: 10px;">  Save</button>           
                            </form>
                    </div>
            

                </section>

            </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection             