@extends('karyawan.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">Presensi Masuk</h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <!-- MAP -->
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">Lokasi Anda</div>
                        <div class="card-body p-0">
                            <div id="map" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <!-- CAMERA -->
                <div class="col-12 col-md-6">
                    <div class="card text-center">
                        <div class="card-header">Presensi Kamera</div>
                        <div class="card-body">
                            <input type="hidden" id="latitude">
                            <input type="hidden" id="longitude">

                            <div class="d-flex justify-content-center mb-3">
                                <div id="my_camera"></div>
                            </div>
                            <div id="tanggal_jam_live" class="fw-bold text-muted fs-5 mb-2"></div>

                            <button class="btn btn-primary w-100" id="take-photo">Presensi Masuk</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- WebcamJS & Leaflet --}}
    <script>
        let latitude = null;
        let longitude = null;

        try {
            // 🕒 Live Tanggal & Jam
            function updateClock() {
                const now = new Date();
                const dateString = now.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
                const timeString = now.toLocaleTimeString('en-GB', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                const waktuLive = document.getElementById('tanggal_jam_live');
                if (waktuLive) {
                    waktuLive.innerText = `${dateString} - ${timeString}`;
                }
            }

            setInterval(updateClock, 1000);
            updateClock();
        } catch (err) {
            console.error("Gagal update jam:", err);
        }

        try {
            // 🗺️ Peta dengan Leaflet
            let latitude_kantor = {{ $lokasi->latitude }};
            let longitude_kantor = {{ $lokasi->longitude }};
            let radius = {{ $lokasi->radius }};
            const mapContainer = document.getElementById('map');

            if (mapContainer && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    latitude = position.coords.latitude;
                    longitude = position.coords.longitude;

                    const map = L.map('map').setView([latitude, longitude], 16);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; OpenStreetMap'
                    }).addTo(map);

                    L.marker([latitude, longitude])
                        .addTo(map)
                        .bindPopup("Lokasi Anda").openPopup();

                    L.circle([latitude_kantor, longitude_kantor], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: radius
                        })
                        .addTo(map)
                        .bindPopup("Lokasi Kantor").openPopup();
                }, function(err) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal mendapatkan lokasi. Izinkan akses lokasi di browser.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error("Geolocation error:", err);
                });
            }
        } catch (err) {
            console.error("Gagal menampilkan peta:", err);
        }

        // 🖼️ WebcamJS
        Webcam.set({
            width: 300,
            height: 240,
            dest_width: 300,
            dest_height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        // 📷 Kamera & Snap Foto
        Webcam.attach('#my_camera');

        $('#take-photo').on('click', function() {

            navigator.geolocation.getCurrentPosition(function(position) {
                const lat = position.coords.latitude;
                const long = position.coords.longitude;

                Webcam.snap(function(data_uri) {
                    let now = new Date();
                    
                    // Ambil tanggal & jam lokal (bukan UTC!)
                    let tanggal = now.getFullYear() + '-' +
                        String(now.getMonth() + 1).padStart(2, '0') + '-' +
                        String(now.getDate()).padStart(2, '0');

                    let jam = String(now.getHours()).padStart(2, '0') + ':' +
                        String(now.getMinutes()).padStart(2, '0') + ':' +
                        String(now.getSeconds()).padStart(2, '0');

                    console.log({
                        photo: data_uri,
                        latitude: lat,
                        longitude: long,
                        tanggal: tanggal,
                        jam: jam
                    });

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('presensi.store') }}',
                        data: {
                            _token: "{{ csrf_token() }}",
                            photo: data_uri,
                            latitude: lat,
                            longitude: long,
                            tanggal: tanggal,
                            jam: jam
                        },
                        success: function(res) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: res.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                            setTimeout(() => {
                                window.location.href =
                                    '/dashboard-karyawan/dashboard';
                            }, 3000);
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }

                    });
                });
            }, function(err) {
                alert("Gagal mendapatkan lokasi.");
                console.error("Geolocation error:", err);
            });
        });
    </script>
@endsection
