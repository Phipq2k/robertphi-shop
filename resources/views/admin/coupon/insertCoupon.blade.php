@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <span class="text-alert notify"></span>
            <div class="panel-body">    
                <div class="position-center">
                    <form id="insert_coupon">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã</label>
                            <input type="text" name="CouponName" class="form-control coupon-name" id="exampleInputEmail1" placeholder="Tên sản phẩm"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã</label>
                            <input type="text" name="CouponCode" class="form-control coupon-code" id="exampleInputEmail1"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                            <textarea  style="resize: none" class="form-control coupon-quantity" name="CouponCodeQuantity" placeholder="Mô tả sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mức giá tối thiểu để khuyến mãi</label>
                            <input type="number" min="1000" step="1000" name="CouponCondition" class="form-control coupon-condition" id="exampleInputEmail1"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Tính năng mã</label>
                            <select class="form-control input-sm m-bot15 coupon-feature" name="CouponFeature">
                                <option value="0">-----Chọn-----</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInput">Nhập số % hoặc số tiền giảm</label>
                            <textarea  style="resize: none" class="form-control coupon-number" name="CouponNumber" placeholder="Mô tả sản phẩm" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="coupon_date_start">Ngày gia hạn</label>
                            <input type="text" name="CouponDateStart" class="form-control coupon-date-start" id="coupon_date_start" placeholder="Ngày gia hạn"/>
                        </div>
                        <div class="form-group">
                            <label for="coupon_date_end">Ngày hết hạn</label>
                            <input type="text" name="CouponDateEnd" class="form-control coupon-date-end" id="coupon_date_end" placeholder="Ngày hết hạn"/>
                        </div>
                        <button type="button" name="AddCoupon" class="btn btn-info btn-coupon">Thêm mã</button>
                        <a href="{{url('/list-coupon')}}" class="btn btn-warning">Xem danh sách mã</a>
                    </form>
                </div>
            </div>
    </section>
</div>
@endsection
