<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <img style="width:100px"src="{{url('storage/app/public/uploads/logo/'.$contact->contact_images)}}" alt="Logo">
                        <h2><span>Robert Phi </span>Store</h2>
                        <p>Chuyên cung cấp các loại sản phẩm thời trang thuộc các hãng nổi tiếng thế giới, còn hãng nào thì shop không biết</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Dịch vụ chúng tôi</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="{{url('/')}}">Hướng dẫn mua hàng</a></li>
                            <li><a href="{{url('/')}}">Hướng dẫn thanh toán</a></li>
                            <li><a href="{{url('/')}}">Quy định đổi trả</a></li>
                            <li><a href="{{url('/')}}">Điều khoản và dịch vụ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Thông tin shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li>Địa chỉ 1: 14 Lý Thường Kiệt, Tam Thanh, Phú Quý, Bình Thuận</li>
                            <li>Địa chỉ 2: 27 Lý Thường Kiệt, Tam Thanh, Phú Quý, Bình Thuận</li>
                            <li>Sđt: 0941915884</li>
                            <li>Email: tranquocphi156006278@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="single-widget">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="single-widget">
                        <h2>Fanpage</h2>
                        <ul class="nav nav-pills nav-stacked">
                            {!!$contact->contact_fanpage!!}
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-widget">
                        <h2>Đăng ký Email</h2>
                        <form action="#">
                            <input type="text" placeholder="Điền Email của bạn"/>
                            <button style="margin:0" type="submit" class="btn btn-primary"><i class="fa fa-arrow-circle-right"></i></button>
                            <p>Bạn sẽ nhận được tất cả thông báo cập nhật của shop chúng tôi khi đăng ký qua email, kể cả thư spam 😝</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Website được phát triển bởi Cậu Bé Coder team</p>
                <p class="pull-right">Muốn biết thêm thông tin chi tiết, vui lòng liên hệ anh <span><a target="_blank" href="https://www.facebook.com/robertphicoder/">Robert Phi</a></span> để được khai sáng tâm hồn</p>
            </div>
        </div>
    </div>
    
</footer><!--/Footer-->