@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm danh mục bài viết
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
                    <form role="form" action="{{URL::to('/save-cate-post')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="CatePostName" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục bài viết">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Slug</label>
                            <textarea style="resize: none" class="form-control" name="CatePostSlug" id="" placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea style="resize: none" class="form-control" name="CatePostMetaKeywords" id="ckeditorBrandAdd" placeholder="Mô tả danh mục bài viết" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea style="resize: none" class="form-control" name="CatePostDesc" id="ckeditorBrandAdd" placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="CatePostStatus">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="AddCatePost" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
    </section>
</div>
@endsection
