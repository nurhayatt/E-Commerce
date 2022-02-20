@extends('layouts.master')
@section('title','Product')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert') 


            @if(count(Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>İşlem</th>
                </tr>
           @foreach (Cart::content() as $cart)
                  <tr>
                    <td style="width: 120px"> <img src="http://lorempixel.com/120/100/food/2"> Ürün adı</td>
                    <td>
                      <a href="{{ route('products',$cart->options->slug) }}">
                        {{ $cart->name }}
                      </a>
                    </td>
                    <td>{{ $cart->price }}</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default">-</a>
                        <span style="padding: 10px 20px">{{ $cart->qty }}</span>
                        <a href="#" class="btn btn-xs btn-default">+</a>
                    </td>
                    <td>18.99</td>
                    <td class="text-right">
                      {{ $cart->subtotal }}
                    </td>
                </tr>
           @endforeach
             
                <tr>
                  
                    <th colspan="4" class="text-right">Alt Toplam</th>
                    <td class="text-right">{{ Cart::subtotal() }}</td>
                 
                </tr>
                
                <tr>
                  
                    <th colspan="4" class="text-right">KDV</th>
                    <td class="text-right">{{ Cart::tax() }}</td>
                 
                </tr>
                     <tr>
                  
                    <th colspan="4" class="text-right">Genel Toplam</th>
                    <td class="text-right">{{ Cart::total() }} </td>
                 
                </tr>
            </table>
            @else
            <p>
                Sepetinizde ürün bulunmamaktadır.
            </p>
            @endif
            <div>
                <a href="#" class="btn btn-info pull-left">Sepeti Boşalt</a>
                <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
        </div>
    </div>
@endsection