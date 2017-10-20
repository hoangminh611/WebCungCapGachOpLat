
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{route('Content_Admin')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('Slide_Admin')}}">
                        <i class="fa fa-sliders"></i>
                        <span>Slide</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-book"></i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="sub">
                        <li> <a href="{{route('Admin_All_Product')}}">Tất cả sản phẩm</a>
                        @foreach($type as $type_parent)
                            @foreach($loaicon[$type_parent->id] as $type_child)
                        <li><a href="{{route('Admin_All_Product_By_Type',$type_child->id)}}">{{$type_child->name}}</a></li>
                            @endforeach
                        @endforeach
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-book"></i>
                        <span>Loại sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li> <a href="{{route('Admin_All_Type')}}">Tất cả loại cha</a>
                        @foreach($type as $type_parent)
                            <li><a href="{{route('Admin_All_Type_By_Type',$type_parent->id)}}">{{$type_parent->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @if(Auth::User()->group!=2)
                <li class="sub-menu">
                    <a href="javascript:void(0)">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Tin Tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('ViewNews')}}"> Tất cả tin</a></li>
                        <li><a href="{{route('TypeNews')}}"> Tất cả loại tin</a></li>
                        @foreach($typenews as $typenew)
						<li><a href="{{route('ViewNewsBy_id',$typenew->id)}}">{{$typenew->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
                <li>
                    <a href="{{route('ViewPageBill_Admin')}}">
                        <i class="fa fa-bullhorn"></i>
                        <span>Hóa Đơn</span>
                    </a>
                </li>
                @if(Auth::User()->group==5)
                <li >
                    <a href="{{route('ViewPage_User_Admin')}}">
                        <i class="fa fa-user"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                @endif
                <li >
                    <a href="{{route('ViewPage_ImportProduct_Admin')}}">
                        <i class="fa fa-user"></i>
                        <span>Hàng Nhập Kho</span>
                    </a>
                </li>
                 <li >
                    <a href="{{route('ViewPageError_Product')}}">
                        <i class="fa fa-user"></i>
                        <span>Hàng Lỗi</span>
                    </a>
                </li>
                @if(Auth::User()->group==5)
                 <li >
                    <a href="{{route('Discount_Admin')}}">
                        <i class="fa fa-user"></i>
                        <span>Giảm Giá</span>
                    </a>
                </li>
                 <li >
                    <a href="{{route('Gift_Admin')}}">
                        <i class="fa fa-user"></i>
                        <span>Quá Tặng Kèm</span>
                    </a>
                </li>
                @endif
{{--                     <ul class="sub">
                        <li><a href="basic_table.html">Basic Table</a></li>
                        <li><a href="responsive_table.html">Responsive Table</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>Form Components</span>
                    </a>
                    <ul class="sub">
                        <li><a href="form_component.html">Form Elements</a></li>
                        <li><a href="form_validation.html">Form Validation</a></li>
						<li><a href="dropzone.html">Dropzone</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <span>Mail </span>
                    </a>
                    <ul class="sub">
                        <li><a href="mail.html">Inbox</a></li>
                        <li><a href="mail_compose.html">Compose Mail</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="sub">
                        <li><a href="chartjs.html">Chart js</a></li>
                        <li><a href="flot_chart.html">Flot Charts</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="sub">
                        <li><a href="google_map.html">Google Map</a></li>
                        <li><a href="vector_map.html">Vector Map</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-glass"></i>
                        <span>Extra</span>
                    </a>
                    <ul class="sub">
                        <li><a href="gallery.html">Gallery</a></li>
						<li><a href="404.html">404 Error</a></li>
                        <li><a href="registration.html">Registration</a></li>
                    </ul>
                </li>
                <li>
                    <a href="login.html">
                        <i class="fa fa-user"></i>
                        <span>Login Page</span>
                    </a>
                </li> --}}
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end