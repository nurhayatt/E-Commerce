<?php

namespace App\Http\Controllers\Admin\Basket;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
#use Gloudemans\Shoppingcart\Cart;
use Cart;
class BasketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view("Admin.Basket.index");
    }

    public function  create()
    {
        $products = Product::find(request('id'));
        Cart::add($products->id, $products->name, 1, $products->price, ['slug'=>$products->slug]);
 
        return redirect()->route('basket')
        ->with('message_type','success')  
        ->with('message','Ürün sepete eklendi.');   
    }
}