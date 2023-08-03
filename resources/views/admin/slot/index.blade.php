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
            <div class="col-12 col-lg-8 mb-3 d-grid gap-2">
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
                        <form action="{{ route('slot.store') }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-12 col-form-label fw-bold">Nama Slot Parkir</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control form-control-sm" id="name"
                                            name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                                <button type="submit" class="btn btn-sm btn-outline-dark">Tambah Slot Parkir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 mb-3">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th></th>
                            <th class="d-none d-lg-table-cell">#</th>
                            <th>Nama</th>
                            <th>Token</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td>
                                    <span class="badge bg-{{ $item->status ? 'success' : 'danger' }}">
                                        {{-- {{ $item->status ? 'Aktif' : 'Non-Aktif' }} --}}
                                    </span>
                                </td>
                                <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->token }}</td>
                                <td>
                                    <a href="{{ route('slot.show', ['slot' => $item->id]) }}"
                                        class="btn btn-sm btn-outline-dark">
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
