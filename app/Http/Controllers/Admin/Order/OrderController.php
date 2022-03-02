<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('getBasket')
        ->whereHas('basket', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->orderBydesc('created_date')
        ->get();
        return view('Admin.Order.index', compact('orders'));
    }
    public function detail($id)
    {
        $orders = Order::with('getBasket.getBasketProduct.getProduct')
            ->whereHas('basket', function ($query) {
                $query->where('user_id', auth()->id());
            })
        ->where('order.id',$id)->firstOrFail($id);
        return view('Admin.Order.detail', compact('orders'));
    }
}