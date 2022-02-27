<?php

namespace App\Http\Controllers\Admin\Basket;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\Request;

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
        if(auth()->check())
        {
            $active_basket_id = session('active_basket_id');
            $cartItem = Cart::get($rowId);
            BasketProduct::where('basket_id',$active_basket_id)->where('product_id',$cartItem->id)->delete();
        }
        Cart::remove($rowId);
        return redirect()->route('basket')
        ->with('message_type','success')  
        ->with('message','Ürün sepetten kaldırıldı.');   
   
   
    }
    public function truncate()
    {
        if (auth()->check()) {
            $active_basket_id = session('active_basket_id');
           
            BasketProduct::where('basket_id', $active_basket_id)->delete();
        }
        Cart::destroy();
        return redirect()->route('basket')
        ->with('message_type','success')  
        ->with('message','Sepet boşaltıldı.');   
    }
    public function update($rowId)
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
        if (auth()->check()) {
            $active_basket_id = session('active_basket_id');
            $cartItem=Cart::get($rowId);
           if(request('number')==0)
            BasketProduct::where('basket_id', $active_basket_id)->where('product_id', $cartItem->id)->delete();
            else
            BasketProduct::where('basket_id', $active_basket_id)->where('product_id', $cartItem->id)
            ->update(['number' => request('number')]);
        }
    Cart::update($rowId,request('number'));
     session()->flash('message_type','success');
     session()->flash('message','Adet Bilgisi güncellendi.');
       return response()->json(['success'=>true]);
    }
}