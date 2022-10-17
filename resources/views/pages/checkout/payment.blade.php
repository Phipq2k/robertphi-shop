@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Trang chủ</a></li>
              <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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
        <h4 style="margin: 40px 0">Chọn hình thức thanh toán</h4>
        <form action="{{URL::to('/order-places  ')}}" method="get" enctype="multipart/form">
            <div class="payment-options">
                <span>
                    <label><input name="paymentOption" value="0" type="checkbox"> Thanh toán qua thẻ ATM</label>
                </span>
                <span>
                    <label><input name="paymentOption" value="1" type="checkbox"> Thanh toán bằng tiền mặt</label>
                </span>
                <span>
                    <label><input name="paymentOption" value="2" type="checkbox"> Than toán qua Paypal</label>
                </span>
                <input style="margin-top: 0px" type="submit" value="Đặt hàng" name="sendOrder" class="btn btn-primary btn-sm"/>
           </div>
        </form>
    </div>
</section> <!--/#cart_items-->
@endsection