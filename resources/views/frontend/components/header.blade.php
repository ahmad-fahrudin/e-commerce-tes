            <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-transparent" id="page-navigation">
                <div class="container">
                    <!-- Navbar Brand -->
                    <a href="{{ url('/') }}" class="navbar-brand">
                        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="">
                    </a>

                    <!-- Toggle Button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarcollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarcollapse">
                        <!-- Navbar Menu -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="{{ route('products.shop') }}" class="nav-link">Home</a>
                            </li>

                            @auth
                                <li class="nav-item">
                                    @php
                                        $cartCount = App\Models\Cart::count();
                                    @endphp
                                    <a href="{{ route('products.cart') }}" class="nav-link">Keranjang<span
                                            class="badge badge-danger"
                                            style="position: relative; top: -5px; right: -5px;">{{ $cartCount }}</span></a>
                                </li>
                            @endauth
                            @guest
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="avatar-header"><img
                                                src="{{ asset('assets/users_images/no_image.jpg') }}">
                                        </div>
                                        {{ Auth::user()->name }}

                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('users.orders') }}">Riwayat Transaksi</a>
                                        <a class="dropdown-item" href="{{ route('users.settings') }}">Settings</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </div>
            </nav>
