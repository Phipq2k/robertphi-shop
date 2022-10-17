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
    <div class="title-login"><h2>Xác nhận mã đăng nhập</h2></div>
    <div class="register-req">
        <p>Lấy lại mật khẩu bằng tài khoản email</p>
    </div><!--/register-req-->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-1"></div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Nhập mã xác nhận được gửi từ Enail</h2>
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
                <form action="{{url('/reset-password')}}" method="post">
                    @csrf
                    <input required maxlength="6" class="form-control code-auth" type="text" name="code_auth" placeholder="Nhập mã xác nhận* (gồm 6 số)"  />
                    <button type="submit" class="btn btn-default pull-right">Gửi</button>
                </form>
            </div><!--/login form-->
        </div>
    </div>
</div>
<hr>
@endsection