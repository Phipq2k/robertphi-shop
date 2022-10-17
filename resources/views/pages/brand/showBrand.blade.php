@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('sidebar')
@include('components.sidebar')
@endsection
@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        @foreach($brandName as $key => $brandTitle)
        <nav aria-label="breadcrumb">
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="background: none">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$brandTitle->brand_name}}</li>
                  </ol>
            </div>
        </nav>
        <h2 class="title text-center">{{$brandTitle->brand_name}}</h2>
        @endforeach
        @foreach ($productsByBrand as $key => $pro)
        <a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            @csrf
                            <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                            <input type="hidden" value="{{$pro->product_quantity}}" class="product_quantity_{{$pro->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                            <a href="{{URL::to('chi-tiet-san-pham/'.$pro->product_slug)}}">
                                <img src="{{URL::to('storage/app/public/uploads/products/'.$pro->product_image)}}" alt="Ảnh sản phẩm"/>
                                <h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
                                <p>{{$pro->product_name}}</p>
                                <input name="quantity" type="hidden" min="1" value="1" />
                                <input name="productIdHiden" type="hidden" value="{{$pro->product_id}}" />
                            </a>
                            {{-- <button type="submit" class="btn btn-default add-to-cart">Thêm vào giỏ hàng</button> --}}
                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$pro->product_id}}" name="addToCart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                            <button type="button" data-toggle="modal" data-target="#quickView" data-id_product="{{$pro->product_id}}" class="btn btn-default quick-view"  name="addToCart"><i class="fa fa-eye"></i>Xem nhanh</button>
                        </form>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </a>
        @endforeach
        <!--Modal content-->
        <div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="pro_quickview_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <h4 align="center" class="titleCt">Hình ảnh sản phẩm</h4>
                                <div class="view-product">
                                    <span id="pro_quickview_img" class="pro_quickview_img"></span>
                                    <span id="pro_quickview_gallery" class="pro_quickview_img"></span>
                                </div>
                            </div>
                            <form>
                                @csrf
                                <div id="quickview_hidden_info"></div>
                                <div class="col-sm-7">
                                    <h4 align="center" class="titleCt">Thông tin sản phẩm</h4>
                                    <p id="pro_quickview_id"></p>
                                    <h2 id="pro_quickview_price" class="pro_quickview_price"></h2>
                                    <input id="cart_quantity" type="hidden" min="1" value="1" />
                                    <h5>Mô tả sản phẩm</h5>
                                    <p id="pro_quickview_desc" class="pro_quickview_desc"></p>
                                    <hr />
                                    <h5>Nội dung sản phẩm</h5>
                                    <p id="pro_quickview_content" class="pro_quickview_content"></p>
                                    <p id="pro_quickview_cate"></p>
                                    <p id="pro_quickview_brand"></p>
                                    <button type="button" class="btn btn-primary add-to-cart-quick-view" name="addToCart"><i class="fa fa-shopping-cart"></i> Mua ngay</button>
                                    <p id="notify_quickview"></p>
                                </div>
                            </form>
                        </div>    
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!--features_items-->
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {!!$productsByBrand->links()!!}
    </ul>
</div>
@section('footer')
@include('components.footer')
@endsection
@endsection