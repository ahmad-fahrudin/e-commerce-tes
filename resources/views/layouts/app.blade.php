<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('./avatar.jpg') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/fonts/sb-bistro/sb-bistro.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/fonts/font-awesome/font-awesome.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/packages/bootstrap/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/packages/o2system-ui/o2system-ui.css') }}">
    <link rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/packages/owl-carousel/owl-carousel.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/packages/cloudzoom/cloudzoom.css') }}">
    <link rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/packages/thumbelina/thumbelina.css') }}">
    <link rel="stylesheet" type="text/css" media="all"
        href="{{ asset('assets/packages/bootstrap-touchspin/bootstrap-touchspin.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('assets/css/theme.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('sass/app.scss') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <div id="app">

        <div class="page-header">
            <!--=============== Navbar ===============-->
            @include('frontend.components.header')
        </div>



        <main class="py-4">
            @yield('content')
        </main>
    </div>


    @include('frontend.components.footer')


    <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-migrate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/bootstrap/libraries/popper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/bootstrap/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/o2system-ui/o2system-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/owl-carousel/owl-carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/cloudzoom/cloudzoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/thumbelina/thumbelina.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/packages/bootstrap-touchspin/bootstrap-touchspin.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/theme.js') }}"></script>

    @include('sweetalert::alert')
</body>

</html>
