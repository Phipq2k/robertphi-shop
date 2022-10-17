@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
                ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh sản phẩm</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $key => $valueContent)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('storage/app/public/uploads/products/'.$valueContent->options->image)}}" alt="Ảnh sản phẩm" width="120px" height="120px" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$valueContent->name}}</a></h4>
                            <p>ID: {{$valueContent->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($valueContent->price)}} VND</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-quantity')}}" method="post">
                                    @csrf
                                    <input class="cart_quantity_input" type="text" name="cartQuantity" value="{{$valueContent->qty}}"  size="2">
                                    <input type="hidden" value="{{$valueContent->rowId}}" name="rowIDCart" class="form-control" />
                                    <input type="submit" value="Cập nhật" name="updateQty" class="btn btn-default btn-sm"/>
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                @php
                                    $value = 'VND';
                                    $subtotal = $valueContent->price * $valueContent->qty;
                                    echo number_format($subtotal).' '.$value;
                                @endphp
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/remove-product-to-cart/'.$valueContent->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::pricetotal(0,',','.').' '.'VND'}}</span></li>
                        <li>Thuế <span>{{Cart::tax(0,',','.').' '.'VND'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::total(0,',','.').' '.'VND'}}</span></li>
                    </ul>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}
                    
                    <?php
									$customerId = Session::get('customerId');
									$shippingId = Session::get('shippingId');
									if($customerId != null && $shippingId == null){
								?>
									<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
									
								<?php
									}
									elseif($customerId != null && $shippingId != null){
								?>
                                    <a class="btn btn-default check_out" href="{{URL::to('/payment')}}">Thanh toán</a>
                                <?php
                                    }
									else{
                                ?>
									<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
								<?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection