@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            @if (Auth::user()->level == '1')
                <div class="col-12 col-lg-8 mb-3 d-grid gap-2">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-outline-dark fw-bold">
                        Booking Slot Parkir
                    </a>
                </div>
            @endif
            @if (Session::has('alert'))
                <div class="col-12 col-lg-8">
                    <div class="alert alert-{{ session('color') }} alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {{ session('alert') }}
                    </div>
                </div>
            @endif
            <div class="col-12 col-lg-8 mb-3">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="d-none d-lg-table-cell">#</th>
                            <th>Kode Transaksi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>
                                    <span class="badge bg-{{ $item->status ? 'danger' : 'success' }}">
                                        {{ $item->status ? 'Selesai' : 'Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($item->status == 0 && $item)
                                        <a class="btn btn-sm btn-outline-dark" title="Kontrol Slot Parkir"
                                            href="{{ route('transaksi.control', ['id' => $item->id]) }}">
                                            <i class="fa fa-gamepad"></i>
                                            <span class="d-none d-lg-inline-block">
                                                Kontrol Slot Parkir
                                            </span>
                                        </a>
                                    @endif
                                    <a class="btn btn-sm btn-dark" title="Lihat Detail Pesanan"
                                        href="{{ route('transaksi.show', ['transaksi' => $item->id]) }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="d-none d-lg-inline-block">
                                            Lihat Detail Pesanan
                                        </span>
                                    </a>
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
                {{ $data->links('layouts.pagination-sm') }}
            </div>
        </div>
    </div>
@endsection
