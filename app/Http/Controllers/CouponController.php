<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\CouponModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

session_start();

class CouponController extends Controller
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
    //Thanh toán mã giảm giá
    public function checkCoupon(Request $request){
        $data = $request->all();
        $coupon = CouponModel::where('coupon_code',$data['couponCode'])->where('coupon_status',1)
        ->where('coupon_used','not like','% '.Session::get('customerId').' %')
        ->first();
        // dd($coupon->coupon_condition);
        if($coupon){
            $coupon_count = $coupon->count();
            if($data['total_order'] >= $coupon->coupon_condition){
                if($coupon_count > 0){
                    $coupon_session = Session::get('coupon');
                    if($coupon_session == true){
                        $is_available = 0;
                        if($is_available == 0){
                           $cou[] = array(
                               'coupon_code' => $coupon->coupon_code,
                               'coupon_feature' => $coupon->coupon_feature,
                               'coupon_number' => $coupon->coupon_number,
                               'coupon_condition' => $coupon->coupon_condition
                           );
                           Session::put('coupon', $cou);
                            
                        }
                    }
                    else{
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_feature' => $coupon->coupon_feature,
                            'coupon_number' => $coupon->coupon_number,
                            'coupon_condition' => $coupon->coupon_condition
                        );
                        Session::put('coupon', $cou);
                    }
                    Session::save();
                    return Redirect::back()->with('message', 'Thêm mã giảm giá thành công');
                }
            }
            else{
                return Redirect::back()->with('error', 'Sử dụng mã thất bại, mã chỉ kích hoạt khi tổng số tiền thanh toán đạt yêu cầu');
            }
        }
        else {
            if(Session::get('coupon')){
                Session::forget('coupon');
            }
            return Redirect::back()->with('error', 'Mã giảm giá này không khả dụng, vui lòng liên hệ nhà cung cấp để biết thêm thông tin chi tiết');
        }


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
    }

    public function insertCoupon(){
        $this->authLogin();
        return view('admin.coupon.insertCoupon');
    }

    public function insertCouponCode(Request $request){
        $this->authLogin();
        $data = $request->all();
        $coupon = new CouponModel();
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_code_qty = $data['coupon_quantity'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_feature = $data['coupon_feature'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_date_start = $data['coupon_date_start'];
        $coupon->coupon_date_end = $data['coupon_date_end'];
        $date_start = strtotime($data['coupon_date_start']);
        $date_end = strtotime($data['coupon_date_end']);
        $today = strtotime(Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y'));
        //Hiệu giữa 2 ngày
        $result1 = $today - $date_start;
        $result2 = $date_end - $today;
        //Điệu kiện thời gian hiển thị trạng thái gia hạn
        if($result1 < 0){
            $coupon->coupon_status = 0;
        }
        elseif($result1 >= 0 && $result2 >= 0){
            $coupon->coupon_status = 1;
        }
        elseif($result2 < 0 ){
            $coupon->coupon_status = 2;
           
        }
        $coupon->save();
    }

    public function listCoupon(){
        $this->authLogin();
        $coupon = CouponModel::orderby('coupon_id','desc')->paginate(5);
        $today = strtotime(Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y'));
        $data = array();
        foreach ($coupon as $key => $cou) {
            $couponById = CouponModel::find($cou->coupon_id);
            $date_start = strtotime($couponById->coupon_date_start);
            $date_end = strtotime($couponById->coupon_date_end);
            //Hiệu giữa 2 ngày
            $result1 = $today - $date_start;
            $result2 = $date_end - $today;
            $data [$key] = 'Đang gia hạn: '.$result1.' '.$result2;
            //Điệu kiện thời gian hiển thị trạng thái gia hạn
            if($result1 < 0){
                $couponById->coupon_status = 0;
                $couponById->save();
            }
            elseif($result1 >= 0 && $result2 >= 0){
                $couponById->coupon_status = 1;
                $couponById->save();
            }
            elseif($result2 < 0 ){
                $couponById->coupon_status = 2;
                $couponById->save();
            }
        }
        // dd($data);
        return view('admin.coupon.listCoupon')->with(compact('coupon','today'));
    }

    public function deleteCoupon($couponId){
        $this->authLogin();
        $coupon = CouponModel::find($couponId);
        $coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('/list-coupon');
    }

    public function unsetCoupon(){
        $coupon = Session::get('coupon');
        if($coupon){
            Session::forget('coupon');
            return Redirect::back()->with('message','Xóa mã khuyến mãi thành công');
        }
        
    }
}
