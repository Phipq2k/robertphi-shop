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
        Danh sách danh mục sản phẩm
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
              <th style="width:20px;">STT</th>
              <th>Tên danh mục</th>
              <th>Thuộc danh mục</th>
              <th>Hiển thị</th>
              <th style="width:30px;">Chức năng</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($allCategoryProduct as $key => $catePro)
            @php
              $i++;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{$catePro->category_name}}</td>
              <td>
                @if ($catePro->category_parent_id == 0)
                  <span style="color:green">-----</span> 
                @else
                  @foreach ($categoryPro as $key => $cateSubPro)
                    @if ($cateSubPro->id == $catePro->category_parent_id)
                      <span style="color:red">{{$cateSubPro->category_name}}</span> 
                    @endif  
                  @endforeach
                @endif
              </td>
              <td>
                <span class="text-ellipsis">
                  <?php
                    if ($catePro->category_status == 0){
                      ?>
                       <a href="{{URL::to('/active-category-product/'.$catePro->id)}}"><span class="text-danger fa-thumb-styling fa fa-thumbs-down"></span></a>
                  <?php
                    }else{
                      ?>
                      <a href="{{URL::to('/unactive-category-product/'.$catePro->id)}}"><span class="text-success fa-thumb-styling fa fa-thumbs-up"></span></a>
                        
                    <?php }?>
              </td>
              <td>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Chỉnh sửa danh mục sản phẩm" href="{{URL::to('/edit-category-product/'.$catePro->id)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-pencil-square-o text-success-active"></i>
                        </a>
                      </li>
                  </ul>
                </div>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Xóa danh mục sản phẩm" onclick="return confirm('Bạn có chắc là muốn xóa danh mục sản phẩm này không?')" href="{{URL::to('/delete-category-product/'.$catePro->id)}}" class="active styling-edit" ui-toggle-class="">
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
        {{-- import data --}}

        {{-- <form action="{{url('/admin/import-csv')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" accept=".xlsx"><br>
          <input type="submit" value="Chèn file Excel" name="import_csv" class="btn btn-warning">
        </form>
        <hr/> --}}

        {{-- export data --}}
        {{-- <form action="{{url('/admin/export-csv')}}" method="POST">
          @csrf
          <input type="submit" value="Xuất file Excel" name="export_csv" class="btn btn-success">
        </form> --}}

      </div>
      <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              {!!$allCategoryProduct->links()!!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
