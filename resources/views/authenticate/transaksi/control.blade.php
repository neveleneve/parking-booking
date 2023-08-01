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
                        <form action="{{ route('control.update') }}" method="post" class="text-center">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="mb-3 row">
                                <label for="kode_transaksi" class="form-label fw-bold">Kode Transaksi</label>
                                <div class="col-12">
                                    <input class="form-control form-control-sm form-control-plaintext text-center" readonly
                                        type="text" name="kode_transaksi" id="kode_transaksi"
                                        value="{{ $data->kode_transaksi }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <div class="col-12">
                                    <span class="badge bg-{{ $data->status ? 'danger' : 'success' }}">
                                        {{ $data->status ? 'Selesai' : 'Aktif' }}
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="palang_status" class="form-label fw-bold">Status</label>
                                <div class="col-12">
                                    @if ($data->slot->status_pakai == 0)
                                        <input type="hidden" name="status_pakai" value="{{ $data->slot->status_pakai }}">
                                        <span class="badge bg-danger">
                                            Tertutup
                                        </span>
                                    @elseif ($data->slot->status_pakai == 1)
                                        <input type="hidden" name="status_pakai" value="{{ $data->slot->status_pakai }}">
                                        <span class="badge bg-success">
                                            Terbuka
                                        </span>
                                    @elseif ($data->slot->status_pakai == 2)
                                        <input type="hidden" name="status_pakai" value="{{ $data->slot->status_pakai }}">
                                        <span class="badge bg-danger">
                                            Tertutup
                                        </span>
                                    @elseif ($data->slot->status_pakai == 3)
                                        <input type="hidden" name="status_pakai" value="{{ $data->slot->status_pakai }}">
                                        <span class="badge bg-success">
                                            Terbuka
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                @if ($data->status == 0)
                                    <button class="btn btn-sm btn-outline-dark fw-bold" type="submit">
                                        @if ($data->slot->status_pakai == 0)
                                            Buka Palang
                                        @elseif ($data->slot->status_pakai == 1)
                                            Tutup Palang
                                        @elseif ($data->slot->status_pakai == 2)
                                            Buka Palang
                                        @elseif ($data->slot->status_pakai == 3)
                                            Tutup Palang
                                        @endif
                                    </button>
                                @endif
                                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-dark">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
