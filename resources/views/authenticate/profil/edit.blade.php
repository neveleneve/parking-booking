@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="card shadow">
                    <div class="card-header bg-dark text-light">
                        <h3 class="fw-bold text-center">Edit Profil</h3>
                    </div>
                    <div class="card-body text-center">
                        <form class="row" method="POST"
                            action="{{ route('profil.update', ['profil' => Auth::user()->id]) }}">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="col-12 mb-3">
                                <label for="nama" class="fw-bold">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="form-control form-control-sm text-center" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-12 gap-2 d-grid mb-3">
                                <button class="btn btn-sm btn-outline-dark fw-bold">
                                    Simpan
                                </button>
                            </div>
                            <div class="col-12 gap-2 d-grid">
                                <a class="btn btn-sm btn-outline-danger fw-bold" href="{{ route('profil.index') }}">
                                    Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
