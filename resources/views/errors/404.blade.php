<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lỗi 404</title>
	<link href="{{asset('public/Frontend/css/404.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
</head><!--/head-->

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>404</h1>
			</div>
			<h2>Không tìm thấy trang này</h2>
			<p>Trang bạn đang tìm kiếm có thể đã bị xóa, đổi tên hoặc tạm thời không có sẵn.</p>
			<a href="{{url('/home')}}">Trở về trang chủ</a>
		</div>
	</div>

<!-- This templates was made by Colorlib (https://colorlib.com) -->


  
    <script src="{{asset('public/Frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/Frontend/js/bootstrap.min.js')}}"></script>
	{{-- <script src="{{asset('public/Frontend/js/jquery.scrollUp.min.js')}}"></script> --}}
	<script src="{{asset('public/Frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/Frontend/js/main.js')}}"></script>
</body>
</html>