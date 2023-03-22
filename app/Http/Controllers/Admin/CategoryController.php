<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'slug' => 'required|unique:categories|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,webp,jpg,gif,svg|max:2048',
        ]);
        
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->status = $request->status;
        $fileData = $this->imageUpload($request->file('image'), 'categories');
        $category->image = $fileData['filePath'] ?? null;
        $category->save();
        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:categories,slug,'.$id.'',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'status' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->status = $request->status;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ]);

            $fileData = $this->imageUpload($request->file('image'), 'categories');
            if (!empty($fileData['filePath'])) {
                if ((!empty($category->image)) && Storage::exists($category->image)) {
                    Storage::delete($category->image);
                }
                $category->image = $fileData['filePath'] ?? null;
            }
        }

        $category->save();
        return redirect()->route('categories.index')->with('message', 'Category updated successfully.');
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

    public function delete($id)
    {
        $category = Category::find($id);
        if (!empty($category->image) && Storage::exists($category->image)) {
            Storage::delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('error', 'Category has been deleted!!');
    }

    public function changeCategoriesStatus(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = $request->status;
        $category->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
