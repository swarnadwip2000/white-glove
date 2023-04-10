<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\Offer;
use App\Models\HomeCms;
use App\Models\AboutCms;
use App\Models\ContactUsCms;
use App\Models\OrderItem;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function home()
    {
        $categories = Category::where('status', 1)->Orderby('id','desc')->get();
        $featured_products = Product::where('status', 1)->where('feature_product', 1)->Orderby('id','desc')->get();
        $blogs = Blog::where('status',1)->orderby('id', 'desc')->get();
        $homeCms = HomeCms::first();
        $offers = Offer::where('status',1)->orderby('id', 'desc')->get();
        $best_selling = OrderItem::select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->orderby('total', 'desc')->with('product')->get();
        return view('frontend.home',compact('categories','featured_products','blogs','homeCms','offers','best_selling'));
    }

    public function about()
    {
        $aboutCms = AboutCms::first();
        return view('frontend.about',compact('aboutCms'));
    }

    public function contact()
    {

        $contactCms = ContactUsCms::first();
        return view('frontend.contact',compact('contactCms'));              
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
            $reviews = Review::where('product_id', $product_id)->get();
            return view('frontend.product-detail',compact('categories','product','related_products','reviews'));
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

    public function offer()
    {
        return view('frontend.offer');  
    }

    

   
}
