@extends('layouts.app')
@section('title', 'Settings')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Settings
                    </h1>
                    <p class="lead">
                        Perbaharui Informasi Kamu
                    </p>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            @if (\Session::has('update'))
                <div class="alert alert-success">
                    <p>{!! \Session::get('update') !!}</p>
                </div>
            @endif
        </div>

        <section id="checkout">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-6">
                        <h5 class="mb-3">ACCOUNT DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="{{ route('users.settings.update', $user->id) }}" method="POST" class="bill-detail">
                            @csrf
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" name="name" value="{{ $user->name }}"
                                            placeholder="Full Name" type="text">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <input class="form-control" name="email" value="{{ $user->email }}"
                                                placeholder="Email Address" type="email">
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                    <input class="form-control" placeholder="Password" type="password">
                                </div> --}}
                                    <div class="form-group text-right">
                                        <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                                        <div class="clearfix">
                                        </div>
                            </fieldset>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
