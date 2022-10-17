<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function authLogin(){
        $adminId = Auth::id();
        if($adminId){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }

    public function showComment(Request $request){
        $productId = $request->commentProId;
        $comments = CommentModel::where('product_id', $productId)
        ->where('comment_status',1)
        ->where('comment_parent_id',-1)->get();
        $commentsReply = CommentModel::whereNotIn('comment_parent_id',[-1])->get();
        $output = '';
        foreach ($comments as $key =>$comment){
            $output .= '
            <div class="row show-comments" >
               <div class="col col-md-2">
                   <div id="avatar_comment" style="background-color:'.$comment->avatar_color.'">
                    '.$comment->comment_image.'
                   </div>
               </div>
               <div class="col col-md-10">
                   <h4>'.$comment->comment_name.'</h4>
                   <span>'.$comment->comment_date.'</span>
                   <p>'.$comment->comment_content.'</p>
               </div>
           </div>
           <p></p>
            ';
            //comments reply
            foreach($commentsReply as $cmtReply) {
                if($cmtReply->comment_parent_id == $comment->comment_id){
                    $output .= '
                    <span><h4>Trả lời:</h4></span>
                    <div class="row show-comments comments-reply-product" >
                        <div class="col col-md-2">
                            <img width="60%" class="img-responsive img-thumbnail" src="'.url('storage/app/public/uploads/admins/3.png').'" ></img>
                        </div>
                        <div class="col col-md-10">
                            <h4>Admin</h4>
                            <span>'.$cmtReply->comment_date.'</span>
                            <p>'.$cmtReply->comment_content.'</p>
                        </div>
                    </div>
                    <hr style="border: 2px double #ccc"/>
                    ';
                }
            }
            
        }
        return $output;
    }

    public function addComment(Request $request){
        $this->authLogin();
        $data = $request->all();
        $comment = new CommentModel();
        $comment->comment_name = $data['comment_name'];
        $comment->product_id = $data['productId'];
        $comment->comment_image = $data['comment_image'];
        $comment->comment_content = $data['comment_content'];
        $comment->comment_status = $data['comment_status'];
        $comment->avatar_color = $data['random_color'];

        $comment->save();
    }

    public function managerComments($productId){
        return view('admin.comments.managerComments')->with(compact('productId'));
    }

    public function showCommentsStatus(Request $request){
        $this->authLogin();
        $comment_status = $request->comments_select_status;
        $commentProId = $request->pro_id;
        $admin_name = Auth::user()->admin_name;
        $commentByStatus = CommentModel::where('comment_status',$comment_status)
        ->where('product_id',$commentProId)
        ->where('comment_parent_id',-1)->get();
        $output = '
        <thead>
            <tr>
            <th>Số thứ tự</th>
            <th>Tên người bình luận</th>
            <th>Nội dung bình luận</th>
            <th>Chức năng</th>
            <th style="width:30px;"></th>
            </tr>
        </thead>
        <tbody>';
        foreach ($commentByStatus as $key => $comment){
            $commentsReply = CommentModel::where('comment_parent_id',$comment->comment_id)->count();
            $index = $key + 1;
            $output .=
            '
            <form>'.csrf_field().'
                <tr>
                    <td>'.$index.'</td>
                    <td>'.$comment->comment_name.'</td>
                    <td>'.$comment->comment_content.'</td>
                    <td>
                        <span class="text-ellipsis"></span>
                        <input type="hidden" class="comment-id" value="'.$comment->comment_id.'"/>
                        <input type="hidden" class="comment-status" value="'.$comment->comment_status.'"/>';
                if ($comment->comment_status == 0){
                    $output .= '
                    <span data-id_cmt="'.$comment->comment_id.'" title="Duyệt bình luận" class="text text-center btn btn-primary approveCmt">Duyệt</span>
                    <span title="Xóa bình luận" class="btn btn-danger delete-cmt" data-comment_parent_id="'.$comment->comment_parent_id.'" data-id_cmt="'.$comment->comment_id.'">Xóa</span>';
                    
                }else{
                    $output .= '
                    <button title="Phản hồi đến '.$comment->comment_name.'" type="button" data-id_comment="'.$comment->comment_id.'" class="btn btn-default reply-comment">
                    <i class="fa fa-commenting-o text-primary text"></i>
                    </button>
                    <div id="dialog_reply_comment_'.$comment->comment_id.'" class="row dialog-cmt">
                        <p><b>Trả lời: </b><span>'.$comment->comment_name.'</span></p>
                        <textarea class="form-control reply_content_'.$comment->comment_id.'" rows="5"></textarea>
                        <button data-id_comment="'.$comment->comment_id.'" data-name="'.$comment->comment_name.'" data-user_reply="'.$admin_name.'" type="button" class="btn btn-primary pull-right send-reply-comment-'.$comment->comment_id.'">Gửi</button>
                    </div>
                    <a href="'.url('/list-reply-comment/'.$comment->comment_id).'" title="Có '.$commentsReply.' bình luận phản hồi" class="btn btn-default">
                        <i class="text text-info fa fa-info-circle" aria-hidden="true"></i>
                    </a>
                    <span data-id_cmt="'.$comment->comment_id.'" title="Ẩn bình luận" class="btn btn-default approveCmt">
                        <i class="text text-warning fa fa-eye-slash" aria-hidden="true"></i>
                    </span>
                    <span title="Xóa bình luận" class="btn btn-default delete-cmt" data-comment_parent_id="'.$comment->comment_parent_id.'" data-id_cmt="'.$comment->comment_id.'">
                        <i class="fa fa-trash text-danger text"></i>
                    </span>';
                };        
                $output .='
                    </td>
                </tr>
            </form>';
        }
        $output .= '
        </tbody>';
        return $output;
    }

    public function approveComment(Request $request){
        $this->authLogin();
        $commentId = $request->commentId;
        $commentsById = CommentModel::find($commentId);
        if($commentsById->comment_status == 0){
            $commentsById->comment_status = 1;
        }
        else{
            $commentsById->comment_status = 0;

        }
        $commentsById->save();
    }

    public function editComment(Request $request){
        $this->authLogin();
        $comment_id = $request->cmtId;
        $commentById = CommentModel::find($comment_id);
        $commentById->comment_content = $request->comment_content;
        $commentById->save();
    }

    public function deleteComment(Request $request){
        $this->authLogin();
        $comment_id = $request->commentId;
        $commentById = CommentModel::find($comment_id);
        $commentsReply = CommentModel::where('comment_parent_id', $comment_id)->get();
        foreach ($commentsReply as $key => $comment){
            $comment->delete();
        }
        $commentById->delete();
    }

    public function replyToComment(Request $request){
        $this->authLogin();
        $data = $request->all();
        $comment = new CommentModel();
        $comment->comment_name = $data['comment_name'];
        $comment->product_id = $data['pro_id'];
        $comment->comment_image = $data['comment_image'];
        $comment->comment_content = $data['comment_content'];
        $comment->comment_status = 1;
        $comment->comment_parent_id = $data['cmtId'];
        $comment->avatar_color = 'black';
        $comment->save();
    }

    public function listReplyToComment($commentId){
        $this->authLogin();
        $commentsReply = CommentModel::where('comment_parent_id',$commentId)->get();
        $commentById = CommentModel::find($commentId); 
        return view('admin.comments.listReplyToComment')->with(compact('commentsReply','commentById'));
    }
}
