<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\BannerModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\CatePostModel;
use App\Models\ContactModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
    public function authLoginCheckout() {
        $customerId = Session::get('customerId');
        if($customerId){
            return Redirect::to('/home');
        }
        else{
            return Redirect::to('login-checkout')->send();
        } 
    }

    public function showCart(Request $request){
        $metaDesc = "Chuyên bán những đồ chơi kích thích dành cho giới trẻ, giúp người trẻ cảm nhận được cuộc sống thiên đường";
        $metaKeywords = "thuc pham chuc nang,thực phẩm chức năng, do choi kich thich, đồ chơi kích thích";
        
        $metaAuthor = "Robert Phi";
        $urlCanonical = $request->url();

        $category = DB::table('tbl_category_product')->where('category_status','0')->orderBy('id','desc')->get();
        $brand = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();

        // return view('pages.cart.showCart')->with('category',$categoryProduct)->with('brand',$brandProduct);

        return view('pages.cart.showCart')->with(compact('category','brand','metaDesc','metaKeywords','metaTitle','urlCanonical','metaAuthor'));
    }

    public function updateCartQuantity(Request $request){
        $rowId = $request->rowIDCart;
        $quantity = $request->cartQuantity;
        Cart::update($rowId,$quantity);
        return Redirect::to('/show-cart');
    }

    public function removeProductToCart($rowId){
        Cart::update($rowId,0);

        return Redirect::to('/show-cart');
    }


    //Ajax
    public function addCartAjax(Request $request){
        // $this->authLoginCheckout();
        $data = $request->all();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');

        if($cart == true){
            $is_available = 0;
            foreach($cart as $key => $value){
                if($value['product_id'] == $data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_qty_sold' => $data['product_qty']
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart [] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
                'product_qty_sold' => $data['product_qty']
            );
        }
        Session::put('cart',$cart);
        Session::save();
    }

    public function showCartProduct(Request $request){
        // $this->authLoginCheckout();
        $metaTitle = "Giỏ hàng";
        return view('pages.cart.showCartAjax')->with(compact('metaTitle'));
    }

    public function updateCart(Request $request){
        $data = $request->all();
        $coupon = Session::get('coupon');
        $cart = Session::get('cart');
        if($cart == true){
            $message = '';
            
            foreach($data['cart_qty'] as $key => $cartQty){
                $i = 0;
                foreach($cart as $session => $val){
                    $i++;
                    if($val['session_id'] == $key && $cartQty <= $cart[$session]['product_qty_sold']) {
                        $cart[$session]['product_qty'] = $cartQty;
                        $message .= '<p style="color:green">'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' thành công'.'</p>';
                    }
                    elseif($val['session_id'] == $key && $cartQty > $cart[$session]['product_qty_sold']){
                        $message .= '<p style="color:red">'.$i.') Cập nhật số lượng '.$cart[$session]['product_name'].' thất bại'.'</p>';
                    }
                }
            }
            Session::put('cart', $cart);
            if($coupon ){
                Session::forget('coupon');
            }
            return redirect()->back()->with(compact('message'));
        }
    }

    public function deleteCartProduct($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $value){
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                    // echo '<pre>';
                    // print_r($cart);
                    // echo '</pre>';
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }

    }

    public function deleteAllCartProduct(){
        $cart = Session::get('cart');
        if($cart == true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa tất cả sản phẩm thành công');
        }
    }

    //Hiển thị danh sách cart hover và chỉ mục
    public function showCartIndex(){
        $cartItems = '';
        $indexCart = array();
        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $value){
                array_push($indexCart,$value);
                $product = ProductModel::find($value['product_id']);
                $cartItems .=
                '
                <li>
                    <a href="'.url('/chi-tiet-san-pham/'.$product->product_slug).'">
                        <img title="'.$product->product_name.'" src="'.url('storage/app/public/uploads/products/'.$product->product_image).'" alt="Ảnh"/>
                        <h4>Giá: '.number_format($product->product_price,0,',','.').' VND'.'</h4>
                        <p>Số lượng: '.$value['product_qty'].'</p>
                    </a>
                    <a title="Xóa sản phẩm khỏi giỏ hàng" class="btn btn-default cart_quantity_delete" href="'.url('/delete-cart-product/'.$value['session_id']).'"><i class="fa fa-times"></i></a>
                </li>
                <p></p>
                ';
            }
        }
        // dd($indexCart);
        $arr3CartItems = [];
        $arrCartItems = explode('<p></p>', $cartItems);
        
        if(count($arrCartItems) > 0){
            for($i = 0; $i < 2; $i++){
                array_push($arr3CartItems, array_shift($arrCartItems));
            }
        }
        // dd($arr3CartItems);
        // dd($arr3CartItems);

        $data = array(
            'indexCart' => $indexCart,
            'cartItems' => implode('', $arr3CartItems).'<a class="btn btn-default btn-full-cart" href="'.url('/show-cart-product').'">Xem giỏ hàng '.(count($indexCart) > 2 ? '('.(count($indexCart) - 2).'+'.')' : null).'</a>'
        );
        // dd($data['cartItems']);
        return $data;
    }
}
