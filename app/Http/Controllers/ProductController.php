<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\BannerModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\CommentModel;
use App\Models\ContactModel;
use App\Models\GalleryModel;
use App\Models\ProductModel;
use App\Models\RatingModel;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

session_start();

class ProductController extends Controller
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

    public function addProduct(){
        $this->authLogin();
        $categoryProduct = CategoryModel::orderBy('id','desc')->get();
        $brandProduct = BrandModel::orderBy('brand_id','desc')->get();
        return view('admin.products.addProduct')->with('categoryProduct', $categoryProduct)->with('brandProduct', $brandProduct);
    }

    public function allProduct(){
        $this->authLogin();
        $allProduct = ProductModel::with('category')->with('brand')
        ->orderby('product_id','desc')->paginate(5);
        $comments = CommentModel::where('comment_status',0)->get();
        $managerProduct = view('admin.products.allProduct')->with('allProduct',$allProduct)->with('comments',$comments);
        return view('admin_layout')->with('admin.products.allProduct', $managerProduct);

    }

    public function saveProduct(Request $request){
        $this->authLogin();
        $data = $request->all();
        $product = new ProductModel();
        $product->product_name = $data['ProductName'];
        $product->product_quantity = $data['ProductQuantity'];
        $product->product_sold = 0;
        $product->product_price = $data['ProductPrice'];
        $product->product_decs = $data['ProductDescription'];
        $product->product_keyword = $data['ProductKeyword'];
        $product->product_content = $data['ProductContent'];
        $product->category_id = $data['CatePro'];
        $product->brand_id = $data['BrandPro'];
        $product->product_slug = $this->createSlug($data['ProductName']);
        $product->product_status = $data['ProductStatus'];
        $getImage = $request->file('ProductImage');

        // echo base_path('public/uploads/products');

        if($getImage){
            $getNameImage = $getImage->getClientOriginalName();
            $newNameImage = current(explode('.', $getNameImage ));
            $destinationPath = 'public/uploads/products';
            $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            // Storage::move($newImage, base_path('public/uploads/products'));
            $getImage->storeAs($destinationPath,$newImage);
            $product->product_image = $newImage;
            $product->save();
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $product->product_image = '';
        $product->save();
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
        
        // dd($data);
    }
    
    public function activeProduct($productId){
        $this->authLogin();
        ProductModel::find($productId)->update(['product_status' =>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function unactiveProduct($productId){
        $this->authLogin();
        ProductModel::find($productId)->update(['product_status' =>0]);
        Session::put('message','Không Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
        
    }

    public function editProduct($productId){
        $this->authLogin();
        $categoryProduct = CategoryModel::orderBy('id','desc')->get();
        $brandProduct = BrandModel::orderBy('brand_id','desc')->get();

        $editProduct = ProductModel::where('product_id',$productId)->get();

        $managerProduct = view('admin.products.editProduct')->with('editProduct',$editProduct)->with('cateProduct',$categoryProduct)->with('brandProduct',$brandProduct);

        return view('admin_layout')->with('admin.products.editProduct', $managerProduct);
        // dd($editProduct);
        
    }

    public function updateProduct(Request $request, $productId){
        $this->authLogin();
        // $data = array();
        // $data['product_name'] = $request->ProductName;
        // $data['product_quantity'] = $request->ProductQuantity;
        // $data['product_price'] = $request->ProductPrice;
        // $data['product_decs'] = $request->ProductDescription;
        // $data['product_keyword'] = $request->ProductKeyword;
        // $data['product_content'] = $request->ProductContent;
        // $data['category_id'] = $request->CatePro;
        // $data['brand_id'] = $request->BrandPro;
        // $data['product_status'] = $request->ProductStatus;

        $data = $request->all();
        $product = ProductModel::find($productId);
        $product->product_name = $data['ProductName'];
        $product->product_quantity = $data['ProductQuantity'];
        $product->product_price = $data['ProductPrice'];
        $product->product_decs = $data['ProductDescription'];
        $product->product_keyword = $data['ProductKeyword'];
        $product->product_content = $data['ProductContent'];
        $product->category_id = $data['CatePro'];
        $product->brand_id = $data['BrandPro'];
        $product->product_slug = $this->createSlug($data['ProductName']);
        $product->product_status = $data['ProductStatus'];

        $getImage = $request->file('ProductImage');
        if($getImage){
            $imageOld = $product->product_image;
            Storage::delete('public/uploads/products/'.$imageOld);

            $getNameImage = $getImage->getClientOriginalName();
            $newNameImage = current(explode('.', $getNameImage ));
            $destinationPath = 'public/uploads/products';
            $newImage = $newNameImage.rand(0,99).'.'.$getImage->getClientOriginalExtension();
            // Storage::move($newImage, base_path('public/uploads/products'));
            $getImage->storeAs($destinationPath,$newImage);
            $product->product_image = $newImage;
            $product->save();
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }
        $product->save();
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
        // dd($getImage);

        
    }

    public function deleteProduct($productId){
        $this->authLogin();
        $product = ProductModel::find($productId);
        $imageStorage = $product->product_image;
        Storage::delete('public/uploads/sliders/'.$imageStorage);
        $product->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
        
    }

    //End function admin page

    public function showDetailProduct($productSlug, Request $request){
        $category = CategoryModel::where('category_status','1')->orderBy('id')->get();
        $brand = BrandModel::where('brand_status','1')->orderBy('brand_id')->get();
        $minPrice = ProductModel::min('product_price');
        $maxPrice = ProductModel::max('product_price');
        $maxPriceRange = $maxPrice + 200000;
        $productDetail = ProductModel::join('tbl_category_product','tbl_category_product.id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_slug',$productSlug)->get();
        $productById = ProductModel::where('product_slug',$productSlug)->first();
        $productId = $productById->product_id;
        foreach($productDetail as $key => $detail){
            $categoryId = $detail->category_id;
            $categoryName = $detail->category_name;
            $metaDesc = $detail->product_decs;
            $metaKeywords = $detail->product_keyword;
            $metaTitle = $detail->product_name;
            $metaAuthor = 'Robert Phi';
            $urlCanonical = $request->url();
            $imageOrg = '<img src="'.url('storage/app/public/uploads/products/'.$detail->product_image).'" alt="">';
        }
        $gallery = GalleryModel::where('product_id', $productId)->get();
        $relatedProduct = ProductModel::with('category')->with('brand')
        ->where('category_id',$categoryId)->whereNotIn('product_id',[$productId])->get();

        //Rating
        $rating = RatingModel::where('product_id',$productId)->avg('rating');
        $rating = round($rating);


        //Update view 
        $product_update_view = ProductModel::find($productId);
        $product_update_view->product_views += 1;
        $product_update_view->save(); 

        return view('pages.product.showDetail')->with(compact('category','brand','productDetail','relatedProduct','metaDesc','metaKeywords','metaTitle','metaAuthor','urlCanonical','imageOrg','gallery','categoryName','categoryId','rating','minPrice','maxPrice','maxPriceRange'));
    }

    //Xem nhanh sản phẩm
    public function quickViewData(Request $request){
        $pro_id = $request->productId;
        $productById = ProductModel::find($pro_id);
        $categoryById = CategoryModel::find($productById->category_id);
        $brandById = BrandModel::find($productById->brand_id);
        $gallery = GalleryModel::where('product_id',$pro_id)->get();
        $output = array();
        $output['product_gallery'] = '';
        foreach($gallery as $key => $gal){
            $output['product_gallery'] .= '<p><img src="storage/app/public/uploads/gallery/'.$gal->gallery_image.'" alt="Ảnh sản phẩm" /></p><br/>';
        }
        $output['product_name'] = $productById->product_name;
        $output['product_id'] = $productById->product_id;
        $output['product_desc'] = $productById->product_decs;
        $output['product_price'] = number_format($productById->product_price).' '.'VND';
        $output['product_content'] = $productById->product_content;
        $output['product_cate'] = $categoryById->category_name;
        $output['product_brand'] = $brandById->brand_name;
        $output['product_image'] = '<p><img src="'.url('storage/app/public/uploads/products/'.$productById->product_image).'" alt="Ảnh sản phẩm" /></p>';
        $output['quickview_info_hidden'] = '
        <input type="hidden" value="'.$productById->product_id.'" class="pro_id">
        <input type="hidden" value="'.$productById->product_id.'" class="cart_product_id_quickview_'.$productById->product_id.'">
        <input type="hidden" value="'.$productById->product_name.'" class="cart_product_name_quickview_'.$productById->product_id.'">
        <input type="hidden" value="'.$productById->product_image.'" class="cart_product_image_quickview_'.$productById->product_id.'">
        <input type="hidden" value="'.$productById->product_price.'" class="cart_product_price_quickview_'.$productById->product_id.'">
        <input type="hidden" value="'.$productById->product_quantity.'" class="product_quantity_quickview_'.$productById->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_quickview_'.$productById->product_id.'">'; 

        return json_encode($output);
    }

    public function addStarRating(Request $request){
        $data = $request->all();
        $rating = new RatingModel();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['rating'];
        $rating->save();
        return true;
    }

    //Upload ảnh trong CKEditor
    public function uploadImgCkeditor(Request $request){
        if($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();

            //Lấy tên file
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            //Lấy đuôi file
            $extension = $request->file('upload')->getClientOriginalExtension();
            //Gán tên file
            $fileName = $fileName.'_'.time().'.'.$extension;
            $destinationPath = 'public/uploads/contents';
            $request->file('upload')->storeAs($destinationPath,$fileName);

            //Trả link ảnh
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = url('storage/app/public/uploads/contents/'.$fileName);
            $msg = 'Tải ảnh thành công';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;

        }
    }

    //Trình duyệt máy chủ
    public function fileBrowser(Request $request){
        $paths = glob('storage/app/public/uploads/contents/*');
        $fileNames = array();
        foreach ($paths as $key => $path) {
            array_push($fileNames, basename($path));
        }
        $data = array(
            'fileNames' => $fileNames
        );
        return view('admin.images.listImageCkEditor')->with($data);
        // var_dump($data);
    }

}
