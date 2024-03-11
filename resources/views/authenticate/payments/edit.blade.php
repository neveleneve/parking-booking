@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header text-center text-bg-dark">
                        <h4 class="fw-bold">Konfirmasi Top Up</h4>
                    </div>
                    <div class="card-body text-center">
                        <label for="order_id" class="fw-bold">Order ID</label>
                        <input type="text" value="{{ $data['order_id'] }}" readonly id="order_id"
                            class="form-control-plaintext form-control-sm text-center mb-3">
                        <label for="nominal" class="fw-bold">Nominal Top Up</label>
                        <input type="text" value="Rp {{ number_format($data['nominal'], 0, ',', '.') }}" readonly
                            id="nominal" class="form-control-plaintext form-control-sm text-center mb-3">
                        <div id="snapToken" data-snap-token="{{ $data['snap_token'] }}"></div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button id="pay-button" class="btn btn-sm btn-outline-dark fw-bold">
                        Pay Now
                    </button>
                    <button class="btn btn-sm btn-outline-warning fw-bold" data-bs-toggle="modal"
                        data-bs-target="#modalCancelPayment">
                        Batalkan Pembayaran
                    </button>
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-danger fw-bold">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCancelPayment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Batalkan Top Up Saldo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('payment.cancel') }}" method="post">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $data['order_id'] }}">
                    <div class="modal-body">
                        <p>Batalkan pembayaran Top Up?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-outline-dark">Lanjutkan Pembatalan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('app.midtrans_client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').onclick = function() {
            const snapToken = document.getElementById('snapToken').dataset.snapToken;
            snap.pay(snapToken);
        };
    </script>
@endpush
