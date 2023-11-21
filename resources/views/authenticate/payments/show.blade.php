@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 mb-3">
                <div class="card mb-3">
                    <div class="card-header text-bg-dark text-center">
                        <h4 class="fw-bold ">Data Pembayaran</h4>
                    </div>
                    <div class="card-body text-center">
                        <label for="order_id" class="fw-bold">Order ID</label>
                        <input type="text" value="{{ $data->order_id }}" readonly id="order_id"
                            class="form-control-plaintext form-control-sm text-center mb-3">
                        <label for="nominal" class="fw-bold">Nominal Top Up</label>
                        <input type="text" value="Rp {{ number_format($data->nominal, 0, ',', '.') }}" readonly
                            id="nominal" class="form-control-plaintext form-control-sm text-center mb-3">
                        <label for="status" class="fw-bold">Status</label>
                        @if ($data->status != 3)
                            <input type="text" value="Pembayaran dalam proses" readonly id="status"
                                class="form-control-plaintext form-control-sm text-center mb-3">
                        @else
                            <input type="text" value="Pembayaran berhasil" readonly id="status"
                                class="form-control-plaintext form-control-sm text-center mb-3">
                        @endif
                        <label for="tanggal" class="fw-bold">Tanggal Transaksi</label>
                        <input type="text" readonly id="tanggal"
                            class="form-control-plaintext form-control-sm text-center mb-3"
                            value="{{ \App\Http\Controllers\Controller::konversiTanggalWaktu($data->created_at) }}">
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-sm btn-dark fw-bold">
                        Cetak Struk
                    </a>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-danger fw-bold">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
