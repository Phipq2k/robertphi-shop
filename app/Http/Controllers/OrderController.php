<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\CouponModel;
use Illuminate\Http\Request;

use App\Models\FeeshipModel;
use App\Models\ShippingModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\CustomerModel;
use App\Models\OrderHistoryDetailModel;
use App\Models\OrderHistoryModel;
use App\Models\ProductModel;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function authLogin(){
        $adminId = Auth::id();
        if($adminId){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function managerOrder(){
        $this->authLogin();
        $order = OrderModel::orderby('created_at','DESC')->paginate(5);

        return view('admin.orders.managerOrder')->with(compact('order'));
    }

    public function viewOrder($orderCode){
        $this->authLogin();
        $orderDetails = OrderDetailModel::with('productModel')->where('order_code',$orderCode)->get();
        $order = OrderModel::where('order_code',$orderCode)->get();

        foreach($order as $key => $ordList) {
            $customerId = $ordList->customer_id;
            $shippingId = $ordList->shipping_id;
            $orderStatus = $ordList->order_status;
            
        }
        $customerById = CustomerModel::where('customers_id',$customerId)->first();
        $shipping = ShippingModel::where('shipping_id',$shippingId)->first();
        $orderDetailsProduct = OrderDetailModel::with('productModel')->where('order_code',$orderCode)->paginate(5);
        foreach($orderDetails as $key => $ordDt) {
            $productCoupon = $ordDt->product_coupon;
            // echo '<pre>';
            // print_r($ordDt);
            // echo '</pre><hr>'; 

            
        }
        if($productCoupon == 'no'){
            $couponFeature = 2;
            $couponNumber = 0;
        }
        else{
            $coupon = CouponModel::where('coupon_code',$productCoupon)->first();
            $couponFeature = $coupon->coupon_feature;
            $couponNumber = $coupon->coupon_number;
            // echo '<pre>';
            // print_r($coupon->coupon_id);
            // echo '</pre>'; 
        }
        // dd($customerById->customers_name);
        return view('admin.orders.viewOrder')->with(compact('customerById','orderDetails','shipping','orderDetailsProduct','couponFeature','couponNumber','order','orderStatus'));

    }

    public function printOrder($checkoutCode){
        $this->authLogin();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->printOrderConvert($checkoutCode));
        return $pdf->stream();
    }

    public function printOrderConvert($checkcode){
        $this->authLogin();
        $orderDetail = OrderDetailModel::where('order_code',$checkcode)->get();
        $order = OrderModel::where('order_code',$checkcode)->get();

        foreach($order as $key => $ordList) {
            $customerId = $ordList->customer_id;
            $shippingId = $ordList->shipping_id;
            
        }
        $customer = CustomerModel::where('customers_id',$customerId)->first();
        $shipping = ShippingModel::where('shipping_id',$shippingId)->first();
        $orderDetails = OrderDetailModel::with('productModel')->where('order_code',$checkcode)->get();
        foreach($orderDetails as $key => $ordDt) {
            $productCoupon = $ordDt->product_coupon;
            // echo '<pre>';
            // print_r($ordDt);
            // echo '</pre><hr>'; 

            
        }   
        if($productCoupon == 'no'){
            $couponFeature = 2;
            $couponEcho = 0;
            $couponNumber = 0;
        }
        else{
            $coupon = CouponModel::where('coupon_code',$productCoupon)->first();
            $couponFeature = $coupon->coupon_feature;
            $couponNumber = $coupon->coupon_number;
            if($couponFeature == 1){
                $couponEcho = $couponNumber.'%';
            }
            else{
                $couponEcho = number_format($couponNumber,0,',','.');
            }
            // echo '<pre>';
            // print_r($coupon->coupon_id);
            // echo '</pre>'; 
        }
        $output = '';
        $output .= '
        <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
        }
        li {
            list-style-type: none;
        }
        .table-styling{
            border: 1px solid black
        }
        .table-styling th{
            border: 1px solid black;
            padding: 0 15px;

        }
        .table-styling tr td{
            border: 1px solid black;
            padding: 0 10px;

        }

        </style>
        <h1>
        <center>Công ty TNHH 1 Coder</center>
        </h1>
        <h4>
            <center>Độc lập - Tự do - Hạnh phúc</center>
        </h4>
        <p>Người đặt hàng</p>
        <table class="table-styling" cellspacing="0" cellpadding="1">
            <thead>
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>';
        $output .= '
                <tr>
                    <td>'.$customer->customers_name.'</td>
                    <td>'.$customer->customers_phone.'</td>
                    <td>'.$customer->customers_email.'</td>
                </tr>';
        $output .= '
            </tbody>
        </table>
        ';
        $output .= '
        <p>Vận chuyển hàng tới</p>
        <table class="table-styling" cellspacing="0" cellpadding="1">
            <thead>
                <tr>
                    <th>Tên người nhận</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>';
        $output .= '
                <tr>
                    <td>'.$shipping->shipping_name.'</td>
                    <td>'.$shipping->shipping_address.'</td>
                    <td>'.$shipping->shipping_phone.'</td>
                    <td>'.$shipping->shipping_email.'</td>
                    <td>'.$shipping->shipping_notes.'</td>
                </tr>';
        $output .= '
            </tbody>
        </table>
        ';

        $output .= '
        <p>Đơn hàng đã đặt</p>
        <table class="table-styling" cellspacing="0" cellpadding="1">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Mã giảm giá</th>
                    <th>Số lượng</th>
                    <th>Giá sản phẩm</th>
                    <th>Phí vận chuyển</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>';
            $total = 0;
            foreach ($orderDetails as $key => $detailsPro) {
                $feeship = $detailsPro->product_feeship;
                $supTotal = $detailsPro->product_price *$detailsPro->product_sales_quantity;
                $total += $supTotal;
                $valueMoney = 'VND';
                if($detailsPro->product_coupon != 'no'){
                    $productCoupon = $detailsPro->product_coupon;
                }
                else{
                    $productCoupon = 'Không có mã';
                }
                
        $output .= '
                <tr>
                    <td>'.$detailsPro->product_name.'</td>
                    <td>'.$productCoupon.'</td>
                    <td>'.$detailsPro->product_sales_quantity.'</td>
                    <td>'.number_format($detailsPro->product_price,0,',','.').' '.$valueMoney.'</td>
                    <td>'.number_format($feeship,0,',','.').' '.$valueMoney.'</td>
                    <td>'.number_format($supTotal,0,',','.').' '.$valueMoney.'</td>
                </tr>';
            }
            if($couponFeature == 1){
                $totalAfterCoupon = ($total*$couponNumber)/100;
                $totalCoupon = $total - $totalAfterCoupon + $feeship;
            }
            else{
                $totalAfterCoupon = $couponNumber;
                $totalCoupon = $total - $totalAfterCoupon + $feeship;
            }
        $output .= '
                <tr>
                    <td colspan = "6">
                        <li>Tổng giảm: '.$couponEcho.' '.$valueMoney.'</li>
                        <li>Phí vận chuyển: '.number_format($detailsPro->product_feeship,0,',','.').' '.$valueMoney.'</li>
                        <li>Thành tiền: '.number_format($totalCoupon,0,',','.').' '.$valueMoney.'</li>
                    </td>
                </tr>';
        $output .= '
            </tbody>
        </table>
        ';

        $output .= '
        <p>Chữ ký</p>
        <table class="table-single" cellspacing="0" cellpadding="1">
            <thead>
                <tr>
                    <th width="200px">Người lập phiếu</th>
                    <th width="800px">Người nhận</th>
                    
                </tr>
            </thead>
            <tbody>';
        $output .= '
            </tbody>
        </table>
        ';
        return $output;
    }

    //Cập nhật số lượng sản phẩm khi giao hàng
    public function updateOrderQtyPro(Request $request){
        $this->authLogin();
        $data = $request->all();
        $order = OrderModel::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();


        if($order->order_status == 1){
            foreach($data['order_product_id'] as $key => $ordProId){
                $product = ProductModel::find($ordProId);
                $productQty = $product->product_quantity;
                $productSold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                    if($key == $key2) {
                        $productRemain = $productQty - $qty;
                        $product->product_quantity = $productRemain;
                        $product->product_sold = $productSold + $qty;
                        $product->save();
                    }
                };
            }
        }
        elseif($order->order_status == 2){
            foreach($data['order_product_id'] as $key => $ordProId){
                $product = ProductModel::find($ordProId);
                $productQty = $product->product_quantity;
                $productSold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                    if($key == $key2) {
                        $productRemain = $productQty + $qty;
                        $product->product_quantity = $productRemain;
                        $product->product_sold = $productSold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }
    public function updateOrderQty(Request $request){
        $this->authLogin();
        $data = $request->all();
        $orderDetail = OrderDetailModel::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $orderDetail->product_sales_quantity = $data['order_qty'];
        $orderDetail->save();
    }

    public function deleteOrder(Request $request, $orderId){
        $order = OrderModel::find($orderId);
        $shipping = ShippingModel::find($order->shipping_id);
        $orderDetail = OrderDetailModel::where('order_code',$order->order_code)->get();
        foreach ($orderDetail as $key => $ord_dt) {
            $ord_dt->delete();
        }
        $shipping->delete();
        $order->delete();

        Session::put('message', 'Xóa đơn hàng thành công');
        return Redirect::back();
    }

    public function deleteAllOrder(Request $request){
        $orders = OrderModel::get();
        $orders_count = $orders->count();
        // dd($orders_count);
        foreach ($orders as $order){
            $orderById = OrderModel::find($order->order_id);
            $shipping = ShippingModel::find($orderById->shipping_id);
            $orderByIdDetail = OrderDetailModel::where('order_code',$orderById->order_code)->get();
            foreach ($orderByIdDetail as $key => $ord_dt) {
                $ord_dt->delete();
            }
            $shipping->delete();
            $orderById->delete();
        }
        Session::put('message', 'Xóa đơn hàng thành công');
        return Redirect::back();
    }

    public function orderHistory(){
        $metaTitle = 'Lịch sử đơn hàng';
        $contact = ContactModel::first();
        $imageOrg = url('storage/app/public/uploads/logo/'.$contact->contact_image);
        $orders_history = OrderHistoryModel::where('customer_id', Session::get('customerId'))->get();
        return view('pages.order.history')->with(compact('metaTitle','orders_history','imageOrg'));
    }

    public function deleteHistoryOrder($order_history_id){
        $order_history = OrderHistoryModel::find($order_history_id);
        $order_history->delete();
        return Redirect::back()->with('message','Xoá đơn hàng thành công');
    }

    public function deleteAllHistoryOrder(){
        OrderHistoryModel::truncate();
        return Redirect::back()->with('message','Xoá tất cả đơn hàng thành công');
    }
}
