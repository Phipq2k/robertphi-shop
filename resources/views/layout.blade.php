<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!------------- Seo ------------->
    <meta name="description" content="{!!$metaDesc!!}">
	<meta name="keywords" content="{{$metaKeywords}}"/>
	<meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="author" content="{{$metaAuthor}}">
	<link rel="canonical" href="{{$urlCanonical}}">

	<meta property="og:site_name" content="{{$urlCanonical}}">
	<meta property="og:image" content="{{$imageOrg}}"/>
	<meta property="og:site_discription" content="{{$metaDesc}}">
	<meta property="og:title" content="{{$metaTitle}}">
	<meta property="og:url" content="{{$urlCanonical}}">
	<meta property="og:type" content="website">

	<!------------ endSeo ----------->
    <title>{{$metaTitle}}</title>
    <link href="{{asset('public/Frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/Frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/Frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/Frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/Frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/Frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/Frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/Frontend/css/sweetalert.css')}}" rel="stylesheet">
	<link href="{{asset('public/Frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/Frontend/css/prettify.css')}}" rel="stylesheet">
	<link href="{{asset('public/Frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
	<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
	<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/Frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('public/Frontend/images/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('public/Frontend/images/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('public/Frontend/images/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('public/Frontend/images/apple-touch-icon-57-precomposed.png')}}">

	{{-- CSS config --}}
	<style type="text/css">
		/* Quick view */
		.quick-view {
			background: #F5F5ED;
			border: 0 none;
			border-radius: 0;
			color: #696763;
			font-family: 'Roboto', sans-serif;
			font-size: 15px;
			margin-bottom: 25px;
		}
	
		.quick-view:hover {
			background: #FE980F;
			border: 0 none;
			border-radius: 0;
			color: #FFFFFF;
		}
		
		.quick-view i {
			margin-right: 5px;
		}
		
		.quick-view:hover {
			background: #FE980F;
			color: #FFFFFF;
		}
		
		/* Breadcumbs */
		.breadcrumb-item.active {
			border-bottom: 2px solid #FE980F;
			margin: 0 5px;
		}
		.breadcrumb>.active {
			color: #FE980F;
		}
		
		.breadcrumb>li+li:before {
			padding: 0px;
		}
		/* Modal */
		.modal-title{
			color: #FE980F;
			font-size: 20px;
			font-weight: bold;
		}
		.pro_quickview_price{
			color: red;
			font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif
		}
		.titleCt{
			color: blue
		}
		.pro_quickview_img img{
			width: 100%;
			height: auto;
		}
		@media screen and (max-width: 768px) {
			.modal-dialog{
				width: 650px;
			}
			.modal-sm{
				width: 350px;
			}
		}
		@media screen and (max-width: 992px){
			.modal-lg{
				width: 1200px;
			}
		}

		/* L???c gi?? s???n ph???m */
		.price-range{
			padding: 5px 0;
		}

		.ui-widget-header{	
			background: #FE980F;
		}

		/* Gallery */
	.ISSlideOuter .ISPager .ISGallery img {
		display: block;
		height: 140px;
		max-width: 100%;
	}
	.lSAction>a {
    width: 32px;
    display: block;
    top: 50%;
    height: 32px;
    background-image: url(http://sachinchoolur.github.io/lightslider/src/img/controls.png);
    cursor: pointer;
    position: absolute;
    z-index: 99;
    margin-top: -16px;
    opacity: 0.5;
    -webkit-transition: opacity 0.35s linear 0s;
    transition: opacity 0.35s linear 0s;
}

	li.active{
		border: 1px solid #FE980F;
	}

	/* B??nh lu???n */
	.show-comments{
		/* border: 1px solid #FE980F; */
		border-radius: 10px;
		background: rgb(212, 206, 206);
	}
	.show-comments img{
		margin: 10px 0;
		width: 80%;
	}
	.show-comments h4{
		font-weight: bold;
		margin-top: 10px;
		margin-bottom: 0px;
		color: #FE980F;
	}
	.show-comments span{
		opacity: 0.7;
	}
	#notify_comment{
		margin-bottom: 20px;
		font-weight: bold;
		font-size: 16px;
	}
	.show-comments #avatar_comment{
		border-radius: 40px;
		border: 3px solid black;
		margin: 10px 0;
		width: 80px;
		height: 80px;
		display: flex;
		align-items: center;
		justify-content: center;
		background: #000;
		color: #FE980F;
		font-weight: 600;
		font-size: 30px;

	}

	#show_comment{
		overflow: scroll;
		padding: 30px;
		max-height: 500px;
	}

	.comments-reply-product{
		margin: 5px 40px;
		background-color: rgb(171, 217, 238);
	}
	</style>
</head><!--/head-->

<body>
	<div style="width:100%; height: 240px" class="row"></div>
	{{-- @php
		echo Session::get('shippingId');
	@endphp --}}
	{{-- Header --}}
	@yield('header')
	{{-- component Slider --}}
	@yield('slider')
	<section>
		<div class="container">
			<div class="row">
				@yield('sidebar')
				@yield('content')
			</div>
		</div>
	</section>
	@yield('footer')
	<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100885969078547");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
	

  
    <script src="{{asset('public/Frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/Frontend/js/bootstrap.min.js')}}"></script>
	{{-- <script src="{{asset('public/Frontend/js/jquery.scrollUp.min.js')}}"></script> --}}
	<script src="{{asset('public/Frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/Frontend/js/main.js')}}"></script>
    <script src="{{asset('public/Frontend/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/Frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/Frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/Frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/Frontend/js/jquery.validate.min.js')}}"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&v=beta&callback=initMap"></script>
	<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="CDVeHxaN"></script>

	<script type="text/javascript">
	$(document).ready(function(){
		var index = 0;
		var menuHome = $('.menu-home');
	})
	</script>
	{{-- Login and Signup Customers --}}
	<script type="text/javascript">
	$(document).ready(function(){
		//login
		$('.login-checkout').click(function(){
			var emailAcc = $('.email').val();
			var passwordAcc = $('.password').val();
			var _token = $('input[name="_token"]').val();
			if(emailAcc !== '' && passwordAcc !== ''){
				$.ajax({
					url: '{{url('/login-customer')}}',
					method: 'POST',
					data:{emailAcc: emailAcc, passwordAcc: passwordAcc,_token:_token},
					success:function(data){
						if(data.length == 0){
							var message = 'T??i kho???n ho???c m???t kh???u kh??ng ????ng, vui l??ng ????ng nh???p l???i';
							$('.login-message').text(message);
							
						}
						else{
							window.location.href = '{{url('/checkout')}}';
						}
					}
				});
			}
			else{
				$('.login-message').text('Vui l??ng ??i???n ?????y ????? th??ng tin ????ng nh???p');
			}


		});

		//Signup
		$('.signup-checkout').click(function(){
			var customerName = $('.customer_name').val();
			var customerEmail = $('.customer_email').val();
			var customerPassword = $('.customer_password').val();
			var customerPhone = $('.customer_phone').val();
			var _token = $('input[name="_token"]').val();
			//Validation form Signup
			$.validator.addMethod(
				'regex',
				function(value, element, regexp) {
					var re = new RegExp(regexp);
					return this.optional(element) || re.test(value);
				},
				"Please check your input."
			);
			$('#signup-customer').validate({
				rules: {
					customerName: {
						required: true,
						regex: '^[a-zA-Z0-9]',
					},
					customerEmail: {
						email: 'required',
						required: true,
					},
					customerPassword: {
						required: true,
						minlength: 6
					},
					customerPhone: {
						required: true,
						number: 'required',
					}
				},
				messages: {
					customerName: {
						required: 'Vui l??ng nh???p t??n',
						regex: 'T??n kh??ng h???p l???'
					},
					customerEmail: {
						required: 'Vui l??ng nh???p Email',
						email: 'Email kh??ng h???p l???',
					},
					customerPassword: {
						required: 'Vui l??ng nh???p m???t kh???u',
						minlength: 'M???t kh???u t???i thi???u 6 k?? t???'
					},
					customerPhone: {
						required: 'Vui l??ng nh???p s??? ??i???n tho???i',
						number: 'S??? ??i???n tho???i kh??ng h???p l???'
					}
				}
			});
			const arr = [customerName, customerEmail, customerPassword, customerPhone];
			// console.log(arr);

			if($('#signup-customer').valid()){
				$.ajax({
					url: '{{url('/register-customer')}}',
					method: 'POST',
					data:{customerName:customerName, customerEmail:customerEmail, customerPassword:customerPassword, customerPhone:customerPhone, _token:_token},
					success:function(data){
						swal({
							title:'????ng k?? th??nh c??ng',
							text: "B???n ???? ????ng k?? th??nh c??ng, vui l??ng ????ng nh???p ????? ti???p t???c thanh to??n",
							type: 'success',
							confirmButtonText: "Ti???p t???c",
						},
						function(confirm) {
							if(confirm) {
								location.reload();	
							}	
						});
						
					}
				});
			}


		});
	})
	</script>
	{{-- X??c nh???n ????n ?????t h??ng --}}
	<script type="text/javascript">
		$(document).ready(function(){
			$('.send-order').click(function(){
				var shippingEmail = $('.shipping-email').val();
				var shippingName = $('.shipping-name').val();
				var shippingAddress = $('.shipping-address').val();
				var shippingPhone = $('.shipping-phone').val();
				var shippingNotes = $('.shipping-notes').val();
				var shippingMethod = $('.shipping-method').val();
				var orderFee = $('.order_fee').val();
				var orderCoupon = $('.order_coupon').val();
				var _token = $('input[name="_token"]').val();

				if(shippingEmail == '' || shippingName == '' || shippingAddress == '' || shippingPhone == '' || shippingNotes == ''){
							swal("C???nh b??o!", "Vui l??ng nh???p c??c th??ng tin c???n thi???t ????? giao h??ng", "warning");
				}
				else{
				swal({
					title: "X??c nh???n ????n h??ng",
					text: "????n h??ng s??? kh??ng ???????c ho??n tr??? sau khi ?????t, b???n c?? mu???n ?????t kh??ng?",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "?????ng ??",
					cancelButtonText: "H???y",
					showLoaderOnConfirm: true,
					closeOnConfirm: false,
					closeOnCancel: false,
					},
					function(isConfirm){
						if(isConfirm){
							$.ajax({
								url: '{{url('/confirm-order')}}',
								method: 'POST',
								data:{shippingEmail:shippingEmail,shippingName:shippingName,shippingAddress:shippingAddress,shippingNotes:shippingNotes,shippingPhone:shippingPhone,shippingMethod:shippingMethod,orderFee:orderFee,orderCoupon:orderCoupon,_token:_token},
								success:function(data){
									swal({
										title: 'X??c nh???n ????n h??ng th??nh c??ng',
										text: 'Ch??ng t??i s??? giao h??ng cho b???n trong th???i gian s???m nh???t!',
										type: 'success',
										confirmButtonClass: "btn-warning",
										confirmButtonText: "Quay l???i trang ch???",
									},
									function(){
										window.location.href = "{{url('/home')}}";
									});
								}
							});
							
						}
							
						else
						swal("????ng", "????n h??ng ch??a ???????c x??c nh???n!", "error");
								
					});	
				}
				
						
			});
		});
	</script>
	{{-- Add to cart --}}
	<script type="text/javascript">
		$(document).ready(function(){
			showCartIndex();
			function showCartIndex(){
				$.ajax({
					url: '{{url('/show-cart-index')}}',
					method: 'GET',
					success:function(data){
						$('.badges').html(data['indexCart'].length);
						if(data['indexCart'].length == 0){
							$('.hover-cart').css('display', 'none');
						}
						if(data['indexCart'].length > 9){
							$('.badges').html('9+');
						}		
						else{
							$('.hover-cart').css('display', 'inderhit');
						}
						$('.hover-cart').html(data['cartItems']);
					}
				});
			}
			$('.add-to-cart').click(function(){
				var idProduct = $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + idProduct).val();
				var cart_product_name = $('.cart_product_name_' + idProduct).val();
				var cart_product_image = $('.cart_product_image_' + idProduct).val();
				var cart_product_price = $('.cart_product_price_' + idProduct).val();
				var cart_product_qty = $('.cart_product_qty_' + idProduct).val();
				var product_qty = $('.product_quantity_' + idProduct).val();
				var customer_check = $('.check-customers').val();
				var _token = $('input[name="_token"]').val();

				// if(customer_check == 1){
					if(parseInt(cart_product_qty) > parseInt(product_qty)){
					swal('S??? h??ng t???n kho kh??ng ?????','','warning');
					}
					else{
						$.ajax({
							url: '{{url('/add-cart-ajax')}}',
							method: 'POST',
							data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,product_qty:product_qty,_token:_token},
							success:function(data){

								swal({
										title: "???? th??m s???n ph???m v??o gi??? h??ng",
										text: "B???n c?? th??? mua h??ng ti???p ho???c t???i gi??? h??ng ????? ti???n h??nh thanh to??n",
										showCancelButton: true,
										cancelButtonText: "Xem ti???p",
										confirmButtonClass: "btn-success",
										confirmButtonText: "??i ?????n gi??? h??ng",
										closeOnConfirm: false
									},
									function() {
										location.href = "{{url('/show-cart-product')}}";
								});
								showCartIndex();
							}
						});
					}
				// }
				// else{
				// 	swal({
				// 		title: "Vui l??ng ????ng nh???p ho???c ????ng k?? ????? ti???p t???c mua h??ng!",
				// 		type: 'warning',
				// 		showCancelButton: true,
				// 		cancelButtonText: "Xem ti???p",
				// 		confirmButtonClass: "btn-warning",
				// 		confirmButtonText: "????ng nh???p",
				// 		closeOnConfirm: false
				// 		},
				// 		function() {
				// 			window.location.href = "{{url('/login-checkout')}}";
				// 	});
				// }
				
			});
		});
		
	</script>
	<script>
	$(document).ready(function() {
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
				url: '{{url('/select-delivery-client')}}',
				method: 'POST',
				data: {action:action, maId:maId, _token:_token},
				success: function(data){
					$('#'+result).html(data);
				}
			});
			
    	});
	});
	</script>

	{{-- Fee ship handler --}}
	<script>
		$(document).ready(function(){
			$('.btn-caculate-delivery').click(function(){
				var matp = $('.city').val();
				var maqh = $('.province').val();
				var xaid = $('.ward').val();
				var _token = $('input[name="_token"]').val();
				if(matp == '' && maqh == '' && xaid == ''){
					swal('Vui l??ng ch???n ?????a ch??? ????? giao h??ng','','error');
				}
				else{
					$.ajax({
					url: '{{url('/caculate-feeship')}}',
					method: 'POST',
					data: {matp:matp, maqh:maqh, xaid:xaid, _token:_token},
					success: function(data){
						$('#feeship').html(`<li id="feeship"><a class="cart_quantity_delete" href="{{URL::to('/delete-feeship')}}"><i class="fa fa-times"></i></a>Ph?? v???n chuy???n: ${data} VND</li>`);
						swal({
								title: "X??c nh???n ?????a ch??? th??nh c??ng",
								type: "success",
								confirmButtonClass: "btn-warning",
								confirmButtonText: "OK",
								closeOnConfirm: false
							},
							function(){
								location.reload();
							});
					}
					});
				}
			});
		});
	</script>
	{{-- <script>
		map = new google.maps.Map(document.getElementById('gmap'), {
		center: {lat: -34.397, lng: 150.644},
		zoom: 8,
		mapId: 'MAP_ID'
	});
	</script> --}}

	{{-- lightGallery --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('#imageGallery').lightSlider({
				gallery:true,
				item:1,
				loop:true,
				thumbItem:3,
				slideMargin:0,
				enableDrag: false,
				currentPagerPosition:'left',
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '#imageGallery .lslide'
					});
				}   
			});  
		});
	</script>
	{{-- Quick view --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.quick-view').click(function(){
				var productId = $(this).data('id_product');
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/quick-view')}}',
					method: 'POST',
					dataType: 'json',
					data: {productId: productId, _token:_token},
					success: function(data){
						$('#pro_quickview_title').html(data.product_name);
						$('#pro_quickview_id').html(`<b>M?? ID: ${data.product_id}</b>`);
						$('#pro_quickview_img').html(data.product_image);
						$('#pro_quickview_gallery').html(data.product_gallery);
						$('#pro_quickview_price').html(data.product_price);
						$('#pro_quickview_desc').html(data.product_desc);
						$('#pro_quickview_content').html(data.product_content);
						$('#pro_quickview_cate').html(`<b>Danh m???c:</b> ${data.product_cate}`);
						$('#pro_quickview_brand').html(`<b>Danh m???c:</b> ${data.product_brand}`);
						$('#quickview_hidden_info').html(data.quickview_info_hidden);
						$('#cart_quantity').attr('class', `cart_product_qty_quickview_${data.product_id}`);
					}
				});
			})
		});
	</script>
	{{-- Add to cart quick view --}}
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart-quick-view').click(function(){
				var idProduct = $('.pro_id').val();
				var cart_product_id = $('.cart_product_id_quickview_' + idProduct).val();
				var cart_product_name = $('.cart_product_name_quickview_' + idProduct).val();
				var cart_product_image = $('.cart_product_image_quickview_' + idProduct).val();
				var cart_product_price = $('.cart_product_price_quickview_' + idProduct).val();
				var cart_product_qty = $('.cart_product_qty_quickview_' + idProduct).val();
				var product_qty = $('.product_quantity_quickview_' + idProduct).val();
				var customer_check = $('.check-customers').val();
				var _token = $('input[name="_token"]').val();
				// alert('Name: '+ cartProductName);
				// alert('Image: '+ cartProductImage);
				// alert('Price: '+ cartProductPrice);
				// alert('Qty: '+ cartProductQty);
				// alert('Id: '+ cartProductId);

				// if(customer_check == 1){
					if(parseInt(cart_product_qty) > parseInt(product_qty)){
					swal('S??? h??ng t???n kho kh??ng ?????','','warning');
					}
					else{
						$.ajax({
							url: '{{url('/add-cart-ajax')}}',
							method: 'POST',
							data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,product_qty:product_qty,_token:_token},
							beforeSend: function(){
								$('#notify_quickview').text('??ang th??m s???n ph???m v??o gi??? h??ng').attr('class', 'text text-info');
							},
							success:function(data){
								$('#notify_quickview').text('???? th??m s???n ph???m v??o gi??? h??ng').attr('class', 'text text-success');
								window.location.href = "{{url('/checkout')}}";
								
							}
						});
					}
				// }
				// else{
				// 	swal({
				// 		title: "Vui l??ng ????ng nh???p ho???c ????ng k?? ????? ti???p t???c mua h??ng!",
				// 		type: 'warning',
				// 		showCancelButton: true,
				// 		cancelButtonText: "Xem ti???p",
				// 		confirmButtonClass: "btn-warning",
				// 		confirmButtonText: "????ng nh???p",
				// 		closeOnConfirm: false
				// 		},
				// 		function() {
				// 			window.location.href = "{{url('/login-checkout')}}";
				// 	});
				// }

				
			});
		});
		
	</script>
	{{-- B??nh lu???n --}}
	<script type="text/javascript">
	$(document).ready(function(){
		loadComment();
		function loadComment(){
			var commentProId = $('.comment-product-id').val();
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{url('/load-comment')}}',
				method: 'POST',
				data: {commentProId: commentProId, _token:_token},
				success: function(data){
					if(data != ''){
						$('#show_comment_client').html(data);
					}
				}
			});
		}	
		//????ng b??nh lu???n
		$('.send-comment').click(function(){
			const colors = [
				'#00aefd',
				'#07a787',
				'black',
				'pink',
				'yellow',
				'#e74c3c',
				'#2979ff',
			];
			var random_color = colors[Math.floor(Math.random() * colors.length)];
			var productId = $('.comment-product-id').val();
			var firstname = $('.comment-firstname').val();
			var lastname = $('.comment-lastname').val();
			var comment_name = firstname+' '+lastname;
			var comment_image = $('.comment-lastname').val().substring(0,1).toUpperCase();
			var comment_content = $('.comment-content').val();
			var comment_status = $('.comment-status').val();
			var _token = $('input[name="_token"]').val();
			if(firstname != '' && lastname != '' && comment_content != ''){
				$.ajax({
					url: '{{url('/add-comment')}}',
					method: 'POST',
					data: {productId: productId, random_color:random_color, comment_name: comment_name, comment_image:comment_image, comment_content: comment_content,comment_status:comment_status, _token:_token},
					success: function(data){
						loadComment();
						$('#upload_comment').trigger('reset');
						swal('Th??m b??nh lu???n th??nh c??ng','B??nh lu???n c???a b???n s??? hi???n th??? khi ???????c duy???t','success');
					}
				});
			}
			else{
				$('#notify_comment').text('Vui l??ng ??i???n th??ng tin ?????y ?????');
				setTimeout(() => {
					$('#notify_comment').text('');
				},2000)
			}
		})
	});
	</script>

	{{-- X???p h???ng sao --}}
	<script type="text/javascript">
	$(document).ready(function(){
		function remove_background(pro_id){
			for(var i = 1; i <= 5; i++){
				$('#'+pro_id +'_'+i).css('color','#ccc');
			}
		}
		function add_background(pro_id,index){
			for(var i = 1; i <= index; i++){
				$('#'+pro_id +'_'+i).css('color','#FE980F');
			}
		}
		//Di chu???t v??o sao
		$(document).on('mouseenter','.star-rating',function(e){
			var index = $(this).data('index');
			var product_id = $(this).data('id_product');
			remove_background(product_id);
			add_background(product_id, index);
		});

		//Di chu???t r???i kh???i sao
		$(document).on('mouseleave','.star-rating',function(e){
			var rating = $(this).data('rating');
			var product_id = $(this).data('id_product');
			remove_background(product_id);
			add_background(product_id,rating);
		});

		//Nh???n v??o sao
		$(document).on('click','.star-rating',function(e){
			var rating = $(this).data('index')
			var product_id = $(this).data('id_product');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{url('/add-star-rating')}}',
				method: 'POST',
				data: {rating:rating, product_id:product_id, _token:_token},
				success: function(data){
					if(data){
						swal({
							title: 'C???m ??n b???n ???? ????nh gi??',
							text: `B???n ???? ????nh gi?? ${rating} tr??n 5 sao`,
							confirmButtonClass: "btn-success",
							confirmButtonText: "Ti???p t???c ????nh gi??",
						},
						function(){
							window.location.reload();
						})
					}
					else{
						swal('L???i ????nh gi??');
					}
				}
			});
		});
	})
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.tab-product').click(function(){
			var cate_id = $(this).data('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{url('/products-tab')}}',
				method: 'POST',
				data: {cate_id: cate_id, _token:_token},
				success: function(data){
					$('#load_products_tab').html(data);
				}
			});

		})
	});
	</script>

	{{-- Truy xu???t s???n ph???m --}}
	<script type="text/javascript">
	$(document).ready(function(){
		// S???p x???p s???n ph???m theo c??c ti??u ch??
		$('#sort').on('change', function(){
			var url = $(this).val();
			if(url){
				window.location = url;
			}
			return false;
		});

		//L???c gi?? s???n ph???m
		$( "#slider-range" ).slider({
				range: true,
				min: {{$minPrice}},
				max: {{$maxPriceRange}},
				step: 1000,
				values: [ {{$minPrice}}, {{$maxPrice}}],
				slide: function( event, ui ) {
					$( "#amount" ).val( new Intl.NumberFormat().format(ui.values[ 0 ]) + " VND"  +" - " + new Intl.NumberFormat().format(ui.values[ 1 ])+ " VND" );
					$( "#start_price" ).val(ui.values[ 0 ]);
					$( "#end_price" ).val(ui.values[ 1 ]);
				}
			});

		$( "#amount" ).val(new Intl.NumberFormat().format($( "#slider-range" ).slider( "values", 0 )) +
		" VND" +" - " + new Intl.NumberFormat().format($( "#slider-range" ).slider( "values", 1 )) + " VND");
	});
	</script>
	{{-- ???n hi???n m???t kh???u --}}
	{{-- <script type="text/javascript">
	$document.ready(function(){
		var isClick = false;
		var password = $('.password-input');
		$('.toggle-pass').click(function(){
			if(!isClick){
				password.attr('type','password');
			}
			isClick = true;
		});
	})
	</script> --}}
	<script type="text/javascript">
		$("#btnPopup").click(function () {
			var postData = $("#create_form").serialize();
			var submitUrl = $("#create_form").attr("action");
			$.ajax({
				type: "POST",
				url: submitUrl,
				data: postData,
				dataType: 'JSON',
				success: function (x) {
					if (x.code === '00') {
						if (window.vnpay) {
							vnpay.open({width: 768, height: 600, url: x.data});
						} else {
							location.href = x.data;
						}
						return false;
					} else {
						alert(x.Message);
					}
				}
			});
			return false;
		});
	</script>
</body>
</html>