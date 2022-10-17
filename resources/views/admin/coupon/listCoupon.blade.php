@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách mã giảm giá
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">              
          <a href="{{url('/insert-coupon')}}" class="btn btn-sm btn-warning">Thêm mã giảm giá</a>                
        </div>
        <div class="col-sm-4">
        </div>
        {{-- <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div> --}}
      </div>
      <div class="table-responsive">
        <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}
            $i = 1;	
	        ?>
          <span class="text-alert notify"></span>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">STT</th>
              <th>Sự kiện</th>
              <th>Mã</th>
              <th>Số lượng mã</th>
              <th>Loại mã giảm</th>
              <th>Mức giá tối thiểu đạt yêu cầu</th>
              <th>Giảm giá</th>
              <th>Ngày gia hạn</th>
              <th>Ngày hết hạn</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <form>
              @csrf
              @foreach ($coupon as $key => $value)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$value->coupon_name}}</td>
                <td>{{$value->coupon_code}}</td>
                <td>{{$value->coupon_code_qty}}</td>
                <td>
                  @if ($value->coupon_feature == 1)
                    <p>Giảm theo đơn vị phần trăm</p>
                  @else
                    <p>Giảm theo đơn vị tiền</p>
                  @endif
                </td>
                <td>{{number_format($value->coupon_condition,0,',','.').' VND'}}</td>
                <td>
                    @php
                        switch($value->coupon_feature){
                            case 1: echo 'Giảm '.$value->coupon_number.' %';
                            break;
                            case 2: echo 'Giảm '.$value->coupon_number.' VND';
                            break;
                            default: 'Không miễn giảm';

                        }
                    @endphp
                </td>
                <td>{{$value->coupon_date_start}}</td>
                <td>{{$value->coupon_date_end}}</td>
                <td>
                  @if ($value->coupon_status == 0)
                  <span title="Chưa kích hoạt" class=" text-warning fa fa fa-minus"></span>
                  @elseif ($value->coupon_status == 1)
                  <span title="Đang kích hoạt" class="text-success fa fa-check"></span>
                  @elseif($value->coupon_status == 2)
                  <span title="Đã hết hạn" class="text-danger fa fa-ban"></span>
                  @endif
                </td>
                <td>
                  <a onclick="return confirm('Bạn có chắc là muốn xóa mã giảm giá này không?')" href="{{URL::to('/delete-coupon/'.$value->coupon_id)}}" title="Xóa mã giảm giá" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </form>
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$coupon->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
