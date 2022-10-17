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
        Danh sách sản phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>                
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
            $i = 0;
	        	$messages = Session::get('message');
	        	if($messages){
	        		echo '<span class="text-alert">'.$messages.'</span>';
	        		Session::put('message', null);	
	        	}	
	        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                STT
              </th>
              <th>Tên sản phẩm</th>
              <th>Hình sản phẩm</th>
              <th>Thư viện ảnh</th>
              <th>Số lượng</th>
              <th>Giá</th>
              <th>Danh mục</th>
              <th>Thương hiệu</th>
              <th>Hiển thị</th>
              <th style="width:30px">Chức năng</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allProduct as $key => $pro)
            @php
              $i++;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{$pro->product_name}}</td>
              <td><img src="storage/app/public/uploads/products/{{$pro->product_image}}" height="100px" width="100px"alt="image"/></td>
              <td><a class="btn btn-primary" href="{{url('/gallery/'.$pro->product_id)}}">Thư viện ảnh</a></td>
              <td>{{$pro->product_quantity}}</td>
              <td>{{$pro->product_price}}</td>
              <td>{{$pro->category_name}}</td>
              <td>{{$pro->brand_name}}</td>
              <td>
                <span class="text-ellipsis">
                  <?php
                    if ($pro->product_status == 0){
                      ?>
                       <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span class="text-danger fa-thumb-styling fa fa-thumbs-down"></span></a>
                  <?php
                    }else{
                      ?>
                      <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span class="text-success fa-thumb-styling fa fa-thumbs-up"></span></a>
                        
                    <?php }?>
              </td>
              <td>
                @php
                $commentsCountbyProId = 0;
                  foreach($comments as $key => $cmts){
                    if($cmts->product_id == $pro->product_id){
                      $commentsCountbyProId++;
                    }
                  }
                @endphp
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Có {{$commentsCountbyProId}} bình luận chưa duyệt" href="{{URL::to('/manager-comments/'.$pro->product_id)}}" class="active styling-edit " ui-toggle-class="">
                          <i class="fa fa-comments-o"></i>
                          <span class="badge bg-info">{{$commentsCountbyProId}}</span>
                        </a>
                      </li>
                  </ul>
                </div>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Chỉnh sửa sản phẩm" href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-pencil-square-o text text-primary"></i>
                        </a>
                      </li>
                  </ul>
                </div>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Xóa sản phẩm" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-times text-danger text"></i>
                        </a>
                      </li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
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
              {!!$allProduct->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
