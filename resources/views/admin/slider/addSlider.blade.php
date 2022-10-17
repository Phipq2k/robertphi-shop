@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm Banner
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
                    <form role="form" action="{{URL::to('/save-banner')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Banner</label>
                            <input type="text" name="SliderName" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Banner</label>
                            <input type="file" name="SliderImage" class="form-control" id="exampleInputEmail1"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Banner</label>
                            <textarea style="resize: none" class="form-control" name="SliderDescription" placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Hiển thị</label>
                            <select class="form-control input-sm m-bot15" name="SliderStatus">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="AddSlider" class="btn btn-info">Thêm Banner</button>
                    </form>
                </div>
            </div>
    </section>
</div>
@endsection
