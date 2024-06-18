<header class="bg-dark text-white p-3">
    <div class="container-fluid container-lg d-flex justify-content-between align-items-center">
        <a href="{{ route('landing-page') }}" class="m-0 h4 fw-bold text-white text-decoration-none">
            {{ config('app.name', 'Laravel') }}</a>
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
                        <a href="{{ route('dashboard.index') }}" class="dropdown-item">
                            <i class="fas fa-gauge me-2"></i>
                            Dashboard
                        </a>
                    </li>
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
