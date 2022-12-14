@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('sidebar')
@include('components.sidebar')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-9 padding-right">
            @foreach ($productDetail as $key => $detailPro)
            <nav aria-label="breadcrumb">
                <div class="breadcrumbs">
                    <ol class="breadcrumb" style="background: none">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/danh-muc-san-pham/'.$detailPro->category_slug)}}">{{$categoryName}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$detailPro->product_name}}</li>
                    </ol>
                </div>
            </nav>
            <div style="margin-left: 16px" class="fb-like" data-href="{{$urlCanonical}}" data-width="" data-layout="box_count" data-action="like" data-size="small" data-share="false"></div>
            <div class="product-details"><!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <ul id="imageGallery">
                            <li data-thumb="{{URL::to('storage/app/public/uploads/products/'.$detailPro->product_image)}}" data-src="{{URL::to('storage/app/public/uploads/products/'.$detailPro->product_image)}}">
                            <img src="{{URL::to('storage/app/public/uploads/products/'.$detailPro->product_image)}}" />
                            </li>
                            @foreach ($gallery as $key => $gal)
                            <li data-thumb="{{URL::to('storage/app/public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{URL::to('storage/app/public/uploads/gallery/'.$gal->gallery_image)}}">
                                <img src="{{URL::to('storage/app/public/uploads/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}" />
                            </li>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                        <img src="{{url('public/Frontend/images/new.jpg')}}" class="newarrival" alt="" />
                        <h2>{{$detailPro->product_name}}</h2>
                        <p>M?? ID: {{$detailPro->product_id}}</p>
                        <img src="{{url('public/Frontend/images/rating.png')}}" alt="" />
                        <form>
                            @csrf
                            <span>
                                <input type="hidden" value="{{$detailPro->product_id}}" class="cart_product_id_{{$detailPro->product_id}}">
                                <input type="hidden" value="{{$detailPro->product_name}}" class="cart_product_name_{{$detailPro->product_id}}">
                                <input type="hidden" value="{{$detailPro->product_image}}" class="cart_product_image_{{$detailPro->product_id}}">
                                <input type="hidden" value="{{$detailPro->product_price}}" class="cart_product_price_{{$detailPro->product_id}}">
                                <input type="hidden" value="{{$detailPro->product_quantity}}" class="product_quantity_{{$detailPro->product_id}}">
                                <span>{{number_format($detailPro->product_price)}} VND</span>
                                <label>S??? l?????ng:</label>
                                <input name="quantity" type="number" min="1" value="1" class="cart_product_qty_{{$detailPro->product_id}}" />
                                <input name="productIdHiden" type="hidden" value="{{$detailPro->product_id}}" />
                                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$detailPro->product_id}}" name="addToCart"><i class="fa fa-shopping-cart"></i>Th??m v??o gi??? h??ng</button>
                            </span>
                        </form>
                        <p><b>T??nh tr???ng:</b> C??n h??ng</p>
                        <p><b>??i???u ki???n:</b> M???i 100%</p>
                        <p><b>Danh m???c:</b> {{$detailPro->category_name}}</p>
                        <p><b>Th????ng hi???u:</b> {{$detailPro->brand_name}}</p>
                        <div class="fb-share-button" data-href="{{$urlCanonical}}" data-layout="box_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia s???</a></div>
                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->



            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li ><a href="#details" data-toggle="tab">M?? t???</a></li>
                        <li><a href="#companyprofile" data-toggle="tab">Chi ti???t s???n ph???m</a></li>
                        <li class="active"><a href="#reviews" data-toggle="tab">????nh gi??</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade " id="details" >
                        <p>{!!$detailPro->product_decs!!}</p>
                    </div>
                    
                    <div class="tab-pane fade" id="companyprofile" >
                        <p>{!!$detailPro->product_content!!}</p>
                    </div>
                    
                    <div class="tab-pane fade active in fade" id="reviews" >
                        <div class="col-sm-12">
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                            </ul>
                            <form>
                                @csrf
                                <input type="hidden" class="comment-product-id" value="{{$detailPro->product_id}}">
                                <div id="show_comment_client"></div>
                                {{-- <div class="row show-comments" >
                                    <div class="col col-md-2">
                                        <div id="avatar_comment">
                                        P
                                        </div>
                                    </div>
                                    <div class="col col-md-10">
                                        <h4>Tr???n Qu???c Phi</h4>
                                        <span>23-8-2000</span>
                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam est, magnam dolorem soluta enim fuga distinctio voluptatum ratione id reiciendis facilis impedit unde, totam eius consequuntur sequi ducimus eveniet qui?</p>
                                    </div>
                                </div>
                                <p></p> --}}
                            </form>
                            <hr width="100%" style="border: 2px double #ccc"/>
                            <p style="color: #FE980F"><b>Vi???t ????nh gi?? c???a b???n</b></p>
                            <form>
                                @csrf
                                <ul class="list-inline" title="X???p h???ng trung b??nh">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            if($i <= $rating){
                                                $color = '#FE980F';
                                            }
                                            else{
                                                $color = '#ccc';
                                            }
                                        @endphp
                                        <li title="X???p h???ng sao" id="{{$detailPro->product_id}}_{{$i}}" data-index = "{{$i}}" data-id_product = "{{$detailPro->product_id}}" data-rating = "{{$rating}}" style="font-size:24px;cursor:pointer;color:<?php echo $color; ?>" class="star-rating">
                                            &#9733;
                                        </li>
                                    @endfor
                                </ul>
                            </form>
                            <div id="notify_comment" class="text text-danger"></div>
                            <form id="upload_comment">
                                @csrf
                                <div class="row">
                                    <input type="hidden" value="0" class="comment-status">
                                    <div class="col col-md-6 col-sm-6">
                                        <input class="form-control comment-firstname" type="text" placeholder="H???"/>
                                    </div>
                                    <div class="col col-md-6 col-sm-6">
                                        <input class="form-control comment-lastname" type="text" placeholder="T??n"/>
                                    </div>
                                </div>
                                <textarea style="background-color: white; border: 1px solid #ccc" placeholder="Vi???t b??nh lu???n" class="form-control comment-content" ></textarea>
                                <b>????nh gi?? sao: </b> <img src="{{url('public/Frontend/images/rating.png')}}" alt="" />
                                <button type="button" class="btn btn-default pull-right send-comment">
                                    ????ng b??nh lu???n
                                </button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div><!--/category-tab-->
            @endforeach

            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">S???n ph???m li??n quan</h2>
                
                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach ($relatedProduct as $key => $relatedPro)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('storage/app/public/uploads/products/'.$relatedPro->product_image)}}" alt="???nh s???n ph???m" height="200px" />
                                            <h2>{{number_format($relatedPro->product_price).' '.'VND'}}</h2>
                                            <p>{{$relatedPro->product_name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Th??m v??o gi??? h??ng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>			
                </div>
            </div><!--/recommended_items-->
        </div>
    </div>
</div>
@section('footer')
@include('components.footer')
@endsection
@endsection
