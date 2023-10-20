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
                            Data Slot Parkir
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <div class="col-12">
                                <input type="text" name="nama" id="nama" class="form-control form-control-sm"
                                    value="{{ $data->name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="token" class="form-label fw-bold">Token</label>
                            <div class="col-12">
                                <input type="text" name="token" id="token" class="form-control form-control-sm"
                                    value="{{ $data->token }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <div class="col-12">
                                <select name="status" id="status" class="form-select form-select-sm">
                                    <option value="1" {{ $data->status ? 'selected' : null }}>Aktif</option>
                                    <option value="0" {{ !$data->status ? 'selected' : null }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label for="status" class="form-label fw-bold">Status</label> --}}
                            <div class="col-12 gap-2 d-grid">
                                <input type="submit" class="btn btn-sm btn-outline-dark fw-bold" value="Perbarui">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            {{-- <label for="status" class="form-label fw-bold">Status</label> --}}
                            <div class="col-12 gap-2 d-grid">
                                <input type="button" class="btn btn-sm btn-outline-danger fw-bold" value="Kembali">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
