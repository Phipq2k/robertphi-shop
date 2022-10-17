<?php

namespace App\Providers;

use App\Models\BannerModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\PostModel;
use App\Models\ProductModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        /**Hàm lưu biến cục bộ trả về view */
        view()->composer('*', function ($view) {
            #region Admin
            //Thống kê admin
            $products_count = ProductModel::all()->count();
            $orders_count = OrderModel::all()->count();
            $posts_count = PostModel::all()->count();
            $customers_count = CustomerModel::all()->count();
            #endregion

            #region Homepage
            // Layout
            $customer = CustomerModel::find(Session::get('customerId'));
            $category = CategoryModel::where('category_status','1')->orderBy('id')->get();
            $slider = BannerModel::where('slider_status','1')->orderBy('slider_id','desc')->take(4)->get();
            $categoryPost = CatePostModel::orderBy('cate_post_id','DESC')->get();
           
            $minPrice = ProductModel::min('product_price');
            $maxPrice = ProductModel::max('product_price');
            $maxPriceRange = $maxPrice + 200000;

            //SEO
            $metaDesc = "Chuyên cung cấp các mặt hàng thời trang chất lượng cao được nhập từ các thương hiệu nổi tiếng";
            $metaKeywords = "thuc pham chuc nang,thực phẩm chức năng";
            $metaAuthor = "Robert Phi";
            $urlCanonical = request()->url();
            $contact = ContactModel::first();
            $imageOrg = url('storage/app/public/uploads/logo/'.$contact->contact_image);
            #endregion
            
            $view->with(compact('products_count', 'orders_count', 'posts_count','customers_count','customer','category','slider','categoryPost','minPrice', 'maxPrice', 'maxPriceRange','contact','metaDesc','metaKeywords','urlCanonical','metaAuthor','imageOrg'));
        });
    }
}
