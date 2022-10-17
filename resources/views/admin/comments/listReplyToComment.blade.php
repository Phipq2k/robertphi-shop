@extends('admin_layout')
@section('admin_content')
<style type="text/css">
    .ui-dialog.success-dialog {
        font-family: Verdana,Arial,sans-serif;
        font-size: .8em;
        background: #8b5c7e;
    }
    .dialog-cmt{
        display: none;
    }
    .dialog-cmt p{
      color: #fff;
    }
</style>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách bình luận phản hồi {{$commentById->comment_name}}
      </div>
      <div class="row w3-res-tb">
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
        <span class="text text-alert notify-comments-manager"></span>
        <input type="hidden" class="comment-pro-manager-id" value="{{$commentById->product_id}}">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                <th>Số thứ tự</th>
                <th>Tên người bình luận</th>
                <th>Nội dung bình luận</th>
                <th>Chức năng</th>
                <th style="width:30px;"></th>
                </tr>
            </thead>
              <tbody>
                @foreach ($commentsReply as $key => $comment)
                @php
                    $i++;
                @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$comment->comment_name}}</td>
                        <td>
                          <span class="text-ellipsis">
                          {{$comment->comment_content}}</td>
                        <td>
                            <button data-id_cmt="{{$comment->comment_id}}" class="btn btn-default edit-comment-by-id">
                                <i class="fa fa-pencil-square-o text-primary "></i>
                            </button>
                            <form class="form form-horizontal dialog-cmt">
                              @csrf
                              <div id="dialog_reply_comment_{{$comment->comment_id}}" class="row dialog-cmt">
                                <p><b>Trả lời: </b><span>{{$comment->comment_name}}</span></p>
                                <textarea class="form-control reply_content_{{$comment->comment_id}}" rows="5"></textarea>
                                <button data-id_comment="{{$comment->comment_id}}" type="button" class="btn btn-primary pull-right send-reply-comment-{{$comment->comment_id}}">Gửi</button>
                              </div>
                            </form>
                            <form>
                              @csrf
                              <span title="Xóa bình luận" class="btn btn-default delete-cmt" data-comment_parent_id="{{$comment->comment_parent_id}}" data-id_cmt="{{$comment->comment_id}}">
                                <i class="fa fa-times text-danger text"></i>
                              </span>
                            </form>
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
              {{-- {!!$commentsById->links() !!} --}}
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
@endsection
