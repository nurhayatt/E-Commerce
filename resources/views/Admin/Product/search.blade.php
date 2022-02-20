@extends('layouts.master')
@section('content')

<div class="container">
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Anasayfa</a></li>
        <li class="active">Arama Sonucu</li>
    </ol>
</div><div class="product bg-content">
    <div class="row">
        @if(count($products)==0)
        <div class="col-md-12 text-center">
            Bir ürün bulunamadı!
        </div>
        @endif
        @foreach ($products as $item )
            <div class="col-md-3 product">
                <a href="{{ route('product',$item->slug) }}">
                    <img src="" alt="{{ $item->name }}">
                </a>
                <p>
                    <a href="{{ route('product',$item->slug) }}">
                   {{ $item->name }}
                    </a>
                </p>
                <p class="price">{{ $item->price }}</p>
            </div>
        @endforeach
    </div>
    {{ $products->appends(['search'=>old('search')])->links() }}
</div>

@endsection