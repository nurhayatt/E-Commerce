@extends('layouts.master')
@section('title',$categories->name)
@section('content')
<div class="container">
         <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Anasayfa</a></li>
         
            <li class="active">{{ $categories->name }}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $categories->name }}</div>
                    <div class="panel-body">
                     
                     
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach ($sub_categories as $item )
                                  <a href="{{ route('category',$item->slug) }}" class="list-group-item"><i class="fa fa-arrow-circle-right"></i> {{ $item->name }}</a>
                            @endforeach
                          
                         
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                     @if(count($products)>0)
                    Sırala
                    <a href="?order=bestsellers" class="btn btn-default">Çok Satanlar</a>
                    <a href="?order=newproduct" class="btn btn-default">Yeni Ürünler</a>
                    
                    <hr>
                    @endif
                    <div class="row">
                        @if(count($products)==0)
                       <div class="col-md-12">
                           Bu kategoride henüz ürün bulunmamamktadır!
                       </div>
                        @endif
                        @foreach ($products as $product )
                             <div class="col-md-3 product">
                            <a href="{{ route('product', $product->slug) }}"><img src="http://lorempixel.com/400/400/food/1"></a>
                            <p><a href="{{ route('product, $product->slug') }}">{{ $product->name }}</a></p>
                            <p class="price">{{ $product->price }}₺</p>
                            <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                        </div>
                       
                        @endforeach
                       
                    </div>
                    {{ request()->has('order') ? $products->appends(['order'=>request('order')])->links() :
                    $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection