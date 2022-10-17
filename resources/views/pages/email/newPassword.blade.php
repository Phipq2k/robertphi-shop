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
    span{
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #FE980F;
        cursor: pointer;
        /* display: none; */
    }
</style>
<div class="container">
    <div class="title-login"><h2>Mật khẩu mới</h2></div>
    <div class="register-req">
        <p>Cập nhật mật khẩu mới</p>
    </div><!--/register-req-->
    <div class="row">
        <div class="col-sm-2 col-sm-offset-1"></div>
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Cập nhật mật khẩu mới</h2>
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
                <form action="{{url('/update-new-pass')}}" method="post">
                    @csrf
                    <input required  class="form-control password-input" type="password" name="new_password" placeholder="Nhập mật khẩu mới"  />
                    {{-- <span class="toggle-pass" ><i class="fa fa-eye"></i></span> --}}
                    <button type="submit" class="btn btn-default pull-right">Cập nhật</button>
                </form>
            </div><!--/login form-->
        </div>
    </div>
</div>
<hr>
@endsection