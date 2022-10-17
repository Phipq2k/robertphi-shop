@extends('admin_layout')
@section('admin_content')
<style type="text/css">
  ul.top-menu>li>a{
    background: black;
  }
</style>
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading" id="header_contact_form">
                Thêm thông tin liên hệ
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
                    <form role="form" action="{{URL::to('/insert-contact-data')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thông tin liên hệ</label>
                            <textarea style="resize: none" class="form-control" id="ckeditorContent" name="contact_info"  placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh logo</label>
                            <input type="file" name="contact_images" accept="image/*" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Bản đồ</label>
                            <textarea style="resize: none" class="form-control map" name="contact_map"  placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Fanpage</label>
                            <textarea style="resize: none" class="form-control" name="contact_fanpage"  placeholder="Mô tả danh mục sản phẩm" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Thêm</button>
                    </form>
                </div>
            </div>
    </section>
</div>

@endsection
