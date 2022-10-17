@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Cập nhật danh mục sản phẩm
            </header>
            <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
            <div class="panel-body">
                @foreach ($editCategoryProduct as $key => $editValue)   
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category-product/'.$editValue->id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $editValue->category_name}}" name="CategoryProductName" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Danh mục cha</label>
                            <select class="form-control input-sm m-bot15" name="CateParent">
                                <option value="0">Không danh mục</option>
                            @foreach ($categoryParent as $key => $cate)
                                @if($cate->category_parent_id == 0)
                                    @if ($editValue->category_parent_id == $cate->id)
                                    <option selected value="{{$cate->id}}">{{$cate->category_name}}</option>
                                    @else
                                    <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                    @endif
                                @endif      
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            <textarea style="resize: none" class="form-control" name="MetaKeyword"  placeholder="Từ khóa danh mục sản phẩm" rows="5">{{$editValue->category_keyword}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" class="form-control" id="ckeditorCategoryDesc" name="CategoryProductDescription" rows="5">{{ $editValue->category_decs }}</textarea>
                        </div>
                        
                        <button type="submit" name="UpdateCategoryProduct" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                </div>
                @endforeach
            </div>
    </section>
</div>
@endsection
