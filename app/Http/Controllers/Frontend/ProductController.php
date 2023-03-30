<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{  

    public function productFilter(Request $request)
    { 
        try {
            $product_name = $request->product;
            $products = Product::where('name' , 'LIKE' , "%{$product_name}%")->paginate(10);
            $count = Product::where('name' , 'LIKE' , "%{$product_name}%")->count();
                    
            $categories = Category::orderBy('id', 'desc')->get();
            $single_category = "All Products";        
            return response()->json(['view'=>(String)View::make('frontend.product-filter')->with(compact('products','count','categories','single_category'))]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage(), 'status' => 'error']);
        }    
        
       
    }

    

    // product search by ajax in header
    public function productSearch(Request $request)
    { 
        
        try {
            $product_name = $request['query'];   
            $searchProducts = Product::where('name' , 'LIKE' , "%{$product_name}%")->paginate(10);
                  
            return response()->json(['view'=>(String)View::make('frontend.includes.search-dropdown')->with(compact('searchProducts'))]);
            
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
