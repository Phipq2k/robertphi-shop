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
                Chỉnh sửa thông tin liên hệ
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
                    <form role="form" action="{{URL::to('/update-contact-data')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_contact" value="{{$contact->contact_id}}">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thông tin liên hệ</label>
                            <textarea style="resize: none" class="form-control" id="ckeditorContent" name="contact_info"  placeholder="Mô tả danh mục sản phẩm" rows="5">{{$contact->contact_info}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh logo</label>
                            <input type="file" name="contact_images" accept="image/*" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                            <img width="10%" src="{{url('storage/app/public/uploads/logo/'.$contact->contact_images)}}" alt="Logo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Bản đồ</label>
                            <textarea style="resize: none" class="form-control map" name="contact_map"  placeholder="Mô tả danh mục sản phẩm" rows="5">{{$contact->contact_map}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Fanpage</label>
                            <textarea style="resize: none" class="form-control" name="contact_fanpage"  placeholder="Mô tả danh mục sản phẩm" rows="5">{{$contact->contact_fanpage}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-info">Cập nhật</button>
                        <a class="btn btn-danger"href="{{url('delete-contact/'.$contact->contact_id)}}">Xóa</a>
                    </form>
                </div>
            </div>
    </section>
</div>

@endsection
