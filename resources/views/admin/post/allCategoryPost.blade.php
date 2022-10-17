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
        Danh sách danh mục bài viết
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
              <th>Tên danh mục</th>
              <th>Slug</th>
              <th>Từ khóa tìm kiếm</th>
              <th>Mô tả</th>
              <th>Hiển thị</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($catePost as $key => $listCatePost)
            @php
              $i++;
            @endphp
            <tr>
              <td>{{$i}}</td>
              <td>{{$listCatePost->cate_post_name}}</td>
              <td>{{$listCatePost->cate_post_slug}}</td>
              <td>{{$listCatePost->cate_post_meta_keywords}}</td>
              <td>{{$listCatePost->cate_post_desc}}</td>
              <td>
                <span class="text-ellipsis">
                  <?php
                    if ($listCatePost->cate_post_status == 0){
                      ?>
                       <span class=" text-danger fa-thumb-styling fa fa-thumbs-down"></span>
                  <?php
                    }else{
                      ?>
                      <span class="text-success fa-thumb-styling fa fa-thumbs-up"></span>
                        
                    <?php }?>
              </td>
              <td>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Chỉnh sửa danh mục bài viết" href="{{URL::to('/edit-cate-post/'.$listCatePost->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                          <i class="fa fa-pencil-square-o text text-primary"></i>
                        </a>
                      </li>
                  </ul>
                </div>
                <div class="nav notify-row" style="width: 85%"id="top_menu">
                  <ul class="nav top-menu">
                      <li class="dropdown">
                        <a title="Xóa danh mục bài viết" onclick="return confirm('Bạn có chắc là muốn xóa danh mục bài viết này không?')" href="{{URL::to('/delete-cate-post/'.$listCatePost->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
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
             {!!$catePost->links() !!}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
