<div wire:poll.500ms>
    <div class="card">
        <div class="card-header text-bg-dark">
            <h4 class="text-center fw-bold">
                Kontrol Slot Parkir
            </h4>
        </div>
        <div class="card-body text-center">
            <div class="mb-3 row">
                <label for="kode_transaksi" class="form-label fw-bold">Kode Transaksi</label>
                <div class="col-12">
                    <input class="form-control form-control-sm form-control-plaintext text-center" readonly type="text"
                        id="kode_transaksi" value="{{ $data->kode_transaksi }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="status" class="form-label fw-bold">Status Aktif</label>
                <div class="col-12">
                    <span id="status" class="badge bg-{{ $data->status ? 'danger' : 'success' }}">
                        {{ $data->status ? 'Selesai' : 'Aktif' }}
                    </span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="palang_status" class="form-label fw-bold">Status Palang</label>
                <div class="col-12">
                    <span id="palang_status" class="badge {{ $this->statusAttributes['class'] }}">
                        {{ $this->statusAttributes['label'] }}
                    </span>
                </div>
            </div>
            <div class="d-grid gap-2">
                @if ($data->status == 0)
                    <button class="btn btn-sm btn-outline-dark fw-bold"
                        wire:click='controlUpdate("{{ $data->id }}")'>
                        {{ $this->statusAttributes['button'] }}
                    </button>
                @endif
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-danger fw-bold">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@push('custom-js')
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setInterval(() => {
                @this.call('notification', {{ $data->id }});
            }, 500);

            window.addEventListener('notificationEvent', event => {
                const message = event.detail.message;
                Swal.fire({
                    title: event.detail.title,
                    text: event.detail.message,
                    icon: event.detail.icon,
                    showConfirmButton: false
                });
            });
        });
    </script>
@endpush
