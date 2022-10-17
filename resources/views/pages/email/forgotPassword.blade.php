@extends('layout')
@section('content')
<style type="text/css">
    .error {
        color: red;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 75;
        margin-bottom: 20px;
    }
    .title-login h2{
        color: #FE980F;
    }
</style>
<div class="container">
    <div class="title-login"><h2>QUÊN MẬT KHẨU</h2></div>
    <div class="register-req">
        <p>Lấy lại mật khẩu bằng tài khoản email</p>
    </div><!--/register-req-->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-1"></div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Điền email để lấy lại mật khẩu</h2>
                <?php
	        	$message = Session::get('message');
	        	if($message){
	        		echo '<span class="text-success">'.$message.'</span>';
	        		Session::put('message', null);	
	        	}

                $error = Session::get('error');
	        	if($error){
	        		echo '<span class="text-alert">'.$error.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
                <form action="{{url('/recover-password')}}" method="post">
                    @csrf
                    <input required class="form-control email" type="email" name="email" placeholder="Nhập email"  />
                    <button type="submit" class="btn btn-default pull-right">Gửi mã xác nhận</button>
                </form>
            </div><!--/login form-->
        </div>
    </div>
</div>
<hr>
@endsection