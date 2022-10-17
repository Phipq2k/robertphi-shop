@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Cập nhật thương hiệu sản phẩm
            </header>
            <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
            <div class="panel-body">
                {{-- @foreach ($editBrandProduct as $key => $editValue)   
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product/'.$editValue->brand_id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{ $editValue->brand_name }}" name="BrandProductName" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" class="form-control" name="BrandProductDescription" id="ckeditorBrandEdit" rows="5">{{ $editValue->brand_decs }}</textarea>
                        </div>
                        
                        <button type="submit" name="UpdateBrandProduct" class="btn btn-info">Cập nhật thương hiệu</button>
                    </form>
                </div>
                @endforeach --}}

                
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product/'.$editBrandProduct->brand_id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{ $editBrandProduct->brand_name }}" name="BrandProductName" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa thương hiệu</label>
                            <textarea style="resize: none" class="form-control" name="MetaKeywordBrand" id="" rows="5">{{ $editBrandProduct->brand_keyword }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" class="form-control" name="BrandProductDescription" rows="5">{{ $editBrandProduct->brand_decs }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="BrandProductStatus">
                                @if($editBrandProduct->brand_status == 0)
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                                @else
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                                @endif
                            </select>
                        </div>
                        
                        <button type="submit" name="UpdateBrandProduct" class="btn btn-info">Cập nhật thương hiệu</button>
                    </form>
                </div>
               
            </div>
    </section>
</div>
@endsection
