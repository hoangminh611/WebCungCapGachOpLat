@extends('Master.master')
@section('body')
<head>
<title>News</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  <div class="breadcrumbs">
      <div class="container">
        <div class="breadcrumbs-main">
          <ol class="breadcrumb">
            <li><a href="{{route('News')}}">Tin tức</a></li>
            <li><a href="{{route('News_By_Type',$new_detail[0]->type_new)}}">{{$new_detail[0]->name}}</a></li>
            <li class="active">Tin Chi tiết</li>
          </ol>
        </div>
      </div>
    </div>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

<section id="content">
  
  <div class="container">
    <div class="row">

      <div class="col-lg-9 col-md-9 col-sm-8">
        <div class="middle_content">
				            <h1>{{$new_detail[0]->title}}</h1>
            <div class="post_commentbox"><i class="fa fa-user"></i> {{$new_detail[0]->full_name}}<span><i class="fa fa-calendar"></i>{{$new_detail[0]->created_at}}</span><i class="fa fa-tags"></i></div>
            <div class="single_content">
              <p>{!!$new_detail[0]->content!!}</p>
             
            </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="right_sidebar">
          <div class="single_widget">
            <h2>Loại Tin</h2>
            <ul>
            	@foreach($category as $type_news)
              	<li class="cat-item"><a href="{{route('News_By_Type',$type_news->id)}}">{{$type_news->name}}</a></li>
              	@endforeach

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
