<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        $admin = AdminModel::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.user.allUser')->with('admin', $admin);
    }

    public function addUserPage(){
        return view('admin.user.addUser');
    }

    public function addUser(Request $request){
        $data = $request->all();
        $user = new AdminModel();
        $user->admin_name = $data['admin_name'];
        $user->admin_email = $data['admin_email'];
        $user->admin_phone = $data['admin_phone'];
        $user->admin_password = md5($data['admin_password']);
        $user->save();

        $user->roles()->attach(RoleModel::where('role_name','user')->first());
        return Redirect::back()->with('message','Thêm người dùng thành công');
    }

    public function assignRoles(Request $request){
        // dd($data);
        $user = AdminModel::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach();
        if($request->admin_role){
            $user->roles()->attach(RoleModel::where('role_name','admin')->first());
        }

        if($request->author_role){
            $user->roles()->attach(RoleModel::where('role_name','author')->first());
        }

        if($request->user_role){
            $user->roles()->attach(RoleModel::where('role_name','user')->first());
        }


        return Redirect::back()->with('message','Cấp quyền cho '.$user->admin_name.' thành công');
    }

    public function deleteUserRoles($userId){
        $admin = AdminModel::find($userId);
        if($admin){
            $admin->roles()->detach();
            $admin->delete();
        }
        return Redirect::back()->with('message','Xóa người dùng '.$admin->admin_name.' thành công');
        
        
    }

    //Truy cập tài khoản khác
    public function impersionate($userId){
        $user = AdminModel::where('admin_id',$userId)->first();
        if($user){
            Session::put('impersionate',$user->admin_id);
        }
        return Redirect::back()->with('message','Truy cập '.$user->admin_name.' thành công');
    }

    public function impersionateDestroy(){
        Session::forget('impersionate');
        return Redirect::to('/all-users');
    }
}
