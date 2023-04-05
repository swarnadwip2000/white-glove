<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Wish;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->pluck('product_id');
        // dd($wishlists);
        $products = Product::whereIn('id', $wishlists)->get();
        return view('frontend.wishlist')->with(compact('products'));
    }

    public function updateWishlist(Request $request)
    {
         if ($request->ajax()) {
            $data = $request->all();
            $countWislist = Wish::wishListCount($data['id'], Auth::user()->id);
            if ($countWislist == 0) {
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $data['id'];
                $wishlist->save();
                $count = Wishlist::where('user_id', Auth::user()->id)->count();
                return response()->json(['status'=>true, 'action'=>'added','count'=>$count ]);
            } else {
                $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $data['id'])->first();
                $wishlist->delete();
                $count = Wishlist::where('user_id', Auth::user()->id)->count();
                return response()->json(['status'=>true, 'action'=>'removed','count'=>$count]);
            }
         }
    }

    public function deleteWishlist($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
        $wishlist->delete();
        $count = Wishlist::where('user_id', Auth::user()->id)->count();
        return response()->json(['status'=>true, 'action'=>'removed','count'=>$count]);
    }
}
