<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
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
        if ($slug == 'all-products') {
            $categories = Category::where('status', 1)->Orderby('id','desc')->get();
            $products = Product::where('status', 1)->Orderby('id','desc')->paginate(10);
            $single_category = "All Products";
            return view('frontend.products',compact('categories','products','single_category'));
        }
        $categories = Category::where('status', 1)->Orderby('id','desc')->get();
        $single_category = Category::where('slug', $slug)->first();
        $products = Product::where('status', 1)->where('category_id', $single_category['id'])->Orderby('id','desc')->paginate(10);
        return view('frontend.products',compact('categories','products','single_category'));
    }

    public function productDetail($id)
    {
        $categories = Category::where('status', 1)->Orderby('id','desc')->get();
        $product = Product::where('id', $id)->first();
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->Orderby('id','desc')->get();
        return view('frontend.product-detail',compact('categories','product','related_products'));
    }

    public function cart()
    {
        return view('frontend.cart');
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
