@extends('layouts.app-login')

@section('content')
    <div class="content-container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Confirm Top Up</div>

                        <div class="card-body">
                            <p><strong>Order ID :</strong> {{ $data['order_id'] }}</p>
                            <p><strong>Total Top Up : </strong>Rp {{ number_format($data['gross_amount'], 2, ',', '.') }}
                            </p>

                            <div id="snapToken" data-snap-token="{{ $snapToken }}"></div>

                            <button id="pay-button" class="btn btn-primary">Pay Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endsection
