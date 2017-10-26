
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a  href="{{route('ViewPageBill_Admin')}}">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success number_Bill_Detail">{{$count_bill}}</span>
                <span>Hóa Đơn</span>
            </a>

        </li>
        <li class="dropdown">
            <a  href="{{route('Content_Admin')}}">
                <span class="badge bg-success numberProductNotEnough"></span>
                <span>Hết Hàng/Hàng Không Đủ</span>
            </a>
            
        </li>   
        <!-- settings end -->
        <script type="text/javascript">
                    $(document).ready(function(){
                        var route="{{route('countProductNotEnough')}}";
                        setInterval(function(){
                            $.ajax({
                                url:route,
                                type:'get',
                                data:{
                                },
                                success:function(data) {  
                                    if(data!=0)
                                        $('.numberProductNotEnough').html(data);
                                    else
                                        $('.numberProductNotEnough').html("");
                                   
                                }
                            });
                        },10000);  
                    });
                </script>
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
       {{--  <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> --}}
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username">{{Auth::User()->full_name}}</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
               {{--  <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> --}}
                <li><a href="{{route('Logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end