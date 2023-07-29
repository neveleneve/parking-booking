@extends('layouts.app-login')


@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 mb-3 d-grid gap-2">
                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalNewBook">
                    Tambah Slot Parkir
                </button>
            </div>
            <div class="modal fade" id="modalNewBook" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 h4 fw-bold" id="exampleModalLabel">Tambah Slot Parkir</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
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
            <div class="col-12 col-lg-8 mb-3">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="d-none d-lg-table-cell">#</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('slot.show', ['slot' => $item->id]) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <h3 class="text-center fw-bold">Data Slot Parkir Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
