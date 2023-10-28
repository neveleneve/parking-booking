@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center mb-3">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header text-bg-dark text-center">
                        <h4 class="fw-bold ">Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 d-grid gap-2">
                <a class="btn btn-sm btn-outline-danger fw-bold" href="{{ route('transaksi.index') }}">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
