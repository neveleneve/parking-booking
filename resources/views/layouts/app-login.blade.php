<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('custom-css')
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .pull-to-refresh {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
        }

        .pull-to-refresh .fa-spinner {
            font-size: 30px;
            /* Adjust the icon size as desired */
            animation: spin 1s infinite linear;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @stack('livewire-style')
</head>

<body>
    <header class="bg-dark text-white p-3">
        <div class="container-fluid container-lg d-flex justify-content-between align-items-center">
            <h1 class="m-0 h4 fw-bold"> {{ config('app.name', 'Laravel') }}</h1>
            <div class="dropdown">
                @guest
                    <button class="btn btn-dark dropdown-toggle d-none d-lg-inline" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="d-none d-lg-inline">
                            <a href="{{ route('landing-page') }}" class="dropdown-item">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li class="d-none d-lg-inline">
                            <a href="{{ route('login') }}" class="dropdown-item">
                                <i class="fas fa-sign-in-alt"></i>
                                Login
                            </a>
                        </li>
                        <li class="d-none d-lg-inline">
                            <a href="{{ route('register') }}" class="dropdown-item">
                                <i class="fas fa-user-plus"></i>
                                Register
                            </a>
                        </li>
                    </ul>
                @else
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </header>
    <div class="content-container" id="contentContainer">
        @include('sweetalert::alert')
        @yield('content')
    </div>
    <footer class="fixed-bottom bg-dark text-white p-3 d-inline d-lg-none">
        <div class="container">
            <ul class="nav footer-menu justify-content-center">
                @guest
                    <li class="nav-item">
                        <a href="{{ route('landing-page') }}" title="Dashboard"
                            class="nav-link text-white {{ Request::is('/') ? 'active' : null }}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" title="Log In"
                            class="nav-link text-white {{ Request::is('login') ? 'active' : null }}">
                            <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" title="Register"
                            class="nav-link text-white {{ Request::is('register') ? 'active' : null }}">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('landing-page') }}" title="Home"
                            class="nav-link text-white {{ Request::is('/') ? 'active' : null }}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" title="Dashboard"
                            class="nav-link text-white {{ Request::is('dashboard*') ? 'active' : null }}">
                            <i class="fas fa-tachometer-alt"></i>
                        </a>
                    </li>
                    @if (Auth::user()->level == '0')
                        <li class="nav-item">
                            <a href="{{ route('slot.index') }}" title="Slot Parkir"
                                class="nav-link text-white {{ Request::is('slot*') ? 'active' : null }}">
                                <i class="fas fa-parking"></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('payments.index') }}" title="Pembayaran"
                            class="nav-link text-white {{ Request::is('payments*') || Request::is('top-up*') ? 'active' : null }}">
                            <i class="fas fa-dollar-sign"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaksi.index') }}" title="Transaksi"
                            class="nav-link text-white {{ Request::is('transaksi*') ? 'active' : null }}">
                            <i class="fas fa-receipt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('profil.index') }}" title="Profil"
                            class="nav-link text-white {{ Request::is('profil*') ? 'active' : null }}">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </footer>
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{-- <script src="{{ asset('js/popper.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @stack('custom-js')
    <script>
        let startY, lastY;
        const contentContainer = document.getElementById('contentContainer');
        const pullToRefreshIcon = '<div class="pull-to-refresh"><i class="fas fa-spinner"></i></div>';

        contentContainer.addEventListener('touchstart', (event) => {
            const touch = event.touches[0];
            startY = touch.clientY;
            lastY = startY;
        });

        contentContainer.addEventListener('touchmove', (event) => {
            const touch = event.touches[0];
            lastY = touch.clientY;
        });

        contentContainer.addEventListener('touchend', (event) => {
            const touch = event.changedTouches[0];
            const deltaY = lastY - startY;
            if (deltaY > 100) {
                const refreshIconElement = document.createElement('div');
                refreshIconElement.innerHTML = pullToRefreshIcon;
                contentContainer.prepend(refreshIconElement);

                setTimeout(() => {
                    location.reload();
                }, 1500);
            }
        });
    </script>
    @stack('livewire-script')
</body>

</html>
