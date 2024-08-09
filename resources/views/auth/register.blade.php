@extends('layouts.app-login')
@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end  fw-bold">
                                    Nama Lengkap
                                </label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">
                                    Alamat Email
                                </label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end  fw-bold">
                                    Kata Sandi
                                </label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end fw-bold">
                                    Konfirmasi Kata Sandi
                                </label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-12 col-md-6 offset-md-4">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="toc" required
                                            value="1" id="toc">
                                        <label class="form-check-label" for="toc">
                                            Sudah membaca syarat dan ketentuan.
                                        </label>
                                        <button type="button" class="btn btn-sm btn-link text-dark" data-bs-toggle="modal"
                                            data-bs-target="#modalTOC">
                                            <i class="fas fa-circle-question"></i>
                                        </button>
                                        <div class="modal modal-xl fade" id="modalTOC" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">
                                                            Syarat dan Ketentuan
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h1 class="h4 fw-bold">
                                                            Syarat dan Ketentuan Pemakaian Aplikasi ParkingBoss
                                                        </h1>
                                                        <ol class="list-group list-group-numbered">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Pengantar
                                                                    </div>
                                                                    <p>
                                                                        Selamat datang di <b>{{ env('APP_NAME') }}</b>,
                                                                        aplikasi yang memungkinkan Anda untuk melakukan
                                                                        pemesanan slot parkir. Dengan menggunakan aplikasi
                                                                        ini,
                                                                        Anda menyetujui untuk terikat dengan syarat dan
                                                                        ketentuan yang diuraikan di bawah ini. Harap baca
                                                                        dengan
                                                                        seksama sebelum menggunakan layanan kami.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Definisi
                                                                    </div>
                                                                    <ul>
                                                                        <li><strong>Pengguna</strong> adalah individu yang
                                                                            mendaftar dan menggunakan aplikasi
                                                                            <b>{{ env('APP_NAME') }}</b>.
                                                                        </li>
                                                                        <li><strong>Slot Parkir</strong> adalah ruang parkir
                                                                            yang bisa dipesan melalui aplikasi.</li>
                                                                        <li><strong>Transaksi</strong> adalah proses
                                                                            pemesanan
                                                                            slot yang melibatkan pembayaran Rp. 20.000 per
                                                                            sesi
                                                                            parkir.
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Pengguna Aplikasi
                                                                    </div>
                                                                    <p>
                                                                        Aplikasi ini terbuka untuk digunakan oleh umum yang
                                                                        telah mencapai usia legal untuk mengikat kontrak.
                                                                        Pengguna harus mendaftar dengan memberikan informasi
                                                                        yang valid dan lengkap serta menjaga kerahasiaan
                                                                        akun
                                                                        dan kata sandi.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Biaya dan Pembayaran
                                                                    </div>
                                                                    <p>
                                                                        Biaya untuk setiap transaksi pemesanan slot parkir
                                                                        adalah Rp. 20.000. Pembayaran dapat dilakukan
                                                                        melalui
                                                                        metode yang telah disediakan oleh aplikasi, seperti
                                                                        transfer bank, kartu kredit, atau e-wallet. Semua
                                                                        pembayaran dianggap final kecuali dinyatakan lain
                                                                        dalam
                                                                        kebijakan pembatalan.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Batasan Kewajiban
                                                                    </div>
                                                                    <p>
                                                                        <b>{{ env('APP_NAME') }}</b> tidak bertanggung jawab
                                                                        atas kerusakan, kehilangan, atau pencurian barang
                                                                        pribadi di area parkir. Tanggung jawab kami terbatas
                                                                        pada penyediaan platform untuk pemesanan slot
                                                                        parkir.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Kebijakan Privasi
                                                                    </div>
                                                                    <p>
                                                                        Informasi pribadi yang dikumpulkan dari pengguna
                                                                        akan
                                                                        digunakan sesuai dengan kebijakan privasi yang dapat
                                                                        diakses di aplikasi.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Perubahan pada Syarat dan Ketentuan
                                                                    </div>
                                                                    <p>
                                                                        <b>{{ env('APP_NAME') }}</b> berhak untuk mengubah
                                                                        syarat dan ketentuan kapan saja. Perubahan akan
                                                                        diumumkan melalui aplikasi atau melalui email.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Hak Kekayaan Intelektual
                                                                    </div>
                                                                    <p>
                                                                        Konten dalam aplikasi, termasuk teks, grafik, logo,
                                                                        adalah milik <b>{{ env('APP_NAME') }}</b> dan
                                                                        dilindungi oleh hukum hak cipta.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Penyelesaian Sengketa
                                                                    </div>
                                                                    <p>
                                                                        Segala sengketa yang timbul terkait penggunaan
                                                                        aplikasi
                                                                        ini akan diselesaikan melalui mediasi atau, jika
                                                                        perlu,
                                                                        arbitrase di lokasi yang telah disepakati.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Penghentian dan Pembatasan Akses
                                                                    </div>
                                                                    <p>
                                                                        Kami berhak untuk menghentikan atau membatasi akses
                                                                        Anda
                                                                        ke aplikasi jika Anda melanggar syarat dan ketentuan
                                                                        ini.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-start">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">
                                                                        Kontak dan Dukungan
                                                                    </div>
                                                                    <p>
                                                                        Untuk pertanyaan atau dukungan lebih lanjut,
                                                                        silahkan
                                                                        hubungi <a
                                                                            href="mailto:{{ strtolower(env('MAIL_FROM_ADDRESS')) }}">{{ strtolower(env('MAIL_FROM_ADDRESS')) }}</a>.
                                                                    </p>
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-outline-dark fw-bold"
                                                            data-bs-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-12 col-md-6 offset-md-4 d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-outline-dark fw-bold">
                                        Daftar
                                    </button>
                                </div>
                                <div class="col-12 col-md-6 offset-md-4 d-grid gap-2 mb-3">
                                    <a href="{{ route('login') }}" class="btn btn-dark fw-bold">
                                        Sudah memiliki akun? Masuk disini!
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
