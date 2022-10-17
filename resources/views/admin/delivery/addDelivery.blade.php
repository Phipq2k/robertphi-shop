@extends('admin_layout')
@section('admin_content')
<div class="col-lg-12">
    <section class="panel">
            <header class="panel-heading">
                Thêm phí vận chuyển
            </header>
            <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
            <div class="panel-body">    
                <div class="position-center">
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInput">Chọn tỉnh / thành phố</label>
                            <select id="city" class="form-control input-sm m-bot15 choose city" name="City">
                                <option value="">--Chọn tỉnh / thành phố--</option>
                                @foreach ($city as $key => $valueCity)
                                <option value="{{$valueCity->ma_tp}}">{{$valueCity->name_tp}}</option>
                                    
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Chọn quận / huyện</label>
                            <select id="province" class="form-control input-sm m-bot15 choose province" name="Provinces">
                                <option value="">--Chọn quận / huyện--</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Chọn xã / phường</label>
                            <select id="ward" class="form-control input-sm m-bot15 choose ward" name="Wards">
                                <option value="">--Chọn xã / phường--</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="text" name="FeeShip" class="form-control feeship" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                        </div>
                        <button type="button" name="AddDelivery" class="btn btn-info btn-add-delivery">Thêm phí vận chuyển</button>
                    </form>
                </div>
                <hr>
                <div id="loadDelivery"></div>
            </div>
    </section>
</div>
@endsection
