@extends('layouts.app-login')

@section('content')
    <div class="content">
        @include('layouts.navtab')
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 mb-3">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="d-none d-lg-table-cell">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $item)
                            <tr>
                                <td class="d-none d-lg-table-cell">{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>Rp {{ number_format($item->saldo->credit, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('user.show', ['user' => $item->id]) }}"
                                        class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h3 class="text-center fw-bold">Data Transaksi Kosong</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $user->links('layouts.pagination-sm') }}
            </div>
        </div>
    </div>
@endsection
