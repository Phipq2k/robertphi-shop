@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
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
                    @foreach ( $editProduct as $key => $pro)
                    
                    <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="ProductName" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="ProductImage" class="form-control" id="exampleInputEmail1"/>
                            <img src="{{URL::to('storage/app/public/uploads/products/'.$pro->product_image)}}" alt="Ảnh sản phẩm" height="100px" width="100px">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="number" name="ProductQuantity" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm"/ value="{{$pro->product_quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="ProductPrice" class="form-control" id="exampleInputEmail1" value="{{$pro->product_price}}"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" class="form-control" name="ProductDescription" id="ckeditorDesc"  rows="5">{!!$pro->product_decs!!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa tìm kiếm</label>
                            <textarea style="resize: none" class="form-control" name="ProductKeyword" id="exampleInputPassword1" rows="3">{{$pro->product_keyword}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" class="form-control" name="ProductContent" id="ckeditorContent" rows="5">{{$pro->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Danh mục sản phẩm</label>
                            <select class="form-control input-sm m-bot15" name="CatePro">
                                @foreach ($cateProduct as $key => $cate)
                                @if($cate->id == $pro->category_id)
                                <option selected value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endif
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Thương hiệu sản phẩm</label>
                            <select class="form-control input-sm m-bot15" name="BrandPro">
                                @foreach ($brandProduct as $key => $brand)
                                @if($brand->brand_id == $pro->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="ProductStatus">
                                @if($pro->product_status == 0)
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                                @else
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" name="AddProduct" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                </div>
            </div>
    </section>
</div>
@endsection
