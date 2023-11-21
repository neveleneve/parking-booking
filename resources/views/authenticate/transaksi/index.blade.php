@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row justify-content-center">
            @if (Auth::user()->level == '1')
                <div class="col-12 col-lg-8 mb-3 d-grid gap-2">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-outline-dark fw-bold">
                        Booking Slot Parkir
                    </a>
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
                                    @if (Auth::user()->level == 1)
                                        @if ($item->status == 0 && $item)
                                            <a class="btn btn-sm btn-outline-dark fw-bold" title="Kontrol Slot Parkir"
                                                href="{{ route('transaksi.control', ['id' => $item->id]) }}">
                                                <i class="fa fa-gamepad"></i>
                                                {{-- <span class="d-none d-lg-inline-block">
                                                    Kontrol Slot Parkir
                                                </span> --}}
                                            </a>
                                        @endif
                                        <a class="btn btn-sm btn-dark fw-bold" title="Lihat Detail Pesanan"
                                            href="{{ route('transaksi.show', ['transaksi' => $item->id]) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-sm btn-outline-dark fw-bold" title="Lihat Detail Pesanan"
                                            href="{{ route('transaksi.show', ['transaksi' => $item->id]) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endif
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
