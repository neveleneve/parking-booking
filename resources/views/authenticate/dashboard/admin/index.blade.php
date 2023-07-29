@extends('layouts.app-login')

@section('content')
    <div class="content-container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 mb-3">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h6 class="h6 text-center fw-bold">Saldo Kamu</h6>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center fw-bold">Rp 50.000</h3>
                            <div class="row">
                                <div class="col-12 d-grid gap-2">
                                    <button class="btn btn-sm btn-outline-dark fw-bold">
                                        Top Up Saldo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 mb-3">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h6 class="h6 text-center fw-bold">Booking-an Kamu</h6>
                        </div>
                        <div class="card-body">
                            {{-- ubah disini untuk transaksi aktif --}}
                            <h3 class="text-center fw-bold">Tidak Ada Booking-an Aktif</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
