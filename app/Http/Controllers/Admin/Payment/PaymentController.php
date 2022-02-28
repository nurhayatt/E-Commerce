<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    public function index()
    {
        if(!auth()->check()){ //kullanıcı girişi yapılmadıysa
            return redirect()->route('user.login')
            ->with('message_type','info')
            ->with('message','Ödeme işlemi için oturum açmanız veya kullanıcı kaydı yapmanız gerekmektedir.');
        }
        else if(count(Cart::content())==0)
        {
            return redirect()->route('user.login')
            ->with('message_type', 'info')
            ->with('message', 'Ödeme işlemi için sepetinizde bir ürün bulunmalıdır.');
        }
        return view("Admin.Payment.index");
    }
}