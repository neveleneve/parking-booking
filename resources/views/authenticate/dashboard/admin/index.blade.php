@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 mb-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="h6 text-center fw-bold">Pemesanan Hari ini</h6>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center fw-bold">{{ count($data) }} Pemesanan</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 mb-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="h6 text-center fw-bold">Pemasukan Hari ini</h6>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center fw-bold">Rp {{ number_format(count($data) * 20000, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
