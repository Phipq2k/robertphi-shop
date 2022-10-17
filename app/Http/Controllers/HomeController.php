<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BannerModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;

class HomeController extends Controller
{
    public function index(Request $request){
        $category =CategoryModel::where('category_status',1)->orderBy('id')->get();
        $brand = BrandModel::where('brand_status',1)->orderBy('brand_id')->get();
        $slider = BannerModel::where('slider_status','1')->orderBy('slider_id','desc')->take(4)->get();

        //Category Post
        $categoryPost = CatePostModel::where('cate_post_status','1')->orderBy('cate_post_id','DESC')->get();
        $contact = ContactModel::first();
        #endregion SEO
        $metaDesc = "Chuyên cung cấp các mặt hàng thời trang chất lượng cao được nhập từ các thương hiệu nổi tiếng";
        $metaKeywords = "thuc pham chuc nang,thực phẩm chức năng, do choi kich thich, đồ chơi kích thích";
        $metaTitle = "Robert Phi Store";
        $metaAuthor = "Robert Phi";
        $urlCanonical = $request->url();
        $imageOrg = '<img src="'.url('storage/app/public/uploads/logo/'.$contact->contact_image).'" alt="logo" />';
        #endregion
        $minPrice = ProductModel::min('product_price');
        $maxPrice = ProductModel::max('product_price');
        $maxPriceRange = $maxPrice + 200000;
        if(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $minPrice = $_GET['start_price'];
            $maxPrice = $_GET['end_price'];
            $all = ProductModel::where('product_status','1')
            ->whereBetween('product_price',[$minPrice,$maxPrice])
            ->orderBy('product_id')->paginate(6)->appends(request()->query());
        }
        elseif(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            switch ($sort_by) {
                case 'tang_dan':
                    $all = ProductModel::where('product_status','1')
                    ->whereBetween('product_price',[$minPrice,$maxPrice])
                    ->orderBy('product_price')->paginate(6)->appends(request()->query());
                    break;
                case 'giam_dan':
                    $all = ProductModel::where('product_status','1')
                    ->whereBetween('product_price',[$minPrice,$maxPrice])
                    ->orderBy('product_price','desc')->paginate(6)->appends(request()->query());
                    break;
                case 'a_z':
                    $all = ProductModel::where('product_status','1')
                    ->whereBetween('product_price',[$minPrice,$maxPrice])
                    ->orderBy('product_name')->paginate(6)->appends(request()->query());
                    break;
                case 'z_a':
                    $all = ProductModel::where('product_status','1')
                    ->whereBetween('product_price',[$minPrice,$maxPrice])
                    ->orderBy('product_id','desc')->paginate(6)->appends(request()->query());
                    break;
                
                default:
                    return false;
                    break;
            }
        }
        else{
            $all = ProductModel::where('product_status','1')->orderBy('product_id','desc')->paginate(6);
        }
        // return view('pages.home')->with('category',$categoryProduct)->with('brand',$brandProduct)->with('all',$allProduct); //Cách 1
        return view('pages.home')->with(compact('category','brand','all','metaDesc','metaKeywords','metaTitle','urlCanonical','metaAuthor','slider','imageOrg','categoryPost','contact','minPrice','maxPrice','maxPriceRange'));

        // return view('error.404');

        // echo '<pre>';
        // print_r($all[2]);
        // echo '</pre>';
    }

    public function searchProduct(Request $request){
        $keyword = $request->keywordSubmit;
        $contact = ContactModel::first();
        $metaDesc = "Chuyên cung cấp các mặt hàng thời trang chất lượng cao được nhập từ các thương hiệu nổi tiếng";
        $metaKeywords = "thuc pham chuc nang,thực phẩm chức năng, do choi kich thich, đồ chơi kích thích";
        $metaTitle = "Search";
        $metaAuthor = "Robert Phi";
        $urlCanonical = $request->url();
        $imageOrg = '<img src="'.url('storage/app/public/uploads/logo/'.$contact->contact_image).'" alt="logo" />';

        $category =CategoryModel::where('category_status','1')->orderBy('id')->get();
        $brand = BrandModel::where('brand_status','1')->orderBy('brand_id')->get();
        $slider = BannerModel::where('slider_status','1')->orderBy('slider_id','desc')->take(4)->get();

        $searchProduct = ProductModel::where('product_status','1')->where('product_name','like','%'.$keyword.'%')->get();
        $categoryPost = CatePostModel::where('cate_post_status','1')->orderBy('cate_post_id','DESC')->get();
        
        // return view('pages.product.searchProduct')->with('category',$categoryProduct)->with('brand',$brandProduct)->with('searchProduct',$searchProduct);

        return view('pages.product.searchProduct')->with(compact('category','brand','searchProduct','metaDesc','metaKeywords','metaTitle','urlCanonical','metaAuthor','slider','imageOrg','categoryPost','contact'));
    }

    // public function contactUs(Request $request){
    //    
    // }

    public function errorException(){
        return view('error.404');
    }

    public function renderProductsTab(Request $request){
        $categoryId = $request->cate_id;
       $productByCate = ProductModel::where('category_id',$categoryId)->get();
       $count = $productByCate->count();
       $output = '';
       if($count > 0){
           foreach($productByCate as $key => $proTab){
                $output .= '
                <div class="tab-content">
                    <div >   
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <form>
                                        '.csrf_field().'
                                            <input type="hidden" value="'.$proTab->product_id.'" class="cart_product_id_'.$proTab->product_id.'">
                                            <input type="hidden" value="'.$proTab->product_name.'" class="cart_product_name_'.$proTab->product_id.'">
                                            <input type="hidden" value="'.$proTab->product_image.'" class="cart_product_image_'.$proTab->product_id.'">
                                            <input type="hidden" value="'.$proTab->product_price.'" class="cart_product_price_'.$proTab->product_id.'">
                                            <input type="hidden" value="'.$proTab->product_quantity.'" class="product_quantity_'.$proTab->product_id.'">
                                            <input type="hidden" value="1" class="cart_product_qty_'.$proTab->product_id.'">
                                            <a href="'.url('chi-tiet-san-pham/'.$proTab->product_slug).'">
                                                <img src="'.url('storage/app/public/uploads/products/'.$proTab->product_image).'" alt="Ảnh sản phẩm"/>
                                                <h2>'.number_format($proTab->product_price).' '.'VND'.'</h2>
                                                <p>'.$proTab->product_name.'</p>
                                                <input name="quantity" type="hidden" min="1" value="1" />
                                                <input name="productIdHiden" type="hidden" value="'.$proTab->product_id.'" />
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
           }

       }
       else{
           $output .= '
           <div class="tab-content">
                <div>  
                    <div class="col-sm-12">
                        <center><span class="text text-info">Danh mục này đang trống</span></center>
                    </div>
                </div>
            </div>
           ';
       }

       echo $output;
    }

    public function voucher(){
        $contact = ContactModel::first();
        $metaTitle = 'Khuyến mãi';
        $imageOrg = '<img src="'.url('storage/app/public/uploads/logo/'.$contact->contact_image).'" alt="logo" />';
        return view('pages.email.voucher')->with(compact('metaTitle'));
    }

}
