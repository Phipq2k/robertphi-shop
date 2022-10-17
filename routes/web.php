<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CatePostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AccessPermission;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\ZaloPayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Trang chủ
Route::get('/',[HomeController::class, 'index']);
Route::get('/home',[HomeController::class, 'index']);
Route::post('/search-product',[HomeController::class, 'searchProduct']);

//Error pages
Route::get('/404',[HomeController::class, 'errorException']);
Route::get('/home',[HomeController::class, 'index']);
Route::post('/products-tab',[HomeController::class, 'renderProductsTab']);

//Đăng ký nhận khuyến main
Route::get('/dang-ky-khuyen-mai',[HomeController::class, 'voucher']);

//Danh mục sản phẩm frontend
Route::get('/danh-muc-san-pham/{categorySlug}',[CategoryProduct::class,'showCategoryHome']);

//Thương hiệu sản phẩm frontend
Route::get('/thuong-hieu-san-pham/{brandSlug}',[BrandProduct::class,'showBrandHome']);



//Chi tiết sản phẩm frontend
Route::get('/chi-tiet-san-pham/{productSlug}',[ProductController::class,'showDetailProduct']);

//Danh mục bài viết frontend
Route::get('/blog/{catePostSlug}',[CatePostController::class, 'showPostFrontend']);

//Noi dung blog
Route::get('/noi-dung-blog/{postSlug}',[PostController::class, 'showDetailPost']);



//Authentication Roles
Route::get('/register-authentication',[AuthenticationController::class,'registerAuthPage']);
// Route::post('/user-register-auth',[AuthenticationController::class,'registerAuth']);
Route::get('/admin',[AuthenticationController::class,'loginAuthPage']);
Route::post('/user-login-auth',[AuthenticationController::class,'loginAuth']);
Route::get('/user-logout-auth',[AuthenticationController::class,'logoutAuth']);






//Users
Route::get('/all-users',[UserController::class,'index'])->middleware('auth.roles');
Route::get('/add-user',[UserController::class,'addUserPage'])->middleware('auth.roles');
Route::post('/save-user',[UserController::class,'addUser'])->middleware('auth.roles');
Route::post('/assign-roles',[UserController::class,'assignRoles']);
Route::get('/delete-user-roles/{userId}',[UserController::class,'deleteUserRoles']);
Route::get('/impersionate/{userId}',[UserController::class,'impersionate']);
Route::get('/impersionate-destroy',[UserController::class,'impersionateDestroy']);


//Banner
Route::get('/add-banner',[BannerController::class,'addBanner']);
Route::post('/save-banner',[BannerController::class,'saveBanner']);
Route::get('/manager-banner',[BannerController::class,'managerBanner']);
Route::get('/active-slide/{sliderId}',[BannerController::class,'activeSlider']);
Route::get('/unactive-slide/{sliderId}',[BannerController::class,'unactiveSlider']);
Route::get('/delete-slide/{sliderId}',[BannerController::class,'deleteSlider']);



//Giỏ hàng
Route::post('/add-to-cart',[CartController::class,'addToCart']);
Route::post('/update-cart-quantity',[CartController::class,'updateCartQuantity']);
Route::post('/update-cart',[CartController::class,'updateCart']);
Route::get('/show-cart',[CartController::class,'showCart']);
Route::get('/show-cart-product',[CartController::class,'showCartProduct']);
Route::get('/remove-product-to-cart/{rowId}',[CartController::class,'removeProductToCart']);
Route::post('/add-cart-ajax',[CartController::class,'addCartAjax']);
Route::get('/delete-cart-product/{session_id}',[CartController::class,'deleteCartProduct']);
Route::get('/delete-all-cart-product',[CartController::class,'deleteAllCartProduct']);
Route::get('/show-cart-index',[CartController::class,'showCartIndex']);

//Coupon
Route::post('/check-coupon',[CouponController::class,'checkCoupon']);
Route::get('/insert-coupon',[CouponController::class,'insertCoupon']);
Route::get('/list-coupon',[CouponController::class,'listCoupon']);
Route::get('/unset-coupon',[CouponController::class,'unsetCoupon']);
Route::post('/insert-coupon-code',[CouponController::class,'insertCouponCode']);
Route::get('/delete-coupon/{couponId}',[CouponController::class,'deleteCoupon']);


//Thanh toán
Route::get('/login-checkout',[CheckoutController::class,'loginCheckout'])->middleware('checkcustomerId');
Route::post('/login-customer',[CheckoutController::class,'loginCustomer']);
Route::post('/register-customer',[CheckoutController::class,'registerCustomer']);

Route::middleware(['customerId'])->group(function (){
    Route::get('/checkout',[CheckoutController::class,'checkout'])->name('checkout');
    Route::post('/save-checkout-customer',[CheckoutController::class,'saveCheckout']);
    Route::get('/logout-checkout',[CheckoutController::class,'logoutCheckout']);
    Route::post('/select-delivery-client',[CheckoutController::class,'selectDeliveryClient']);
    Route::post('/caculate-feeship',[CheckoutController::class,'caculateFeeship']);
    Route::get('/delete-feeship',[CheckoutController::class, 'deleteFeeShip']);
    Route::post('/confirm-order',[CheckoutController::class, 'confirmOrder']);
});

//Paypal
Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

//VNPay
Route::middleware(['customerId'])->group(function(){
    Route::get('checkout-vnpay', [VNPayController::class, 'checkoutVNPay'])->name('ptVNPay');
    Route::post('payment-vnpay', [VNPayController::class, 'createPaymentVNPay'])->name('createPmVNPay');
    Route::get('vnpay-return', [VNPayController::class, 'returnPaymentVNPay'])->name('vnPayReturn');
});

//Order
Route::get('/manager-order',[OrderController::class, 'managerOrder']);
// Route::get('/manager-order',[CheckoutController::class,'managerOrder']);
Route::get('/view-order/{orderCode}',[OrderController::class,'viewOrder']);
Route::get('/delete-order/{orderId}',[OrderController::class,'deleteOrder']);
Route::get('/delete-all-order',[OrderController::class,'deleteAllOrder'])->name('deleteAllOrder');
Route::get('/print-order/{checkoutCode}',[OrderController::class, 'printOrder']);
Route::post('/update-order-quantity-product',[OrderController::class, 'updateOrderQtyPro']);
Route::post('/update-order-qty',[OrderController::class, 'updateOrderQty']);

Route::middleware(['customerId'])->group(function (){
    Route::get('/order-history',[OrderController::class, 'orderHistory'])->name('orderHistory');
    Route::get('/delete-order-history/{order_history_id}',[OrderController::class,'deleteHistoryOrder'])->name('deleteHistoryOrder');
    Route::get('/delete-all-order-history',[OrderController::class,'deleteAllHistoryOrder'])->name('deleteAllHistoryOrder');
});



//Admin Manager
// Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[AdminController::class, 'showDashboard']);
Route::get('/logout',[AdminController::class,'logout']);
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);
Route::post('/filter-by-date',[AdminController::class,'filterByDate']);
Route::post('/dashboard-filter',[AdminController::class,'dashboardFilter']);
Route::post('/days-order',[AdminController::class,'daysOrder']);
Route::post('/reload-admin-chart',[AdminController::class,'dataForAdmin']);



//Category products
Route::get('/add-category-product',[CategoryProduct::class, 'addCategoryProduct']);
Route::get('/all-category-product',[CategoryProduct::class,'allCategoryProduct']);
Route::get('/edit-category-product/{categoryProductId}',[CategoryProduct::class, 'editCategoryProduct'])->middleware('auth.roles');
Route::get('/delete-category-product/{categoryProductId}',[CategoryProduct::class, 'deleteCategoryProduct'])->middleware('auth.roles');

Route::post('/save-category-product',[CategoryProduct::class, 'saveCategoryProduct']);
Route::post('/update-category-product/{categoryProductId}',[CategoryProduct::class, 'updateCategoryProduct']);

Route::get('/unactive-category-product/{categoryProductId}',[CategoryProduct::class, 'unActiveCategoryProduct']);
Route::get('/active-category-product/{categoryProductId}',[CategoryProduct::class, 'activeCategoryProduct']);

// Route::post('/admin/import-csv',[CategoryProduct::class,'importCSV']);
// Route::post('/admin/export-csv',[CategoryProduct::class,'exportCSV']);


//Brand products
Route::get('/add-brand-product',[BrandProduct::class, 'addBrandProduct']);
Route::get('/all-brand-product',[BrandProduct::class, 'allBrandProduct']);
Route::get('/edit-brand-product/{brandProductId}',[BrandProduct::class, 'editBrandProduct']);
Route::get('/delete-brand-product/{BrandProductId}',[BrandProduct::class, 'deleteBrandProduct']);

Route::post('/save-brand-product',[BrandProduct::class, 'saveBrandProduct']);
Route::post('/update-brand-product/{brandProductId}',[BrandProduct::class, 'updateBrandProduct']);

Route::get('/unactive-brand-product/{brandProductId}',[BrandProduct::class, 'unActiveBrandProduct']);
Route::get('/active-brand-product/{brandProductId}',[BrandProduct::class, 'activeBrandProduct']);


//Products
Route::middleware(['auth.roles'])->group(function () {
    Route::get('/add-product',[ProductController::class, 'addProduct']);
    Route::get('/edit-product/{productId}',[ProductController::class, 'editProduct']);
    Route::get('/delete-product/{productId}',[ProductController::class, 'deleteProduct']);

    Route::post('/save-product',[ProductController::class, 'saveProduct']);
    Route::post('/update-product/{productId}',[ProductController::class, 'updateProduct']);

    Route::get('/unactive-product/{productId}',[ProductController::class, 'unactiveProduct']);
    Route::get('/active-product/{productId}',[ProductController::class, 'activeProduct']);
});

Route::get('/all-product',[ProductController::class, 'allProduct']);





//Email
Route::post('/send-coupon',[EmailController::class, 'sendCoupon']);
Route::get('/send-email',[EmailController::class, 'sendEmail']);
Route::get('/send-email-order',[EmailController::class, 'emailOrderPage']);
Route::get('/forgot-password',[EmailController::class, 'forgotPassword']);
Route::post('/reset-password',[EmailController::class, 'resetPassword']);
Route::post('/update-new-pass',[EmailController::class, 'newPassword']);
Route::post('/recover-password',[EmailController::class, 'recoverPassword']);
Route::middleware(['codeauth'])->group(function(){
    Route::get('/code-authentication',[EmailController::class, 'codeAuthPage']);
    Route::get('/new-password',[EmailController::class, 'newPasswordPage']);
});


//Login facebook
Route::get('/login-facebook',[AdminController::class, 'loginFacebook']);
Route::get('/admin/callback',[AdminController::class, 'callbackFacebook']);

//Vận chuyển
Route::get('/delivery',[DeliveryController::class, 'deliveryManage']);
Route::post('/select-delivery',[DeliveryController::class, 'selectDelivery']);
Route::post('/insert-data-delivery',[DeliveryController::class, 'addDelivery']);
Route::post('/select-feeship',[DeliveryController::class, 'selectFeeShip']);
Route::post('/update-feeship',[DeliveryController::class, 'updateFeeShip']);

//Danh mục bài viết
Route::get('/add-category-post',[CatePostController::class, 'addCategoryPost']);
Route::get('/list-category-post',[CatePostController::class, 'allCategoryPost']);
Route::get('/delete-cate-post/{catePostId}',[CatePostController::class, 'deleteCatePost']);
Route::get('/edit-cate-post/{catePostId}',[CatePostController::class, 'editCatePost']);
Route::post('/save-cate-post',[CatePostController::class, 'saveCategoryPost']);
Route::post('/update-cate-post/{catePostId}',[CatePostController::class, 'updateCategoryPost']);

//Bài viết
Route::get('/add-post',[PostController::class, 'addPost']);
Route::get('/list-post',[PostController::class, 'allPost']);
Route::get('/edit-post/{postId}',[PostController::class, 'editPost']);
Route::get('/delete-post/{postId}',[PostController::class, 'deletePost']);
Route::post('/save-post',[PostController::class, 'savePost']);
Route::post('/update-post/{postId}',[PostController::class, 'updatePost']);

//Gallery
Route::get('/gallery/{productId}',[GalleryController::class, 'gallery']);
Route::post('/select-gallery',[GalleryController::class, 'selectGallery']);
Route::post('/insert-gallery/{productId}',[GalleryController::class, 'insertGallery']);
Route::post('/update-gallery-name',[GalleryController::class, 'updateGalleryName']);
Route::post('/update-gallery-img',[GalleryController::class, 'updateGalleryImage']);
Route::get('/del-gallery',[GalleryController::class, 'deleteGallery']);


//Xem nhanh
Route::post('/quick-view',[ProductController::class, 'quickViewData']);

//Bình luận
Route::post('/load-comment',[CommentController::class, 'showComment']);
Route::post('/add-comment',[CommentController::class, 'addComment']);
Route::post('/show-comments-status',[CommentController::class, 'showCommentsStatus']);
Route::post('/approve',[CommentController::class, 'approveComment']);
Route::post('/reply-comment',[CommentController::class, 'replyToComment']);
Route::post('/edit-cmt',[CommentController::class, 'editComment']);
Route::post('/del-cmt',[CommentController::class, 'deleteComment']);
Route::get('/manager-comments/{productId}',[CommentController::class, 'managerComments']);
Route::get('/list-reply-comment/{commentId}',[CommentController::class, 'listReplyToComment']);

//Đánh giá xếp hạng sao
Route::post('/add-star-rating',[ProductController::class, 'addStarRating']);

//Liên hệ
Route::get('/contact',[ContactController::class, 'contact']);
Route::get('/contact-information',[ContactController::class, 'contactInformationPage']);
Route::post('/insert-contact-data',[ContactController::class, 'insertContact']);
Route::post('/update-contact-data',[ContactController::class, 'updateContact']);
Route::get('/delete-contact/{contactId}',[ContactController::class, 'deleteContact']);

//Ckeditor
Route::post('/uploads-ckeditor',[ProductController::class, 'uploadImgCkeditor']);
Route::get('/file-browser',[ProductController::class, 'fileBrowser']);
Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
