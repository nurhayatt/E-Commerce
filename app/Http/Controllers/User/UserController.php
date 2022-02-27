<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\UserSingUpMail;
use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logoutPost');
    }

    public function login()
    {
        return view('User.login');
    }

    public function loginPost()
    {
        $this->validate(request(), [

            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt(['email' => request('email'), 'password' => request('password')], request()->has('remember'))) {
            request()->session()->regenerate();

            $active_basket_id = Basket::firstOrCreate(['user_id' => auth()->user()->id])->id;
            session()->put("active_basket_id", $active_basket_id);
            if (Cart::count() > 0) {
                foreach (Cart::content() as $cartItem) {
                    BasketProduct::updateOrCreate(
                        [
                            'basket_id' => $active_basket_id, 'product_id' => $cartItem->id
                        ],

                        ['number' => $active_basket_id->qty, 'price' => $cartItem->price, 'durum' => 'Beklemede'],
                    );
                }
            }
            Cart::destroy();
            $basketProducts = BasketProduct::with('product')->where('basket_id', $active_basket_id)->get();
            foreach ($basketProducts as $basketProduct) {
                Cart::add($basketProduct->getProduct->id, $basketProduct->getProduct->name, $basketProduct->number, $basketProduct->price, ['slug' => $basketProduct->getProduct->slug]);
            }
            return redirect()->intended('/');
        } else {
            $errors  = ['email' => 'Hatalı Giriş'];
            return back()->withErrors($errors);
        }
    }


    public function singUp()
    {
        return view('User.singup');
    }
    public function singUpPost(Request $request)
    {
        $this->validate(request(), [
            //   'name' => 'required|min:3:max:60',
            //  'email' => 'required|email|unique',
            //  'password' => 'required|confirmed|min:4' 
        ]);
        $users = User::create([
            'name' =>  request('name'),
            'email'  => request('email'),
            'password' => Hash::make(request('password')),
            'activation' => Str::random(60),
            'status' => 0
        ]);

        Mail::to(request('email'))->send(new UserSingUpMail($users));
        auth()->login($users);
        return redirect()->route('home');
    }

    public function activate($key)
    {
        $users = User::where('activation', $key)->first();
        if (!is_null($users)) {
            $users->status = 1;
            $users->activation = null;
            $users->save();
            // auth()->login($users);
            return redirect()->route('home')
                ->with('message_type', 'success')
                ->with('message', 'Hesabınız aktifleştirildi');
        } else {
            return redirect()->route('home')
                ->with('message_type', 'danger')
                ->with('message', 'Hesabınız aktifleştirilemedi');
        }
    }
    public function logoutPost()
    {
        auth()->logout();
        request()->session() > flush();
        request()->session()->regenerate();
        return redirect()->route('home');
    }
}