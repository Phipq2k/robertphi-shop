@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
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
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="CategoryProductName" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Danh mục cha</label>
                            <select class="form-control input-sm m-bot15" name="CateParent">
                                <option value="0">Không danh mục</option>
                                @foreach ($allCategory as $key => $cate)
                                @if ($cate->category_parent_id == 0)
                                    <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            <textarea style="resize: none" class="form-control" name="MetaKeywordCate" id="" placeholder="Từ khóa danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" class="form-control" name="CategoryProductDescription" placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="CategoryProductStatus">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="AddCategoryProduct" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>
            </div>
    </section>
</div>
@endsection
