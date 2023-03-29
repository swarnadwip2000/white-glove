<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function products($slug)
    {
        if ($slug == 'all-products') {
            $products = Product::orderBy('id', 'desc')->paginate('20');
            // dd($products);
            $count = Product::orderBy('id', 'desc')->count();
            $categories = Category::orderBy('id', 'desc')->get();
            $type = 'All Products';
            return view('frontend.products')->with(compact('products', 'type', 'categories', 'count'));
        } else if ($slug == 'new-arrivals') {
            $products = Product::orderBy('id', 'desc')->paginate('20');
            $count = Product::orderBy('id', 'desc')->count();
            $categories = Category::orderBy('id', 'desc')->get();
            $type = 'New Arrivals';
            return view('frontend.products')->with(compact('products', 'type', 'categories', 'count'));
        } else if ($slug == 'featured-products') {
            $products = Product::orderBy('id', 'desc')->where('feature_product', 1)->paginate('20');
            $count = Product::orderBy('id', 'desc')->where('feature_product', 1)->count();
            $categories = Category::orderBy('id', 'desc')->get();
            $type = 'Featured Products';
            return view('frontend.products')->with(compact('products', 'type', 'categories', 'count'));
        } else {
            $products = Product::with('category')->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->paginate('20');
            $count = Product::with('category')->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->count();
            $categories = Category::orderBy('id', 'desc')->get();
            return view('frontend.products')->with(compact('products', 'categories', 'count'));
        }
    }

    public function productDetails($slug, $id)
    {
        $id = decrypt($id);
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)->get();
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->get();
        return view('frontend.product-details')->with(compact('product', 'related_products', 'reviews'));
    }

    public function productFilter(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = $request->all();
            //    echo "<pre>"; print_r($data); die;
                $query = Product::query();
                if (isset($data['category'])) {
    
                  $query->whereIn('category_id', $data['category']);
    
                if (isset($data['sort'])) {
                    if ($data['sort'] == 0) {
                        $query->orderBy('price', 'asc');
                    } else {
                        $query->orderBy('price', 'desc');
                    }
                }
    
                if (isset($data['priceFrom']) && isset($data['priceTo'])) { 
                    $priceForm = $data['priceFrom'];
                    $priceTo = $data['priceTo'];                                                                                                                                
                    $query->whereBetween('price', [$priceForm, $priceTo])->get();
                }
                // $type = "all-products"
                $products = $query->paginate();
                $count = $products->count();
                $types_product = Category::whereIn('id', $data['category'])->pluck('name')->toArray();
                $type = implode(', ', $types_product);
                    
            } else {
                $products = [];
                $count = 0;
                $type = '';
            }
    
                return response()->json(['view'=>(String)View::make('frontend.product-filter')->with(compact('products','count','type'))]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function productReview(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = $request->all();
                $review = new Review();
                $review->user_id = auth()->user()->id;
                $review->product_id = $data['product_id'];
                $review->rating = $data['rating'];
                $review->comment = $data['review'];
                $review->save();
                $reviews = Review::where('product_id', $data['product_id'])->get();
                return response()->json(['view'=>(String)View::make('frontend.review-ajax')->with(compact('reviews')), 'message' => 'Review added successfully!', 'status' => 'success']);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status' => 'error']);
        }
    }

    // product search by ajax in header
    public function productSearch(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = $request->all();
                $query = Product::query();
                if (isset($data['query'])) {
                    $query->where('name', 'like', '%' . $data['query'] . '%');
                }
                if($data['query'] == null) {
                    $searchProducts = [];
                } else {
                    $searchProducts = $query->get();
                }   
                return response()->json(['view'=>(String)View::make('frontend.includes.search-dropdown')->with(compact('searchProducts'))]);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
