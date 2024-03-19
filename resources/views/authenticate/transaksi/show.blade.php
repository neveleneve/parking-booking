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
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $transaksi->user->name }}" readonly>
                                </div>
                            </div>
                        @endif
                        <div class="mb-3 row">
                            <label class="fw-bold" for="slot">Slot</label>
                            <div class="col-12">
                                <input type="text" name="slot" id="slot" class="form-control"
                                    value="{{ $transaksi->slot->name }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="fw-bold" for="date">Tanggal Booking</label>
                            <div class="col-12">
                                <input type="text" name="date" id="date" class="form-control"
                                    value="{{ date_format($transaksi->created_at, 'd/m/Y H:i:s') }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="fw-bold" for="status">Status</label>
                            <div class="col-12">
                                <input type="text" name="status" id="status" class="form-control"
                                    value="{{ $transaksi->status ? 'Selesai' : 'Aktif' }}" readonly>
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
