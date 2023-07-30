@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            @if (Auth::user()->level == '1')
                <div class="col-12 col-lg-8 mb-3 d-grid gap-2">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-outline-dark">
                        Booking Slot Parkir
                    </a>
                </div>
            @endif
            <div class="col-12 col-lg-8 mb-3">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="d-none d-lg-table-cell">#</th>
                            <th>Kode Transaksi</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="d-none d-lg-table-cell">{{ $loop->index }}</td>
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>{{ $item->status_pembayaran }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center fw-bold h5">Data Transaksi Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
