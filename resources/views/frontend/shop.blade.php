@extends('layouts.app')
@section('title', 'Selamat Berbelanja')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Selamat datang di Freshcery
                    </h1>
                    <p class="lead">
                        Hemat waktu dan serahkan belanjaan kepada kami.
                    </p>
                </div>
            </div>
        </div>

        <section id="most-wanted">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Selamat Berbelanja</h2>
                        <div class="row">
                            @foreach ($product as $item)
                                <div class="col-md-3">
                                    <div class="card card-product">
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPECIAL</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                @if ($item->stock > 0)
                                                    <span class="badge badge-danger">
                                                        Stock {{ $item->stock }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-dark">
                                                        Tunggu restock
                                                    </span>
                                                @endif
                                            </div>
                                            <img src="{{ asset('upload/' . $item->image) }}" alt="Card image 2"
                                                class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="{{ route('single.product', $item->id) }}">{{ $item->name }}</a>
                                            </h4>
                                            <div class="card-price">
                                                <span
                                                    class="reguler">Rp.{{ number_format($item->price, 0, ',', '.') }}</span>
                                            </div>

                                            @if ($item->stock > 0)
                                                <a href="{{ route('single.product', $item->id) }}"
                                                    class="btn btn-block btn-primary">
                                                    Selengkapnya
                                                </a>
                                            @else
                                                <button class="btn btn-block btn-dark" disabled>
                                                    Habis
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Menampilkan pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
