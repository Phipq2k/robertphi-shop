@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">{{$metaTitle}}</h2>
    @foreach ($post as $key => $detailPost)
    <div class="col col-sm-12 title">
        <p style="float:left">{!!$detailPost->post_content!!}</p>
    </div>
    <div class="clearfix"></div>
    @endforeach
    <h2 class="title text-center">Bài viết liên quan</h2>
    <style type="text/css">
        ul.post-related li{
            list-style-type: circle;
            font-size: 16px;
            padding: 6px;
        }
        ul.post-related li a{
            color: #000000;
        }
        ul.post-related li a:hover{
            color: #FE980F;
        }
    </style>
    @foreach ($relatedPost as $key => $related)
    <ul class="post-related">
        <li><a href="{{url('/noi-dung-blog/'.$related->post_slug)}}">{{$related->post_title}}</a></li>
    </ul>
    @endforeach

</div><!--features_items-->
@section('footer')
@include('components.footer')
@endsection
@endsection