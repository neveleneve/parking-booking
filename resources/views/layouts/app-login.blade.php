<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile App-like Navigation</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="m-0 h4"> {{ config('app.name', 'Laravel') }}
            </h1>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="fixed-bottom bg-dark text-white p-3">
        <div class="container">
            <ul class="nav footer-menu justify-content-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-white active" title="Dashboard">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" title="Transaksi Saya">
                        <i class="fas fa-receipt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white" title="Profil Saya">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <!-- Link to Bootstrap JS (Optional) -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Link to Font Awesome JS (Optional) -->
    <script src="{{ asset('fontawesome/css/all.css') }}"></script>
</body>

</html>
