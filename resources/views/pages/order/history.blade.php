@extends('layout')
@section('header')
@include('components.header')
@endsection
@section('content')
<style type="text/css">
    ul.top-menu>li>a{
      background: black;
    }
  </style>
  <div class="table-agile-info">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h2 style=" color: #FE980F;">Danh sách lịch sử đơn hàng</h2>
        </div>
        <div class="table-responsive">
          <?php
                  $messages = Session::get('message');
                  if($messages){
                      echo '<span class="text-alert">'.$messages.'</span>';
                      Session::put('message', null);	
                  }	
              ?>
          <table class="table table-striped table-bordered table-hover b-t b-light">
            <thead>
              <tr>
                <th>Số thứ tự</th>
                <th>Mã đơn hàng</th>
                <th>Thời gian đặt hàng</th>
                {{-- <th>Mã đơn hàng</th> --}}
                {{-- <th>Mã đơn hàng</th> --}}
                <th>Chức năng</th>
              </tr>
            </thead>
            <tbody>
              @php
                $i = 1;
              @endphp
              @foreach ($orders_history as $key => $orderList)
              <tr>
                <td>
                  @php
                    echo $i++;
                  @endphp
                </td>
                <td>{{$orderList->order_history_code}}</td>
                <td>{{$orderList->created_at}}</td>
                <td>
                  <a title="Xóa đơn hàng" onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order-history/'.$orderList->order_history_id)}}" class="btn btn-default" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a>
                </form>
                </td>
              </tr>
              @endforeach
              <tr>
                @if ($orders_history->count() > 0)
                <td colspan="4"> <a href="{{URL::to('/delete-all-order-history')}}" title="Xóa tất cả đơn hàng" onclick="return confirm('Xóa tất cả đơn hàng?')" class="btn btn-danger">Xóa tất cả</a></td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>
        <footer class="panel-footer">
          <div class="row">
            <div class="col-sm-7 text-right text-center-xs">                
              <ul class="pagination pagination-sm m-t-none m-b-none">
               {{-- {!!$order->links() !!} --}}
              </ul><div class="col-sm-5 text-center">
            </div>
          </div>
        </footer>
    </div>
</div>
@section('footer')
@include('components.footer')
@endsection
@endsection