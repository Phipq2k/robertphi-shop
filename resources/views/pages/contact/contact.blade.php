@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12 col-md-12">    			   			
                <h2 class="title text-center">Bản đồ</h2>    			    				    				
                <div class="contact-map">
                   {!!$contact->contact_map!!}
                </div>
            </div>			 		
        </div>
        <hr style="border: 3px double #ccc" width="100%">
        <div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Liên hệ giải quyết vấn đề</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form>
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required" placeholder="Chủ đề">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung"></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Thông tin liên hệ</h2>
                    <address>
                        {!!$contact->contact_info!!}
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Fanpage</h2>
                        {!!$contact->contact_fanpage!!}
                    </div>
                    
                </div>
            </div>    			
        </div>
        <hr width="100%" style="border: 3px double #ccc">  
    </div>	
</div><!--/#contact-page-->
@section('footer')
@include('components.footer')
@endsection
@endsection