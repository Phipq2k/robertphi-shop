@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Cập nhật bài viết
            </header>
            <div class="panel-body">    
                <div class="position-center">
                    @foreach ( $editPost as $key => $post)
                    <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="postTitle" class="form-control" id="exampleInputEmail1" value="{{$post->post_title}}"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="postSlug" class="form-control" id="exampleInputEmail1" value="{{$post->post_slug}}"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea style="resize: none" class="form-control" name="postKeywords" id="exampleInputPassword1" rows="3">{{$post->post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="postImage" class="form-control" id="exampleInputEmail1"/>
                            <img src="{{URL::to('storage/app/public/uploads/posts/'.$post->post_image)}}" alt="Ảnh bài viết" height="100px" width="100px">
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Danh mục bài viết</label>
                            <select class="form-control input-sm m-bot15" name="catePost">
                                @foreach ($catePost as $key => $cate)
                                <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea style="resize: none" class="form-control" name="postSummary" id="exampleInputPassword1" rows="5">{{$post->post_desc}}</textarea>
                        </div>
                         
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả bài viết</label>
                            <textarea style="resize: none" class="form-control" name="postDesc" rows="5">{{$post->post_meta_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea style="resize: none" class="form-control" name="postContent" id="ckeditorContent" rows="5">{{$post->post_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="postStatus">
                                @if($post->post_status == 0)
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                                @else
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="addPost" class="btn btn-info">Cập nhật</button>
                    </form>
                    @endforeach
                </div>
            </div>
    </section>
</div>
@endsection
