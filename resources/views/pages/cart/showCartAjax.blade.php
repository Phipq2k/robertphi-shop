@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<style type="text/css">
    span.badges{
     display: none;   
    }
    .li-cart:hover .hover-cart{
        display: none;
    }
</style>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <?php
	        	$message = Session::get('message');
	        	if($message){
	        		echo '<span class="text-success">'.$message.'</span>';
	        		Session::put('message', null);	
	        	}

                $error = Session::get('error');
	        	if($error){
	        		echo '<span class="text-alert">'.$error.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
        {{-- @if (session()->has('message'))

            
        @endif) --}}
        <div class="table-responsive cart_info">
            <table class="table table-condensed tbl-cart">
                <form action="{{URL::to('/update-cart')}}" method="post">
                    @csrf
                    <thead>
                        <tr class="cart_menu">
                            <td>Hình ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá</td>
                            <td>Số lượng</td>
                            {{-- <td class="quantity_pro">Hàng tồn kho</td> --}}
                            <td>Thành tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($content as $key => $valueContent)
                        @endforeach --}}

                        @if (Session::get('cart') == true)
                            
                        @php
                            $currency_unit = 'VND';
                            $total = 0;
                            $tax = 0;
                            $tfee = 2000;
                        @endphp
                        @foreach (Session::get('cart') as $key => $cart)
                        @php
                            $subtotal = $cart['product_qty']*$cart['product_price'];
                            $total += $subtotal;
                        @endphp
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{asset('storage/app/public/uploads/products/'.$cart['product_image'])}}" alt="Ảnh sản phẩm" width="120px" height="120px" /></a>
                        </td>
                        <td class="cart_name">
                            <h4><a href=""></a></h4>
                            <p>{{$cart['product_name']}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cart['product_price'],0,',','.').' '.$currency_unit}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                
                                    <input class="cart_quantity" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  size="2">
                                    {{-- <input type="hidden" value="" name="rowIDCart" class="form-control" /> --}}
                                    
                            </div>
                        </td>
                        {{-- <td class="pro_qty">
                            <p>{{number_format($cart['product_qty_sold'],0,',','.')}}</p>
                        </td> --}}
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{number_format($subtotal,0,',','.').' '.$currency_unit}}
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-cart-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                   
                    @endforeach
                    <tr>
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out btn-sm"/></td>
                        <td><a class="btn btn-default check_out" href="{{URL::to('/delete-all-cart-product')}}">Xóa tất cả sản phẩm</a></td>
                        <td>
                        @if(Session::get('coupon'))
                            <a class="btn btn-default check_out" href="{{URL::to('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                        @endif
                        </td>
                        <td>
                        @if(Session::get('customerId'))
                            <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Đặt hàng</a>
                        @else
                            <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đặt hàng</a>
                        @endif
                        </td>
                        <td colspan="2">
                            <ul>
                                <li>Tổng: <span>{{number_format($total,0,',','.').' '.$currency_unit}}</span></li>
                                <li>Thuế: <span>{{number_format($tax,0,',','.').' '.$currency_unit}}</span></li>
                                {{-- <li>Phí vận chuyển: <span>{{$tfee == 0 ? 'Miễn phí' : number_format($tfee,0,',','.').' '.$currency_unit}}</span></li> --}}
                                @if (Session::get('coupon'))
                                <li>Mã khuyến mãi: 
                                    <span>
                                       
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            @if($cou['coupon_feature'] == 1)
                                                {{number_format($cou['coupon_number'],0,',','.')}} %
                                                <p>
                                                    @php
                                                        $total_coupon = ($total*$cou['coupon_number'])/100;
                                                        echo '<p>Tổng giảm: '.number_format($total_coupon,0,',','.').' '.'VND'.'</p>';
                                                    @endphp
                                                </p>
                                                <p>Thành tiền: {{number_format($total - $total_coupon,0,',','.')}} VND</p>
                                            @elseif($cou['coupon_feature'] == 2)
                                                {{number_format($cou['coupon_number'],0,',','.')}} VND
                                                <p>
                                                    @php
                                                        $total_coupon = $cou['coupon_number'];
                                                        echo '<p>Tổng giảm: '.number_format($total_coupon,0,',','.').' '.'VND'.'</p>';
                                                    @endphp
                                                </p>
                                                <p>Thành tiền: {{number_format($total - $total_coupon,0,',','.')}} VND</p>
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                                @else
                                <li>Thành tiền: {{number_format($total,0,',','.')}} VND</li>
                                @endif
                            </ul>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="5">
                            <center>
                                @php
                                    echo 'Giỏ hàng bạn đang trống';
                                @endphp
                            </center>
                            <center><a href="{{url('/home')}}" class="btn btn-primary">Quay lại trang chủ</a></center>
                        </td>
                    </tr>
                    @endif
                    </tbody>
                </form>
                {{-- @if (Session::get('cart'))
                <tr>
                    <td>
                        
                        <form action="{{URL::to('/check-coupon')}}" method="post">
                           @csrf
                            <input type="hidden" name="total_order" value="{{$total}}">
                            <input type="text" class="form-control" name="couponCode" placeholder="Nhập mã khuyến mãi"/><br/>
                            <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã khuyến mãi"/>
                        </form>
                    </td>
                </tr>
                @endif --}}
            </table>
            

        </div>
    </div>
</section>
<!--/#cart_items-->
@section('footer')
@include('components.footer')
@endsection
@endsection