<?php

namespace App\Http\Controllers\Admin\Basket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}