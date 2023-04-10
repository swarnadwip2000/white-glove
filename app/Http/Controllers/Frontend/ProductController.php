<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{  


    public function productSort(Request $request)
    {  
        
        try{   
            $product_name = $request->product;
            $category = Category::where('slug',$request->category)->first();
            if($category){
                if($request->sort == '1')
                {
                    $products = Product::query()
                    ->where('category_id',$category->id)
                     ->where('discount','>=', $request->range)
                    ->where('name' , 'LIKE' , "%{$product_name}%")
                    ->orderByRaw('(price -((price * discount) / 100)) ASC')
                    ->paginate(10);
                                 
                }else if($request->sort == '0'){
                    $products = Product::query()
                    ->where('category_id',$category->id)
                    ->where('discount','>=', $request->range)
                    ->where('name' , 'LIKE' , "%{$product_name}%")
                    ->orderByRaw('(price -((price * discount) / 100)) DESC')
                    ->paginate(10);

                }else{

                    $products = Product::where('name' , 'LIKE' , "%{$product_name}%")->where('discount','>=', $request->range)->where('category_id',$category->id)->orderBy('id', 'desc')->paginate(10);
                }  
            
            }else{
                if($request->sort == '1')
                {
                    $products = Product::query()
                    ->where('name' , 'LIKE' , "%{$product_name}%")
                    ->where('discount','>=', $request->range)
                    ->orderByRaw('(price -((price * discount) / 100)) ASC')
                    ->paginate(10);
                
                    
                }else if($request->sort == '0'){
                    $products = Product::query()
                    ->where('name' , 'LIKE' , "%{$product_name}%")
                    ->where('discount','>=', $request->range)
                    ->orderByRaw('(price -((price * discount) / 100)) DESC')
                    ->paginate(10);

                }else{

                    $products = Product::where('name' , 'LIKE' , "%{$product_name}%")->where('discount','>=', $request->range)->orderBy('id', 'desc')->paginate(10);
                } 
                
            }
            $count = Product::where('name' , 'LIKE' , "%{$product_name}%")->count();
            $categories = Category::orderBy('id', 'desc')->get();
            $single_category = "All Products";
            return response()->json(['view'=>(String)View::make('frontend.product-filter')->with(compact('products','categories','single_category','count'))]);
        }catch(\Throwable $th){
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

    public function productRangeFilter(Request $request)
    {
        // return $request;
        $get_product = Product::where('discount','>=', $request->range)->get();

    }

    public function productReview(Request $request)
    {
        
        $validated = Validator::make($request->all(), [
            'review' => 'required',
        ],
        [
            'review.required' => 'Please enter your review!',
        ]);

        if ($validated->fails()) {
            // send first error message
            return response()->json(['error' => $validated->errors()->first(), 'status' => 'error']);
        }
        try {
            if ($request->ajax()) {
                $data = $request->all();
                $check_review = Review::where('user_id', auth()->user()->id)->where('product_id', $data['product_id'])->first();
                if ($check_review) {
                    $check_review->rating = $data['rating'];
                    $check_review->comment = $data['review'];
                    $check_review->save();
                }
                $review = new Review();
                $review->user_id = auth()->user()->id;
                $review->product_id = $data['product_id'];
                $review->rating = $data['rating'];
                $review->comment = $data['review'];
                $review->save();
                $reviews = Review::where('product_id', $data['product_id'])->get();
                return response()->json(['view'=>(String)View::make('frontend.product-reviews')->with(compact('reviews')), 'message' => 'Review added successfully!', 'status' => 'success']);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status' => 'error']);
        }

    }
}
