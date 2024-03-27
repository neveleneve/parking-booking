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
                        @if (Auth::user()->level == 0)
                            <div class="mb-3 row">
                                <label class="fw-bold" for="name">Nama</label>
                                <div class="col-12">
                                    <input type="text" id="name" class="form-control"
                                        value="{{ $transaksi->user->name }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="fw-bold" for="email">Email</label>
                                <div class="col-12">
                                    <input type="text" id="email" class="form-control"
                                        value="{{ $transaksi->user->email }}" readonly>
                                </div>
                            </div>
                        @endif
                        <div class="mb-3 row">
                            <label class="fw-bold" for="slot">Slot</label>
                            <div class="col-12">
                                <input type="text" id="slot" class="form-control"
                                    value="{{ $transaksi->slot->name }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="fw-bold" for="date">Tanggal Booking</label>
                            <div class="col-12">
                                <input type="text" id="date" class="form-control" readonly
                                    value="{{ date_format($transaksi->created_at, 'd/m/Y H:i:s') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="fw-bold" for="date_in">Tanggal Masuk</label>
                            <div class="col-12">
                                <input type="text" id="date_in" class="form-control" readonly
                                    value="{{ $transaksi->jam_masuk == null ? '-' : date_format($transaksi->jam_masuk, 'd/m/Y H:i:s') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="fw-bold" for="date_off">Tanggal Keluar</label>
                            <div class="col-12">
                                <input type="text" id="date_off" class="form-control" readonly
                                    value="{{ $transaksi->jam_keluar == null ? '-' : date_format($transaksi->jam_keluar, 'd/m/Y H:i:s') }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="fw-bold" for="status">Status</label>
                            <div class="col-12">
                                <input type="text" id="status" class="form-control" readonly
                                    value="{{ $transaksi->status ? 'Selesai' : 'Aktif' }}">
                            </div>
                        </div>
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
