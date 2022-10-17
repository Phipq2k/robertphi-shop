@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin đăng nhập
        </div>
        <div class="table-responsive">
        <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>{{$customerById->customers_name}}</td>
                      <td>{{$customerById->customers_phone}}</td>
                      <td>{{$customerById->customers_email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br/>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển hàng hóa
        </div>
        <div class="table-responsive">
        <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                    <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>{{$shipping->shipping_name}}</td>
                      <td>{{$shipping->shipping_address}}</td>
                      <td>{{$shipping->shipping_phone}}</td>
                      <td>{{$shipping->shipping_email}}</td>
                      <td>{{$shipping->shipping_notes}}</td>
                      <td>
                        @php
                          switch ($shipping->shipping_method) {
                            case 0:
                              echo 'Thanh toán bằng thẻ ngân hàng';
                              break;
                            case 1:
                              echo 'Thanh toán bằng tiền mặt';
                              break;
                            
                            default:
                              echo 'Thanh toán bằng Paypal';
                              break;
                          }
                        @endphp
                      </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách chi tiết đơn hàng
      </div>
      
      <div class="table-responsive">
        <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Số thứ tự</th>
              <th>Tên sản phẩm</th>
              <th>Mã giảm giá</th>
              <th>Số lượng</th>
              <th>Số lượng kho</th>
              <th>Giá sản phẩm</th>
              <th>Phí vận chuyển</th>
              <th>Tổng tiền</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 1;
              $total = 0;
              $valueMoney = 'VND';
            @endphp
            @foreach ($orderDetails as $key => $ordDetails)
            @php
                $i++;
                $supTotal = $ordDetails->product_price *$ordDetails->product_sales_quantity;
                $total += $supTotal;
              @endphp
            <tr class="color-order-qty-{{$ordDetails->product_id}}">
              <td>{{$i}}</td>
              <td>{{$ordDetails->product_name}}</td>
              <td>
                @php
                  if($ordDetails->product_coupon != 'no'){
                    echo $ordDetails->product_coupon;
                  }
                  else{
                    echo 'Không có mã';
                  }
                @endphp
              </td>
              <td>
                {{-- <form>
                  @csrf --}}
                  <input type="number" min="1" {{$orderStatus == 2 ? 'disabled': ''}} value="{{$ordDetails->product_sales_quantity}}" class="order-qty-{{$ordDetails->product_id}}" name="ProductSalesQuantity"/>
                  <input type="hidden" name="OrderQtyStorage" class="order-qty-storage-{{$ordDetails->product_id}}" value="{{$ordDetails->productModel->product_quantity}}" />
                  <input type="hidden" name="OrderCode" class="order-code" value="{{$ordDetails->order_code}}" />
                  <input type="hidden" name="OrderCheckoutQuantity" class="order-product-id" value="{{$ordDetails->product_id}}" />
                  @if($orderStatus != 2)
                  <button type="button" class="btn btn-warning btn-sm update-qty-order" data-product_id="{{$ordDetails->product_id}}" name="UpdateProductQuantity">Cập nhật</button>
                  @endif
                {{-- </form> --}}
              </td>
              <td>{{$ordDetails->productModel->product_quantity}}</td>
              <td>{{number_format($ordDetails->product_price,0,',','.').' '.$valueMoney}}</td>
              <td>{{number_format($ordDetails->product_feeship,0,',','.').' '.$valueMoney}}</td>
              <td>{{number_format($supTotal,0,',','.').' '.$valueMoney}}</td>
            </tr>
            @endforeach
            <tr>
              <td colspan="7">
                {!!$orderDetailsProduct->links()!!}
              </td>
            </tr>
            <tr>
              <td colspan="7"> 
                @php
                  $totalCoupon = 0;
                  if($couponFeature == 1){
                    $totalAfterCoupon = ($total*$couponNumber)/100;
                    $totalCoupon = $total - $totalAfterCoupon + $ordDetails->product_feeship;
                    echo 'Tổng giảm:'.number_format($totalAfterCoupon,0,',','.').' '.$valueMoney.'<br/>';
                  }
                  else{
                    $totalCoupon = $total - $couponNumber + $ordDetails->product_feeship;
                    echo 'Tổng giảm:'.number_format($couponNumber,0,',','.').' '.$valueMoney.'<br/>';
                  }
                @endphp
                Phí vận chuyển:
                {{number_format($ordDetails->product_feeship,0,',','.').' '.$valueMoney}}
                <br/>
                Thành tiền: 
                {{number_format($totalCoupon,0,',','.').' '.$valueMoney}}
              </td>
              <td>
                <a href="{{URL::to('/print-order/'.$ordDetails->order_code)}}"><button class="btn btn-primary">In đơn hàng</button></a>
              </td>
            </tr>
            <tr>
              <td colspan="6">
                @foreach($order as $key => $ordValue)
                @if($ordValue->order_status == 0)
                <form>
                  @csrf
                  <select name="" class="form-control status-order-handler" id="">
                    <option>--Chọn hình thức xử lý đơn hàng--</option>
                    <option id="{{$ordValue->order_id}}" value="0" selected>Chưa xử lý</option>
                    <option id="{{$ordValue->order_id}}" value="1" >Đã xử lý-Đã giao hàng</option>
                    <option id="{{$ordValue->order_id}}" value="2">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($ordValue->order_status == 1)
                <form>
                  @csrf
                  <select name="" class="form-control status-order-handler" id="">
                    <option>--Chọn hình thức xử lý đơn hàng--</option>
                    <option id="{{$ordValue->order_id}}" value="0">Chưa xử lý</option>
                    <option id="{{$ordValue->order_id}}" selected value="1">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$ordValue->order_id}}" value="2">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @else
                <form>
                  @csrf
                  <select name="" class="form-control status-order-handler" id="">
                    <option >--Chọn hình thức xử lý đơn hàng--</option>
                    <option id="{{$ordValue->order_id}}" value="0">Chưa xử lý</option>
                    <option id="{{$ordValue->order_id}}" value="1">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$ordValue->order_id}}" selected value="2">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @endif
                {{-- <button type="button" class="btn btn-default kk">demo</button> --}}
                @endforeach
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
    </div>
</div>

@endsection
