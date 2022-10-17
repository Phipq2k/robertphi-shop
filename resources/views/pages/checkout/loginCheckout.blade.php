@extends('layout')
@section('header')
@include('components.header')
@endsection
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
    <div class="title-login"><h2>ĐĂNG NHẬP KHÁCH HÀNG</h2></div>
    <div class="register-req">
        <p>Vui lòng đăng ký hoặc đăng nhập để mua hàng</p>
    </div><!--/register-req-->
    <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form"><!--login form-->
                <h2>Đăng nhập tài khoản</h2>
                <span class="text-alert login-message"></span>
                <form>
                    <input class="form-control email" type="email" name="emailAcc" placeholder="Email"  />
                    <input class="form-control password" type="password" name="passAcc" placeholder="Mật khẩu" />
                    <span>
                        <input type="checkbox" class="checkbox"> 
                        Ghi nhớ đăng nhập
                    </span>
                    <span class="pull-right">
                        <a href="{{url('/forgot-password')}}">Quên mật khẩu</a>
                    </span>
                    <button type="button" class="btn btn-default login-checkout">Đăng nhập</button>
                </form>
            </div><!--/login form-->
        </div>
        <div class="col-sm-1">
            <h2 class="or">HOẶC</h2>
        </div>
        <div class="col-sm-4">
            <div class="signup-form"><!--sign up form-->
                <h2>Đăng ký</h2>
                <span class="text-alert signup-message"></span>
                <form id="signup-customer">
                    @csrf
                    <input class="form-control customer_name" type="text" name="customerName" placeholder="Họ và tên"/>
                    <input class="form-control customer_email" type="email" name="customerEmail" placeholder="Email"/>
                    <input class="form-control customer_password" type="password" name="customerPassword" placeholder="Mật khẩu"/>
                    <input class="form-control customer_phone" type="text" name="customerPhone" placeholder="Số điện thoại"/>
                    <button type="button" class="btn btn-default signup-checkout">Đăng ký</button>
                </form>
            </div><!--/sign up form-->
        </div>
    </div>
</div>
<hr>
@section('footer')
@include('components.footer')
@endsection
@endsection