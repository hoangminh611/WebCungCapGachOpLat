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
                        Update Bill
                    </header>
                    <div class="panel-body">
                            <form class="form-horizontal bucket-form" enctype="multipart/form-data"  id="add-form" method="post" action="{{route('Update_Bill')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">User</label>
                                    <div class="col-sm-6">
                                        <input type="text" value="{{$user}}" name="user" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Customer</label>
                                    <div class="col-sm-6">
                                         <input type="text" value="{{$customer}}" class="form-control" style="border-top: 1px solid black;" disabled="">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Tinh Trạng</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="method" value="{{$bill[0]->method}}">
                                        <span class="help-block">Nhập tình là đã xac nhân hay chưa và đã thanh toán hay chưa </span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class=" col-sm-3 control-label ">Ghi Chú</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="quantity" value="{{$bill[0]->note}}" disabled="">
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