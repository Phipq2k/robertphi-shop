@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách người dùng
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
        $message = Session::get('message');
        if($message){
            echo '<span class="text-alert">'.$message.'</span>';
            Session::put('message',null);
        }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              STT
            </th>
          
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Mật khẩu</th>
            <th>Quản trị viên</th>
            <th>Biên tập viên</th>
            <th>Người dùng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($admin as $key => $user)
          @php
            $i++;
          @endphp
            <form action="{{url('/assign-roles')}}" method="POST">
              @csrf
              <tr>
                <input type="hidden" name="admin_email" value="{{ $user->admin_email }}">
                <input type="hidden" name="admin_id" value="{{ $user->admin_id }}">
                <td>{{$i}}</td>
                <td>{{ $user->admin_name }}</td>
                <td>{{ $user->admin_email }}</td>
                <td>{{ $user->admin_phone }}</td>
                <td>{{ $user->admin_password }}</td>
                <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                <td><input type="checkbox" name="user_role"  {{$user->hasRole('user') ? 'checked' : ''}}></td>

              <td>
                  
                @if (Auth::id() != $user->admin_id)   
                  <input type="submit" title="Cấp quyền cho người dùng" value="Cấp quyền" class="btn btn-sm btn-primary">
                  <a style="margin:5px 0" onclick="return confirm('Bạn có chắc là muốn xóa quyền của người dùng này không?')" href="{{URL::to('/delete-user-roles/'.$user->admin_id)}}" title="Xóa người dùng" class="btn btn-sm btn-danger">
                    Xóa
                  </a>
                  <a href="{{URL::to('/impersionate/'.$user->admin_id)}}" title="{{$user->admin_id}}" class="btn btn-sm btn-info">
                    Truy cập
                  </a>
                @endif
                
              </td> 

              </tr>
            </form>
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
            {!!$admin->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection