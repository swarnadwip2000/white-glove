<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       
        $count['customer'] = User::Role('CUSTOMER')->count();
        $count['category'] = Category::Orderby('id','desc')->count();
        $count['product'] = Product::Orderby('id','desc')->count();

        return view('admin.dashboard')->with(compact('count'));
    }

}
