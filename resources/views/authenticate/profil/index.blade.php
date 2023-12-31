@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="card profile-card shadow">
                    <div class="profile-image text-center">
                        <img class="img-fluid" src="{{ asset('image/profile/default.png') }}" alt="Profile Photo">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">{{ Auth::user()->name }}</h5>
                        <h5 class="card-title h6">{{ Auth::user()->email }}</h5>
                        <p class="card-text">
                            Bergabung sejak
                            {{ \App\Http\Controllers\Controller::konversiTanggal(Auth::user()->created_at) }}
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('profil.edit', ['profil' => Auth::user()->id]) }}"
                                class="btn btn-sm btn-outline-dark fw-bold">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-css')
    <style>
        .profile-card {
            padding: 20px;
            border-radius: 10px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
        }
    </style>
@endsection
