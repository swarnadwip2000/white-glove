<?php

namespace App\Helpers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Wish
{

    
    // Get Wishlist Count
    public static function wishListCount($product_id, $user_id)
    {
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            $wishlists = Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->get();
            return $wishlists->count();
        }
    }

    // Get Wishlist Count
    public static function wishListCountAll()
    {
        if (Auth::check() && Auth::user()->hasRole('CUSTOMER')) {
            $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
            return $wishlists->count();
        }
    }
}
