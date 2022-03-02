<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $user_detail = auth()->user()->getuserDetail;
    
        return view("Admin.Payment.index",compact('user_detail'));
    }

    public function pay() /* sanal pos entegrasyonu olmadığı için bankanın buraya yönlendirdiğini var sayıyoruz*/
    {
        $order =  request()->all();
      
        $order['basket_id'] = session('active_basket_id');
        $order['bank'] = "Garanti";
        $order['number_of_installments'] = 1;
        $order['status'] = "Siparişiniz alındı";
        $order['order_amount'] = Cart::subtotal();

        Order::create($order); //siparişi veritabanına kaydediyoruz
        
        Cart::destroy(); //sepeti sıfırlamak için

        session()->forget('active_basket_id'); //sepetin aktif olduğu sessionu sıfırlamak için
        
        return redirect()->route('order')
        ->with('message_type','success')
        ->with('message','Siparişiniz alındı. Ödeme işlemi başarılı.');
    }
}