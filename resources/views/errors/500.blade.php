<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Lỗi 500</title>
	<link href="{{asset('public/Frontend/css/500.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Semi+Condensed:100,200,300,400" rel="stylesheet">
</head><!--/head-->

<body>

	<body class="loading">
        <h1>500</h1>
        <h2>Lỗi máy chủ <b>😩</b></h2>
        <div class="gears">
          <div class="gear one">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="gear two">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
          <div class="gear three">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
          </div>
        </div>
      </body>

<!-- This templates was made by Colorlib (https://colorlib.com) -->


  
    <script src="{{asset('public/Frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/Frontend/js/bootstrap.min.js')}}"></script>
	{{-- <script src="{{asset('public/Frontend/js/jquery.scrollUp.min.js')}}"></script> --}}
	<script src="{{asset('public/Frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/Frontend/js/main.js')}}"></script>
    <script>
        $(function() {
        setTimeout(function(){
            $('body').removeClass('loading');
        }, 1000);
        });
    </script>
</body>
</html>