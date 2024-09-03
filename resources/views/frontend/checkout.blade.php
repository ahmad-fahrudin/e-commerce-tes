@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Checkout
                    </h1>
                    <p class="lead">
                        Hemat waktu dan serahkan belanjaan kepada kami.
                    </p>
                </div>
            </div>
        </div>

        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <h5 class="mb-3">RINCIAN PENAGIHAN</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="{{ route('products.proccess.checkout') }}" method="POST" class="bill-detail">
                            <fieldset>
                                @csrf
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" name="name" placeholder="Name" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" name="phone_number" placeholder="Phone Number"
                                            type="tel">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" name="user_id" value="{{ Auth::user()->id }}"
                                            type="hidden" placeholder="user_id" type="text">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" name="price" value="{{ $checkoutSubtotal + 16000 }}"
                                            type="hidden">
                                    </div>
                                </div>
                                @foreach ($cartItems as $item)
                                    <input type="hidden" name="product_ids[]" value="{{ $item->product_id }}">
                                @endforeach

                                <div class="form-group">
                                    <textarea class="form-control" name="order_notes" placeholder="Order Notes"></textarea>
                                </div>
                            </fieldset>

                            <div class="form-group">
                                <button class="btn btn-primary" style="width: 167px; height: 48px" name="submit"
                                    type="submit">Submit</button>
                            </div>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <div class="holder">
                            <h5 class="mb-3">Pesanan Anda</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Products</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartItems as $product)
                                            <tr>
                                                <td>
                                                    {{ $product->name }} x{{ $product->qty }}
                                                </td>
                                                <td class="text-right">
                                                    Rp.{{ number_format($product->subtotal, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td>
                                                <strong>Kerangjang Subtotal</strong>
                                            </td>
                                            <td class="text-right">
                                                Rp.{{ number_format($checkoutSubtotal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Ongkir</strong>
                                            </td>
                                            <td class="text-right">
                                                Rp.16.000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>ORDER TOTAL</strong>
                                            </td>
                                            <td class="text-right">
                                                <strong>
                                                    Rp.{{ number_format($product->subtotal + 16000, 0, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>


                        </div>
                        {{-- <p class="text-right mt-3">
                        <input checked="" type="checkbox"> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                    </p>
                    <a href="#" class="btn btn-primary float-right">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a> --}}
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
