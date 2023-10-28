@extends('layouts.app-login')

@push('livewire-style')
    @livewireStyles
@endpush

@push('livewire-script')
    @livewireScripts
@endpush

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header text-bg-dark">
                        <h4 class="text-center fw-bold">
                            Data Slot Parkir
                        </h4>
                    </div>
                    <form class="card-body" action="{{ route('slot.update', ['slot' => $data->id]) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="mb-3 row">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <div class="col-12">
                                <input type="text" name="nama" id="nama" class="form-control form-control-sm"
                                    value="{{ $data->name }}">
                            </div>
                        </div>
                        <label for="token" class="form-label fw-bold">Token</label>
                        @livewire('token-generate', ['ids' => $data->id])
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
                            <div class="col-12 gap-2 d-grid">
                                <input type="submit" class="btn btn-sm btn-outline-dark fw-bold" value="Perbarui">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-12 gap-2 d-grid">
                                <a href="{{ route('slot.index') }}" class="btn btn-sm btn-outline-danger fw-bold">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
