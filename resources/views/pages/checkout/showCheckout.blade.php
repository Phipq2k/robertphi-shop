@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<style type="text/css">
    .error {
        color: red;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 75;
        margin-bottom: 20px;
    }
    .title-checkout{
        color: #FE980F;
    }
    .review-payment h2{
        font-weight: bold;
    }
</style>
<section id="cart_items">
    <div class="container">
        <h2 class="title-checkout">Thanh toán hóa đơn</h2>
        <div class="register-req">
            <p>Vui lòng nhập địa chỉ tính phí vận chuyển trước khi thanh toán để tránh gặp các trường hợp không mong muốn</p>
        </div>
        <!--/register-req-->
        @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
            {{ \Session::forget('error') }}
        @endif
        @if(\Session::has('success'))
            <div class="alert alert-success">{{ \Session::get('success') }}</div>
            {{ \Session::forget('success') }}
        @endif
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-6">
                    <div class="shopper-info">
                        <p>Điền thông tin gửi hàng</p>
                        <form>
                            @csrf
                            <input type="text" class="shipping-email" name="shippingEmail" placeholder="Email">
                            <input type="text" class="shipping-name" name="shippingName" placeholder="Họ và tên">
                            <input type="text" class="shipping-address" name="shippingAddress" placeholder="Địa chỉ">
                            <input type="text" class="shipping-phone" name="shippingPhone" placeholder="Số điện thoại">
                            <input type="hidden" class="shipping-method" value="{{Session::get('shippingMethod')}}">
                            <textarea name="shippingNotes" class="shipping-notes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
                            @if(Session::get('feeship'))
                            <input type="hidden" class="order_fee" name="orderFee" value="{{Session::get('feeship')}}">
                            @endif

                            @if(Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key => $couponOrder)
                                <input type="hidden" class="order_coupon" name="orderCoupon" value="{{$couponOrder['coupon_code']}}">
                                @endforeach
                            @else
                            <input type="hidden" class="order_coupon" name="orderCoupon" value="no">
                            @endif
                            <input type="hidden" class="order_coupon" name="orderCoupon">
                            <hr>
                            {{-- <div>
                                <div class="form-group">
                                    <label for="exampleInput">Phương thức thanh toán</label>
                                    <select class="form-control input-sm m-bot15 payment-select" name="PaymentSelect">
                                        <option value="0">Chuyển khoản qua ngân hàng</option>
                                        <option value="1">Thanh toán bằng tiền mặt</option>
                                        <option value="2">Thanh toán bằng Paypal</option>
                                    </select>
                                </div>
                           </div> --}}
                            <input type="button" name="sendOrder" class="btn btn-primary btn-sm send-order" value="Xác nhận đơn hàng"/>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="order-message">
                        <p>Địa chỉ tính phí vận chuyển</p>
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Chọn tỉnh / thành phố</label>
                                <select id="city" class="form-control input-sm m-bot15 choose city" name="City">
                                    <option value="">--Chọn tỉnh / thành phố--</option>
                                    @foreach ($city as $key => $valueCity)
                                    <option value="{{$valueCity->ma_tp}}">{{$valueCity->name_tp}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="exampleInput">Chọn quận / huyện</label>
                                <select id="province" class="form-control input-sm m-bot15 choose province" name="Provinces">
                                    <option value="">--Chọn quận / huyện--</option>
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label for="exampleInput">Chọn xã / phường</label>
                                <select id="ward" class="form-control input-sm m-bot15 choose ward" name="Wards">
                                    <option value="">--Chọn xã / phường--</option>
                                </select>
                            </div>
                            <input style="width:100%" type="button" value="Xác nhận địa chỉ" name="sendOrder" class="btn btn-primary btn-sm btn-caculate-delivery"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <?php
            $messages = Session::get('message');
            if($messages){
                echo '<span class="text-success">'.$messages.'</span>';
                Session::put('message', null);	
            }
            
            $error = Session::get('error');
            if($error){
                echo '<span class="text-alert">'.$error.'</span>';
                Session::put('message', null);	
            }	
        ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <form action="{{URL::to('/update-cart')}}" method="post">
                    @csrf
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh sản phẩm</td>
                            <td class="description">Tên sản phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Thành tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($content as $key => $valueContent)
                        @endforeach --}}

                        @if (Session::get('cart') == true)
                            
                        @php
                            $vnd = 'VND';
                            $total = 0;
                            $tax = 0;
                            $tfee = Session::get('feeship');
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
                            <p>{{number_format($cart['product_price'],0,',','.').' '.$vnd}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                
                                    <input class="cart_quantity" type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  size="2">
                                    {{-- <input type="hidden" value="" name="rowIDCart" class="form-control" /> --}}
                                    
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                {{number_format($subtotal,0,',','.').' '.$vnd}}
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-cart-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                   
                    @endforeach
                    <tr>
                        <td>
                            @if (!Session::get('shippingMethod'))
                            <input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default check_out btn-sm"/>
                            @endif
                        </td>
                        <td>
                            @if (!Session::get('shippingMethod'))
                            <a class="btn btn-default check_out btn-sm" href="{{URL::to('/delete-all-cart-product')}}">Xóa tất cả sản phẩm</a>
                            @endif
                        </td>
                        @if(Session::get('coupon') && !Session::get('shippingMethod'))
                            <td><a class="btn btn-default check_out btn-sm" href="{{URL::to('/unset-coupon')}}">Xóa mã khuyến mãi</a></td>
                        @endif
                        <td colspan="2">
                            <ul>
                                <li>Tổng: <span>{{number_format($total,0,',','.').' '.$vnd}}</span></li>
                                <li>Thuế: <span>{{number_format($tax,0,',','.').' '.$vnd}}</span></li>
                                @if (Session::get('coupon'))
                                <li>Mã khuyến mãi: 
                                    <span>
                                       
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            @if($cou['coupon_feature'] == 1)
                                                {{number_format($cou['coupon_number'],0,',','.')}} %
                                                <p>
                                                    @php
                                                        $total_coupon = ($total*$cou['coupon_number'])/100;
                                                    @endphp
                                                </p>
                                                <p>@php
                                                   $total_after_coupon = $total - $total_coupon
                                                @endphp</p>
                                            @elseif($cou['coupon_feature'] == 2)
                                                {{number_format($cou['coupon_number'],0,',','.')}} VND
                                                <p>
                                                    @php
                                                        $total_coupon = $total - $cou['coupon_number'];                   
                                                    @endphp
                                                </p>
                                                @php $total_after_coupon = $total_coupon; @endphp
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                                @endif
                                @if (Session::get('feeship') == true)
                                <li id="feeship"><a class="cart_quantity_delete" href="{{URL::to('/delete-feeship')}}"><i class="fa fa-times"></i></a>
                                Phí vận chuyển: <span>{{$tfee == 0 ? 'Miễn phí' : number_format($tfee,0,',','.').' '.$vnd}}</span></li>
                                @php
                                    $total_after_fee = $total + Session::get('feeship'); 
                                    // echo $total_after_fee;
                                    // echo Session::get('feeship');
                                    // echo  $total_coupon;
                                @endphp
                                @elseif(!Session::get('feeship'))
                                <li id="feeship">Phí vận chuyển: <span>Miễn phí</span></li>
                                @endif
                                <li>Thành tiền:
                                @php
                                if(Session::get('feeship') && !Session::get('coupon')){
                                    $total_after = $total_after_fee;
                                }
                                elseif (!Session::get('feeship') && Session::get('coupon')){
                                    $total_after = $total_after_coupon;
                                }
                                elseif (Session::get('feeship') && Session::get('coupon')){
                                    $total_after = $total_after_fee -  $total_coupon;
                                }
                                elseif (!Session::get('feeship') && !Session::get('coupon')){
                                    $total_after = $total;
                                }
                                echo number_format($total_after,0,',','.').' '.$vnd;
                                @endphp
                                <li>
                                    @php
                                    $usd = $total_after /23083;
                                    $total_paypal = round($usd,2);
                                    \Session::put('total_paypal',$total_paypal);
                                    \Session::put('total_VNPay',$total_after);
                                    @endphp
                                    @if (!Session::get('shippingMethod') && Session::get('feeship'))
                                    <a class="btn btn-primary m-3" href="{{ route('ptVNPay') }}">Thanh toán qua VNPay</a>
                                    <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Thanh toán {{$total_paypal}}$ qua Paypal</a>
                                    @endif
                                </li>
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
                @if (Session::get('cart') && !Session::get('shippingMethod'))
                <tr>
                    <td>
                        <form action="{{URL::to('/check-coupon')}}" method="post">
                           @csrf
                            <input type="hidden" name="total_order" value="{{$total}}">
                            <label class="label label-danger" for="couponCode">Sử dụng mã khuyến mãi</label>
                            <input type="text" class="form-control" name="couponCode" placeholder="Nhập mã khuyến mãi"/><br/>
                            <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã khuyến mãi"/>
                        </form>
                    </td>
                </tr>
                @endif
            </table>
        </div><!-- /.cart -->
    </div>
</section>
@section('footer')
@include('components.footer')
@endsection
@endsection