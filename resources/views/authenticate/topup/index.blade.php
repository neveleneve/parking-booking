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
                        <input type="text" value="Rp {{ number_format($data['gross_amount'], 0, ',', '.') }}" readonly
                            id="nominal" class="form-control-plaintext form-control-sm text-center mb-3">
                        <div id="snapToken" data-snap-token="{{ $snapToken }}"></div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button id="pay-button" class="btn btn-sm btn-outline-dark">Pay Now</button>
                </div>
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
