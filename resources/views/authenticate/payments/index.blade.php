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
                                <th>Nominal</th>
                                <th class="d-none d-lg-table-cell">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td class="d-none d-lg-table-cell">
                                        @if ($item->status == '0')
                                            <i class="fa fa-minus-circle" title="Pembayaran dalam proses"></i>
                                        @elseif ($item->status == '1')
                                            <i class="fa fa-times-circle" title="Pembayaran dalam proses"></i>
                                        @elseif ($item->status == '2')
                                            <i class="fa fa-exclamation-circle"
                                                title="Ada kesalahan dalam proses pembayaran"></i>
                                        @elseif ($item->status == '3')
                                            <i class="fa fa-check-circle" title="Pembayaran berhasiil"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('payments.show', ['payment' => $item->order_id]) }}"
                                            class="btn btn-sm btn-outline-dark" title="Lihat Data">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if ($item->status != '3')
                                            <a href="{{ route('payments.edit', ['payment' => $item->order_id]) }}"
                                                class="btn btn-sm btn-outline-danger" title="Lanjut Pembayaran">
                                                <i class="fas fa-dollar-sign"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="d-none d-lg-table-cell">
                                        <h3 class="text-center fw-bold h5">Data Pembayaran Kosong</h3>
                                    </td>
                                    <td colspan="4" class="d-table-cell d-lg-none">
                                        <h3 class="text-center fw-bold h5">Data Pembayaran Kosong</h3>
                                    </td>
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
