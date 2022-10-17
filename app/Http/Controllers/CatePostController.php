<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\BannerModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryModel;
use App\Models\BrandModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use FontLib\Table\Type\post;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

session_start();

class CatePostController extends Controller
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

    }
    public function addCategoryPost(){
        $this->authLogin();
        return view('admin.post.addCategoryPost');
    }

    public function allCategoryPost(){
        $this->authLogin();
        $catePost = CatePostModel::orderBy('cate_post_id','DESC')->paginate(5);
        return view('admin.post.allCategoryPost')->with(compact('catePost'));

    }

    public function saveCategoryPost(Request $request){
        $this->authLogin();
        $data = $request->all();
        $catePost = new CatePostModel();
        $catePost->cate_post_name = $data['CatePostName'];
        $catePost->cate_post_meta_keywords = $data['CatePostMetaKeywords'];
        $catePost->cate_post_slug = $data['CatePostSlug'];
        $catePost->cate_post_desc = $data['CatePostDesc'];
        $catePost->cate_post_status = $data['CatePostStatus'];
        $catePost->save();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // dd($data);

        Session::put('message','Thêm danh mục bài viết thành công');
        return Redirect::back();
    }

    public function showPostFrontend(Request $request,$catePostSlug){
        $category =CategoryModel::where('category_status','1')->orderBy('id')->get();
        $slider = BannerModel::where('slider_status','1')->orderBy('slider_id','desc')->take(4)->get();
        $minPrice = ProductModel::min('product_price');
        $maxPrice = ProductModel::max('product_price');
        $maxPriceRange = $maxPrice + 200000;

        //Category Post
        $categoryPost = CatePostModel::where('cate_post_status','1')->orderBy('cate_post_id','DESC')->get();
        $catePostName = CatePostModel::where('cate_post_slug',$catePostSlug)->take(1)->get();
        $contact = ContactModel::first();

        foreach($catePostName as $key => $catePostValue) {
            //Seo
            $metaDesc = $catePostValue->cate_post_desc;  
            $metaKeywords = $catePostValue->cate_post_meta_keywords;
            $metaTitle = $catePostValue->cate_post_name;
            $metaAuthor = 'Robert Phi';
            $catePostId = $catePostValue->cate_post_id;
            $urlCanonical = $request->url();
            $imageOrg = '';
            //endSeo
        }
        $posts = PostModel::with('catePost')->where('post_status',1)
        ->where('cate_post_id',$catePostId)
        ->paginate(6);
        // $catePostById = PostModel::join('tbl_category_post','tbl_posts.cate_post_id','=','tbl_category_post.cate_post_id')
        // ->where('tbl_posts.cate_post_id',$catePostId)
        // ->where('tbl_posts.post_status','1')->get();

        return view('pages.post.showPost')->with(compact('category','metaDesc','metaKeywords','metaTitle','urlCanonical','metaAuthor','slider','imageOrg','categoryPost','catePostName','posts','contact','minPrice','maxPrice','maxPriceRange'));
        // dd($catePostId);
    }

    

    public function editCatePost($catePostId){
        $this->authLogin();
        $catePost = CatePostModel::find($catePostId);
        return view('admin.post.editCategoryPost')->with(compact('catePost'));
        
        // dd($catePost->cate_post_id);
    }

    public function updateCategoryPost(Request $request, $catePostId){
        $this->authLogin();
        $data = $request->all();
        // $data['cate_post_name'] = $request->CatePostName;
        // $data['cate_post_slug'] = $request->CatePostSlug;
        // $data['cate_post_desc'] = $request->CatePostDesc;

        $newCatePost = CatePostModel::find($catePostId);
        $newCatePost->cate_post_name = $data['CatePostName'];
        $newCatePost->cate_post_meta_keywords = $data['CatePostMetaKeywords'];
        $newCatePost->cate_post_slug = $data['CatePostSlug'];
        $newCatePost->cate_post_desc = $data['CatePostDesc'];
        $newCatePost->cate_post_status = $data['CatePostStatus'];
        $newCatePost->save();

        // CatePostModel::where('cate_post_id',$catePostId)->update($data);
        Session::put('message','Cập nhật danh mục bài viết thành công');
        return Redirect::to('/list-category-post');

        
    }

    public function deleteCatePost($catePostId){
        $this->authLogin();
        CatePostModel::find($catePostId)->delete();
        Session::put('message','Xóa danh mục bài viết thành công');
        return Redirect::to('list-category-product');
        
    }
    
}
