@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            @if (Session::has('alert'))
                <div class="col-12 col-lg-8">
                    <div class="alert alert-{{ session('color') }} alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {{ session('alert') }}
                    </div>
                </div>
            @endif
            <div class="col-12 col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header text-bg-dark">
                        <h4 class="text-center fw-bold">
                            Pesan Slot Parkir
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label class="form-label fw-bold">Pilih Slot</label>
                                @forelse ($slot as $item)
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="slot" required
                                                value="{{ $item->id }}" id="radio{{ $item->id }}"
                                                {{ $item->is_booked == 0 && $item->status == 1 ? null : 'disabled' }}>
                                            <label
                                                class="form-check-label {{ $item->is_booked == 0 && $item->status == 1 ? 'text-success' : 'text-danger' }}"
                                                for="radio{{ $item->id }}">
                                                <i class="fa fa-car"></i> {{ $item->name }}
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <h4 class="text-center">
                                            Data Slot Tidak Tersedia
                                        </h4>
                                    </div>
                                @endforelse
                            </div>
                            <div class="mb-3 row">
                                <label for="tanggal" class="form-label fw-bold">Tanggal Pemesanan</label>
                                <div class="col-12">
                                    <input type="datetime-local" name="tanggal" id="tanggal" step="1800"
                                        class="form-control form-control-sm" value="{{ date('Y-m-d\TH') }}:00">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="saldo" class="form-label fw-bold">Saldo</label>
                                <div class="col-12">
                                    <input type="text" name="saldo" id="saldo" disabled
                                        value="Rp {{ number_format($saldo->credit, 0, ',', '.') }}"
                                        class="form-control-plaintext form-control-sm">
                                </div>
                            </div>
                            <input type="hidden" name="credit" value="{{ $saldo->credit }}">
                            <input type="hidden" name="minimum" value="20000">
                            <div class="mb-3 row">
                                <label for="pembayaran" class="form-label fw-bold">Total Pembayaran</label>
                                <div class="col-12">
                                    <input type="text" name="pembayaran" id="pembayaran" disabled value="Rp 20.000"
                                        class="form-control-plaintext form-control-sm">
                                </div>
                            </div>
                            @if ($saldo->credit < 20000)
                                <small class="text-danger">Saldo kamu tidak cukup untuk melakukan pemesanan slot parkir.
                                    Silakan top up terlebih dulu!</small>
                            @else
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="agreement" required value="1"
                                        id="agreement">
                                    <label class="form-check-label" for="agreement">
                                        Saldo anda akan dikurangin setelah melakukan pemesanan.
                                    </label>
                                </div>
                            @endif
                            <div class="d-grid gap-2">
                                @if ($saldo->credit >= 20000)
                                    <button type="submit" class="btn btn-sm btn-outline-dark">Pesan</button>
                                @endif
                                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-dark fw-bold">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
