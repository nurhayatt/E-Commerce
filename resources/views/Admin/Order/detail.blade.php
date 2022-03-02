@extends('layouts.master')
@section('title','Order-Detail')
@section('content')
<div class="container">
        <div class="bg-content">
            <a href="route('order')" class="btn btn-xs btn-primary">
                <i class="gly gly-arrow-left">Siparişlere Dön</i>
            </a>
            <h2>Sipariş (SP-{{ $orders->id }})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($orders->getBasket->getbasketProduct as $item)
                <tr>
                    <td style="width: 120px">
                        <a href="{{ route('product', $item->getProduct->slug) }}">
                             <img src="http://lorempixel.com/120/100/food/2"> Ürün adı
                        </a>
                       </td>
                    <td>         <a href="{{ route('product', $item->getProduct->slug) }}">{{ $item->getProduct->name}}</a></td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->number *  $item->price}}</td>
                    <td>
                      {{ $item->getProduct->status }}
                    </td>
                </tr>
                @endforeach
                <tr>

                    <th colspan="4" class="text-right">Toplam Tutar </th>
                    <th colspan="2"> {{ $orders->order_amount }}</th>
                </tr>
               <tr>

                    <th colspan="4" class="text-right">Toplam Tutar (KDV Dahil)</th>
                    <th colspan="2"> {{ $orders->order_amount * ((100+config('cart.tax'))/100) }}</th>
                </tr>
                   <tr>

                    <th colspan="4" class="text-right">Sipariş Durumu</th>
                    <th colspan="2"> {{ $orders->status}}</th>
                </tr>
            </table>
        </div>
    </div>
@endsection