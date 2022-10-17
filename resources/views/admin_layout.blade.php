<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Trang quản trị</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="shortcut icon" href="{{asset('public/Frontend/images/favicon.ico')}}">
<link rel="stylesheet" href="{{asset('public/Backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/Backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/Backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/Backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/Backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/Backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/Backend/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('public/Backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/Backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/Backend/js/morris.js')}}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
{{-- Config Css layout --}}
<style type="text/css">
    html, body {
        font-family: 'Roboto', sans-serif;
        font-size: 100%;
        overflow-x: hidden;
        background:  url('public/Backend/images/background-admin.jpg') no-repeat 0px 0px;
        background-size: cover;
    }

    .header {
        background: linear-gradient(to bottom, #0066ff 0%, #ccffff 100%);
    }

    .brand {
        background: #0d1fbd;
    }

    .search {
        background: #0d1fbd url(public/Backend/images/search-icon.png) no-repeat 10px 8px;
    }

    .top-nav ul.top-menu>li>a {
        background: #0d1fbd;
    }

    .top-nav ul.top-menu>li>a:hover, .top-nav ul.top-menu>li>a:focus {
        border: 1px solid #3dd8e3;
        background: #3dd8e3 !important;
    }

    .sidebar-toggle-box {
        background: #0d1fbd;
    }

    .sidebar-toggle-box:hover {
        background: #3dd8e3;
    }

    .footer {
        background: #0d1fbd;
    }

    .footer p a {
        color: #23bb62;
    }
    ul.sidebar-menu li a.active, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus {
        background-color: #292e2a;
    }
    ul.sidebar-menu li ul.sub li a:hover, ul.sidebar-menu li ul.sub li.active a {
        background-color: #292e2a;
    }
</style>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">Admin</a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
{{-- <div class="nav notify-row" id="top_menu">
    <ul class="nav top-menu">
        <li class="dropdown">
            <a  href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success">8</span>
            </a>
        </li>
    </ul>
</div> --}}

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img class="img img-circle" alt="" src="{{url('storage/app/public/uploads/admins/3.png')}}">
                <span class="username">
					<?php
							$name = Auth::user()->admin_name;
							if($name){
								echo $name;
							}
						
						
					?>
				</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Trang cá nhân</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>Cài đặt</a></li>
                @impersionate
                <li><a href="{{url('/impersionate-destroy')}}"><i class="fa fa-sign-out" aria-hidden="true"></i> Rời khỏi tài khoản này</a></li>
                @endimpersionate
                <li><a href="{{URL::to('/user-logout-auth')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="{{Request::segment(1) == 'dashboard' ? 'active' : ''}}" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                @hasrole(['admin'])
                <li class="sub-menu">
                    <a class="{{Request::segment(1) == 'contact-information' || Request::segment(1) == 'list-contact-customer' ? 'active' : ''}}">
                        <i class="fa fa-tty"></i>
                        <span>Quản lý thông tin liên hệ</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'contact-information' ? 'active' : ''}}" href="{{URL::to('/contact-information')}}">Thông tin website</a></li>
						<li><a href="{{URL::to('/list-contact-customer')}}">Danh sách khách hàng liên hệ</a></li>
                    </ul>
                </li>
                @endhasrole

                <li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-banner' || Request::segment(1) == 'manager-banner' ? 'active' : ''}}">
                        <i class="fa fa-bullhorn"></i>
                        <span>Banner</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-banner' ? 'active' : ''}}"  href="{{URL::to('/add-banner')}}">Thêm Banner</a></li>
						<li><a class="{{Request::segment(1) == 'manager-banner' ? 'active' : ''}}" href="{{URL::to('/manager-banner')}}">Danh sách Banner</a></li>
                    </ul>
                </li>
                @hasrole(['admin','author'])
                <li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-user' || Request::segment(1) == 'all-users' ? 'active' : ''}}">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Nguời dùng</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-user'  ? 'active' : ''}}" href="{{URL::to('/add-user')}}">Thêm người dùng</a></li>
						<li><a class="{{Request::segment(1) == 'all-users' ? 'active' : ''}}" href="{{URL::to('/all-users')}}">Danh sách người dùng</a></li>
                    </ul>
                </li>
                @endhasrole

                <li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-category-post' || Request::segment(1) == 'list-category-post' ? 'active' : ''}}">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Danh mục bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-category-post'  ? 'active' : ''}}" href="{{URL::to('/add-category-post')}}">Thêm danh mục bài viết</a></li>
						<li><a class="{{Request::segment(1) == 'list-category-post' ? 'active' : ''}}" href="{{URL::to('/list-category-post')}}">Danh sách danh mục bài viết</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-post' || Request::segment(1) == 'list-post' ? 'active' : ''}}">
                        <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-post' ? 'active' : ''}}" href="{{URL::to('/add-post')}}">Thêm  bài viết</a></li>
						<li><a class="{{Request::segment(1) == 'list-post' ? 'active' : ''}}" href="{{URL::to('/list-post')}}">Danh sách bài viết</a></li>
                    </ul>
                </li>
                <li>
                    <a class="{{Request::segment(1) == 'manager-order' ? 'active' : ''}}" href="{{URL::to('/manager-order')}}">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>

				<li class="sub-menu">
                    <a class="{{Request::segment(1) == 'insert-coupon' || Request::segment(1) == 'list-coupon' ? 'active' : ''}}">
                        <i class="fa fa-qrcode"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'insert-coupon' ? 'active' : ''}}" href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
						<li><a class="{{Request::segment(1) == 'list-coupon' ? 'active' : ''}}" href="{{URL::to('/list-coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                {{-- <li class="sub-menu">
                    <a>
                        <i class="fa fa-envelope-square"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/info-email')}}">Trang nội dung email</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a class="{{Request::segment(1) == 'delivery' ? 'active' : ''}}" href="{{URL::to('/delivery')}}">
                        <i class="fa fa-paper-plane"></i>
                        <span>Vận chuyển</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-category-product' || Request::segment(1) == 'all-category-product' ? 'active' : ''}}">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-category-product' ? 'active' : ''}}" href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
						<li><a class="{{Request::segment(1) == 'all-category-product' ? 'active' : ''}}" href="{{URL::to('/all-category-product')}}">Danh sách danh mục sản phẩm</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-brand-product' || Request::segment(1) == 'all-brand-product' ? 'active' : ''}}">
                        <i class="fa fa-flag"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-brand-product' ? 'active' : ''}}" href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a class="{{Request::segment(1) == 'all-brand-product' ? 'active' : ''}}" href="{{URL::to('/all-brand-product')}}">Danh sách thương hiệu sản phẩm</a></li>
                    </ul>
                </li>

				<li class="sub-menu">
                    <a class="{{Request::segment(1) == 'add-product' || Request::segment(1) == 'all-product' ? 'active' : ''}}">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a class="{{Request::segment(1) == 'add-product' ? 'active' : ''}}" href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a class="{{Request::segment(1) == 'all-product' ? 'active' : ''}}" href="{{URL::to('/all-product')}}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	
        @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>Mọi vấn đề cần giải quyết vui lòng liên hệ anh <a target="_blank" href="https://www.facebook.com/robertphicoder/">Trần Quốc Phi</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/Backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/Backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/Backend/js/scripts.js')}}"></script>
<script src="{{asset('public/Backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/Backend/js/jquery.nicescroll.js')}}"></script>
{{-- <script src="{{asset('public/Backend/js/jquery-ui-git.js')}}"></script> --}}
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" integrity="sha256-xH4q8N0pEzrZMaRmd7gQVcTZiFei+HfRTBPJ1OGXC0k=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
{{-- <script src="{{asset('public/Frontend/js/sweetalert.js')}}"></script> --}}

{{-- gửi thông tin mã giảm giá vào email --}}
<script>
    //Vô hiệu hóa thẻ a
    $(document).ready(function(){
       
        //Sự kiện nhấn vào radio button
        var radios = document.querySelectorAll('input[name="coupon_checked"]');
        for(var i = 0; i < radios.length; i++) {
            // console.log(radios[i]);
            radios[i].onclick = function(e) {
                $('.btn-send-coupon').removeAttr('disabled');
                var coupon_id = e.target.value;
                var _token = $('input[name="_token"]').val();
                //Sự kiện gửi email
                $('.btn-send-coupon').click(function() {
                  $.ajax({
                      url: `{{url('/send-coupon')}}`,
                      method: 'POST',
                      data: {coupon_id: coupon_id,_token:_token},
                      success: function(data){
                          $('.notify').html('Gửi mã thành công');
                          setTimeout(() => {
                              $('.notify').html('');
                          }, 3000);
                      }
                  });
                });
            }
        }
    });
</script>

{{-- feeship handler --}}
<script type="text/javascript">
$(document).ready(function(){
    fetchDelivery();
    function fetchDelivery(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/select-feeship')}}',
            method: 'POST',
            data: {_token:_token},
            success: function(data){
                $('#loadDelivery').html(data);
            }
        });

    }

    $(document).on('blur','.feeship_edit',function(){
        var _token = $('input[name="_token"]').val();
        var feeshipId = $(this).data('feeship_id');
        var feeValue = $(this).text();
        $.ajax({
            url: '{{url('/update-feeship')}}',
            method: 'POST',
            data: {feeshipId: feeshipId, feeValue: feeValue, _token:_token},
            success: function(data){
                fetchDelivery();
            }
        });
        
    });

    $(document).on('focus','.feeship_edit',function(e){
        var feeValue = $(this).text();
        feeValue = feeValue.replace('.','');
        feeValue = feeValue.slice(0, feeValue.length - 3);
        e.target.innerText = feeValue;
    });

    $('.btn-add-delivery').on('click',function(){
        var city  = $('.city').val();
        var province = $('.province').val();
        var ward  = $('.ward').val();
        var feeShip  = $('.feeship').val();
        var _token = $('input[name="_token"]').val();

        // alert(city);
        // alert(province);
        // alert(ward);
        // alert(feeShip);

        $.ajax({
            url: '{{url('/insert-data-delivery')}}',
            method: 'POST',
            data: {city:city, province:province, ward:ward, feeShip:feeShip, _token:_token},
            success: function(data){
                fetchDelivery();
            }
        });
    });

    $('.choose').on('change',function(){
        var action = $(this).attr('id');
        var maId = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
        // alert(action);
        // alert(matp);
        // alert(_token);
        if(action == 'city'){
            result = 'province';
        }
        if(action == 'province'){
            result = 'ward';
        }
        $.ajax({
            url: '{{url('/select-delivery')}}',
            method: 'POST',
            data: {action:action, maId:maId, _token:_token},
            success: function(data){
                $('#'+result).html(data);
            }
        });
    });
});

</script>

{{-- Comments manager--}}
<script>
    $(document).ready(function(){
        //Load comments with status function handler
        loadManagerComments();
        function loadManagerComments(){
            var pro_id = $('.comment-pro-manager-id').val();
            var comments_select_status = $('.show-comment-status').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/show-comments-status')}}',
                method: 'POST',
                data: {pro_id: pro_id, comments_select_status: comments_select_status,_token:_token},
                success: function(data){
                   $('#show_comments_status').html(data);
                }
            });
        }

        //Select status show comments
        $('.show-comment-status').change(function(){
            var comments_select_status = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/show-comments-status')}}',
                method: 'POST',
                data: {comments_select_status: comments_select_status,_token:_token},
                success: function(data){
                    loadManagerComments();
                }
            });
        });

        //Approve comments and Unapprove comments
        $(document).on('click','.approveCmt',function(){
            var commentId = $(this).data('id_cmt');
            var commentStatus = $('.comment-status').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/approve')}}',
                method: 'POST',
                data: {commentId: commentId,_token:_token},
                success: function(data){
                    loadManagerComments();
                    if(commentStatus == 0){
                        $('.notify-comments-manager').text('Duyệt bình luận thành công');
                    }
                    else{
                        $('.notify-comments-manager').text('Ẩn bình luận thành công');
                    }
                    setTimeout(() => {
                            $('.notify-comments-manager').text('');
                        },1500);
                }
            });
        });

        //Edit comment by id
        $(document).on('click','.edit-comment-by-id',function(){
            var cmtId = $(this).data('id_cmt');
            $(`#dialog_reply_comment_${cmtId}`).dialog({
                height: 'auto',
                width: 500,
                modal: true,
                resizable: true,
                dialogClass: 'no-close success-dialog'
            });
            $(`.send-reply-comment-${cmtId}`).click(function(){
                var comment_content = $(`.reply_content_${cmtId}`).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:'{{url('/edit-cmt')}}',
                    method: 'POST',
                    data: {cmtId:cmtId, comment_content:comment_content,_token:_token},
                    success: function(data){
                        $('.notify-comments-manager').text('Chỉnh sửa bình luận thành công');
                        $(`#dialog_reply_comment_${cmtId}`).dialog('close');
                        setTimeout(() => {
                            window.location.reload();
                        },2000);
                    }
                });
            })

        });

        //Delete to comment
        $(document).on('click', '.delete-cmt',function(){
            var commentId = $(this).data('id_cmt');
            var comment_parent_id = $(this).data('comment_parent_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn có chắc là muốn xóa bình luận này không?')){
                $.ajax({
                    url:'{{url('/del-cmt')}}',
                    method: 'POST',
                    data: {commentId: commentId,_token:_token},
                    success: function(data){
                        if(comment_parent_id == -1){
                            loadManagerComments();
                            $('.notify-comments-manager').text('Xóa bình luận thành công');
                            setTimeout(() => {
                                $('.notify-comments-manager').text('');
                            },2000);
                        }
                        else{
                            $('.notify-comments-manager').text('Xóa bình luận thành công');
                            setTimeout(() => {
                                window.location.reload();
                            },2000);
                        }
                    }
                });
                // alert(commentId);
            }
        });
        
        //Dialog reply to comments
        $(document).on('click','.reply-comment',function(){
            var cmtId = $(this).data('id_comment');
            $(`#dialog_reply_comment_${cmtId}`).dialog({
                height: 200,
                width: 500,
                modal: true,
                resizable: true,
                dialogClass: 'no-close success-dialog'
            });
            //Send reply to comment
            $(`.send-reply-comment-${cmtId}`).click(function(){
                var cmtId = $(this).data('id_comment');
                var pro_id = $('.comment-pro-manager-id').val();
                var comment_parent_name = $(this).data('name');
                var comment_name = $(this).data('user_reply');
                var comment_image = comment_name.substring(0,1);
                var comment_content = $(`.reply_content_${cmtId}`).val();
                var _token = $('input[name="_token"]').val();
                if(comment_content !=''){
                    $.ajax({
                        url:'{{url('/reply-comment')}}',
                        method: 'POST',
                        data: {pro_id: pro_id,cmtId: cmtId,comment_name:comment_name,comment_image:comment_image,comment_content:comment_content,_token:_token},
                        success: function(data){
                            $(`#dialog_reply_comment_${cmtId}`).dialog('close');
                            loadManagerComments();
                            $('.notify-comments-manager').text(`Phản hồi đến ${comment_parent_name} thành công`);
                            setTimeout(() => {
                                window.location.reload();
                            },2000);
                           
                        }
                    });
                }
                else{
                    alert('Vui lòng nhập nội dung');
                }
            });
        });
        
    })
</script>

{{-- Gallery --}}
<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();
        function load_gallery(){
          var pro_id = $('.product_id').val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
              url:'{{url('/select-gallery')}}',
              method: 'POST',
              data: {pro_id:pro_id,_token:_token},
              success: function(data){
                $('#gallery_load').html(data);
              }
          });
        }
        //show error for upload img
        $(document).on('change','#images',function(){
            var error = '';
            var files = $('#images')[0].files;
            if(files.length > 5){
                error += '<p>Bạn chỉ được phép thêm tối đa 5 ảnh</p>';
            }
            else if(files.length == 0){
                error += '<p>Bạn không được bỏ trống ảnh</p>';
            }
            else{
                $('.insert-gallery').attr('type','submit');
                $('.insert-gallery').removeAttr('onclick');
            }

            if(error != ''){
                $('#images').val('');
                $('#error_gallery').html(`<span class = "text-danger">${error}</span>`);
                return false;
            }

            
        });

        $(document).on('blur','.edit_gallery_name',function(){
            var galId = $(this).data('gal_id');
            var text = $(this).text();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:'{{url('/update-gallery-name')}}',
                method: 'POST',
                data: {galId: galId,text: text,_token:_token},
                success: function(data){
                    load_gallery();
                    $('.message').text('Cập nhật tên ảnh thành công');
                    setTimeout(() => {
                       $('.message').text('');
                    },2000);
                    
                }
            });
        });
        //Cập nhật gallery
        $(document).on('change','.img-gal',function(){
            var galId = $(this).data('gal_id');
            var image = document.getElementById(`img_gallery_${galId}`).files[0];
            var formData = new FormData();
            formData.append('imgGal',image);
            formData.append('gal_id',galId);
            $.ajax({
                url:'{{url('/update-gallery-img')}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    load_gallery();
                    $('.message').text('Cập nhật ảnh thành công');
                    setTimeout(() => {
                       $('.message').text('');
                    },2000);
                    
                }
            });

        });

        $(document).on('click','.delete-gal',function(){
            var galId = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn có muốn xóa hình ảnh này không')){
                $.ajax({
                    url:'{{url('/del-gallery')}}',
                    method: 'GET',
                    data: {galId: galId,_token:_token},
                    success: function(data){
                        load_gallery();
                        $('.message').text('Xóa ảnh thành công');
                        setTimeout(() => {
                            $('.message').text('');
                        },2000);
                        
                    }
                });
            }
        });
        
    });
</script>
{{-- edit gallery name --}}
<script type="text/javascript">
    $(document).ready(function(){
       
    });
</script>

{{-- Update order product quanity --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('.update-qty-order').click(function(){
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order-qty-'+order_product_id).val();
            var order_code = $('.order-code').val();
            var _token = $('input[name="_token"]').val();
            // console.log(order_product_id);
            // console.log(order_qty);
            // console.log(order_code);
            // console.log( _token);

            $.ajax({
                url: '{{url('/update-order-qty')}}',
                method: 'POST',
                data: {order_product_id:order_product_id, order_qty:order_qty, order_code:order_code, _token:_token},
                success: function(data){
                    alert('Cập nhật số lượng thành công');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                    // alert(data);
                }
            });

            
        });

        
        //Xử lý tình trạng đơn hàng
         $('.status-order-handler').change(function(){
             var order_status = $(this).val();
             var order_id = $(this).children(':selected').attr('id');
             var _token = $('input[name="_token"]').val();
             //get quantity
             var quantity = [];
             $('input[name="ProductSalesQuantity"]').each(function(){
                 quantity.push($(this).val());
        
             });
             //get product_id
             order_product_id = [];
            $('input[name="OrderCheckoutQuantity"]').each(function(){
                order_product_id.push($(this).val());
        
            });

            OOSQty = 0;

            //Cập nhật số lượng hàng tồn kho
            for(var i= 0; i < order_product_id.length; i++){
                var order_qty = $('.order-qty-'+order_product_id[i]).val();
                var order_qty_storages = $('.order-qty-storage-'+order_product_id[i]).val();
                if(parseInt(order_qty) > parseInt(order_qty_storages)){
                    OOSQty += 1;
                    if(OOSQty == 1){
                        alert('Số lượng hàng trong kho không đủ');
                    }
                    
                    $('.color-order-qty-'+order_product_id[i]).css({
                        'background':'orange',
                        'color': 'white',
                    });
                }

            }
            if( OOSQty == 0){
                if(order_status != 3){
                    $.ajax({
                        url: '{{url('/update-order-quantity-product')}}',
                        method: 'POST',
                        data: {order_status: order_status, order_id: order_id, quantity: quantity, order_product_id: order_product_id, _token:_token},
                        success: function(data){
                            alert('Thay đổi tình trạng đơn hàng thành công');
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            // alert(data);
                        }
                    });
                }
                
            }
         });
    });
 
 </script>
<script src="{{asset('public/Backend/ckeditor/ckeditor.js')}}"></script>

{{-- Ck editor --}}
<script type="text/javascript">
    var options = {
            filebrowserImageBrowseUrl: 'laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
            filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token='
        };
	CKEDITOR.replace('ckeditorProductAdd',options);
	CKEDITOR.replace('ckeditorProductEdit');
	

	CKEDITOR.replace('ckeditorBrandAdd');
	CKEDITOR.replace('ckeditorBrandEdit');
	
	CKEDITOR.replace('ckeditorCategoryAdd');
	CKEDITOR.replace('ckeditorCategoryEdit');


	CKEDITOR.replace('ckeditorCategoryDesc');

	CKEDITOR.replace('ckeditorKeywordCateAdd');
	CKEDITOR.replace('ckeditorKeywordCateEdit');

	CKEDITOR.replace('ckeditorKeyworBranddAdd');
	CKEDITOR.replace('ckeditorKeywordBrandEdit');

    // var editor = CKEDITOR.replace( 'ckeditorContent' );
    // CKFinder.setupCKEditor(editor);

    CKEDITOR.replace('ckeditorDesc', options);
    // CKEDITOR.replace( 'ckeditorContent', {
    //     filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
    //     filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
    //     filebrowserUploadMethod: 'form'
    // });

    CKEDITOR.replace('ckeditorContent', options);
</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="public/Backend/js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('public/Backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/Backend/js/jquery.form-validator.min.js')}}"></script>
<script type="text/javascript">
	$.validate({
		
	});
</script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
    {{-- Mã giảm giá --}}
    <script>
        $(document).ready(function(){
            $('.btn-coupon').click(function(){
                var coupon_name = $('.coupon-name').val();
                var coupon_code = $('.coupon-code').val();
                var coupon_quantity = $('.coupon-quantity').val();
                var coupon_condition = $('.coupon-condition').val();
                var coupon_feature = $('.coupon-feature').val();
                var coupon_number = $('.coupon-number').val();
                var coupon_date_start = $('.coupon-date-start').val();
                var coupon_date_end = $('.coupon-date-end').val();
                var coupon_status = $('coupon-status').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/insert-coupon-code')}}',
                    method: 'POST',
                    data: {coupon_name: coupon_name, coupon_code: coupon_code,coupon_quantity: coupon_quantity, coupon_condition: coupon_condition, coupon_feature: coupon_feature, coupon_number: coupon_number, coupon_date_start: coupon_date_start, coupon_date_end: coupon_date_end, coupon_status: coupon_status,_token:_token},
                    success: function(data){
                        $('.notify').text('Thêm mã giảm giá thành công');
                        document.getElementById('insert_coupon').reset();
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
    //Ngày gia hạn mã giảm giá
    $('#coupon_date_start').datepicker({
        prevText: 'Tháng trước',
        nextText: 'Tháng sau',
        dateFormat: 'dd-mm-yy',
        minDate: "+0d",
        dayNamesMin: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
        monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
        duration: 'slow'
    });
    //Ngày hết hạn mã giảm giá
    $('#coupon_date_end').datepicker({
        prevText: 'Tháng trước',
        nextText: 'Tháng sau',
        dateFormat: 'dd-mm-yy',
        minDate: "+0d",
        dayNamesMin: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
        monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
        duration: 'slow'
    });
    </script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/Backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->

    {{-- Thống kê doanh số bán hàng --}}
	<script type="text/javascript">
        $(document).ready(function(){
            chart30daySoder();
            /*Biểu đồ*/
            var sales_chart = new Morris.Area({
                element: 'sales_chart',
                lineColors: ['#c81fd1','#d4442a','#d1d42a','#2ed11f'],
                pointFillColors: ['#fff'],
                pointStrokeColors: ['#000'],
                gridTextColor: '#fff',
                goalLineColors: ['#fff','#000'],
                fillOpacity: 0.3,
                hideHover: 'auto',
                paresTime: false,
                resize: true,
                gridTextColor: 'black',
                xLabels: 'day',
                xkey: 'period',
                ykeys: ['order','sales','profit','quantity'],
                labels: ['Tổng đơn hàng','Doanh số','Lợi nhuận','Số lượng']   
            });

            function chart30daySoder(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/days-order')}}',
                    method: 'POST',
                    dataType: 'json',
                    data: {_token:_token},
                    success: function(data){
                        sales_chart.setData(data);
                    }
                });

            }

            //Ngày bắt đầu
            $('#datepicker_from').datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                maxDate: "+0d",
                dayNamesMin: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
                monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
                duration: 'slow'
            });
            //Ngày kết thúc
            $('#datepicker_to').datepicker({
                prevText: 'Tháng trước',
                nextText: 'Tháng sau',
                dateFormat: 'yy-mm-dd',
                maxDate: '+0d',
                dayNamesMin: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
                monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
                duration: 'slow'
            });

            //Bộ lọc bảng điều khiển
            $('.select-dashboard-filter').change(function () {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/dashboard-filter')}}',
                    method: 'POST',
                    dataType: 'json',
                    data: {dashboard_value: dashboard_value,_token:_token},
                    success: function(data){
                        sales_chart.setData(data);
                    }
                });
                
            })
            $('#btn_dashboard_filter').click(function () {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker_from').val(); 
                var to_date = $('#datepicker_to').val();
                $.ajax({
                    url: '{{url('/filter-by-date')}}',
                    method: 'POST',
                    dataType: 'json',
                    data: {from_date: from_date, to_date: to_date,_token:_token},
                    success: function(data){
                        sales_chart.setData(data);
                    }
                });
            });
        });
    </script>
    {{-- Thống kê admin --}}
    <script type="text/javascript">
        var admin_chart = Morris.Donut({
            element: 'admins_chart',
            resize: true,
            colors: [
                'red',
                'orange',
                'yellow',
                'green',
                'aqua'
            ],
            //labelColor:"#cccccc", // text color
            //backgroundColor: '#333333', // border color
            data: [
                {label:"Sản phẩm", value:<?php echo $products_count?>},
                {label:"Bài viết", value:<?php echo $posts_count?>},
                {label:"Đơn hàng", value:<?php echo $orders_count?>},
                {label:"Khách hàng", value:<?php echo $customers_count?>}
            ]
        });
    </script>
</body>
</html>
