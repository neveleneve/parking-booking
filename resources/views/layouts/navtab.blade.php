<div class="row justify-content-center">
    <div class="col-8 d-none d-lg-inline mb-3">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                    class="nav-link text-dark {{ Request::is('dashboard*') ? 'active fw-bold' : null }}">
                    Dashboard
                </a>
            </li>
            @if (Auth::user()->level == '0')
                <li class="nav-item">
                    <a href="{{ route('slot.index') }}"
                        class="nav-link text-dark {{ Request::is('slot*') ? 'active fw-bold' : null }}">
                        Slot Parkir
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link text-dark {{ Request::is('user*') ? 'active fw-bold' : null }}">
                        Pengguna
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('pembayaran.index') }}"
                    class="nav-link text-dark {{ Request::is('pembayaran*') ? 'active fw-bold' : null }}">
                    Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transaksi.index') }}"
                    class="nav-link text-dark {{ Request::is('transaksi*') ? 'active fw-bold' : null }}">
                    Transaksi
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profil.index') }}"
                    class="nav-link text-dark {{ Request::is('profil*') ? 'active fw-bold' : null }}">
                    Profil
                </a>
            </li>
        </ul>
    </div>
</div>
