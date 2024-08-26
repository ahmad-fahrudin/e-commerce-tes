@extends('layouts.app')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Keranjang Kamu
                    </h1>
                    <p class="lead">
                        Hemat waktu dan serahkan belanjaan kepada kami.
                    </p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            @if (\Session::has('delete'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('delete') !!}</p>
                </div>
            @endif
        </div>
        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th width="15%">Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartProducts as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/img/' . $product->image . '') }}" width="60">
                                            </td>
                                            <td>
                                                {{ $product->name }}<br>
                                                <small>1000g</small>
                                            </td>
                                            <td>
                                                Rp.{{ number_format($product->price, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ $product->qty }}
                                            </td>

                                            <td>
                                                Rp.{{ number_format($product->price * $product->qty, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('products.cart.delete', $product->id) }}"
                                                    class="btn btn-danger text-white"> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <a href="{{ route('products.shop') }}" class="btn btn-default">Continue Shopping</a>
                    </div>
                    <div class="col text-right">
                        <div class="clearfix"></div>
                        <h6 class="mt-3">Total:
                            Rp.{{ number_format($subtotal, 0, ',', '.') }}</h6>
                        @if ($subtotal > 0)
                            <form action="{{ route('products.prepare.checkout') }}" method="POST">
                                @csrf
                                <input name="price" value="{{ $subtotal }}" type="hidden">
                                <button type="submit" class="btn btn-lg btn-primary">Checkout <i
                                        class="fa fa-long-arrow-right"></i></button>
                            </form>
                        @else
                            <p class="alert alert-success">you have no products in cart you cant checkout yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
