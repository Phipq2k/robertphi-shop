<style type="text/css">
    span.badges{
        position: absolute;
        margin: -40px 0 30px 20px;
        background: red;
        border-radius: 50%;
        color: white;
        width: 30px;
        height: 30px;
        padding-top: 5px;
        text-align: center;
    }
    #header{
        position: fixed;
        background: white;
        width: 100%;
        z-index: 20;
        margin-top: -240px;
    }
    .header-top {
        background-color: #ccc;
    }

    .li-cart:hover .hover-cart{
        display: inherit;

    }

    ul.hover-cart{
        position: absolute;
        margin-left: -40px;
        margin-top: 12px;
        background: ;
        padding: 10px 5px;
        background: #ccc;
        border-radius: 5px;
        z-index: 19;
        display: none;
        text-align: center;
    }
    ul.hover-cart li{
        text-align: center;
        background: #FE980F;
        margin: 1px 0;
        padding: 10px;
    }
    ul.hover-cart li a{
        font-size: 12px;
    }
    ul.hover-cart li a p.title-product-cart{
        font-weight: bold;
    }
    ul.hover-cart li a h4{
        font-size: 12px;
    }
    ul.hover-cart li a:hover{
        color: white;
    }
    ul.hover-cart::before{
        width: 28px;
        height: 28px;
        background: #ccc;
        position: absolute;
        content: '';
        margin-top: -24px;
        margin-left: 36px;
        border-radius: 0 0 0 100%;
        transform: rotate(-45deg);

    }
    ul.hover-cart li a img{
        width: 80px;
        height: 80px;
    }
    ul.hover-cart a.btn-full-cart{
        /* padding: 5px 0; */
        font-weight: bold;
        background: #ccc;
        border: none;
    }
    ul.hover-cart a.btn-full-cart:hover{
        background: #ccc;
        border: none;
    }
    ul.hover-cart a.cart_quantity_delete{
        background: none;
        border: none;
        font-size: 20px;
    }
    ul.hover-cart a.cart_quantity_delete:hover{
        background: none;
        color: red;
    }
</style>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> 012345678</a></li>
                            <li><a href="https://www.facebook.com/robertphicoder"><i class="fa fa-facebook"></i> Robert Phi</a></li>
                            <li><a href="{{url('/dang-ky-khuyen-mai')}}"><i class="fa fa-bullhorn"></i>Đăng ký Khuyến mãi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    @if(Session::get('customerId'))
                    <div class="logo pull-left">
                        <a href="{{url('/profile-customer')}}"><img width="50" src="{{asset('public/Frontend/images/customerAvatar.png')}}" alt=""></a>
                        <span style="font-size:20px;margin-left:20px;color:#FE980F;font-weight:bold">Xin chào {{$customer->customers_name}}</span>
                    </div>
                    @else
                    <div class="logo pull-left">
                        <a href="{{url('/login-checkout')}}"><img width="50" src="{{asset('public/Frontend/images/customerAvatar.png')}}" alt=""></a>
                        <a href="{{url('/login-checkout')}}" style="font-size:20px;margin-left:20px;color:#FE980F;font-weight:bold">Đăng nhập</a>
                    </div>
                    @endif
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a class="{{Request::segment(1) == 'favorite-list' ? 'active' : ''}}" href="{{URL::to('/favorite-list')}}"><i class="fa fa-star"></i> Yêu thích</a></li>
                            <li><a class="{{Request::segment(1) == 'checkout' ? 'active' : ''}}" href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            @if (Session::get('customerId'))
                            <li><a class="{{Request::segment(1) == 'order-history' ? 'active' : ''}}" href="{{URL::to('/order-history')}}"><i class="fa fa-book"></i> Lịch sử đơn hàng</a></li>
                            <li><a onClick="return confirm('Tất cả mọi thao tác của bạn sẽ bị hủy, bạn muốn đăng xuất chứ?')" href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                            @endif
                            <li class="li-cart">
                                <a class="{{Request::segment(1) == 'show-cart-product' ? 'active' : ''}}" title="Giỏ hàng" style="font-size:30px" href="{{URL::to('/show-cart-product')}}"><i class="fa fa-shopping-cart"></i></a>
                                <span class="badges"></span>
                                <ul class="hover-cart">
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <style>
                        .mainmenu ul .image-logo {
                            margin-top: -12px;
                            padding-left: 12px;
                        }
                    </style>
                    <div class="mainmenu pull-left">
                        <ul style="margin: 0 0 0 10px" class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{URL::to('/home')}}" class="menu-home {{Request::segment(1) == 'home' || Request::segment(1) == ''? 'active' : ''}}">Trang chủ</a></li>
                            <li class="dropdown"><a>Sản phẩm<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu ">
                                @foreach ($category as $cate)
                                @if ($cate->category_parent_id == 0 && $cate->category_parent_status == 1)
                                @else
                                    <li><a class="menu-home {{Request::segment(2) == $cate->category_slug ? 'active' : ''}}" href="{{url('/danh-muc-san-pham/'.$cate->category_slug)}}">{{$cate->category_name}}</a></li>
                                @endif           	
                                @endforeach
                                </ul>
                            </li> 
                            <li class="dropdown"><a>Blog<i class="fa fa-angle-down menu-home"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($categoryPost as $key => $catePost)
                                        <li><a class="menu-home {{Request::segment(2) == $catePost->cate_post_slug ? 'active' : ''}}" href="{{url('/blog/'.$catePost->cate_post_slug)}}">{{$catePost->cate_post_name}}</a></li>        	
                                    @endforeach
                                </ul>

                            </li> 

                            {{-- <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li> --}}
                            <li ><a class="menu-home {{Request::segment(1) == 'contact' ? 'active' : ''}}" href="{{URL::to('/contact')}}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 search-product">
                    <form action="{{URL::to('/search-product')}}" method="post" >
                        {{ csrf_field() }}
                        <div class="search_box pull-right">
                            <input type="text" name="keywordSubmit" placeholder="Tìm kiếm sản phẩm"/>
                            <button type="submit" name="searchItem" class="btn btn-primary btn-sm" style="margin-top: 0px"><i class="glyphicon glyphicon-search"></i></button>
                            {{-- <input type="submit"class="btn btn-primary btn-sm" value="Submit"/> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->