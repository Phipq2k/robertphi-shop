<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Trang quản lý admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{('public/Backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{('public/Backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{('public/Backend/css/font.css')}}" type="text/css"/>
<link href="{{('public/Backend/css/font-awesome.css')}}" rel="stylesheet">

<style type="text/css">
	html, body {
        font-family: 'Roboto', sans-serif;
        font-size: 100%;
        overflow-x: hidden;
        background:  url('public/Backend/images/background-admin.jpg') no-repeat 0px 0px;
        background-size: cover;
    }
	.w3layouts-main input[type="submit"] {
		background: #0d1fbd;
	}
	.w3layouts-main input[type="submit"]:hover {
   		background: #3dd8e3;
	}

	.w3layouts-main h2 {
		color: #c7ec1f;
	}
</style>
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng nhập</h2>
	<?php
		$messages = Session::get('message');
		if($messages){
			echo '<span class="text-alert">'.$messages.'</span>';
			Session::put('message', null);	
		}	
	?>

		<form action="{{URL::to('/user-login-auth')}}" method="post">
			{{ csrf_field() }}
			<input type="text" class="ggg" name="admin_email" placeholder="Nhập email" required="">
			<input type="password" class="ggg" name="admin_password" placeholder="Nhập password" required="">
			<span><input type="checkbox" />Ghi nhớ tài khoản đăng nhập</span>
			<h6><a href="#">Quên mật khẩu</a></h6>
			<div class="clearfix"></div>
			<input type="submit" value="Đăng nhập" name="login">
			
		</form>
		{{-- <p>Don't Have an Account ?<a href="registration.html">Tạo tài khoản</a></p> --}}


		{{-- <a href="{{URL::to('/login-facebook')}}" title="Đăng nhập bằng facebook"><i class="fa fa-facebook-official"></i></a>  <b style="color:white">||</b>
		<a href="{{URL::to('/register-authentication')}}" title="Đăng ký Authentication"><i class="fa fa-registered" aria-hidden="true"></i></a>
        <b style="color:white">||</b>
		<a href="{{URL::to('/login-authentication')}}" title="Đăng nhập Authentiaction"><i class="fa fa-sign-in"></i></a> --}}
</div>
</div>
<script src="{{('public/Backend/js/bootstrap.js')}}"></script>
<script src="{{('public/Backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{('public/Backend/js/scripts.js')}}"></script>
<script src="{{('public/Backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{('public/Backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{('public/Backend/js/jquery.scrollTo.js')}}"></script>
</body>
</html>
