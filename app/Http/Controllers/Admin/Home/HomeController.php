<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use  Illuminate\Support\Facedes\DB;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereRaw('top_id is null')->take(8)->get();
        $sliders =
        Product::select('products.*')
        ->join('product_details', 'product_details.product_id', 'product_id')
        ->where('product_details.slider', 1)
        ->orderBy('updated_date', 'desc')
        ->take(4)->get();
        $opportunity_day = 
        Product::select('products.*')
        ->join('product_details','product_details.product_id','product_id')
        ->where('product_details.opportunity_day',1)
        ->orderBy('updated_date','desc')
        ->first();
        $featured   =
        Product::select('products.*')
        ->join('product_details', 'product_details.product_id', 'product_id')
        ->where('product_details.featured', 1)
        ->orderBy('updated_date', 'desc')
        ->take(4)->get();
        $bestseller   =
        Product::select('products.*')
        ->join('product_details', 'product_details.product_id', 'product_id')
        ->where('product_details.bestseller', 1)
        ->orderBy('updated_date', 'desc')
        ->take(4)->get();
        $discount   =
        Product::select('products.*')
        ->join('product_details', 'product_details.product_id', 'product_id')
        ->where('product_details.discount', 1)
        ->orderBy('updated_date', 'desc')
        ->take(4)->get();
        return view('Admin.Home.index',compact('categories','sliders', 'opportunity_day', 'bestseller', 'discount', 'featured'));
    }
}