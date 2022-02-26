<?php

namespace App\Http\Controllers\Admin\Basket;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
#use Gloudemans\Shoppingcart\Cart;
//use Cart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

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
        Cart::add($products->id, $products->name, 1, $products->price,0, ['slug'=>$products->slug]);

        return redirect()->route('basket')
        ->with('message_type','success')  
        ->with('message','Ürün sepete eklendi.');   
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('basket')
        ->with('message_type','success')  
        ->with('message','Ürün sepetten kaldırıldı.');   
    }
    public function truncate()
    {
        Cart::destroy();
        return redirect()->route('basket')
        ->with('message_type','success')  
        ->with('message','Sepet boşaltıldı.');   
    }
    public function update(Request $request ,$rowId)
    {
        
        $validator = Validator::make(request()->all(), [
            'number' => 'required|numeric|between:0,5'
        ]);
        if($validator->fails())
        {
            session()->flash('message_type', 'danger');
            session()->flash('message', 'Adet değeri 0 ile 5 arasında olmalıdır.');
            return response()->json(['success' => false]);
        }
      
    Cart::update($rowId,request('number'));
     session()->flash('message_type','success');
     session()->flash('message','Adet Bilgisi güncellendi.');
       return response()->json(['success'=>true]);
    }
}