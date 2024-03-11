@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <div class="alert alert-{{ $alert['color'] }}">
                    <i class="fa fa-check-circle fa-2x"></i>
                    <br>
                    <br>
                    <h4>{{ $alert['title'] }}</h4>
                    <p>{{ $alert['content1'] }} <br> {{ $alert['content2'] }}</p>
                    <p>
                        Kembali ke
                        <a class="link-{{ $alert['color'] }}" href="{{ route('pembayaran.index') }}">
                            halaman pembayaran
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
