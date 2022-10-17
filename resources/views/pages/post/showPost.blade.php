@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
    @foreach ($catePostName as $key => $title)
    <h2 class="title text-center">{{$title->cate_post_name}}</h2>
    @endforeach
   
    @foreach ($posts as $key => $listPost)
    <div style="padding:10px 0" class="col col-sm-12 text-center title">
        <div class="col col-sm-3">
        <img style="float: left; width:100%" src="{{URL::to('storage/app/public/uploads/posts/'.$listPost->post_image)}}" alt="Ảnh bài viết">
        </div>
        <h2 style="color: #FE980F;">{{$listPost->post_title}}</h2>
        <div class="col col-sm-9">
            <p style="overflow-wrap:break-word;">{{$listPost->post_desc}}</p>
            <a href="{{url('/noi-dung-blog/'.$listPost->post_slug)}}" title="Nhấn vào để xem thêm nội dung blog" class="btn btn-primary" href="">Xem thông tin chi tiết</a>
        </div>
    </div>
    @endforeach

</div><!--features_items-->
@section('footer')
@include('components.footer')
@endsection
@endsection