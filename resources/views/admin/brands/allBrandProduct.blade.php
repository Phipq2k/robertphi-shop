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
        Liệt kê thương hiệu sản phẩm
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
              <th>Tên thương hiệu</th>
              <th>Hiển thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allBrandProduct as $key => $brandPro)
            @php
              $i++;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{$brandPro->brand_name}}</td>
              <td>
                <span class="text-ellipsis">
                  <?php
                    if ($brandPro->brand_status == 0){
                      ?>
                       <a href="{{URL::to('/active-brand-product/'.$brandPro->brand_id)}}"><span class=" text-danger fa-thumb-styling fa fa-thumbs-down"></span></a>
                  <?php
                    }else{
                      ?>
                      <a href="{{URL::to('/unactive-brand-product/'.$brandPro->brand_id)}}"><span class="text-success fa-thumb-styling fa fa-thumbs-up"></span></a>
                        
                    <?php }?>
              </td>
              <td>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Chỉnh sửa thương hiệu sản phẩm" href="{{URL::to('/edit-brand-product/'.$brandPro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-pencil-square-o text-success-active"></i>
                        </a>
                      </li>
                  </ul>
                </div>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Xóa thương hiệu sản phẩm" onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu sản phẩm này không?')" href="{{URL::to('/delete-brand-product/'.$brandPro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
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
              {!!$allBrandProduct->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
