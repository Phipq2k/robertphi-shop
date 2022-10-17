<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\CustomerModel;
use App\Models\LoginModel;
use App\Models\OrderModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use App\Models\SocialModel;
use App\Models\StatisticModel;
use App\Models\VisitorModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

session_start();


class AdminController extends Controller
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

    public function index(){
        return view('admin_login');
    }

    public function loginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = SocialModel::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = LoginModel::where('admin_id',$account->user)->first();
            Session::put('admin_login',$account_name->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $accFb = new SocialModel([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = LoginModel::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = LoginModel::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''

                ]);
            }
            $accFb->login()->associate($orang);
            $accFb->save();

            // echo '<pre>';
            // print_r($account);
            // echo '</pre>';

            $account_name = LoginModel::where('admin_id',$accFb->user)->first();

            Session::put('admin_name',$account_name->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
        
    }

    public function showDashboard(Request $request){
        $this->authLogin();
        $user_ip_address = $request->ip();
        
        //Current Online
        $visitor_current = VisitorModel::where('ip_address',$user_ip_address)->get();
        $visitor_online_count = $visitor_current->count();
        if($visitor_online_count == 0){
            $visitor = new VisitorModel();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        //Đàu tháng này, đầu tháng trước, cuối tháng trước, 1 năm trước và hiện tại
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $one_years_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        
        //Tổng lượng truy cập tháng trước
        $visitor_of_lastMonth = VisitorModel::whereBetween('date_visitor',[$early_last_month,$end_last_month])->get();
        $visitor_of_lastMonth_count = $visitor_of_lastMonth->count();

        //Tổng lượng truy cập tháng này
        $visitor_of_thisMonth = VisitorModel::whereBetween('date_visitor',[$early_this_month,$today])->get();
        $visitor_of_thisMonth_count = $visitor_of_thisMonth->count();

        //Tổng lượng truy cập trong 1 năm trở lại đây
        $visitor_of_one_year = VisitorModel::whereBetween('date_visitor',[$one_years_ago,$today])->get();
        $visitor_of_one_year_count = $visitor_of_one_year->count();

        //Tổng lượng truy cập
        $all_visitor = VisitorModel::all();
        $visitor_total = $all_visitor->count();

        //Thống kê admin
        $products_count = ProductModel::all()->count();
        $orders_count = OrderModel::all()->count();
        $posts_count = PostModel::all()->count();
        $customers_count = CustomerModel::all()->count();

        //Thống kê top lượt xem sản phẩm
        $products_top_views = ProductModel::orderBy('product_views','desc')->limit(20)->get(); 
        $posts_top_views = PostModel::orderBy('post_views','desc')->limit(20)->get();



        return view('admin.dashboard.dashboard')->with(compact('visitor_online_count','visitor_of_lastMonth_count','visitor_of_thisMonth_count','visitor_of_one_year_count','visitor_total','products_count','orders_count','posts_count','customers_count','products_top_views','posts_top_views'));
    }

    //Đăng nhập thành công
    public function dashboard(Request $request){
        $data = $request->all();
        $adminEmail = $data['admin_email'];
        $admiPpassword = $data['admin_password'];
        $login = LoginModel::where('admin_email',$adminEmail)->where('admin_password', $admiPpassword)->first();
        
        if($login){
            $loginCount = $login->count();
            if($loginCount){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                Session::put('login_normal',true);
                return Redirect::to('/dashboard');
            }
        }
        else{
            Session::put('message','Tài khoản hoặc mật khẩu không đúng');
            return Redirect::to('/admin');
        }
        
    }

    //Đăng xuất
    public function Logout(Request $request){
        Session::put('admin_name',null);
        Session::put('login_normal',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    //Lọc dữ liệu biểu đồ theo khoảng cách giữa 2 mốc thời gian
    public function filterByDate(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $getStatistical = StatisticModel::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date')->get();
        if($getStatistical->count() > 0){
            foreach ($getStatistical as $key => $date) {
                $chartData [] = array(
                    'period' => $date->order_date,
                    'order' => $date->total_order,
                    'sales' => $date->sales,
                    'profit' => $date->profit,
                    'quantity' => $date->quantity
                );
            }
            echo $data= json_encode($chartData);
        }
        return false;

    }

    //Lọc dữ liệu biểu đồ theo điều kiện thời gian cho trước
    public function dashboardFilter(Request $request){
        $data  = $request->all();

        $today = Carbon::now('Asia/Ho_Chi_Minh');
        $sub_7_days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7);
        $sub_365_days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365);
        
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth();
        switch ($data['dashboard_value']) {
            case '7ngayqua':
                $getStatistical = StatisticModel::whereBetween('order_date',[$sub_7_days->toDateString(),$today->toDateString()])->orderBy('order_date')->get();
                break;
            case 'thangtruoc':
                $getStatistical = StatisticModel::whereBetween('order_date',[$early_last_month->toDateString(),$end_last_month->toDateString()])->orderBy('order_date')->get();
                break;
            case 'thangnay':
                $getStatistical = StatisticModel::whereBetween('order_date',[$early_this_month->toDateString(),$today->toDateString()])->orderBy('order_date')->get();
                break;
            case '365ngayqua':
                $getStatistical = StatisticModel::whereBetween('order_date',[$sub_365_days->toDateString(),$today->toDateString()])->orderBy('order_date')->get();
                break;
            default:
                return false;
                break;
        }

        if($getStatistical->count() > 0){
            foreach ($getStatistical as $key => $date) {
                $chartData [] = array(
                    'period' => $date->order_date,
                    'order' => $date->total_order,
                    'sales' => $date->sales,
                    'profit' => $date->profit,
                    'quantity' => $date->quantity
                );
            }
            echo $data= json_encode($chartData);
        }
        return false;
  
    }

    //Dữ liệu biểu đồ mặc định
    public function daysOrder(){
        $sub_30_days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(60)->toDateString();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $getStatistical = StatisticModel::whereBetween('order_date',[$sub_30_days,$today])->orderBy('order_date')->get();
        if($getStatistical->count() > 0){
            foreach ($getStatistical as $key => $date) {
                $chartData [] = array(
                    'period' => $date->order_date,
                    'order' => $date->total_order,
                    'sales' => $date->sales,
                    'profit' => $date->profit,
                    'quantity' => $date->quantity
                );
            }
            echo $data= json_encode($chartData);
        }
        return false;
    }

}
