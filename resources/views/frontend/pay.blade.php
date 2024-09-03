@extends('layouts.app')
@section('title', 'Pembayaran')

@section('content')
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0"
                style="margin-top: -25px; background-image: url('{{ asset('assets/img/bg-header.jpg') }}');">
                <div class="container">
                    <h1 class="pt-5">
                        Pembayaran
                    </h1>
                    <p class="lead">

                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div style="text-align: center; margin-top: 30px">
                <button type="button" class="btn btn-lg btn-primary waves-effect waves-light text-center">
                    <a id="pay-button">
                        Bayar Sekarang
                    </a>
                </button>
            </div>

            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
            <script type="text/javascript">
                document.getElementById('pay-button').onclick = function() {
                    // SnapToken acquired from previous step
                    snap.pay('{{ $snapToken }}', {
                        // Optional
                        onSuccess: function(result) {
                            /* You may add your own js here, this is just example */
                            window.location.href = "{{ route('products.success') }}";
                        },
                        // Optional
                        onPending: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        },
                        // Optional
                        onError: function(result) {
                            /* You may add your own js here, this is just example */
                            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        }
                    });
                };
            </script>

        </div>
    </div>
@endsection
