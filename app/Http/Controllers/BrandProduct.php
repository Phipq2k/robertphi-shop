<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\BannerModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;

session_start();

class BrandProduct extends Controller
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

    public function addBrandProduct(){
        $this->authLogin();
        return view('admin.brands.addBrandProduct');
    }

    public function allBrandProduct(){
        $this->authLogin();
        // $allBrandProduct = DB::table('tbl_brand_product')->get();
        $allBrandProduct = BrandModel::orderBy('brand_id','DESC')->paginate(5);
        $managerBrandProduct = view('admin.brands.allBrandProduct')->with('allBrandProduct',$allBrandProduct);
        return view('admin_layout')->with('admin.brands.allBrandProduct', $managerBrandProduct);

    }

    public function saveBrandProduct(Request $request){
        $this->authLogin();
        $data = $request->all();
        $brand = new BrandModel();
        $brand->brand_slug = $this->createSlug($data['BrandProductName']);
        $brand->brand_name = $data['BrandProductName'];
        $brand->brand_keyword = $data['MetaKeywordBrand'];
        $brand->brand_decs = $data['BrandProductDescription'];
        $brand->brand_status = $data['BrandProductStatus'];
        $brand->save();

        // $data = array();
        // $data['brand_name'] = $request->BrandProductName;
        // $data['brand_decs'] = $request->BrandProductDescription;
        // $data['brand_status'] = $request->BrandProductStatus;
        // DB::table('tbl_brand_product')->insert($data);


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        
        Session::put('message','Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }
    
    public function unactiveBrandProduct($brandProductId){
        $this->authLogin();
        BrandModel::where('brand_id',$brandProductId)->update(['brand_status' =>0]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    public function activeBrandProduct($brandProductId){
        $this->authLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brandProductId)->update(['brand_status' =>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
        
    }

    public function editBrandProduct($brandProductId){
        $this->authLogin();
        // $editBrandProduct = DB::table('tbl_brand_product')->where('brand_id',$brandProductId)->get();

        $editBrandProduct = BrandModel::find($brandProductId);

        $managerBrandProduct = view('admin.brands.editBrandProduct')->with('editBrandProduct',$editBrandProduct);
        return view('admin_layout')->with('admin.brands.editBrandProduct', $managerBrandProduct);
        
    }

    public function updateBrandProduct(Request $request, $brandProductId){
        $this->authLogin();
        // $data = array();
        // $data['brand_name'] = $request->BrandProductName;
        // $data['brand_decs'] = $request->BrandProductDescription;
        // DB::table('tbl_brand_product')->where('brand_id',$brandProductId)->update($data);

        $data = $request->all();
        $brand = BrandModel::find($brandProductId);
        $brand->brand_slug = $this->createSlug($data['BrandProductName']);
        $brand->brand_name = $data['BrandProductName'];
        $brand->brand_keyword = $data['MetaKeywordBrand'];
        $brand->brand_decs = $data['BrandProductDescription'];
        $brand->brand_status = $data['BrandProductStatus'];
        $brand->save();

        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

        
    }

    public function deleteBrandProduct($brandProductId){
        $this->authLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brandProductId)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
        
    }

    //End Function Admin Page

    public function showBrandHome(Request $request, $brandSlug){
        $category = CategoryModel::where('category_status','1')->orderBy('id')->get();
        $brand = BrandModel::where('brand_status','1')->orderBy('brand_id')->get();
        $minPrice = ProductModel::min('product_price');
        $maxPrice = ProductModel::max('product_price');
        $maxPriceRange = $maxPrice + 200000;

        $brandById = BrandModel::where('brand_slug',$brandSlug)->first();
        $productsByBrand = ProductModel::with('brand')
        ->where('brand_id',$brandById->brand_id)
        ->where('product_status',1)->paginate(6);
        if(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $minPrice = $_GET['start_price'];
            $maxPrice = $_GET['end_price'];
            $productsByBrand = ProductModel::with('brand')
            ->where('brand_id',$brandById->brand_id)
            ->whereBetween('product_price',[$minPrice,$maxPrice])
            ->where('product_status',1)->paginate(6)->appends(request()->query());
        }
        $brandName = BrandModel::where('brand_slug',$brandSlug)->limit(1)->get();

            foreach($brandName as $key => $brandValue) {
                //Seo
                $metaDesc = $brandValue->brand_decs;
                $metaKeywords = $brandValue->brand_keyword;
                $metaTitle = $brandValue->brand_name;
                $metaAuthor = 'Robert Phi';
                $urlCanonical = $request->url();
                $imageOrg = '';
                //endSeo
            
            }

            return view('pages.brand.showBrand')->with(compact('category','brand','productsByBrand','brandName','metaDesc','metaKeywords','metaTitle','metaAuthor','urlCanonical','imageOrg','minPrice','maxPrice','maxPriceRange'));

    }
}
