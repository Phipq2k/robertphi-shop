<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\BannerModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\PostModel;
use App\Models\ProductModel;

session_start();

class PostController extends Controller
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


    public function addPost(){
        $this->authLogin();
        $catePost = CatePostModel::orderBy('cate_post_id','desc')->get();
        return view('admin.post.addPost')->with(compact('catePost'));
    }

    public function allPost(){
        $this->authLogin();
        $allPost = PostModel::orderBy('post_id')
        ->with('catePost')
        ->paginate(5);
        return view('admin.post.allPost')->with(compact('allPost'));
        // dd($allPost->cate_post_name);

    }

    public function editPost($postId){
        $this->authLogin();
        $editPost = PostModel::where('post_id',$postId)->get();
        $catePost = CatePostModel::orderBy('cate_post_id')->get();
        return view('admin.post.editPost')->with(compact('editPost','catePost'));

        // foreach ($editPost as $key => $value){
        //     $value->post_name;
        // }
        // dd($editPost);
    }

    public function savePost(Request $request){
        $this->authLogin();
        $data = $request->all();
        $post = new PostModel();
        $post->post_title = $data['postTitle'];
        $post->post_slug = $data['postSlug'];
        $post->cate_post_id = $data['categoryPost'];
        $post->post_meta_keywords = $data['postMetaKeyword'];
        $post->post_desc = $data['postDesc'];
        $post->post_meta_desc = $data['postMetaDesc'];
        $post->post_content = $data['postContent'];
        $post->post_status = $data['postStatus'];
        $getImage = $request->file('postImage');

        // echo base_path('public/uploads/products');

        if($getImage){
            $getNameImage = $getImage->getClientOriginalName();
            $newNameImage = current(explode('.', $getNameImage ));
            $destinationPath = 'public/uploads/posts';
            $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            // Storage::move($newImage, base_path('public/uploads/products'));
            $getImage->storeAs($destinationPath,$newImage);
            $post->post_image = $newImage;
            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return Redirect::back(); 
        }
        else{
            return Redirect::back()->with('message','Vui lòng thêm hình ảnh cho bài viết');
        }

        
        // dd($data);
    }

    public function updatePost(Request $request, $postId){
        $data = $request->all();
        $post = PostModel::find($postId);
        $post->post_title = $data['postTitle'];
        $post->post_slug = $data['postSlug'];
        $post->post_desc = $data['postSummary'];
        $post->post_meta_desc = $data['postDesc'];
        $post->post_content = $data['postContent'];
        $post->post_meta_keywords = $data['postKeywords'];
        $post->post_status = $data['postStatus'];
        $post->cate_post_id = $data['catePost'];
        $getImage = $request->file('postImage');

        // $imageOld = $post->post_image;

        // echo base_path('public/uploads/products');

        

        if($getImage){
            //Xóa file ảnh trong Storage
            $imageOld = $post->post_image;
            Storage::delete('public/uploads/posts/'.$imageOld);

            $getNameImage = $getImage->getClientOriginalName();
            $newNameImage = current(explode('.', $getNameImage ));
            $destinationPath = 'public/uploads/posts';
            $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            // Storage::move($newImage, base_path('public/uploads/products'));
            $getImage->storeAs($destinationPath,$newImage);
            $post->post_image = $newImage;
            $post->save();
            Session::put('message','Cập nhật bài viết thành công');
            return Redirect::to('/list-post'); 
        }
        $post->save();
        Session::put('message','Cập nhật bài viết thành công');
        return Redirect::to('/list-post');
    }

    public function deletePost(Request $request, $postId){
        $this->authLogin();
        $post = PostModel::find($postId);
        $imageStorage = $post->post_image;
        Storage::delete('public/uploads/posts/'.$imageStorage);
        $post->delete();
        return Redirect::to('/list-post')->with('message','Xóa bài viết thành công');
    }

    /**
     * end Admin
     */


    public function showDetailPost(Request $request, $postSlug){
        $post = PostModel::with('catePost')->where('post_status',1)
        ->where('post_slug',$postSlug)
        ->where('post_status',1)
        ->take(1)->get();

        foreach($post as $key => $postValue) {
            $postId = $postValue->post_id;
            //Seo
            $metaDesc = $postValue->post_meta_desc;  
            $metaKeywords = $postValue->post_meta_keywords;
            $metaTitle = $postValue->post_title;
            $metaAuthor = 'Robert Phi';
            $catePostId = $postValue->cate_post_id;
            $urlCanonical = $request->url();
            $imageOrg = '<img style="float: left; width:100%" src="'.url('storage/app/public/uploads/posts/'.$postValue->post_image).'" alt="Ảnh bài viết">';
            //endSeo
        }

        $relatedPost = PostModel::with('catePost')->where('post_status',1)
        ->where('cate_post_id',$catePostId)
        ->whereNotIn('post_slug',[$postSlug])
        ->take(5)->get();

        //Update view
        $post_update_view = postModel::find($postId);
        $post_update_view->post_views += 1;
        $post_update_view->save(); 

        return view('pages.post.showDetailPost')->with(compact('metaDesc','metaKeywords','metaTitle','urlCanonical','metaAuthor','imageOrg','post','relatedPost'));
    }
}
