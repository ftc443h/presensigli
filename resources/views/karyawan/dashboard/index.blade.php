@extends('karyawan.layouts.index')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title fs-2">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cols-1 row-cols-md-2 justify-content-center g-4">

                {{-- PRESENSI MASUK --}}
                <div class="col">
                    <div class="card text-center h-100 shadow rounded-3">
                        <div class="card-header bg-primary text-white fs-4">
                            Presensi Masuk
                        </div>
                        <div class="card-body py-4">
                            @if ($cekPresensi && $cekPresensi->tanggal_masuk === date('Y-m-d') && $cekPresensi->jam_masuk)
                                <i class="fa-regular fa-circle-check fa-4x text-success my-3"></i>
                                <p class="fs-4 text-success mb-1">
                                    Anda sudah melakukan presensi masuk
                                </p>
                                <p class="fs-5">
                                    <strong>{{ \Carbon\Carbon::parse($cekPresensi->tanggal_masuk)->locale('id')->translatedFormat('l, d F Y') }}</strong><br>
                                    Pukul {{ \Carbon\Carbon::parse($cekPresensi->jam_masuk)->translatedFormat('H:i') }}
                                    {{ $lokasi->zona_waktu }}
                                </p>
                            @else
                                <div id="date-in" class="fs-3 text-muted mb-1"></div>
                                <div id="time-in" class="fs-1 fw-bold mb-3"></div>
                                <a href="{{ route('presensi.masuk') }}" class="btn btn-primary fs-5 px-4">
                                    <i class="fas fa-sign-in-alt me-1"></i> Masuk
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- PRESENSI KELUAR --}}
                <div class="col">
                    <div class="card text-center h-100 shadow rounded-3">
                        <div class="card-header bg-danger text-white fs-4">
                            Presensi Keluar
                        </div>
                        <div class="card-body py-4">
                            @php
                                $waktuSekarang = now()->format('H:i:s');
                                $waktuPulang = $lokasi->jam_pulang;
                            @endphp
                            @if (strtotime($waktuSekarang) <= strtotime($waktuPulang))
                                <i class="fa-regular fa-circle-xmark fa-4x text-danger my-3"></i>
                                <p class="fs-4 text-danger mb-1">
                                    Belum waktunya pulang.
                                </p>
                                <small class="text-muted">
                                    Presensi akan dibuka pada pukul
                                    <strong>
                                        {{ \Carbon\Carbon::parse($waktuPulang)->format('H:i') }}
                                    </strong>
                                    {{ $lokasi->zona_waktu }}
                                </small>
                            @else
                                @if ($cekPresensi && $cekPresensi->tanggal_masuk === date('Y-m-d') && $cekPresensi->jam_keluar)
                                    <i class="fa-regular fa-circle-check fa-4x text-success my-3"></i>
                                    <p class="fs-4 text-success mb-1">
                                        Anda sudah melakukan presensi keluar
                                    </p>
                                    <p class="fs-5">
                                        <strong>
                                            {{ \Carbon\Carbon::parse($cekPresensi->tanggal_keluar)->locale('id')->translatedFormat('l, d F Y') }}
                                        </strong><br>
                                        Pukul {{ \Carbon\Carbon::parse($cekPresensi->jam_keluar)->translatedFormat('H:i') }}
                                        {{ $lokasi->zona_waktu }}
                                    </p>
                                @elseif ($cekPresensi && $cekPresensi->jam_masuk && !$cekPresensi->jam_keluar)
                                    <div id="date-out" class="fs-3 text-muted mb-1"></div>
                                    <div id="time-out" class="fs-1 fw-bold mb-3"></div>
                                    <a href="{{ route('presensi.keluar') }}" class="btn btn-danger fs-5 px-4">
                                        <i class="fas fa-sign-out-alt me-1"></i> Keluar
                                    </a>
                                @else
                                    <i class="fa-regular fa-circle-xmark fa-4x text-danger my-3"></i>
                                    <p class="text-muted fs-3">
                                        Silahkan melakukan presensi masuk terlebih dahulu.
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        function updateClock() {
            const now = new Date();
            const dateOptions = {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            };
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            const date = now.toLocaleDateString('id-ID', dateOptions);
            const time = now.toLocaleTimeString('en-GB', timeOptions);

            if (document.getElementById('date-in')) document.getElementById('date-in').textContent = date;
            if (document.getElementById('time-in')) document.getElementById('time-in').textContent = time;
            if (document.getElementById('date-out')) document.getElementById('date-out').textContent = date;
            if (document.getElementById('time-out')) document.getElementById('time-out').textContent = time;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endsection
