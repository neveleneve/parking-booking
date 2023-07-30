@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <div class="alert alert-success">
                    <i class="fa fa-check-circle fa-2x"></i>
                    <br>
                    <br>
                    <h4>Payment Successful!</h4>
                    <p>Proses pembayaran berhasil. <br> Terima kasih sudah melakukan top up.</p>
                    <p>Kembali ke <a class="link-success" href="{{ route('payments.index') }}">halaman pembayaran</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
