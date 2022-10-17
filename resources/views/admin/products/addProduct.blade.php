@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
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
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 kí tự" name="ProductName" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="ProductImage" class="form-control" id="exampleInputEmail1"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number" name="ProductQuantity" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="Vui lòng điền số tiền" name="ProductPrice" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea id="ckeditorProductAdd" style="resize: none" class="form-control" name="ProductDescription" placeholder="Mô tả sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea style="resize: none" class="form-control" name="ProductKeyword" placeholder="Từ khóa tìm kiếm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" class="form-control" name="ProductContent" id="ckeditor1" placeholder="Nội dung sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Danh mục sản phẩm</label>
                            <select class="form-control input-sm m-bot15" name="CatePro">
                                @foreach ($categoryProduct as $key => $cate)
                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Thương hiệu sản phẩm</label>
                            <select class="form-control input-sm m-bot15" name="BrandPro">
                                @foreach ($brandProduct as $key => $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="ProductStatus">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="AddProduct" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>
    </section>
</div>
@endsection
