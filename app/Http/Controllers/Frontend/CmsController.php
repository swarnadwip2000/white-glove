<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function home()
    {
        $categories = Category::where('status', 1)->Orderby('id','desc')->get();
        $featured_products = Product::where('status', 1)->where('feature_product', 1)->Orderby('id','desc')->get();
        return view('frontend.home',compact('categories','featured_products'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function products($slug)
    {
        
        try {
            if ($slug == 'all-products') {
                $categories = Category::where('status', 1)->Orderby('id','desc')->get();
                $products = Product::where('status', 1)->Orderby('id','desc')->paginate(10);
                $single_category = "All Products";
                return view('frontend.products',compact('categories','products','single_category'));
            }else if($slug == 'featured'){
                $categories = Category::where('status', 1)->Orderby('id','desc')->get();
                $products = Product::where('status', 1)->where('feature_product', 1)->Orderby('id','desc')->paginate(20);
                $single_category = "All Products";
                return view('frontend.products',compact('categories','products','single_category'));
            }else{
                $categories = Category::where('status', 1)->Orderby('id','desc')->get();
                $single_category = Category::where('slug', $slug)->first();
                $products = Product::where('status', 1)->where('category_id', $single_category['id'])->Orderby('id','desc')->paginate(10);
            }
            return view('frontend.products',compact('categories','products','single_category'));
        }  catch (\Exception $e) {
            \Log::error( $e->getMessage() );
            abort(404);
        }
        
    }

    public function productDetail($slug,$id)
    {
       
        try {
            $product_id = decrypt($id);
            $categories = Category::where('status', 1)->Orderby('id','desc')->get();
            $product = Product::findOrFail($product_id);
            $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product_id)->Orderby('id','desc')->get();
            return view('frontend.product-detail',compact('categories','product','related_products'));
        }  catch (\Exception $e) {
            \Log::error( $e->getMessage() );
            abort(404);
        }    
    }

    public function cart()
    {
        if (Auth::check()) {
            $userCart = Cart::where('user_id', Auth::user()->id)->get();
        } else {
            $session_id = Session::get('session_id');
            $userCart = Cart::where('session_id', $session_id)->get();
        }
        return view('frontend.cart',compact('userCart'));
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }

    public function blogs()
    {
        return view('frontend.blogs');
    }

   
}
