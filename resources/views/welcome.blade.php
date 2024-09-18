@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-lg-8 p-5 mb-4 bg-dark text-light rounded-3 shadow-lg">
                <h1 class="display-5 fw-bold text-center">ParkingBoss</h1>
                <p class="fs-4 text-center">
                    Satu Solusi untuk Parkir Kamu
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            @auth
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('landing-page') }}"
                        class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-home"></i>
                        <p class="fw-bold mb-1">Home</p>
                    </a>
                </div>
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('dashboard.index') }}"
                        class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-gauge"></i>
                        <p class="fw-bold mb-1">Dashboard</p>
                    </a>
                </div>
                @if (Auth::user()->level == 0)
                    <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                        <a href="{{ route('slot.index') }}"
                            class="text-light link-offset-2 link-underline link-underline-opacity-0">
                            <i class="fa fa-parking"></i>
                            <p class="fw-bold mb-1">Slot Parkir</p>
                        </a>
                    </div>
                @endif
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('pembayaran.index') }}"
                        class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-dollar-sign"></i>
                        <p class="fw-bold mb-1">Pembayaran</p>
                    </a>
                </div>
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('transaksi.index') }}"
                        class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="far fa-receipt"></i>
                        <p class="fw-bold mb-1">Transaksi</p>
                    </a>
                </div>
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('profil.index') }}"
                        class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-user"></i>
                        <p class="fw-bold mb-1">Profile</p>
                    </a>
                </div>
            @else
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('login') }}" class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-right-to-bracket"></i>
                        <p class="fw-bold mb-1">Login</p>
                    </a>
                </div>
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('register') }}" class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-user-plus"></i>
                        <p class="fw-bold mb-1">Register</p>
                    </a>
                </div>
                <div class="col-6 col-lg-4 bg-dark rounded-5 text-center mb-3">
                    <a href="{{ route('landing-page') }}"
                        class="text-light link-offset-2 link-underline link-underline-opacity-0">
                        <i class="fa fa-right-to-bracket"></i>
                        <p class="fw-bold mb-1">Dashboard</p>
                    </a>
                </div>
            @endauth
        </div>
    </div>
@endsection
