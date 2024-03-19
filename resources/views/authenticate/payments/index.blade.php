@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row justify-content-center">
            @if (Auth::user()->level == '1')
                <div class="col-12 col-lg-8 d-grid gap-2 mb-3">
                    <button class="btn btn-sm btn-outline-dark fw-bold" data-bs-toggle="modal" data-bs-target="#modalTopUp">
                        Top Up Saldo
                    </button>
                </div>
            @endif
            <div class="col-12 col-lg-8 mb-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-center text-nowrap">
                        <thead class="table-dark">
                            <tr>
                                <th class="d-none d-lg-table-cell">#</th>
                                <th>Order ID</th>
                                @if (Auth::user()->level == 0)
                                    <th>Nama</th>
                                @endif
                                <th>Nominal</th>
                                <th>Waktu</th>
                                <th class="d-none d-lg-table-cell">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    @if (Auth::user()->level == 0)
                                        <td>{{ $item->user->name }}</td>
                                    @endif
                                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>{{ date_format($item->updated_at, 'd/m/Y H:i:s') }}</td>
                                    <td class="d-none d-lg-table-cell">
                                        <span class="badge text-bg-dark">
                                            {{ ucwords(str_replace('_', ' ', $item->transaction_status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('pembayaran.show', ['pembayaran' => $item->order_id]) }}"
                                            class="btn btn-sm btn-outline-dark" title="Lihat Data">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($item->status != '2' && $item->status != '3')
                                            <a href="{{ route('pembayaran.edit', ['pembayaran' => $item->order_id]) }}"
                                                class="btn btn-sm btn-outline-danger" title="Lanjut Pembayaran">
                                                <i class="fas fa-dollar-sign"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    @if (Auth::user()->level == 0)
                                        <td colspan="7" class="d-none d-lg-table-cell">
                                            <h3 class="text-center fw-bold h5">Data Pembayaran Kosong</h3>
                                        </td>
                                        <td colspan="4" class="d-table-cell d-lg-none">
                                            <h3 class="text-center fw-bold h5">Data Pembayaran Kosong</h3>
                                        </td>
                                    @else
                                        <td colspan="6" class="d-none d-lg-table-cell">
                                            <h3 class="text-center fw-bold h5">Data Pembayaran Kosong</h3>
                                        </td>
                                        <td colspan="4" class="d-table-cell d-lg-none">
                                            <h3 class="text-center fw-bold h5">Data Pembayaran Kosong</h3>
                                        </td>
                                    @endif
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTopUp">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Top Up Saldo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('topup.index') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="number" name="total" id="total" class="form-control form-control-sm"
                            placeholder="Jumlah Top Up (Minimal Rp 20.000)" min="20000" step="5000" value="20000">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-outline-dark">Lanjut ke pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
