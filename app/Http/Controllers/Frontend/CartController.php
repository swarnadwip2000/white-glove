<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\DeliverAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    //
    public function cart()
    { 
       
        if (Auth::check()) {
            $userCart = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $session_id = Session::get('session_id');
            $userCart = Cart::where('session_id', $session_id)->get();
        }

        return view('frontend.cart')->with(compact('userCart'));
    }

    public function addToCart(Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            // Check stock is available or not
            $productCount = Product::where('id', $data['product_id'])->count();
            if ($productCount > 0) {
                $productStock = Product::where('id', $data['product_id'])->first();
                if ($productStock['quantity'] < $data['quantity']) {
                    return response()->json(['status' => 'failed', 'message' => 'Stock is not available']);
                }
            }

            // generate session id if not exists
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            if (Auth::check()) {
                $user = Auth::user()->id;
            } else {
                $user = Null;
            }
            
           
            // check product is already exists in cart
            // if (Auth::check()) {
            //     $user = Auth::user()->id;
            //     $product_seller = Product::where('id', $data['product_id'])->pluck('seller_id');
            //     $cart_seller = Cart::where('user_id', Auth::user()->id)->first();
            //     if ($cart_seller) {
            //         if ($cart_seller->product->seller_id != $product_seller[0]) {
            //             Cart::where('user_id', Auth::user()->id)->delete();
            //         }
            //     }
                
            // } else {
            //     $productCountCart = Cart::where('session_id', $session_id)->where('product_id', $data['product_id'])->count();
            //     $user = Null;
            //     $product_seller = Product::where('id', $data['product_id'])->pluck('seller_id');
            //     $cart_seller = Cart::where('session_id', $session_id)->first();
            //     if ($cart_seller) {
            //         if ($cart_seller->product->seller_id != $product_seller[0]) {
            //             Cart::where('session_id', $session_id)->delete();
            //         }
            //     }
            // }

            // if ($productCountCart > 0) {
            //     return response()->json(['status' => 'failed', 'message' => 'Product is already exists in cart']);
            // }

            // save product in cart
            $cart = new Cart();
            $cart->session_id = $session_id;
            $cart->user_id = $user;
            $cart->product_id = $data['product_id'];
            $cart->quantity = $data['quantity'];
            $cart->save();
            return response()->json(['status' => 'success', 'message' => 'Product has been added in cart']);
        }
        return view('frontend.cart');
    }

    public function checkout($id = null)
    {  
        
        if ($id == null) {
            $count = Cart::where('user_id', Auth::user()->id)->count();
            if ($count == 0) {
                return redirect()->back()->with('error', 'Your cart is empty');
            }
            $userCarts = Cart::where('user_id', Auth::user()->id)->get();
            // out of stock
            foreach ($userCarts as $cart) {
                $product = Product::where('id', $cart->product_id)->first();
                
                if ($product->quantity < $cart->quantity ) {
                    return redirect()->back()->with('error', 'Product ' . $product->name . ' is out of stock');
                }
            }
            $count = DeliverAddress::where('user_id', Auth::user()->id)->count();
            $get_product_id = Cart::where('user_id', Auth::user()->id)->pluck('product_id');
            if ($count > 0) {
                $address = DeliverAddress::where('user_id', Auth::user()->id)->first();
            } else {
                $address = null;
            }
            $from = 'cart';
            return view('frontend.shipping')->with(compact('userCarts', 'from', 'address'));
        } else {
            // buy now checkout
            $product = Product::where('id', $id)->first();
            // seller token balance is zero
            if ($product->quantity < 1 ) {
                return redirect()->back()->with('error', 'Product ' . $product->name . ' is out of stock');
            }

            $count = DeliverAddress::where('user_id', Auth::user()->id)->count();
            if ($count > 0) {
                $address = DeliverAddress::where('user_id', Auth::user()->id)->first();
            } else {
                $address = null;
            }
            $from = 'buy_now';
            return view('frontend.shipping')->with(compact('product', 'from', 'address'));
        }
    }

    public function decreaseQuantity(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->all();
            $cart = Cart::where('id', $data['id'])->first();
            if ($cart->quantity == 1) {
                if (Auth::check()) {
                    $userCart = Cart::where('user_id', Auth::user()->id)->get();
                } else {
                    $session_id = Session::get('session_id');
                    $userCart = Cart::where('session_id', $session_id)->get();
                }
                return  response()->json(['view' => (string)View::make('frontend.cart-items')->with(compact('userCart'))]);
            } else {
                $cart->quantity = $cart->quantity - 1;
                $cart->save();
                if (Auth::check()) {
                    $userCart = Cart::where('user_id', Auth::user()->id)->get();
                } else {
                    $session_id = Session::get('session_id');
                    $userCart = Cart::where('session_id', $session_id)->get();
                }
                return response()->json(['view' => (string)View::make('frontend.cart-items')->with(compact('userCart'))]);
            }
        }
    }

     public function increaseQuantity(Request $request)
    {
       
        if ($request->ajax()) {

            $data = $request->all();
            $cart = Cart::where('id', $data['id'])->first();
            $productStock = Product::where('id', $cart->product_id)->first();
            if ($cart->quantity == $productStock->quantity) {
                return  response()->json(['view' => (string)View::make('frontend.cart-items')->with(compact('userCart'))]);
            } else {
                $cart->quantity = $cart->quantity + 1;
                $cart->save();
                if (Auth::check()) {
                    $userCart = Cart::where('user_id', Auth::user()->id)->get();
                } else {
                    $session_id = Session::get('session_id');
                    $userCart = Cart::where('session_id', $session_id)->get();
                }
                return response()->json(['view' => (string)View::make('frontend.cart-items')->with(compact('userCart'))]);
            }
        }
    }

    public function removeProductFromCart(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['id'])->delete();
            if (Auth::check()) {
                $userCart = Cart::where('user_id', Auth::user()->id)->get();
            } else {
                $session_id = Session::get('session_id');
                $userCart = Cart::where('session_id', $session_id)->get();
            }
            return response()->json(['view' => (string)View::make('frontend.cart-items')->with(compact('userCart'))]);
        }
    }

}
