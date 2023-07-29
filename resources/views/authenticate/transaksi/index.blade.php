@extends('layouts.app-login')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            @if (Auth::user()->level == '1')
                <div class="col-12 col-lg-8 mb-3 d-grid gap-2">
                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalNewBook">
                        Booking Slot Parkir
                    </button>
                </div>
                <div class="modal fade" id="modalNewBook" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 h4 fw-bold" id="exampleModalLabel">Booking Slot Parkir</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="slot" class="fw-bold fs-6">Pilih Slot Parkir</label>
                                <select class="form-select form-select-sm mb-3" name="slot" id="slot">
                                    <option selected disabled value="">Pilih Slot Parkir</option>
                                    <option value="A">A</option>
                                </select>
                                <label for="waktu" class="fw-bold fs-6">Atur Waktu</label>
                                <input type="datetime-local" name="waktu" id="waktu"
                                    class="form-control form-control-sm">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-dark">Lanjut Pembayaran</button>
                            </div>
                        </div>
                    </div>
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
