<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.products.list')->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->where('status',1)->get();
       
        return view('admin.products.create')->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'status' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required',
            'specification' => 'required',
            'discount' => 'required|numeric|between:0,100',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->discount = $request->discount;
        $fileData = $this->imageUpload($request->file('image'), 'products');
        $product->image = $fileData['filePath'] ?? null;
        $product->save();
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.view')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->get();
       
        return view('admin.products.edit')->with(compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:products,slug,' . $id,
            'meta_title' => 'required',
            'meta_description' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'description' => 'required',
            'specification' => 'required',
            'discount' => 'required|numeric|between:0,100',
        ]);
        // return $request->all();
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->specification = $request->specification;
        $product->discount = $request->discount;
        $product->save();
        if ($request->hasFile('image')) {
                $fileData = $this->imageUpload($request->file('image'), 'products');   
                $product->image = $fileData['filePath'] ?? null;
                $product->save();
            }
        
        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeProductsStatus(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    public function changeFeaturedProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->feature_product = $request->feature_product;
        $product->save();
        return response()->json(['success' => 'Featured product change successfully.']);
    }

    public function productImageDelete(Request $request)
    {
        $productImage = ProductImage::find($request->id);
        if (!empty($productImage->image) && Storage::exists($productImage->image)) {
            Storage::delete($productImage->image);
        }

        $productImage->delete();
        return response()->json(['success' => 'Product image deleted successfully.']);
    }
}
