<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug_productname)
    {
        $products = Product::whereSlug($slug_productname)->firstOrFail();
      $categories = $products->getCategory()->distinct()->get();
        return view('Admin.Product.index',compact('products','categories'));
    }
    public function search()
    {
      $search = request()->input('search');
      $products=Product::where('name','like', "%search%")
      ->orWhere('description', 'like', "%description%")
      ->paginate(8);
      request()->flash();
      return view('Admin.Product.search',compact('products','search'));
    }
}