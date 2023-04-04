<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogDetail($slug,$id)
    {
        $blog_id = decrypt($id);
        $blog = Blog::with('category')->findOrFail($blog_id);
        $blog_category = BlogCategory::Orderby('id','desc')->get();
        $blog_list = Blog::where('status',1)->where('id','!=',$blog_id)->orderby('id', 'desc')->get();
        return view('frontend.blog-details')->with(compact('blog','blog_category','blog_list'));
    }

    public function blogs($slug = null,$id = null)
    {
        
        if($slug == null && $id == null){
            $blogs = Blog::where('status',1)->orderby('id', 'desc')->with('category')->paginate(6);
            return view('frontend.blogs')->with(compact('blogs'));
        }else{
            $blogs = Blog::where('blog_category_id',$id)->where('status',1)->orderby('id', 'desc')->with('category')->paginate(6);
            return view('frontend.blogs')->with(compact('blogs'));
        }
    }


    
}
