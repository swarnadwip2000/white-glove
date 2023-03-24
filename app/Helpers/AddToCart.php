<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddToCart
{


    public static function CheckCartItem($product_id)
    {
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            $carts = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->get();
            return $carts->count();
        } else {
            if (Session::has('session_id')) {
                $carts = Cart::where('session_id', Session::get('session_id'))->where('product_id', $product_id)->get();
                return $carts->count();
            } else {
                return 0;
            }
        }
    }

    public static function CheckStock($product_id)
    {
        $product = Product::find($product_id);
        if ($product->quantity == 0 ) {
            return 0;
        } else {
            return 1;
        }
    }
    public static function CountCart()
    {
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return $carts->count();
        } else {
            if (Session::has('session_id')) {
                $carts = Cart::where('session_id', Session::get('session_id'))->get();
                return $carts->count();
            } else {
                return 0;
            }
        }
    }
}
