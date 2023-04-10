<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       
        $count['customer'] = User::Role('CUSTOMER')->where('status',1)->count();
        $count['category'] = Category::Orderby('id','desc')->where('status',1)->count();
        $count['product'] = Product::Orderby('id','desc')->where('status',1)->count();
        $sum['transaction'] = Order::where('order_status','Order Confirmed')->sum('grand_total');

        return view('admin.dashboard')->with(compact('count','sum'));
    }

}
