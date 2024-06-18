@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="card profile-card shadow">
                    <div class="profile-image text-center">
                        <img class="img-fluid" src="{{ Auth::user()->getUrlfriendlyAvatar() }}">

                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ Auth::user()->name }}</h5>
                        <h5 class="card-title h6">{{ Auth::user()->email }}</h5>
                        <p class="card-text">
                            Bergabung sejak
                            {{ \App\Http\Controllers\Controller::konversiTanggal(Auth::user()->created_at) }}
                        </p>
                        <div class="d-grid gap-2 mb-3 mb-lg-0">
                            <a href="{{ route('profil.edit') }}" class="btn btn-sm btn-outline-dark fw-bold">
                                Edit Profile
                            </a>
                        </div>
                        <div class="d-grid gap-2 d-inline d-lg-none">
                            <a class="btn btn-sm btn-outline-danger fw-bold" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                Logout
                            </a>
                            <form id="logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
