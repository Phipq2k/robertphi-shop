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
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng ký Authentication</h2>
	<?php
		$messages = Session::get('message');
		if($messages){
			echo '<span class="text-alert">'.$messages.'</span>';
			Session::put('message', null);	
		}	
	?>

		<form action="{{URL::to('/user-register-auth')}}" method="post">
			{{ csrf_field() }}
            @foreach ($errors->all() as $error)
                <ul>
                    <li>{{$error}}</li>
                </ul>
            @endforeach
			<input type="text" class="ggg" name="admin_name" value="{{old('admin_name')}}" placeholder="Nhập tên" required="">
			<input type="text" class="ggg" name="admin_email" value="{{old('admin_email')}}" placeholder="Nhập email" required="">
			<input type="text" class="ggg" name="admin_phone" value="{{old('admin_phone')}}" placeholder="Nhập số điện thoại" required="">
			<input type="password" class="ggg" name="admin_password" value="{{old('admin_password')}}" placeholder="Nhập password" required="">
			{{-- <input type="password" class="ggg" name="admin_password" value="{{old('admin_password')}}" placeholder="Nhập lại password" required=""> --}}
			<div class="clearfix"></div>
			<input type="submit" value="Đăng ký" name="signup">
			
		</form>
		{{-- <p>Don't Have an Account ?<a href="registration.html">Tạo tài khoản</a></p> --}}
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
