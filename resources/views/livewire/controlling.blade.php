<div class="card" wire:poll>
    <div class="card-header text-bg-dark">
        <h4 class="text-center fw-bold">
            Kontrol Slot Parkir
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
                        type="text" name="kode_transaksi" id="kode_transaksi" value="{{ $data->kode_transaksi }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="form-label fw-bold">Status Aktif</label>
                <div class="col-12">
                    <span class="badge bg-{{ $data->status ? 'danger' : 'success' }}">
                        {{ $data->status ? 'Selesai' : 'Aktif' }}
                    </span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="palang_status" class="form-label fw-bold">Status Palang</label>
                <div class="col-12">
                    <input type="hidden" name="status_pakai" value="{{ $data->slot->status_pakai }}">
                    <span class="badge {{ $this->statusAttributes['class'] }}">
                        {{ $this->statusAttributes['label'] }}
                    </span>
                </div>
            </div>
            <div class="d-grid gap-2">
                @if ($data->status == 0)
                    <button class="btn btn-sm btn-outline-dark fw-bold" type="submit">
                        {{ $this->statusAttributes['button'] }}
                    </button>
                @endif
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-danger fw-bold">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@push('custom-js')
@endpush
