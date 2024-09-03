@extends('layouts.app')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Your Transactions
                    </h1>
                    <p class="lead">
                        Belanja Aman dan Nyaman.
                    </p>
                </div>
            </div>
        </div>

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>name</th>
                                        <th>phone number</th>
                                        <th>price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>{{ $item->iteration }}</td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>
                                                    {{ $item->phone_number }}
                                                </td>
                                                <td>
                                                    {{ $item->price }}
                                                </td>
                                                <td>
                                                    @if ($item->status == 'Bayar Berhasil')
                                                        <button class="btn btn-success">{{ $item->status }}</button>
                                                    @else
                                                        <a href="{{ route('products.pay', $item->id) }}"
                                                            class="btn btn-secondary">{{ $item->status }}</a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <p class="alert alert-success">kamu belum ada order untuk sekarang</p>
                                    @endif

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </section>


    </div>

@endsection
