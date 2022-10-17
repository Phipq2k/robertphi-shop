<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthenticationController extends Controller
{
    public function registerAuthPage(Request $request){
        return view('admin.customerAuthen.registerAuth');
    }

    public function loginAuthPage(){
        return view('admin.customerAuthen.loginAuth');
    }
    public function loginAuth(Request $request){
        $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|min:8|max:255',
        ]);

        $data = $request->all();
        $email = $data['admin_email'];
        $password = $data['admin_password'];
        if(Auth::attempt(['admin_email' => $email, 'admin_password' => $password])){
            return Redirect::to('/dashboard');
        }
        else{
            return Redirect::back()->with('message','Tài khoản hoặc mật khẩu không đúng');
        }
    }

    public function logoutAuth(Request $request){
        Auth::logout();
        return redirect('/admin');
    }


    public function registerAuth(Request $request){
        $this->validation($request);
        $data = $request->all();
        $admin = new AdminModel();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return Redirect::to('/login-authentication')->with('message','Đăng ký thành công, vui lòng đăng nhập để tiếp tục');
    }

    public function validation($request){
        return $this->validate($request,[
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|email|max:255',
            'admin_phone' => 'required|max:255',
            'admin_password' => 'required|min:8|max:255',
        ]);
    }
}
