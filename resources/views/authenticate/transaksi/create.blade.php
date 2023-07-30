@extends('layouts.app-login')
@section('content')
    <div class="content">
        <div class="row justify-content-center">
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
                            <label class="form-label fw-bold">Pilih Slot</label>
                            @forelse ($slot as $item)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioSlot" required
                                        value="{{ $item->id }}" id="radio{{ $item->id }}"
                                        {{ $item->is_booked == 1 ? null : 'disabled' }}>
                                    <label class="form-check-label" for="radio{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @empty
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioSlot" required value="0"
                                        id="radio0" disabled>
                                    <label class="form-check-label" for="radio0">
                                        Slot Belum Tersedia
                                    </label>
                                </div>
                            @endforelse
                            <br>
                            <label for="tanggal" class="form-label fw-bold">Tanggal Pemesanan</label>
                            <input type="datetime-local" name="tanggal" id="tanggal"
                                class="form-control form-control-sm mb-3" value="{{ date('Y-m-d\TH:i') }}">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-sm btn-outline-dark">Pesan</button>
                                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-dark">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
