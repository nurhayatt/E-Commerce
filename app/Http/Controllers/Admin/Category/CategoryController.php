<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug_categoryname)
    {

        $categories = Category::where('slug', $slug_categoryname)->firstOrFail();
        $sub_categories = Category::where('top_id', $categories->id)->get();
        $products = $categories->getProducts()->paginate(2);
        $order = request('order');
        if ($order == 'bestsellers') {
            $products = $categories->getProducts()
                ->distinct()
                ->join('product_details', 'product_details.product_id', 'product_id')
                ->orderBy('product_detail.bestsellers', 'desc')
                ->paginate(2);
        } else if ($order == 'newproduct') {
            $products = $categories
                ->getProducts()
                ->distinct()
                ->orderByDesc('updated_date')
                ->paginate(2);
        } else {
            $products = $categories
                ->getProducts()
                ->distinct()
                ->paginate(2);
        }
        return view("Admin.Category.index", compact('categories', 'sub_categories', 'products'));
    }
}