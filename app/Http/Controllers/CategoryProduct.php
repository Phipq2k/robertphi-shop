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
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;

session_start();

class CategoryProduct extends Controller
{
    #region Adminpage
    public function authLogin(){
        $adminId = Auth::id();
        if($adminId){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }

    public function createSlug($string)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $string);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }

    //Chuyển đến trang thêm danh mục sản phẩm
    public function addCategoryProduct(){
        $this->authLogin();
        $allCategory = CategoryModel::where('category_status','1')->orderBy('id')->get();
        return view('admin.categories.addCategoryProduct')->with(compact('allCategory'));
    }

    //Chuyển đến trang danh sách danh mục sản phẩm
    public function allCategoryProduct(){
        $this->authLogin();
        $categoryPro = CategoryModel::where('category_status','1')->orderBy('id')->get();
        $allCategoryProduct = CategoryModel::paginate(5);
        $managerCategoryProduct = view('admin.categories.allCategoryProduct')->with('allCategoryProduct',$allCategoryProduct)->with('categoryPro',$categoryPro);
        return view('admin_layout')->with('admin.categories.allCategoryProduct', $managerCategoryProduct);

    }

    //Lưu danh mục sản phẩm
    public function saveCategoryProduct(Request $request){
        $this->authLogin();
        $data = $request->all();
        $categoryParent = CategoryModel::find($data['CateParent']);
        $category = new CategoryModel();
        $category->category_slug = $this->createSlug($data['CategoryProductName']);
        $category->category_name = $data['CategoryProductName'];
        $category->category_parent_id = $data['CateParent'];
        if($data['CateParent'] != 0){
            $category->category_parent_status = 1;
            $categoryParent->category_parent_status = 1;
            $categoryParent->save();
        }
        $category->category_keyword = $data['MetaKeywordCate'];
        $category->category_decs = $data['CategoryProductDescription'];
        $category->category_status = $data['CategoryProductStatus'];
        $category->save();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // dd($data);

        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }

    //Ẩn danh mục sản phẩm
    public function unactiveCategoryProduct($categoryProductId){
        $this->authLogin();
        CategoryModel::where('id',$categoryProductId)->update(['category_status' =>0]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //Hiển thị danh mục sản phẩm
    public function activeCategoryProduct($categoryProductId){
        $this->authLogin();
        CategoryModel::where('id',$categoryProductId)->update(['category_status' =>1]);
        Session::put('message','Hiển thị danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
        
    }

    //Chuyển đến trang chỉnh sửa danh mục sản phẩm
    public function editCategoryProduct($categoryProductId){
        $this->authLogin();
        $categoryPro = CategoryModel::orderBy('id')->get();
        $editCategoryProduct =CategoryModel::where('id',$categoryProductId)->get();
        $managerCategoryProduct = view('admin.categories.editCategoryProduct')->with('editCategoryProduct',$editCategoryProduct)->with('categoryParent',$categoryPro);
        return view('admin_layout')->with('admin.categories.editCategoryProduct', $managerCategoryProduct);
        
    }

    //Cập nhật danh mục sản phẩm
    public function updateCategoryProduct(Request $request, $categoryProductId){
        $this->authLogin();
        $data = $request->all();
        $categoryById = CategoryModel::find($categoryProductId);
        $categoryParent = CategoryModel::find($data['CateParent']);
        $categoryById->category_slug = $this->createSlug($data['CategoryProductName']);
        $categoryById->category_name = $data['CategoryProductName'];
        $categoryById->category_keyword = $data['MetaKeyword'];
        $categoryById->category_parent_id = $data['CateParent'];
        $categoryById->category_decs = $data['CategoryProductDescription'];
        if($data['CateParent'] != 0){
            $categoryById->category_parent_status = 1;
            $categoryParent->category_parent_status = 1;
            $categoryParent->save();
        }
        $categoryById->save();
        return Redirect::to('all-category-product')->with('message','Cập nhật danh mục sản phẩm thành công');
        
    }

    //Xoá danh mục sản phẩm
    public function deleteCategoryProduct($categoryProductId){
        $this->authLogin();
        $category = CategoryModel::find($categoryProductId);
        $categoryParent = CategoryModel::find($category->category_parent_id);
        $categorySub = CategoryModel::where('category_parent_id',$category->id)->first();
        if($categoryParent){
            $categoryParent->category_parent_status = 0;
            $categoryParent->save();
        }
        if($categorySub){
            $categorySub->delete();
        }
        $category->delete();
        
        return Redirect::to('all-category-product')->with('message','Xóa danh mục sản phẩm thành công');
        
    }
    #endregion

    #region ClientPage
    public function showCategoryHome($categorySlug, Request $request){

        $category = CategoryModel::where('category_status','1')->orderBy('id')->get();
        $brand = BrandModel::where('brand_status','1')->orderBy('brand_id')->get();
        $minPrice = ProductModel::min('product_price');
        $maxPrice = ProductModel::max('product_price');
        $maxPriceRange = $maxPrice + 200000;

        $categoryById = CategoryModel::where('category_slug',$categorySlug)->first();
        

        $categoryName = CategoryModel::where('category_slug',$categorySlug)->limit(1)->get();

        foreach($categoryName as $key => $categoryValue) {
            //Seo
            $metaDesc = $categoryValue->category_decs;  
            $metaKeywords = $categoryValue->category_keyword;
            $metaTitle = $categoryValue->category_name;
            $metaAuthor = 'Robert Phi';
            $urlCanonical = $request->url();
            $imageOrg = '';
            //endSeo
        }
        if(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $minPrice = $_GET['start_price'];
            $maxPrice = $_GET['end_price'];
            $productsByCategory = ProductModel::with('category')
            ->where('category_id',$categoryById->id)
            ->whereBetween('product_price',[$minPrice,$maxPrice])
            ->where('product_status',1)->paginate(6)->appends(request()->query());
        }
        /** Sắp xếp sản phẩm theo các tiêu chí*/
        elseif(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            switch ($sort_by) {
                case 'tang_dan':
                     $productsByCategory = ProductModel::with('category')
                    ->where('category_id',$categoryById->id)
                    ->where('product_status', 1)
                    ->orderBy('product_price','asc')
                    ->paginate(2)->appends(request()->query());
                    break;
                case 'giam_dan':
                     $productsByCategory = ProductModel::with('category')
                    ->where('category_id',$categoryById->id)
                    ->where('product_status', 1)
                    ->orderBy('product_price','desc')
                    ->paginate(2)->appends(request()->query());
                    break;
                case 'a_z':
                     $productsByCategory = ProductModel::with('category')
                    ->where('category_id',$categoryById->id)
                    ->orderBy('product_name','asc')
                    ->where('product_status', 1)
                    ->paginate(2)->appends(request()->query());
                    break;
                case 'z_a':
                     $productsByCategory = ProductModel::with('category')
                    ->where('category_id',$categoryById->id)
                    ->orderBy('product_name','desc')
                    ->where('product_status', 1)
                    ->paginate(2)->appends(request()->query());
                    break;
                
                default:
                    return false;
                    break;
            }
        }
        else{
            $productsByCategory = ProductModel::with('category')
            ->where('category_id',$categoryById->id)
            ->where('product_status', 1)
            ->orderBy('product_id','desc')
            ->paginate(6);
        }

        return view('pages.category.showCategory')->with(compact('category','brand','productsByCategory','categoryName','metaDesc','metaKeywords','metaTitle','metaAuthor','urlCanonical','imageOrg','minPrice','maxPrice','maxPriceRange'));
    }
    #endregion
    // public function importCSV(){

    // }

    // public function exportCSV(){
        
    // }


}
