@extends('layouts.app-login')

@section('content')
    <div class="content-container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 mb-3">
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th class="d-none d-lg-table-cell">#</th>
                                <th>Order ID</th>
                                <th>Nominal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary" title="Lihat Data">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
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
@endsection
