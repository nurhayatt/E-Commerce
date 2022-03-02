@extends('layouts.master')
@section('title', 'Product')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')


            @if (count(Cart::content()) > 0)
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
                                <a href="{{ route('product', $cart->options->slug) }}">
                                    {{ $cart->name }}
                                </a>
                                <form action="{{ route('basket.remove', $cart->rowId) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">Sepetten Kaldır</button>
                            </td>
                            <td>{{ $cart->price }}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-default product-number-decrease"
                                    data-id="{{ $cart->rowId }}" data-number="{{ $cart->qty - 1 }}">-</a>
                                <span style="padding: 10px 20px">{{ $cart->qty }}</span>
                                <a href="#" class="btn btn-xs btn-default product-number-increase"
                                    data-id="{{ $cart->rowId }}" data-number="{{ $cart->qty + 1 }}">+</a>
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

                <form action="{{ route('basket.truncate') }}" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                </form>
                <a href="{{ route('payment') }}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(function() {
            $('.product-number-decrease, .product-number-increase').on('click', function() {
                var id = $(this).attr('data-id');
                var number = $(this).attr('data-number');
                $.ajax({
                    type: 'PATCH',
                    url: "{{ url('Basket/Update') }}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        number: number
                    },
                    method: "PATCH",
                    success: function(result) {

                        window.location.href = '/Basket';
                    }


                });

              

            });
        })
    </script>
@endsection
