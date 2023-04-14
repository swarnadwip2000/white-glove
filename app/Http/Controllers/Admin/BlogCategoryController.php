<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog_categories = BlogCategory::orderby('id', 'desc')->get();
        return view('admin.blogs.category.list')->with(compact('blog_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.category.create');
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
            'slug' => 'required|unique:blog_categories',
        ]);

        $blog = new BlogCategory();
        $blog->name = $request->name;
        $blog->slug = $request->slug;
        $blog->save();
        return redirect()->route('blog-categories.index')->with('message', 'Blog Category has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = BlogCategory::FindOrFail($id);
        return view('admin.blogs.category.edit')->with(compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog_category = BlogCategory::FindOrFail($id);
        return view('admin.blogs.category.edit')->with(compact('blog_category'));
    }

   
    public function update(Request $request)
    {      
        //
    }


    public function blogCatUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug,'.$request->category_id
        ]);
        $update_blog_category = BlogCategory::FindOrFail($request->category_id);
        $update_blog_category->name = $request->name;
        $update_blog_category->slug = $request->slug;
        $update_blog_category->save();
        return redirect()->route('blog-categories.index')->with('message', 'Blog Category has been updated successfully');
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
        BlogCategory::findOrFail($id)->delete();
        return redirect()->back()->with('error', 'Blog Category has been deleted!');
    }

}
