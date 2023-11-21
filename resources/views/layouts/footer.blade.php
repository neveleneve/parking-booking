<footer class="fixed-bottom bg-dark text-white p-3 d-inline d-lg-none">
    <div class="container">
        <ul class="nav footer-menu justify-content-center">
            @guest
                <li class="nav-item">
                    <a href="{{ route('landing-page') }}" title="Dashboard"
                        class="nav-link text-white {{ Request::is('/') ? 'active' : null }}">
                        <i class="far fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" title="Log In"
                        class="nav-link text-white {{ Request::is('login') || Request::is('register') ? 'active' : null }}">
                        <i class="far fa-user"></i>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route('landing-page') }}" title="Home"
                        class="nav-link text-white {{ Request::is('/') ? 'active' : null }}">
                        <i class="far fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" title="Dashboard"
                        class="nav-link text-white {{ Request::is('dashboard*') ? 'active' : null }}">
                        <i class="far fa-gauge"></i>
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
                    <a href="{{ route('pembayaran.index') }}" title="Pembayaran"
                        class="nav-link text-white {{ Request::is('pembayaran*') || Request::is('top-up*') ? 'active' : null }}">
                        <i class="far fa-dollar-sign"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaksi.index') }}" title="Transaksi"
                        class="nav-link text-white {{ Request::is('transaksi*') ? 'active' : null }}">
                        <i class="far fa-receipt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profil.index') }}" title="Profil"
                        class="nav-link text-white {{ Request::is('profil*') ? 'active' : null }}">
                        <i class="far fa-user"></i>
                    </a>
                </li>
            @endguest
        </ul>
    </div>
</footer>
