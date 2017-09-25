@extends('Master.master')
@section('body')
<head>
<title>News</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
  <div class="breadcrumbs">
      <div class="container">
        <div class="breadcrumbs-main">
          <ol class="breadcrumb">
            <li><a href="{{route('News')}}">Tin tức</a></li>
          </ol>
        </div>
      </div>
    </div>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

<section id="content">
  
  <div class="container">
    <div class="row">

      <div class="col-lg-9 col-md-9 col-sm-8">
        <div class="middle_content">
          <h2>Bài Viết</h2>
          <ul class="featured_nav">
          	@foreach($All_news as $All_new)
	            <li class="wow fadeInDown">
              @if(isset($All_new->name))
                <h5><i>Loại gạch:{{$All_new->name}}</i></h5>
              @endif
	            <a href="{{route('New_Detail',$All_new->id)}}" style="text-decoration:none;">

	              <figure class="featured_img"><img src="images/news/{{$All_new->image}}"  style="width: 150px; height: 150px;" alt=""></figure>
	              <article class="featured_article">
	                <h2 class="article_titile" >{{$All_new->title}}</h2>

	                <p style="color: black;">{{$All_new->description}}</p>
	              </article>
	            </a>
	            </li>
              <hr style="border:1px solid black;">
            @endforeach
          </ul>
          <nav>
          	<div>{{$All_news->links()}}</div>
          </nav>
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