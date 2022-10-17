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
        Danh sách bình luận
      </div>
      <div class="row w3-res-tb">
        <form>
            @csrf
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle show-comment-status">
                  <option selected value="0">Bình luận chưa duyệt</option>
                  <option value="1">Bình luận đã duyệt</option>
                </select>             
              </div>
        </form>
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
        <span class="text text-alert notify-comments-manager"></span>
        <input type="hidden" class="comment-pro-manager-id" value="{{$productId}}">
        <table class="table table-striped b-t b-light" id="show_comments_status">
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
