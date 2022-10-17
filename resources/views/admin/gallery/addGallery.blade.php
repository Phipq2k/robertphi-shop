@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm thư viện ảnh
            </header>
            <span class="text-alert message"></span>
            <form action="{{url('/insert-gallery/'.$productId)}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row col-md-10">
                <div class="col col-md-2">

                </div>
                <div class="col col-md-7">
                  <input class="form-control" type="file" name="galleryImages[]" id="images" accept="image/*" multiple />
                  <span id="error_gallery"></span>
                </div>
                <div class="col col-md-1" align="right">
                  <input type="button" onclick="return alert('Vui lòng chọn ảnh')" value="Tải ảnh lên" class="btn btn-success btn-sm insert-gallery"/>
                </div>
              </div>
            </form>
            <div class="panel-body">    
                <input type="hidden" value="{{$productId}}" name="ProId" class="product_id">
                  <div id="gallery_load">
                  </div>
            </div>
    </section>
</div>
@endsection
