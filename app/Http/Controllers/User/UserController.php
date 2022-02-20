<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function singUpPost()
    {
        $this->validate(request(), [
            'name' => 'required|min:3:max:60',
            'email' => 'required|email|unique',
            'password' => 'required|confirmed|min:5'
        ]);
        $users = User::creare([
            'name' =>  request('name'),
            'email'  => request('email'),
            'password' => Hash::make(request('password')),
            'activation' => Str::random(60),
            'status' => 0
        ]);
        auth()->login($users);
        return redirect()->route('anasayfa');
    }
    public function logoutPost()
    {
        auth()->logout();
        request()->sessiom() > flush();
        request()->session()->regenerate();
        return redirect()->route('home');
    }
}