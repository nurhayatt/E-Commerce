@extends('layouts.master')
@section('title',$products->name)
@section('content')
<div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Anasayfa</a></li>
           @foreach ($categories as $item )
                <li><a href="{{ route('category', $item->slug) }}">{{ $item->name }}</a></li>
           @endforeach
        
            <li class="active">{{ $products->name }}</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="http://lorempixel.com/400/200/food/1">
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://lorempixel.com/60/60/food/2"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://lorempixel.com/60/60/food/3"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="http://lorempixel.com/60/60/food/4"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>  {{ $products->name}}</h1>
                    <p class="price">  {{ $products->price}} ₺</p>
                    <form action="{{ route('basket.add') }}" method="post">
                     @csrf
                     <input type="hidden" name="id" value="{{ $products->id }}">
                       <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                    </form>
                  
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">
                       {{ $products->name}}
                    </div>
                    <div role="tabpanel" class="tab-pane" id="t2">
                        Henüz yorum yapılmadı.
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection