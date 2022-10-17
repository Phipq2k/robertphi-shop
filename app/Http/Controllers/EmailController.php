<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\CouponModel;
use App\Models\CustomerModel;
use Carbon\Carbon;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

session_start();


class EmailController extends Controller
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

    public function sendEmail(){
        $this->authLogin();
        //send mail
        $to_name = "Robert Phi Coder";
        $to_email = "tranquocphi156006278@gmail.com";//send to this email

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail gửi về vấn đề hàng hóa"); //body of mail.blade.php

        Mail::send('pages.sendEmail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Demo send email');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        //--send mail

        return Redirect::to('/home')->with('message','');
    }


    public function sendCoupon(Request $request){
        $customer_vip = CustomerModel::where('customers_vip',1)->get();
        $current_time = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_email = 'Mã khuyến mãi ngày'.' '.$current_time;
        $couponById = CouponModel::find($request->coupon_id);
        $coupon = array(
            'coupon_name' => $couponById->coupon_name,
            'coupon_number' => $couponById->coupon_number,
            'coupon_feature' => $couponById->coupon_feature,
            'coupon_condition' => $couponById->coupon_condition,
            'coupon_code' => $couponById->coupon_code,
            'coupon_date_start' => $couponById->coupon_date_start,
            'coupon_date_end' => $couponById->coupon_date_end
        );

        $data = [];
        foreach($customer_vip as $vip){
            $data['email'][] = $vip->customers_email;
        }
        // dd($data);
        Mail::send('admin.email.sendEmail',['coupon' => $coupon],function($message) use ($title_email,$data){
            $message->to($data['email'])->subject($title_email);//send this mail with subject
            $message->from($data['email'],$title_email);//send from this mail
        });

      
    }

    //Quên mật khẩu
    public function forgotPassword(){
        $metaTitle = 'Quên mật khẩu';
        return view('pages.email.forgotPassWord')->with(compact('metaTitle'));
    }

    //Lấy lại mật khẩu
    public function recoverPassword(Request $request){
        $data = $request->all();
        $title_email = 'Yêu cầu xác nhận tài khoản của bạn';
        $token_random = Str::random();
        $customer = CustomerModel::where('customers_email', $data['email'])->first();
        if($customer){
            $coderAuth = rand(100000,900000);
            // $customerById = CustomerModel::find($customer->customers_id);
            // $customerById->customers_token = $token_random;
            // $customerById->save();
            // $link_reset_password = url('/update-new-password?email='.$data['email'].'&token='.$token_random);
            $info_reset_pass = array('name'=>$title_email,'code'=>$coderAuth,'email'=>$data['email']);
            Mail::send('pages.email.infoEmailgetPass',['info' => $info_reset_pass],function($message) use ($title_email,$data){
                $message->to($data['email'])->subject($title_email);//send this mail with subject
                $message->from($data['email'],$title_email);//send from this mail
            });
            Session::put('customerAuth',$customer->customers_id);
            Session::put('codeAuth',$coderAuth);
            return Redirect::to('/code-authentication');
        }
        else{
            return Redirect::back()->with('error','Email không đúng, vui lòng nhập email khác');
        }
        
    }

    public function codeAuthPage(){
        $metaTitle = 'Mã xác nhận';
        return view('pages.email.codeAuth')->with(compact('metaTitle'));
    }

    public function resetPassword(Request $request){
        $data = $request->all();
        if($data['code_auth'] == Session::get('codeAuth')){
            return Redirect::to('/new-password');   
        }
    }

    public function newPassword(Request $request){
        $data = $request->all();
        $customer = CustomerModel::find(Session('customerAuth'));
        $customer->customers_password = md5($data['new_password']);
        $customer->save();
        Session::forget('customerAuth');
        Session::forget('codeAuth');
        return Redirect::to('/login-checkout');

    }

    public function newPasswordPage(){
        $metaTitle = 'Mật khẩu mới';
        return view('pages.email.newPassword')->with(compact('metaTitle'));
    }

    public function emailOrderPage(){
        $metaTitle = 'Email order';
        $contact = ContactModel::all()->first();
        return view('pages.email.sendMailOrdered')->with(compact('metaTitle','contact'));
    }
}
