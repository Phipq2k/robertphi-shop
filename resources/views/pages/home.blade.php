@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('slider')
@include('components.slider')
@endsection
@section('sidebar')
@include('components.sidebar')
@endsection
@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        <div class="row"><!--Sắp xếp sản phẩm theo các tiêu chí-->
            <div class="col col-sm-4">
                <label class="label label-primary" for="amount">Sắp xếp theo</label>
                <form>
                    @csrf
                    <select name="sort" id="sort" class="form form-row form-cotrol">
                        <option value="{{Request::url()}}?sort_by=none">--Lọc--</option>
                        <option value="{{Request::url()}}?sort_by=tang_dan">--Giá tăng dần--</option>
                        <option value="{{Request::url()}}?sort_by=giam_dan">--Giá giảm dần--</option>
                        <option value="{{Request::url()}}?sort_by=a_z">A đến Z</option>
                        <option value="{{Request::url()}}?sort_by=z_a">Z đến A</option>
                    </select>
                </form>
            </div>
        </div><!--/Sắp xếp sản phẩm theo các tiêu chí-->
        <hr>
        @php
            if(Session::get('customerId')){
                $customer_check = 1;
            }
            else{
                $customer_check = 0;
            }
        @endphp
        @foreach ($all as $key => $pro)
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
                            <input type="hidden" value="{{$customer_check}}" class="check-customers">
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
        
        <!-- Modal -->
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
        {!!$all->links()!!}
    </ul>
    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                @foreach ($category as $key => $cateTab)
                @if ($cateTab->category_parent_id == 0 && $cateTab->category_parent_status == 1)
                @else
                    <li><a class="tab-product" data-id="{{$cateTab->id}}" href="#pro_{{$cateTab->id}}" data-toggle="tab">{{$cateTab->category_name}}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        <div id="load_products_tab"></div>
    </div><!--/category-tab-->
</div>
@section('footer')
@include('components.footer')
@endsection
@endsection