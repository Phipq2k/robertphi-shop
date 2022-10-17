@extends('admin_layout')
@section('admin_content')
<style type="text/css">
  ul.top-menu>li>a{
    background: black;
  }
</style>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách đơn hàng
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
                          
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <?php
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Số thứ tự</th>
              <th>Mã đơn hàng</th>
              <th>Ngày đặt hàng</th>
              <th>Tình trạng đơn hàng</th>
              {{-- <th>Mã đơn hàng</th> --}}
              {{-- <th>Mã đơn hàng</th> --}}
              <th>Chức năng</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i = 1;
            @endphp
            @foreach ($order as $key => $orderList)
            <tr>
              <td>
                @php
                  echo $i++;
                @endphp
              </td>
              <td>{{$orderList->order_code}}</td>
              <td>{{$orderList->created_at}}</td>
              <td>
                @php
                  switch ($orderList->order_status) {
                    case 0:
                      echo 'Đang xử lý';
                      break;
                    case 1:
                      echo 'Đơn hàng mới';
                      break;
                    
                    default:
                      echo 'Đã hủy đơn hàng';
                      break;
                  }
                @endphp
              </td>
              <td>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Xem chi tiết đơn hàng" href="{{URL::to('/view-order/'.$orderList->order_code)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-eye text text-primary"></i>
                        </a>
                      </li>
                  </ul>
                </div>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Xóa đơn hàng" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order/'.$orderList->order_id)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-times text-danger text"></i>
                        </a>
                      </li>
                  </ul>
                </div>
              </form>
              </td>
            </tr>
            @endforeach
            <tr>
              <td colspan="5"><a href="{{route('deleteAllOrder')}}"class="btn btn-danger">Xoá tất cả</a></td>
            </tr>
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
             {!!$order->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
