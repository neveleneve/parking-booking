@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="h6 text-center fw-bold">Saldo Kamu</h6>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center fw-bold">Rp {{ number_format($data->saldo->credit, 0, ',', '.') }}</h3>
                        <div class="row">
                            <div class="col-12 d-grid gap-2">
                                <button class="btn btn-sm btn-outline-dark fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#modalTopUp">
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
                        @if (count($data->transaksi) > 0)
                            @php
                                $jumlah = 0;
                            @endphp
                            @foreach ($data->transaksi as $item)
                                @if ($item->status == 0)
                                    @php
                                        $jumlah++;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($jumlah > 0)
                                <h3 class="text-center fw-bold">
                                    Terdapat {{ $jumlah }} Transaksi Pemesanan yang aktif
                                </h3>
                                <div class="d-grid gap-2">
                                    <a class="btn btn-sm btn-outline-dark fw-bold" href="{{ route('transaksi.index') }}">
                                        Transaksi
                                    </a>
                                </div>
                            @else
                                <h3 class="text-center fw-bold">Tidak Ada Booking-an Aktif</h3>
                            @endif
                        @else
                            <h3 class="text-center fw-bold">Tidak Ada Booking-an Aktif</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTopUp">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Top Up Saldo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('topup.index') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="number" name="total" id="total" class="form-control form-control-sm"
                            placeholder="Jumlah Top Up (Minimal Rp 20.000)" min="20000" step="5000" value="20000">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-outline-dark">Lanjut ke pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
