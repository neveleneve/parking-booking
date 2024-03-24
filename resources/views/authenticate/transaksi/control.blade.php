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
                @livewire('controlling', ['transaction_id' => $data->id])
            </div>
        </div>
    </div>
@endsection
