@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục bài viết
            </header>
            <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
            <div class="panel-body">    
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-cate-post/'.$catePost->cate_post_id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="CatePostName" value="{{$catePost->cate_post_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <textarea style="resize: none" class="form-control" name="CatePostSlug" id="" placeholder="slug danh mục bài viết" rows="5">{{$catePost->cate_post_slug}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea style="resize: none" class="form-control" name="CatePostMetaKeywords" placeholder="Từ khóa tìm kiếm" rows="5">{{$catePost->cate_post_meta_keywords}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" class="form-control" name="CatePostDesc" placeholder="Mô tả danh mục sản phẩm" rows="5">{{$catePost->cate_post_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="CatePostStatus">
                                @if ($catePost->cate_post_status == 0)
                                <option selected value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                                @else
                                <option value="0">Ẩn</option>
                                <option selected value="1">Hiển thị</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="UpdateCatePost" class="btn btn-info">Cập nhật</button>
                    </form>
                </div>
            </div>
    </section>
</div>
@endsection
