@extends('layouts.master')
@section('content')

<div class="container">
    <h1>404</h1>
    <h2>Aradığınız sayfa bulunamadı!</h2>
<a href="{{ route('home') }}" class="btn btn-primary">Anasayfa'ya Dön</a>
</div>
@endsection