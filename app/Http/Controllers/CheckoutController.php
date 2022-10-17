<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\BannerModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\CityModel;
use App\Models\ContactModel;
use App\Models\CouponModel;
use App\Models\CustomerModel;
use App\Models\FeeshipModel;
use App\Models\ProvinceModel;
use App\Models\WardsModel;
use App\Models\ShippingModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\OrderHistoryDetailModel;
use App\Models\OrderHistoryModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

session_start();

class CheckoutController extends Controller
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

    public function loginCustomer(Request $request){
        $email = $request->emailAcc;
        $password = md5($request->passwordAcc);

        $result = CustomerModel::where('customers_email', $email)->where('customers_password', $password)->first();
        $data = array();
        if($result){
            $data['email_customer'] = $result->customers_email;
            $data['password_customer'] = $result->customers_password;
            Session::put('customerId', $result->customers_id);
        }

        return $data;
        
        
    }

    public function loginCheckout(Request $request){
        $metaTitle = 'Đăng nhập';
        return view('pages.checkout.loginCheckout')->with(compact('metaTitle'));
    }

    public function registerCustomer(Request $request){
        $data = $request->all();
        $customer = new CustomerModel();
        $customer->customers_name = $data['customerName'];
        $customer->customers_email = $data['customerEmail'];
        $customer->customers_password = md5($data['customerPassword']);
        $customer->customers_phone = $data['customerPhone'];
        $customer->save();
        Session::put('customerId', $customer->customer_id);
        Session::put('customer_name', $request->customer_name);
    }

    public function checkout(Request $request){
        $city = CityModel::orderBy('ma_tp','ASC')->get();
        $metaTitle = "Thanh toán";
        return view('pages.checkout.showCheckout')->with(compact('city','metaTitle'));
    }

    public function logoutCheckout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function managerOrder(){
        $this->authLogin();
        $allOrder = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customers_id')
        ->select('tbl_order.*','tbl_customers.customers_name')
        ->orderBy('tbl_order.order_id','desc')->get();
        $managerOrder = view('admin.managerOrder')->with('allOrder',$allOrder);
        return view('admin_layout')->with('admin.managerOrder', $managerOrder);
        // echo '<pre>';
        // print_r($allOrder);
        // echo '</pre>';
    }

    public function viewOrder($orderId){
        $this->authLogin();
        $orderById = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customers_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_detail.*')->first();
        // echo '<pre>';
        // print_r($orderById);
        // echo '</pre>';
        $managerOrderById = view('admin.viewOrder')->with('orderById',$orderById);
        return view('admin_layout')->with('admin.viewOrder', $managerOrderById);
    }

    public function selectDeliveryClient(Request $request){
        $data = $request->all();
        $output = '';
        if($data['action']){
            if($data['action'] == "city"){
                $selectProvince = ProvinceModel::where('ma_tp',$data['maId'])->orderby('ma_qh','ASC')->get();
                $output = '<option>--Chọn quận / huyện--</option>';
                foreach($selectProvince as $key => $province){
                    $output.='<option value="'.$province->ma_qh.'">'.$province->name_qh.'</option>';
                }
            
            }
            else{
                $selectWard = WardsModel::where('ma_qh',$data['maId'])->orderby('xa_id','ASC')->get();
                $output = '<option>--Chọn xã / phường--</option>';

                foreach($selectWard as $key => $ward){
                    $output.='<option value="'.$ward->xa_id.'">'.$ward->name_xa.'</option>';
                }
            }
        }
        return $output;
    }

    public function caculateFeeShip(Request $request){
        $data = $request->all();
        $feeship = FeeshipModel::where('fee_mtp', $data['matp'])->where('fee_mqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
        if($data['matp']){
            if($feeship){
                $countFeeship = $feeship->count();
                if($countFeeship > 0){
                    foreach($feeship as $key => $fee){
                    Session::put('feeship',$fee->fee_feeship);
                    Session::save();
                    }
                }else{
                    Session::put('feeship',20000);
                    Session::save();
                }    
            
                
            }
            return Session::get('feeship');
        }
        
        return $feeship;
    }

    public function deleteFeeShip(Request $request){

        Session::forget('feeship');
        return Redirect::back(); 
    }

    public function confirmOrder(Request $request){
       $data = $request->all();
       $customerById = CustomerModel::find(Session::get('customerId'));
    //    $coupon = CouponModel::where('coupon_code',$data['orderCoupon'])->take(1)->get();
    //    dd($coupon->coupon_used);
       $shipping = new ShippingModel();
       $shipping->shipping_email = $data['shippingEmail'];
       $shipping->shipping_name = $data['shippingName'];
       $shipping->shipping_address = $data['shippingAddress'];
       $shipping->shipping_phone = $data['shippingPhone'];
       $shipping->shipping_notes = $data['shippingNotes'];
       $shipping->shipping_method = $data['shippingMethod'];
       $shipping->save();

       $code = substr(md5(microtime()),rand(0,26),5);
       date_default_timezone_set('Asia/Ho_Chi_Minh');
       $shippingId = $shipping->shipping_id;
       $order = new OrderModel();
       $order->customer_id = Session::get('customerId');
       $order->shipping_id = $shippingId;
       $order->order_status = 0;
       $order->order_code = $code;
       $order->created_at = now();
       $order->save();

       //Lưu vào lịch sử đơn hàng
       $order_history = new OrderHistoryModel();
       $order_history->customer_id = Session::get('customerId');
       $order_history->shipping_id = $shippingId;
       $order_history->order_history_code = $code;
       $order_history->created_at = now();
       $order_history->save();

       if(Session::get('cart')){
            $order_detail_arr = [];
            foreach(Session::get('cart') as $key => $cart){
                $orderDetail = new OrderDetailModel();
                // $orderCode = OrderModel::orderby('created_at','DESC')->get();

                $orderDetail->order_code = $code;
                $orderDetail->product_id = $cart['product_id'];
                $orderDetail->product_name = $cart['product_name'];
                $orderDetail->product_price = $cart['product_price'];
                $orderDetail->product_sales_quantity = $cart['product_qty'];
                $orderDetail->product_coupon = $data['orderCoupon'];
                $orderDetail->product_feeship = $data['orderFee'];

                $orderDetail->save();

                //Get product details to send email
                $order_detail = array(
                    'product_name' => $cart['product_name'],
                    'product_price' => $cart['product_price'],
                    'product_qty' => $cart['product_qty'],
                    'order_total' => $cart['product_price'] * $cart['product_qty']
                );
                array_push($order_detail_arr,$order_detail);
            }
        }
       $coupon = CouponModel::where('coupon_code',$data['orderCoupon'])->take(1)->get();
       foreach ($coupon as $key => $cou) {
           $cou->coupon_used = $cou->coupon_used.' '.Session::get('customerId').' ';
           $coupon_qty = $cou->coupon_code_qty -1;
           $cou->coupon_code_qty = $coupon_qty;
           $cou->save();
       }
       $shipping_method = '';
       switch ($data['shippingMethod']) {
            case 0:
                $shipping_method = 'Thanh toán bằng tiền mặt';
                break;
            case 1:
                $shipping_method = 'Thanh toán qua VNPay';
                break;
            default:
                $shipping_method = 'Thanh toán bằng paypal';
                break;
       }
       if($data['orderCoupon'] == 'no'){
           $data['orderCoupon'] = 'Không sủ dụng mã';
       }

       $shipping_arr = array(
            'shipping_name' => $data['shippingName'],
            'shipping_address' => $data['shippingAddress'],
            'shipping_email' => $data['shippingEmail'],
            'shipping_phone' => $data['shippingPhone'],
            'shipping_notes' => $data['shippingNotes'],
            'shipping_method' => $shipping_method
        );
        $order_arr = array(
            'order_code' => $code,
            'order_coupon' => $data['orderCoupon'],
            'customer_id' => Session::get('customerId')
        );
        $title_email = "Cảm ơn bạn đã đặt hàng bên Robert Phi Store";
        $to_email = $customerById->customers_email;//send to this email
        $metaTitle = 'Thư cảm ơn';

        Mail::send('pages.email.sendMailOrdered',['order_detail'=> $order_detail_arr, 'shipping' => $shipping_arr,'order' => $order_arr, 'metaTitle' => $metaTitle],function($message) use ($title_email,$to_email,$metaTitle){
            $message->to($to_email)->subject($title_email);//send this mail with subject
            $message->from($to_email,$metaTitle);//send from this mail
        });

       Session::forget('coupon');
       Session::forget('shippingMethod');
       Session::forget('feeship');
       Session::forget('cart');
    }

}