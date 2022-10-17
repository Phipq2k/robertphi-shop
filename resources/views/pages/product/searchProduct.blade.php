@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('sidebar')
@include('components.sidebar')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach ($searchProduct as $key => $search)
    <a href="{{URL::to('chi-tiet-san-pham/'.$search->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form>
                            {{csrf_field()}}
                            <input type="hidden" value="{{$search->product_id}}" class="cart_product_id_{{$search->product_id}}">
                            <input type="hidden" value="{{$search->product_name}}" class="cart_product_name_{{$search->product_id}}">
                            <input type="hidden" value="{{$search->product_image}}" class="cart_product_image_{{$search->product_id}}">
                            <input type="hidden" value="{{$search->product_price}}" class="cart_product_price_{{$search->product_id}}">
                            <input type="hidden" value="{{$search->product_quantity}}" class="product_quantity_{{$search->product_id}}">
                            <input type="hidden" value="1" class="cart_product_qty_{{$search->product_id}}">
                            <a href="{{URL::to('chi-tiet-san-pham/'.$search->product_id)}}">
                                <img src="{{URL::to('storage/app/public/uploads/products/'.$search->product_image)}}" alt="Ảnh sản phẩm"/>
                                <h2>{{number_format($search->product_price).' '.'VND'}}</h2>
                                <p>{{$search->product_name}}</p>
                                <input name="quantity" type="hidden" min="1" value="1" />
                                <input name="productIdHiden" type="hidden" value="{{$search->product_id}}" />
                            </a>
                            {{-- <button type="submit" class="btn btn-default add-to-cart">Thêm vào giỏ hàng</button> --}}
                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$search->product_id}}" name="addToCart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
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
    
</div><!--features_items-->
<!--/recommended_items-->
@section('footer')
@include('components.footer')
@endsection
@endsection